<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados
?>
<html>
<head>
<title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(ano,aluno,turma,disciplina){
	if(confirm("Confirma a exclusão deste Registro?"))
		window.location = 'excluir_registro_matricula.php?ano='+ano+'&aluno='+aluno+'&turma='+turma+'&disciplina='+disciplina;
	}
</script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="../img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td width="162" height="19" background="../img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="../img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="../img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conteúdo -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Matr&iacute;cula de Alunos</h3>
			</div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
		  <td colspan="2" valign="top" class="Texto">
			<?php
			##########################################
			// Verificar
			// For de aluno
			for($volta = 0; $volta < count($_REQUEST['item_aluno']); $volta++){
				// For de disciplina
				for($conta = 0; $conta < count($_REQUEST['item']); $conta++){
					// Verificar se a matricula já foi cadastrada
					$consulta = "SELECT * FROM matricula WHERE Ano = ".$_REQUEST['ano']." AND Turma = '".$_REQUEST['turma']."' AND Aluno = '".$_REQUEST['item_aluno'][$volta]."' AND Disciplina = ".$_REQUEST['item'][$conta];
					$resultado = mysql_query($consulta) or die ("Erro na consulta da Matricula. ".mysql_error());
					$numero = mysql_num_rows($resultado);

					if($numero > 0){
					?>
					<script language="javascript">
						alert('A mátricula para este aluno já foi realizada.\nClick aqui para realizar uma nova matrícula.');
						history.back(-1);
					</script>
					<?php
						exit;
					}

					$comando = "
						INSERT INTO	matricula (
							Ano,
							Aluno,
							Disciplina,
							Turma,
							Data_Matricula
						)VALUES(
							".$_REQUEST['ano'].",
							'".$_REQUEST['item_aluno'][$volta]."',
							".$_REQUEST['item'][$conta].",
							'".$_REQUEST['turma']."',
							'".$data_matricula."'
						)
					";
					mysql_query($comando) or die ("Erro na Gravação da Matricula. ".mysql_error());

					// Incluir dados na tabela de aluno academico
					$cmd_academicos = "
						INSERT INTO	alunos_academicos (
							Ano,
							Aluno,
							Turma,
							Disciplina
						)VALUES(
							".$_REQUEST['ano'].",
							'".$_REQUEST['item_aluno'][$volta]."',
							'".$_REQUEST['turma']."',
							".$_REQUEST['item'][$conta]."
						)
					";
					mysql_query($cmd_academicos) or die ("Erro na Gravação dos alunos academicos. ".mysql_error());
					
					// Consultar o e-mail do aluno e enviar o usuário e senha do mesmo
					$sqlEmail = "SELECT a.Nome, a.e_Mail as email, ua.Login as Usuario, ua.Senha 
								 FROM aluno a 
								  INNER JOIN usuario_aluno ua ON ua.Id_Numero = a.Id_Numero 
								 WHERE a.Id_Numero = '".$_REQUEST['item_aluno'][$volta]."'";
					$dados = mysql_fetch_array($sqlEmail);
					if($dados['email']){
						// Enviar e-mail
						$msg = '
							<html>
							<head>
							<title>Usuário e Senha de acesso a área do aluno do site IPECON</title>
							</head>
							<body>
								<p>Prezado(a) '.$dados['Nome'].' </p>
								<p>&nbsp;</p>
								<p>Segue abaixo os dados que te dão acesso a <strong>Área do Aluno</strong> do site IPECON.<br />
								<br />
								<h3>Usuário: '.$dados['Usuario'].'
								<br/>Senha: '.$dados['Senha'].'</h3>
								<p><a href="http://www.ipecon.com.br/">Área do aluno</a>
								<p>&nbsp;</p>
								<p>Atenciosamente,
								<br />
								<br />
								<p>IPECON - Ensino e Consultoria </p>
							</body>
							</html>
						';
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html;\r\n";
						$headers .= "From: ipecon@ipecon.com.br";
					
						mail($dados['email'],"[Não responda] Usuário e Senha de acesso a área do aluno do site IPECON.",$msg,$headers);
					}
					
				}// Fim FOR de Disciplina
			}// Fim FOR de aluno
			##########################################

			// Consulta os dados da turma
			$consulta = "
			SELECT
			  MAT.*,
			  ALU.Nome AS NomeAluno,
			  DIS.Nome AS NomeDisciplina
			FROM
			  matricula MAT
			INNER JOIN disciplina DIS ON
			  DIS.Codg_Disciplina = MAT.Disciplina
			INNER JOIN aluno ALU ON
			  ALU.Id_Numero = MAT.Aluno AND ALU.Ano = ".$_REQUEST['ano']."
			WHERE
			  ALU.Ano = ".$_REQUEST['ano']."
			  AND
			  MAT.Turma = '".$_REQUEST['turma']."'
			  AND
			  MAT.Curso = ".$_REQUEST['curso']."
			ORDER BY
			  ALU.Nome, DIS.Nome
			";
			$resultado = mysql_query($consulta) or die ("Erro na consulta da Matricula. ".mysql_error());
			?>
			<table width="100%" cellpadding="0" cellspacing="0" class="Texto">
			  <tr>
				<td width="5%" height="15" style="padding-left: 0.3em"><strong>Turma:</strong></td>
				<td width="90%" style="padding-left: 0.3em"><strong><?php print($_REQUEST['turma'].'|'.$_REQUEST['nome_turma']); ?></strong></td>
				<td width="5%" align="right" style="padding-right: 0.3em"><a href="JavaScript:history.back(-1)">&lt;&lt;&nbsp;Voltar</a></td>
			  </tr>
			</table>
			<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Texto">
			  <tr bgcolor="#DDDDDD">
				<td width="91%" height="15" style="padding-left: 0.3em"><strong>Disciplina</strong></td>
				<td width="9%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>
			  </tr>
			  <?php
			  	  $conta = 0;
				  $muda_aluno = '0';
				  $volta = 0;
				  $num = 1;
				  while($dados = mysql_fetch_array($resultado)){
					if($muda_aluno != 0){
						if($muda_aluno != $dados['Aluno']){
			  ?>
			  <tr>
				<td background="../imagens/spacer.gif" height="2" colspan="2" bgcolor="#000000"></td>
			  </tr>
			  <tr>
				<td bgcolor="#DDDDDD" height="15" colspan="2" style="padding-left: 0.3em; font-weight:bold; color:#990000">Aluno:&nbsp;<?php print(strtoupper($dados['NomeAluno'])); ?></td>
			  </tr>
			  <?php
			  			$volta = 0;
						$num = 1;
						}
					}
					if($conta == 0){
			  ?>
			  <tr>
				<td background="../imagens/spacer.gif" height="2" colspan="2" bgcolor="#000000"></td>
			  </tr>
			  <tr>
				<td bgcolor="#DDDDDD" height="15" colspan="2" style="padding-left: 0.3em; font-weight:bold; color:#990000">Aluno:&nbsp;<?php print(strtoupper($dados['NomeAluno'])); ?></td>
			  </tr>
			  <?php
					}
			  ?>
			  <tr bgcolor="#EEEEEE">
				<td height="15" style="padding-left: 0.3em"><?php print($num.'-'.$dados['NomeDisciplina']); ?></td>
				<td align="center"><a href="#" onClick="Confirma_Exclusao(<?php print($dados['Ano']); ?>,'<?php print($dados['Aluno']); ?>','<?php print($dados['Turma']); ?>',<?php print($dados['Disciplina']); ?>,'<?php print($nome_turma); ?>')"><img src="../../imagens/excluir.gif" alt="Excluir registro" width="16" height="16" border="0"></a></td>
			  </tr>
			  <?php
				  $conta++;
				  $volta++;
				  $num++;
				  $muda_aluno = $dados['Aluno'];
			  }
			  ?>
			</table>
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="5" background="../../imagens/spacer.gif"></td>
			  </tr>
			  <tr>
				<td height="15" align="center"><input type="button" name="nova" value="Nova Matr&iacute;cula?" onClick="JavaScript:history.back(-1)"></td>
			  </tr>
			</table>
		  </td>
		</tr>
	</table>
	<!-- Fim -->
	</td>
    <td background="../img_menu/direita.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img_menu/baixo_esquerda.gif" width="19" height="19"></td>
    <td height="19" background="../img_menu/baixo.gif">&nbsp;</td>
    <td><img src="../img_menu/baixo_direita.gif" width="19" height="19"></td>
  </tr>
</table>
</body>
</html>