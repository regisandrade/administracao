<?php 
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><?=$_SESSION['tituloPagina']?></title>
	<link rel="stylesheet" href="css/tab-view.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/site.css" type="text/css" media="screen">
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/tab-view.js"></script>
</head>
<body>
<div><h3><?=$_SESSION['tituloPagina']?></h3></div>
<div id="dhtmlgoodies_tabView1">
	<div class="dhtmlgoodies_aTab">
		<a href="home.php?pag=aluno" title="Aluno">[Aluno]</a>&nbsp;
		<a href="home.php?pag=cronograma" title="Cronograma">[Cronograma]</a>&nbsp;
		<a href="home.php?pag=curso" title="Curso">[Curso]</a>&nbsp;
		<a href="home.php?pag=disciplina" title="Disciplina">[Disciplina]</a>&nbsp;
		<a href="home.php?pag=material" title="Material de apoio">[Material de apoio]</a>&nbsp;
		<a href="home.php?pag=nota" title="Notas e frequências">[Notas e frequências]</a>&nbsp;
		<a href="home.php?pag=professor" title="Professor">[Professor]</a>&nbsp;
		<a href="home.php?pag=turma" title="Turma">[Turma]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="home.php?pag=artigo" title="Artigo">[Artigo]</a>&nbsp;
		<a href="home.php?pag=aviso" title="Avisos">[Avisos]</a>&nbsp;
		<a href="home.php?pag=curriculo" title="Curriculo">[Curriculo]</a>&nbsp;
		<a href="home.php?pag=depoimento" title="Depoimento">[Depoimento]</a>&nbsp;
		<a href="home.php?pag=link" title="Link">[Link]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="home.php?pag=matricular" title="Matricular">[Matricular]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="home.php?pag=preInscricao" title="Pré-inscrição">[Pré-inscrição]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="home.php?pag=areaAluno" title="Área do aluno">[Área do aluno]</a>&nbsp;
		<a href="home.php?pag=senhaAluno" title="Senha dos alunos">[Senha dos alunos]</a>&nbsp;
		<a href="home.php?pag=alterarSenha" title="Alterar senha">[Alterar senha]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="logout.php" title="Sair">[Sair]</a>
	</div>
	<div class="dhtmlgoodies_aTab">
		<a href="mailto:regisandrade@gmail.com" title="regisandrade@gmail.com">[Suporte]</a>
	</div>
</div>
<script type="text/javascript">
initTabs('dhtmlgoodies_tabView1',Array('Educacional','Administrativo','Matrícular','Relatórios','Outros','Sair','Ajuda'),0,720,20,Array(false,false,false,false,false,false,false));
</script>
<div id="site_home">
	<div id="conteudo">anananananananananaanananananananananaanananananananananaanananananananananaanananananananananaananananananananana</div>
</div>
<div id="site_rodape"><?=$_SESSION['tituloRodape']?></div>
</body>
</html>
