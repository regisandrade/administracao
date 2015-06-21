<?php
session_start();
if(empty($_SESSION['login'])){
	header("location: pgErro.php");
	exit;
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Administração :: IPECON</title>
<script src="js/administracao.js" type="text/javascript"></script>
</head>

<frameset cols="190,*" frameborder="NO" border="0" framespacing="0">
  <frame src="menu.php" name="leftFrame" scrolling="NO" noresize>
  <frame src="principal.php" name="principal">
</frameset>
<noframes><body>
</body></noframes>
</html>
