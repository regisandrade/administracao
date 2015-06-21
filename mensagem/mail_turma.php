<?
session_start();
require('../../conexao.php'); //== Conexão com o Banco de Dados

// Função de e-mail
/*
Como vai funcionar:
O administrador seleciona o curso, logo apos pegamos o codigo do curso selecionado.
Consultamos todos os alunos do curso seleciono e enviamos o e-mail.

Ps.: So podemos enviar e-mail para os Alunos ativos e que possuem e-mail cadastrado
no IPECON.

**** Atenção ****
Codigo do curso: esta na variavel $para

*/
if($_POST['para'] != ''){
	$comando = "
	SELECT
		DISTINCT AA.Aluno,
		ALU.Nome,
		ALU.e_Mail
	FROM
		alunos_academicos AA
	INNER JOIN aluno ALU ON
		ALU.Id_Numero = AA.Aluno
	WHERE
		AA.Turma = '".$_POST['para']."'
		AND
		ALU.e_Mail <> ''";
	//echo $comando;exit;
	$resultado = mysql_query($comando) or die('Erro na seleção de alunos.<br>Erro:&nbsp;'.$comando);
	
	$volta = 0;
	while($dados = mysql_fetch_array($resultado)){
		/* Para */
		$email_para = $dados['Nome'].' <'.$dados['e_Mail'].'>';
		
		/* Cabeçalho. */
		$cabecalho  = "MIME-Version: 1.0\r\n";
		$cabecalho .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$cabecalho .= "From: Ipecon <ipecon@ipecon.com.br>\r\n";
		if($volta == 0){
			$cabecalho .= "Cc: IPECON <ipecon@ipecon.com.br>\r\n";
		}
		//$cabecalho .= "Bcc: Regis Andrade <regisandrade@centauronet.com.br>\r\n";
		
		$_POST['mensagem'] = '<span style="font-family: verdana; font-size:11px">'.$_POST['mensagem'].'</span>';

		/* and now mail it */
		mail($email_para, $_POST['assunto'], $_POST['mensagem'], $cabecalho);
		$volta++;
	}
?>
<script language="JavaScript">
	alert('Mensagem enviada com sucesso!');
	document.location='select_curso.php';
</script>
<?php
}
?>
