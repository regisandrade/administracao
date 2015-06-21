<?php
/* LIMPAR TODAS AS VARIÁVEIS DE SESSÃO */
session_start();
session_unset();
session_destroy();

header('location: index.php');
?>
