<?php
/* LIMPAR TODAS AS VARIAVEIS DE SESSÃO */
session_start();
session_unset();
session_destroy();

/* Incluindo classes */
include("../captcha/securimage.php");

include("../class/util.class.php");
$u = new Util();

/* DEFINE ALGUNS TEXTOS PADRONIZADOS */
define("_titulo","Administração :: IPECON - Ensino e Consultoria");
define("_copy","&copy;&nbsp;2003&nbsp;IPECON - Ensino e Consultoria. Todos os direitos reservados");
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
<script type="text/javascript" src="js/prototype.js"></script>
<script language="JavaScript" type="text/javascript">
function VerificarFormLogin(){

	if($F('login') == ""){
		alert("Favor, digitar o Login.");
		$('login').focus();
		return false;
	}

	if($F('senha') == ""){
		alert("Favor, digitar a Senha.");
		$('senha').focus();
		return false;
	}

	if($F('user_code') == ""){
		alert("Favor, digitar o código de Verificação.");
		$('user_code').focus();
		return false;
	}
}

function sair(){
	window.location = "../novo/index.php";
}
// Focus

</script>
</head>

<body onLoad="$('login').focus();">
<div id="tudo">
    <div id="divLogin">
        <div id="tituloLogin"><img src="../imagens/marcaBoleto.jpg" alt="marca" /></div>
        <p></p>
        <div id="formLogin">
            <form name="login" action="auth.php" method="post" onSubmit="return VerificarFormLogin();">
            <label class="textoLogin">Usuário:</label><input type="text" name="login" id="login" maxlength="20" class="formulario" /><br />
            <label class="textoLogin">Senha:</label><input type="password" name="senha" id="senha" maxlength="20" class="formulario" /><br />
            <label class="textoLogin">Verificação:</label><input name="user_code" id="user_code" type="text" size="5" class="formulario" /><br />
            <p align="center"><img src="../captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" alt="captcha" /></p>
            <input type="submit" name="btnEntrar" value="Entrar" class="btnEntrar" />&nbsp;&nbsp;<input type="button" name="btnSair" value="Sair" class="btnSair" onclick="sair()" />
            </form>
        </div>
    </div>
    <div id="copy"><?=_copy?></div>
</div>
<?php 
if(!empty($_REQUEST['mensagem'])){
?>
<script type="text/javascript">
    alert('<?php echo $_REQUEST['mensagem']; ?>');
    $('login').focus();
</script>
<?php
}
?>
</body>
</html>