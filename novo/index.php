<?php
/* LIMPAR TODAS AS VARIAVEIS DE SESSÃO */
session_start();
session_unset();
session_destroy();

/* DEFINE ALGUNS TEXTOS PADRONIZADOS */
define("_titulo","Área administrativa :: IPECON - Consultória e treinamento");
define("_copy","&copy;&nbsp;2003&nbsp;IPECON - Consultória e treinamento. Todos os direitos reservados");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=_titulo?></title>
<style type="text/css">
<!--
@import url("css/login.css");
-->
</style>
<script language="JavaScript" type="text/javascript">
function Verificar(nForm){
	if(nForm.login.value==''){
		alert('Favor, digitar o Login.');
		nForm.login.focus();
		return false;
	}

	if(nForm.senha.value==''){
		alert('Favor, digitar a Senha.');
		nForm.senha.focus();
		return false;
	}
}

function sair(){
	window.location = "../novo/index.php";
}
</script>
</head>

<body>
<div id="tudo">
	<div id="login">
		<div id="tituloLogin">Login Ipecon</div>
		<p></p>
		<div id="formLogin">
			<form name="login" action="auth.php" method="post" onSubmit="return Verificar(this)">
			<label class="textoLogin">Usuário:</label><input type="text" name="login" size="20" maxlength="20" class="formulario" /><br />
			<label class="textoLogin">Senha:</label><input type="password" name="senha" size="20" maxlength="20" class="formulario" /><br />
			<input type="submit" name="btnEntrar" value="Entrar" class="btnEntrar" />&nbsp;&nbsp;<input type="button" name="btnSair" value="Sair" class="btnSair" onclick="sair()" />
			</form>
		</div>
	</div>
	<div id="copy"><?=_copy?></div>
</div>
</body>
</html>