<?php
/* LIMPAR TODAS AS VARIAVEIS DE SESSÃO */
session_start();
session_unset();
session_destroy();

/* Incluindo classes */
include("../captcha/securimage.php");
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>IPECON - Ensino e Consultoria Ltda :: Administração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="regisandrade@gmail.com">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <script type="text/javascript" src="bootstrap/js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</head>

<body onLoad="$('login').focus();">
    <div class="container">
        <form class="form-signin" method="POST" action="auth.php" id="formLogin">
            <h2 class="form-signin-heading"><img src="../imagens/novaLogo.png" alt="logomarcaIpecon" /></h2>
            <div class="control-group">
                <input type="text" id="login" name="login" class="input-block-level" placeholder="Usuário">
            </div>
            <div class="control-group">
                <input type="password" id="senha" name="senha" class="input-block-level" placeholder="Senha">
            </div>
            <div class="control-group">
                <input type="text" name="user_code" id="user_code" class="input-block-level" placeholder="Validação">
            </div>
            <label class="captcha">
                <img src="../captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" alt="captcha" />
            </label>
            <button class="btn btn-large btn-primary" type="submit">Entrar</button>
            <label class="copy">
                &copy;&nbsp;2003&nbsp;IPECON - Ensino e Consultoria Ltda.
            </label>
        </form>
    </div> <!-- /container -->

</body>
</html>