<?php
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');

//header('Content-Type: text/html; charset=UTF-8');

class visualizarHistoricoEscolar extends FPDF{

	// Cabecalho
	function Header(){
		//$this->Image('../imagens/ipeconPdf.jpg',90,5,25);
		if($_REQUEST['curso'] == 5 && $this->codgTurma > 'GP004'){
			$this->Image('../imagens/FacAvila.jpg',170,20,35);
			$this->SetFont('arial','',12);
			$this->Cell(200,6,'FACULDADE ÁVILA', 0, 1, 'C');
		}else{
			//$this->Image('../imagens/catolicaPdf.jpg',170,5,35);
			$this->SetFont('arial','',13);
			$this->Cell(200,6,'PUC GOIÁS', 0, 1, 'C');
			$this->Cell(200,6,'PRO-REITORIA DE PÓS-GRADUAÇÃO E PESQUISA', 0, 1, 'C');
			$this->Cell(200,6,'COORDENAÇÃO DE PÓS-GRADUAÇÃO LATO SENSU', 0, 1, 'C');
			$this->Cell(200,6,'IPECON - ENSINO E CONSULTORIA', 0, 1, 'C');
		}
		$this->Ln(20);
		$this->SetFont('arial','B',18);
		$this->Cell(200,4,'HISTÓRICO ESCOLAR', 0, 1, 'C');
		$this->Ln(20);
	}// Fim cabecalho

	// Conteudo
	function conteudo(){
		require('../conexao.inc.php');

		$this->AddPage();

		$sql = "select distinct
						AA.Turma
					   ,TUR.Nome as NomeTurma
					   ,DIS.Nome as Disciplina
					   ,DIS.Horas_Aula
					   ,AA.Nota
					   ,AA.Aluno
					   ,ALU.Nome as NomeAluno
				from
						alunos_academicos AA
				inner join disciplina DIS on
						DIS.Codg_Disciplina = AA.Disciplina
				inner join aluno ALU on
				        ALU.Id_Numero = AA.Aluno
				inner join turma TUR on
				        TUR.Turma = AA.Turma
				where
						AA.Turma = '".$_REQUEST['turma']."'
					and AA.Aluno = '".$_REQUEST['aluno']."'
					and AA.Ano   = '".$_REQUEST['ano']."'
				";

		$resultado = mysql_query($sql) or die ("Erro na Consulta do Historico Escolar.");
		$numero = mysql_num_rows($resultado);

		//$this->MultiCell('200','5',$sql);

		if($numero == 0){
			$this->Cell(200,7,'Nenhum registro encontrado', 0, 1, 'C');
		}else{
			$volta = 0;
			while($registro[$volta] = mysql_fetch_array($resultado)){
				if($volta == 0){
					$this->SetFont('arial','B',11);
					$this->Cell(100,7,'Aluno(a): '.$registro[$volta]['NomeAluno'], 0, 1, 'L');
					$this->Cell(100,7,'Turma: '.$registro[$volta]['NomeTurma'], 0, 1, 'L');
					$this->Ln(3);
					$this->SetFillColor(200,220,255);
					$this->Cell(115,7,"Disciplina", 'BT', 0, 'L', true);
					$this->Cell(30,7,"Carga Horária", 'BT', 0, 'C', true);
					$this->Cell(25,7,"Média Final", 'BT', 0, 'C', true);
					$this->Cell(30,7,"Resultado", 'BT', 1, 'C', true);

					$this->SetFont('arial','',11);
				}
				// Validação
				if($registro[$volta]['Nota'] && $registro[$volta]['Nota'] >= 7){
					$resultadoAluno = "Aprovado(a)";
				}elseif($registro[$volta]['Nota'] && $registro[$volta]['Nota'] < 7){
					$resultadoAluno = "Reprovado(a)";
				}else{
					$resultadoAluno = "--";
				}
				$this->Cell(115,7,$registro[$volta]['Disciplina'], 0, 0, 'L');
				$this->Cell(30,7,$registro[$volta]['Horas_Aula'], 0, 0, 'C');
				$this->Cell(25,7,$registro[$volta]['Nota'], 0, 0, 'C');
				$this->Cell(30,7,$resultadoAluno, 0, 1, 'C');

				$volta++;
			}
		}

	}// Fim conteudo

	// Rodape
	function Footer(){
		$this->SetY(-15);
		$this->Cell(200,4,' ', 'B', 1);
		$this->SetFont('arial','',7);
		$this->Cell(200,4,'IPECON - Consultoria e Treinamento', 0, 1, 'C');
		$this->Cell(200,4,'Sua pós-graduação com qualidade.', 0, 1, 'C');
	}// Fim rodape

}// Fim da class

$pdf = new visualizarHistoricoEscolar('P','mm','A4'); // Cria um arquivo novo tipo A4, na vertical.
$pdf->Open(); // inicia documento
//$pdf->AliasNbPages(); //numeracao automatica de paginas
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(10);
$pdf->SetAuthor("Regis Andrade"); // Define o autor
$pdf->conteudo();
$pdf->Output();

?>
<h2>Gerar pdf do Hist&oacute;rico Escolar</h2>
