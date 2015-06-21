<?php
$assunto = "[Não Responder] Boleto da pré-inscrição do IPECON";

$mensagem = '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>IPECON Pós-Graduação :: Comprovante de Inscrição</title>
	<link href="http://www.ipecon.com.br/css/cssEmail.css" rel="stylesheet" type="text/css">
</head>
<body>
	<table border="1" cellpadding="6" cellspacing="12">
		<tr>
			<td>
				<p class="centralizado titulo"><img src="http://www.ipecon.com.br/imagens/marca.png" border="0" /><br>BOLETO DA PRÉ-INSCRIÇÃO</p>
				<hr>
				<br>
				<p>Prezado(a) <strong>'.$_POST['nomeAluno'].'.</strong></p>
				<p>segue abaixo o link para reimpressão do boleto de pré-inscrição referente ao curso de <strong>'.$_REQUEST['nomeCurso'].'</strong>.</a>
				<p class="centralizado"><a href="http://www.ipecon.com.br/boletophp/boleto_itau.php?idNumero='.$_REQUEST['idNumero'].'&curso='.$_REQUEST['curso'].'"><img src="http://www.ipecon.com.br/imagens/imgBoletoBancario.jpg" border="0" /><br/>imprimir Boleto</a>
				<p>&nbsp;</p>
				<p>Atenciosamente,
				<br />
				IPECON - Ensino e Consultoria<br>
				Rua 10 nº 250, sala 505 - Ed. Trade Center<br>Setor Oeste. Goiânia-GO. <br>CEP: 74.120-020<br>
				Telefones: (62) 3214-2563 ou 3214-3229<br>
				e-Mail: <a href="mailto:ipecon@ipecon.com.br">ipecon@ipecon.com.br</a><br>
				Twitter: <a href="http://twitter.com/ipecongoias">@ipecongoias</a>
				Facebook: <a href="http://facebook.com/ipecon">facebook.com/ipecon</a></p>
				</p>
			</td>
		</tr>
	</table>
</body>
</html>';

$cabecalho  = "MIME-Version: 1.0\r\n";
$cabecalho .= "Content-type: text/html; charset=utf-8\r\n";
$cabecalho .= "From: IPECON Pós-Graduação <ipecon@ipecon.com.br>";

if(!mail($_REQUEST['para'],$assunto,$mensagem,$cabecalho))
	$msg = "Erro ao enviar mensagem";
else
	$msg = "Boleto enviado com sucesso!";
?>
<script language="JavaScript">
	alert("<?=$msg?>");
	window.close();
</script>