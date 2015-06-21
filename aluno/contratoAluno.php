<?php
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');
require('../../class/util.class.php');

//header('Content-Type: text/html; charset=ISO-8859-1');

class contratoAluno extends FPDF
{
  public $nomeArquivo;
  // Cabecalho
  function Header(){
    $this->Image('../imagens/ipeconPdf.jpg',5,5,25);
    $this->SetFont('Times','B',9);
    $this->Cell(30,5,'', 0, 0);
    $this->Cell(165,5,'IPECON - Instituto de Organiza��o de Eventos, Ensino e Consultoria S/S Ltda.', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(30,5,'', 0, 0);
    $this->Cell(165,5,'Rua 10 n� 250, sala 505, Ed. Trade Center, Setor Oeste - Goi�nia/GO - CEP 74.120-020', 0, 1, 'C');
    $this->Cell(30,5,'', 0, 0);
    $this->Cell(165,5,'Fone/Fax.: (0xx62) 3214-3229 - www.ipecon.com.br - ipecon@ipecon.com.br', 0, 1, 'C');
    $this->Ln(4);
  }// Fim cabecalho

  function Body(){
    require('../../conexao.php');
    $util = new Util();

    $comando = "
    SELECT
        TA.Nome,
        DATE_FORMAT(TA.Data_Nascimento,'%d/%m/%Y') AS Data_Nascimento,
        TA.Naturalidade,
        TA.UF_Naturalidade,
        TA.Nacionalidade,
        TA.Sexo,
        TA.RG,
        TA.Orgao,
        TA.CPF,
        TA.e_Mail,
        TA.Status,
        TA.Curso,
        TE.Endereco,
        TE.Bairro,
        TE.CEP,
        TE.Cidade,
        TE.UF,
        TE.Fone_Residencial,
        TE.Fone_Comercial,
        TE.Celular,
        CUR.Nome AS Curso,
        CUR.Qtde_Horas AS qtdeHoras,
        TA.estadoCivil, 
        TA.tituloEleitoral
    FROM
        aluno TA
    INNER JOIN endereco TE ON
        TE.Id_Numero = TA.Id_Numero
    INNER JOIN curso CUR ON
        CUR.Codg_Curso = TA.Curso
    WHERE
            TE.Tipo_Pessoa = 'A'
        AND TA.Id_Numero   = '".$_REQUEST['id_numero']."'
        AND TA.Curso       = ".$_REQUEST['curso']."
    ";
    $resultado = mysql_query($comando) or die ("Erro na Consulta do Aluno".mysql_error());
    $registro = mysql_fetch_array($resultado);
    //echo "<pre>"; print_r($registro); die();
    
    $sqlFormaDePagamento = "SELECT * FROM formasDePagamento WHERE idAluno = '".$_REQUEST['id_numero']."'";
    //$rsFormaDePagamento = mysql_query($sqlFormaDePagamento) or die ("Erro na consulta da forma de pagamento.");
    $dadosFormaPagamento = mysql_fetch_array(mysql_query($sqlFormaDePagamento));
    $numRegistros = mysql_num_rows(mysql_query($sqlFormaDePagamento));

    if($numRegistros == 0){
	// Alerta de erro
	?>
	<script>
		alert('O aluno(a): <?php echo $registro["Nome"];?>, n�o tem forma de pagamento cadastrada, por favor, cadastre.');
		window.close();
	</script>
	<?php
    }
    // Descri��o do tipo
    if($_REQUEST['tipo'] == 'C'){
        $nomeTipo = "Cheque";
    }else{
        $nomeTipo = "Boleto";
    }
    // Nome do arquivo
    $this->nomeArquivo = 'Contrato_'.$nomeTipo.'_'.str_replace(" ","",$registro['Nome']).'_'.str_replace(" ","",$registro['Curso']);

    $this->AddPage();
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'INSTRUMENTO PARTICULAR DE CONTRATO DE PRESTA��O DE SERVI�OS', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Ln(2);
    $this->MultiCell(195, 4, 'Este instrumento formal materializa contrato de presta��o de servi�os, firmado entre IPECON - Instituto de Organiza��o de Eventos, Ensino e Consultoria S/S LTDA. e o CONTRATANTE, abaixo qualificados.', '0', 'J');
    $this->Ln(2);
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Contratante:', 0, 1, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(12,5,'Nome:', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(104,5,$registro['Nome'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(12,5,'C.P.F.:', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(24,5,$registro['CPF'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(10,5,'R.G.:', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(33,5,$registro['RG'].'/'.$registro['Orgao'], 0, 1, 'L');

    $this->SetFont('Times','B',9);
    $this->Cell(48,5,'Residente e domiciliado na: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(88,5,$registro['Endereco'], 0, 1, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(23,5,'Setor, bairro: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(35,5,$registro['Bairro'], 0, 1, 'L');

    $this->SetFont('Times','B',9);
    $this->Cell(24,5,'Munic�pio de:', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(50,5,$registro['Cidade'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(14,5,'Estado: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(52,5,$registro['UF'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(35,5,'Data de nascimento: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(20,5,$registro['Data_Nascimento'], 0, 1, 'L');

    $this->SetFont('Times','B',9);
    $this->Cell(36,5,'Telefone residencial:', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(50,5,$registro['Fone_Residencial'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(14,5,'Celular: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(52,5,$registro['Celular'], 0, 0, 'L');
    $this->SetFont('Times','B',9);
    $this->Cell(19,5,'Comercial: ', 0, 0, 'L');
    $this->SetFont('Times','',9);
    $this->Cell(20,5,$registro['Fone_Comercial'], 0, 1, 'L');

    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Contratado:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'IPECON - Instituto de Organiza��o de Eventos, Ensino e Consultoria S/S LTDA., C.N.P.J. 04.222.855/0001-18, com sede na Rua 10 n� 250, Edif�cio Trade Center, Sala 505, Setor Oeste - Goi�nia /GO. Telefone: (62) 3214-3229 / 3214-2563.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Primeira:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O presente contrato tem por objeto a presta��o de servi�o de curso de especializa��o em n�vel de p�s-gradua��o lato-sensu, em conv�nio com a PUC Goi�s, conforme especificado na cl�usula segunda - campo CURSO.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Segunda:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O CONTRATANTE declara estar informado e concorda com o pagamento estipulado na forma da Cl�usula Terceira, via cobran�a banc�ria ou cobran�a direta pela CONTRATADA, dentro dos prazos descritos no presente instrumento, com a seguinte op��o de pagamento: '.($dadosFormaPagamento['formaPagamento'] == "C" ? "Cheque" : "Boleto").', pelo valor total de R$ '.number_format($dadosFormaPagamento['valorTotal'],2,',','.').' ('.$util->extenso($dadosFormaPagamento['valorTotal']).'). ', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Curso: '.$registro['Curso'].' - '.$registro['qtdeHoras'], 0, 1, 'L');
    $this->Cell(195,5,'Programa��o: ', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195,5,$this->listaDisciplinasPorCurso(), 0, 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Pagamento: ', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $textoFormaPagamento = "";
    if($_REQUEST['tipo'] == 'C'){
        $textoFormaPagamento = "pagamento atrav�s dos cheques abaixo relacionados, ";
    }else{
        $textoFormaPagamento = "emiss�o de boleto banc�rio, ";
    }
    $this->MultiCell(195, 4, $dadosFormaPagamento['parcelas'].' parcelas de R$ '.number_format($dadosFormaPagamento['valorParcela'],2,',','.').' ('.$util->extenso($dadosFormaPagamento['valorParcela']).'), cada, sendo a primeira no ato da matr�cula e as demais mediante '.$textoFormaPagamento.' com vencimento todo dia '.$dadosFormaPagamento['diaVencimento'].' de cada m�s.', '0', 'J');
    if($_REQUEST['tipo'] == 'C'){
        $this->tabelaDeCheques($dadosFormaPagamento['parcelas'],$dadosFormaPagamento['id']);
    }
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Terceira:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Ao contratante ser� reservada uma vaga no curso, de car�ter pessoal e intransfer�vel, pela qual dever� pagar a totalidade do pre�o, assistindo ou n�o a todas as aulas programadas. Como o n�mero de vagas oferecidas pelo Contratado � insuficiente para atender � demanda, o Contratante se obriga a usufruir a presta��o dos servi�os at� o t�rmino do presente instrumento, n�o havendo devolu��o de pagamento, ainda que venha abandonar o curso antes do t�rmino, qualquer que seja o motivo.', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'� 1� - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'Em casos plenamente justificados e comprovados, mediante requerimento direcionado � Diretoria do curso, ser� analisada a hip�tese de devolu��o de quantias pagas. Neste caso, sendo deferido o pedido, dever� ser deduzido do valor correspondente �s horas/aulas ministradas (estas horas ser�o computadas desde o dia de in�cio das aulas at� a data de protocolo do aludido requerimento na secretaria do curso), mais o valor da taxa de inscri��o (valor calculado proporcionalmente �s aulas ministradas, tomando por base o in�cio do curso e a data de protocolo do requerimento) acrescido de multa rescis�ria de 20% (vinte por cento) sobre o valor total do contrato. N�o existe possibilidade de trancamento do Curso.', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'� 2� - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'N�o cumprindo, pontualmente, com qualquer das obriga��es previstas neste contrato, ficar� o(a) CONTRATANTE automaticamente constitu�do(a) em mora, independentemente de qualquer notifica��o judicial e/ou extrajudicial, comprometendo-se a pagar ao CONTRATADO, durante o per�odo em atraso e sobre todos os valores devidos pela mesma em decorr�ncia deste Contrato:
a) multa de 2% (dois por cento); e
b) mora di�ria de 0,333 (zero v�rgula trezentos e trinta e tr�s por cento).', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'� 3� - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'No caso de haver necessidade do contratado ajuizar processo judicial para recebimento do seu cr�dito, e se tiver, o CONTRATADO, que recorrer a servi�os de advogados para fazer valer qualquer de seus direitos do presente instrumento, pagar� ainda o(a) CONTRATANTE, os honor�rios , desde j� arbitrados em 10% (dez por cento) se o cumprimento ocorrer antes de proposta a��o judicial. Se o cumprimento se obtiver apenas ap�s proposta a a��o judicial, os honor�rios ser�o de 20% (vinte por cento) ou percentual que a decis�o judicial vier a fixar, devendo ser ainda reembolsado o CONTRATADO das pertinentes custas processuais, emolumentos judiciais e despesas postais, tudo de acordo com o disposto no artigo 20 e seus par�grafos do C�digo de Processo Civil.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Quarta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Ocorrendo reprova��o por falta e/ou por nota, o aluno dever� requerer junto � PUC Goi�s, atrav�s da CPGLS (Coordena��o da P�s Gradua��o "Lato Sensu"), autoriza��o para cursar a disciplina na pr�xima turma e efetuar ao IPECON, o pagamento do valor correspondente ao n�mero de cr�ditos da mesma.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Quinta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O contratado obriga-se a ministrar aulas constantes das disciplinas constantes do Curso especificado na cl�usula segunda - campo CURSO. Poder� o Curso, independentemente do consentimento do CONTRATANTE, ministrar aulas nos fins de semana e feriados.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Sexta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'A substitui��o ou troca de professores n�o implica em viola��o do contrato. O CONTRATANTE, desde j�, aceita as condi��es estipuladas na presente aven�a.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula S�tima:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'DISPOSI��ES LEGAIS: O(a) CONTRATANTE declara ter lido o presente CONTRATO, n�o tendo quaisquer d�vidas em rela��o as suas clausulas, condi��es e obriga��es, obrigando-se a cumpri-las.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cl�usula Compromiss�ria:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Qualquer diverg�ncia, controv�rsia ou lit�gio decorrente da interpreta��o ou execu��o deste contrato dever� ser resolvido por meio de media��o ou arbitragem pelo TRIBUNAL DE MEDIA��O E ARBITRAGEM DE GOI�NIA/GO, estabelecida � Rua 104, n � 514, Setor Sul - Goi�nia/GO, nos termos de seu regulamento e de acordo com a Lei n� 9.307 de 23/09/1996.?�(Lei de Arbitragem).', '0', 'J');
    $this->Ln(4);
    $this->Cell(195,5,'Goi�nia, '.$util->fmtDataAtualExtenso(false).'.', 0, 1, 'C');
    $this->Ln(6);
    $this->Cell(195,5,'_______________________________________________________', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(195,5,$registro['Nome'], 0, 1, 'C');
    $this->SetFont('Times','B',9);
    $this->Cell(195,4,'CONTRATANTE', 0, 1, 'C');
    $this->Ln(4);
    $this->Cell(195,5,'_______________________________________________________', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(195,5,'IPECON - Instituto de Organiza��o de Eventos, Ensino e Consultoria S/S Ltda.', 0, 1, 'C');
    $this->SetFont('Times','B',9);
    $this->Cell(195,4,'CONTRATADO', 0, 1, 'C');
    $this->Ln(4);
    $this->SetFont('Times','',9);
    $this->Cell(195,5,'Testemunhas:', 0, 1, 'L');
    $this->Ln(4);
    $this->Cell(10,5,'', 0, 0, 'C');
    $this->Cell(70,5,'____________________________________', 0, 0, 'C');
    $this->Cell(35,5,'', 0, 0, 'C');
    $this->Cell(70,5,'____________________________________', 0, 1, 'C');
    $this->Ln(2);
    $this->Cell(10,5,'', 0, 0, 'C');
    $this->Cell(70,5,'C.P.F. n�', 0, 0, 'C');
    $this->Cell(35,5,'', 0, 0, 'C');
    $this->Cell(70,5,'C.P.F. n�', 0, 0, 'C');
    $this->Ln(4);
    $this->Cell(10,5,'', 0, 0, 'C');
    $this->Cell(70,5,'_____________________________', 0, 0, 'C');
    $this->Cell(35,5,'', 0, 0, 'C');
    $this->Cell(70,5,'_____________________________', 0, 1, 'C');

  }

  function listaDisciplinasPorCurso(){
    $sql = "SELECT DIS.Codg_Disciplina as Id, DIS.Nome FROM turma TU
            INNER JOIN disciplina DIS ON DIS.Codg_Disciplina = TU.Disciplina 
            WHERE TU.Ano = '".$_REQUEST['ano']."' AND TU.Curso = ".$_REQUEST['curso']."
            ORDER BY DIS.Nome";
    $resultado = mysql_query($sql) or die ("Erro na Consulta do Aluno".mysql_error());
    $nome = array();
    while($registro = mysql_fetch_array($resultado)){
        $nome[$registro['Id']] = $registro['Nome'];
    }
    return implode(", * ",$nome);
  }

  function tabelaDeCheques($qtdeParcelas = 1, $idFormaDePagamento){
    $util = new Util();
    
    $this->SetFont('Times','B',8);
    $this->Cell(195,4,'Descri��o dos Documentos:', 0, 1, 'L');
    $this->Cell(14,5,'Ord.', 1, 0, 'C');
    $this->Cell(24,5,'Banco', 1, 0, 'C');
    $this->Cell(24,5,'Ag�ncia', 1, 0, 'C');
    $this->Cell(24,5,'Conta', 1, 0, 'C');
    $this->Cell(24,5,'N�mero', 1, 0, 'C');
    $this->Cell(24,5,'Valor (R$)', 1, 0, 'C');
    $this->Cell(24,5,'Vencimento', 1, 0, 'C');
    $this->Cell(37,5,'Emitente', 1, 1, 'C');

    $sql = "SELECT * FROM cheques WHERE idFormaDePagamento = ".$idFormaDePagamento."
            ORDER BY id";
    $resultado = mysql_query($sql) or die ("Erro na Consulta ddos Cheques".mysql_error());
    $ordem = 1;
    $this->SetFont('Times','',8);
    while($registro = mysql_fetch_array($resultado)){
        $this->Cell(14,5, str_pad($ordem, 2,"0",STR_PAD_LEFT), 1, 0, 'C');
        $this->Cell(24,5,$registro['banco'], 1, 0, 'C');
        $this->Cell(24,5,$registro['agencia'], 1, 0, 'C');
        $this->Cell(24,5,$registro['conta'], 1, 0, 'C');
        $this->Cell(24,5,$registro['numero'], 1, 0, 'C');
        $this->Cell(24,5,number_format($registro['valor'],2,',','.'), 1, 0, 'C');
        $this->Cell(24,5,$util->fmtDataBarra($registro['vencimento']), 1, 0, 'C');
        $this->Cell(37,5,substr($registro['emitente'], 0, 35), 1, 1, 'L');
        $ordem++;
    }
  }
}

$pdf = new contratoAluno('P','mm','A4'); // Cria um arquivo novo tipo carta, na vertical.
$pdf->Open(); // inicia documento
//$pdf->AliasNbPages(); //numeracao automatica de paginas
$pdf->SetLeftMargin(5);
$pdf->SetTopMargin(5);
$pdf->SetAuthor("Regis Andrade"); // Define o autor
$pdf->Body();
$pdf->Output($pdf->nomeArquivo,D);
?>