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
    <style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
        text-align: center;
    }
    .form-signin .captcha {
        margin-bottom: 10px;
        text-align: left;
    }
    .form-signin .copy {
        margin-top: 10px;
        text-align: left;
        font-size: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }

</style>
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

<script type="text/javascript" src="bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready( function() {
    $("#formLogin").validate({
        // Define as regras
        rules:{
            login: {
                required: true, minlength: 5
            },
            senha: {
                required: true, minlength: 5
            },
            user_code: {
                required: true, maxlength: 4
            },
        },
        // Define as mensagens de erro para cada regra
        messages:{
            login:{
                required: "Digite o usuário",
                minLength: "O seu usuário deve conter, no mínimo, 5 caracteres."
            },
            senha:{
                required: "Digite a senha do usuário",
                minLength: "O seu usuário deve conter, no mínimo, 5 caracteres."
            },
            user_code:{
                required: "Digite os caracteres de validação.",
                maxlength: "São 4 caracteres no máximo para validação."
            },
        },
        errorClass:'help-inline',
        validClass:'success',
        errorElement:'span',
        highlight: function(label) {
            $(label).closest('.control-group').removeClass('success').addClass('error');
        },
        /*success: function(label) {
            label
                //.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        },*/ 
        unhighlight: function (element, errorClass, validClass)
        {
            $(element).parents(".error")
                    .removeClass(errorClass)
                    .addClass(validClass); 
        }
    });
});
</script>

</head>
<body onLoad="$('login').focus();">
    <div class="container">
        <form class="form-signin" method="POST" action="auth.php" id="formLogin">
            <h2 class="form-signin-heading"><img src="../imagens/marcaBoleto.jpg" alt="marca" /></h2>
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