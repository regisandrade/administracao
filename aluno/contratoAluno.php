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
    $this->Cell(165,5,'IPECON - Instituto de Organização de Eventos, Ensino e Consultoria S/S Ltda.', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(30,5,'', 0, 0);
    $this->Cell(165,5,'Rua 10 n° 250, sala 505, Ed. Trade Center, Setor Oeste - Goiânia/GO - CEP 74.120-020', 0, 1, 'C');
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
		alert('O aluno(a): <?php echo $registro["Nome"];?>, não tem forma de pagamento cadastrada, por favor, cadastre.');
		window.close();
	</script>
	<?php
    }
    // Descrição do tipo
    if($_REQUEST['tipo'] == 'C'){
        $nomeTipo = "Cheque";
    }else{
        $nomeTipo = "Boleto";
    }
    // Nome do arquivo
    $this->nomeArquivo = 'Contrato_'.$nomeTipo.'_'.str_replace(" ","",$registro['Nome']).'_'.str_replace(" ","",$registro['Curso']);

    $this->AddPage();
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'INSTRUMENTO PARTICULAR DE CONTRATO DE PRESTAÇÃO DE SERVIÇOS', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Ln(2);
    $this->MultiCell(195, 4, 'Este instrumento formal materializa contrato de prestação de serviços, firmado entre IPECON - Instituto de Organização de Eventos, Ensino e Consultoria S/S LTDA. e o CONTRATANTE, abaixo qualificados.', '0', 'J');
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
    $this->Cell(24,5,'Município de:', 0, 0, 'L');
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
    $this->MultiCell(195, 4, 'IPECON - Instituto de Organização de Eventos, Ensino e Consultoria S/S LTDA., C.N.P.J. 04.222.855/0001-18, com sede na Rua 10 n° 250, Edifício Trade Center, Sala 505, Setor Oeste - Goiânia /GO. Telefone: (62) 3214-3229 / 3214-2563.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Primeira:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O presente contrato tem por objeto a prestação de serviço de curso de especialização em nível de pós-graduação lato-sensu, em convênio com a PUC Goiás, conforme especificado na cláusula segunda - campo CURSO.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Segunda:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O CONTRATANTE declara estar informado e concorda com o pagamento estipulado na forma da Cláusula Terceira, via cobrança bancária ou cobrança direta pela CONTRATADA, dentro dos prazos descritos no presente instrumento, com a seguinte opção de pagamento: '.($dadosFormaPagamento['formaPagamento'] == "C" ? "Cheque" : "Boleto").', pelo valor total de R$ '.number_format($dadosFormaPagamento['valorTotal'],2,',','.').' ('.$util->extenso($dadosFormaPagamento['valorTotal']).'). ', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Curso: '.$registro['Curso'].' - '.$registro['qtdeHoras'], 0, 1, 'L');
    $this->Cell(195,5,'Programação: ', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195,5,$this->listaDisciplinasPorCurso(), 0, 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Pagamento: ', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $textoFormaPagamento = "";
    if($_REQUEST['tipo'] == 'C'){
        $textoFormaPagamento = "pagamento através dos cheques abaixo relacionados, ";
    }else{
        $textoFormaPagamento = "emissão de boleto bancário, ";
    }
    $this->MultiCell(195, 4, $dadosFormaPagamento['parcelas'].' parcelas de R$ '.number_format($dadosFormaPagamento['valorParcela'],2,',','.').' ('.$util->extenso($dadosFormaPagamento['valorParcela']).'), cada, sendo a primeira no ato da matrícula e as demais mediante '.$textoFormaPagamento.' com vencimento todo dia '.$dadosFormaPagamento['diaVencimento'].' de cada mês.', '0', 'J');
    if($_REQUEST['tipo'] == 'C'){
        $this->tabelaDeCheques($dadosFormaPagamento['parcelas'],$dadosFormaPagamento['id']);
    }
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Terceira:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Ao contratante será reservada uma vaga no curso, de caráter pessoal e intransferível, pela qual deverá pagar a totalidade do preço, assistindo ou não a todas as aulas programadas. Como o número de vagas oferecidas pelo Contratado é insuficiente para atender à demanda, o Contratante se obriga a usufruir a prestação dos serviços até o término do presente instrumento, não havendo devolução de pagamento, ainda que venha abandonar o curso antes do término, qualquer que seja o motivo.', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'§ 1° - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'Em casos plenamente justificados e comprovados, mediante requerimento direcionado à Diretoria do curso, será analisada a hipótese de devolução de quantias pagas. Neste caso, sendo deferido o pedido, deverá ser deduzido do valor correspondente às horas/aulas ministradas (estas horas serão computadas desde o dia de início das aulas até a data de protocolo do aludido requerimento na secretaria do curso), mais o valor da taxa de inscrição (valor calculado proporcionalmente às aulas ministradas, tomando por base o início do curso e a data de protocolo do requerimento) acrescido de multa rescisória de 20% (vinte por cento) sobre o valor total do contrato. Não existe possibilidade de trancamento do Curso.', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'§ 2° - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'Não cumprindo, pontualmente, com qualquer das obrigações previstas neste contrato, ficará o(a) CONTRATANTE automaticamente constituído(a) em mora, independentemente de qualquer notificação judicial e/ou extrajudicial, comprometendo-se a pagar ao CONTRATADO, durante o período em atraso e sobre todos os valores devidos pela mesma em decorrência deste Contrato:
a) multa de 2% (dois por cento); e
b) mora diária de 0,333 (zero vírgula trezentos e trinta e três por cento).', '0', 'J');
    $this->SetFont('Times','',9);
    $this->Cell(12,4,'§ 3° - ', 0, 0, 'L');
    $this->MultiCell(183, 4, 'No caso de haver necessidade do contratado ajuizar processo judicial para recebimento do seu crédito, e se tiver, o CONTRATADO, que recorrer a serviços de advogados para fazer valer qualquer de seus direitos do presente instrumento, pagará ainda o(a) CONTRATANTE, os honorários , desde já arbitrados em 10% (dez por cento) se o cumprimento ocorrer antes de proposta ação judicial. Se o cumprimento se obtiver apenas após proposta a ação judicial, os honorários serão de 20% (vinte por cento) ou percentual que a decisão judicial vier a fixar, devendo ser ainda reembolsado o CONTRATADO das pertinentes custas processuais, emolumentos judiciais e despesas postais, tudo de acordo com o disposto no artigo 20 e seus parágrafos do Código de Processo Civil.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Quarta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Ocorrendo reprovação por falta e/ou por nota, o aluno deverá requerer junto à PUC Goiás, através da CPGLS (Coordenação da Pós Graduação "Lato Sensu"), autorização para cursar a disciplina na próxima turma e efetuar ao IPECON, o pagamento do valor correspondente ao número de créditos da mesma.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Quinta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'O contratado obriga-se a ministrar aulas constantes das disciplinas constantes do Curso especificado na cláusula segunda - campo CURSO. Poderá o Curso, independentemente do consentimento do CONTRATANTE, ministrar aulas nos fins de semana e feriados.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Sexta:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'A substituição ou troca de professores não implica em violação do contrato. O CONTRATANTE, desde já, aceita as condições estipuladas na presente avença.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Sétima:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'DISPOSIÇÕES LEGAIS: O(a) CONTRATANTE declara ter lido o presente CONTRATO, não tendo quaisquer dúvidas em relação as suas clausulas, condições e obrigações, obrigando-se a cumpri-las.', '0', 'J');
    $this->SetFont('Times','B',9);
    $this->Cell(195,5,'Cláusula Compromissória:', 0, 1, 'L');
    $this->SetFont('Times','',9);
    $this->MultiCell(195, 4, 'Qualquer divergência, controvérsia ou litígio decorrente da interpretação ou execução deste contrato deverá ser resolvido por meio de mediação ou arbitragem pelo TRIBUNAL DE MEDIAÇÃO E ARBITRAGEM DE GOIÂNIA/GO, estabelecida à Rua 104, n ° 514, Setor Sul - Goiânia/GO, nos termos de seu regulamento e de acordo com a Lei nº 9.307 de 23/09/1996.? (Lei de Arbitragem).', '0', 'J');
    $this->Ln(4);
    $this->Cell(195,5,'Goiânia, '.$util->fmtDataAtualExtenso(false).'.', 0, 1, 'C');
    $this->Ln(6);
    $this->Cell(195,5,'_______________________________________________________', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(195,5,$registro['Nome'], 0, 1, 'C');
    $this->SetFont('Times','B',9);
    $this->Cell(195,4,'CONTRATANTE', 0, 1, 'C');
    $this->Ln(4);
    $this->Cell(195,5,'_______________________________________________________', 0, 1, 'C');
    $this->SetFont('Times','',9);
    $this->Cell(195,5,'IPECON - Instituto de Organização de Eventos, Ensino e Consultoria S/S Ltda.', 0, 1, 'C');
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
    $this->Cell(70,5,'C.P.F. nº', 0, 0, 'C');
    $this->Cell(35,5,'', 0, 0, 'C');
    $this->Cell(70,5,'C.P.F. nº', 0, 0, 'C');
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
    $this->Cell(195,4,'Descrição dos Documentos:', 0, 1, 'L');
    $this->Cell(14,5,'Ord.', 1, 0, 'C');
    $this->Cell(24,5,'Banco', 1, 0, 'C');
    $this->Cell(24,5,'Agência', 1, 0, 'C');
    $this->Cell(24,5,'Conta', 1, 0, 'C');
    $this->Cell(24,5,'Número', 1, 0, 'C');
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