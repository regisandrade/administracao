<?php
header('Content-type: application/pdf; charset=iso-8859-1');
define('FPDF_FONTPATH','../../fpdf/font/');
require('../../fpdf/fpdf.php');

class verVagaPdf extends FPDF{
    function Header(){
        $this->SetFont('helvetica','B',15);
        $this->Image('../../imagens/ipeconPdf.jpg',5,10);
        $this->Cell(40,6,'');
        $this->Cell(160,6,'I P E C O N', 0, 1, 'C');
        $this->Ln(3);
        $this->Cell(40,6,'');
        $this->Cell(160,6,iconv('UTF-8','ISO-8859-1','Notas e Frequência'), 0, 1, 'C');
        $this->Ln(6);
        $this->Cell(200,0,'', 1, 1);
    }
    function conteudo(){
        require('../../../conexao.php');

        $sql = "SELECT
                    DISTINCT
                    AC.Turma,
                    DIS.Nome AS NomeDisciplina,
                    AC.Nota,
                    AC.Frequencia
                FROM
                    alunos_academicos AC
                INNER JOIN disciplina DIS ON
                    DIS.Codg_Disciplina = AC.Disciplina
                WHERE
                        AC.Turma = '".$_GET['turma']."'
                    AND AC.Aluno = '".$_GET['idAluno']."'
                ORDER BY
                    DIS.Nome";

        $resultado = mysql_query($sql);
        $numero    = mysql_num_rows($resultado);

        $this->nomeArquivo = "temp/nota_frequencia_".$_REQUEST['turma']."_".$_REQUEST['nomeAluno'].".pdf";
        $this->AddPage();

        $this->Ln(10);
        $this->SetFont('helvetica','B',11);
        $this->Cell(20,6,'Turma: ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(180,6,$_REQUEST['turma'].' - '.$_REQUEST['nomeTurma'], 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(20,6,'Aluno(a): ', 0, 0, 'L');
        $this->SetFont('helvetica','',11);
        $this->Cell(180,6,$_REQUEST['nomeAluno'], 0, 1, 'L');
        $this->SetFont('helvetica','B',11);
        $this->Cell(200,0,'', 1, 1);

        // Cabeçalho
        $this->SetFillColor(205,205,193);
        $this->SetFont('helvetica','B',11);
        $this->Cell(150,6,'Disciplina ', 'BT', 0, 'L', true);
        $this->Cell(25,6,iconv('UTF-8','ISO-8859-1','Frequência'), 'BT', 0, 'C', true);
        $this->Cell(25,6,'Disciplina ', 'BT', 1, 'C', true);
        $this->SetFont('helvetica','',11);

        $numero = 1;
        $conta = 0;
        $this->SetFillColor(255,255,240);
        while($dados = mysql_fetch_array($resultado)){
            if($conta % 2 == 1){
                $cor = 'true';
            }else{
                $cor = '';
            }
            $this->Cell(150,6,sprintf('%02s',$numero).'. '.$dados['NomeDisciplina'], 'TB', 0, 'L', $cor);
            $this->Cell(25,6,$dados['Frequencia'], 'TB', 0, 'C', $cor);
            $this->Cell(25,6,number_format($dados['Nota'],1,',','.'), 'TB', 1, 'C', $cor);
            
            $numero++;
            $conta++;
        }
    }

    function Footer(){
        $this->SetY(-15);
        $this->Cell(200,4,' ', 'B', 1);
        $this->SetFont('arial','',7);
        $this->Cell(200,4,'IPECON - Consultoria e Treinamento', 0, 1, 'C');
        $this->Cell(200,4,'Sua pós-graduação com qualidade.', 0, 1, 'C');
    }
}// Fim classe

$pdf = new verVagaPdf('P','mm','A4'); // Cria um arquivo novo tipo A4, na vertical.
$pdf->Open(); // inicia documento
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(10);
$pdf->SetAuthor("Regis Andrade"); // Define o autor
$pdf->conteudo();
$pdf->Output();
?>