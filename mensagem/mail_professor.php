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
if($_POST['para'] == "TODOS PROFESSORES"){
	$comando = "
		SELECT
			Nome,
			e_Mail
		FROM
			professor
		WHERE
			e_Mail <> ''
		ORDER BY
			Nome";
		$resultado = mysql_query($comando) or die('Erro na seleção de Professor.<br>Erro:&nbsp;'.$comando);
		
		$volta = 0;
		while($dados = mysql_fetch_array($resultado)){
			/* Para */
			$email_para = $dados['Nome'].' <'.$dados['e_Mail'].'>';
			
			/* Cabeçalho. */
			$cabecalho  = "MIME-Version: 1.0\r\n";
			$cabecalho .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabecalho .= "From: Ipecon <ipecon@ipecon.com.br>\r\n";
			if($volta == 0){
				$cabecalho .= "Bcc: ipecon@ipecon.com.br";
			}
			//$cabecalho .= "Bcc: Regis Andrade <regisandrade@centauronet.com.br>\r\n";
			
			$_POST['mensagem'] = '<span style="font-family: verdana; font-size:11px">'.$_POST['mensagem'].'</span>';
			
			/* and now mail it */
			mail($email_para, $_POST['assunto'], $_POST['mensagem'], $cabecalho);
			$volta++;
		}
}else{
	$email_para = $nome_prof.' <'.$codg_prof.'>';
	
	/* Cabeçalho. */
	$cabecalho  = "MIME-Version: 1.0\r\n";
	$cabecalho .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$cabecalho .= "From: Ipecon <ipecon@ipecon.com.br>\r\n";
	$cabecalho .= "Cc: IPECON <ipecon@ipecon.com.br>\r\n";
	$cabecalho .= "Bcc: Regis Andrade <regisandrade@centauronet.com.br>\r\n";	

	$mensagem = '<span style="font-family: verdana; font-size:11px">'.nl2br($mensagem).'</span>';
	
	/* and now mail it */
	mail($email_para, $assunto, $mensagem, $cabecalho);
}
?>
<script language="JavaScript">
	alert('Mensagem enviada com sucesso!');
	document.location='select_professor.php';
</script>