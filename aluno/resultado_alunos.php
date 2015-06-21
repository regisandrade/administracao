<?php
require('../../conexao.php');
//== Legendas:
/*
	Web = 2 -> Cadastrado pela Administração
	Web = 1 -> Cadastrado pela Internet
*/

$comando = "SELECT
      ALU.Id_Numero
     ,ALU.Nome
     ,TC.Nome AS NomeCurso
     ,ALU.e_Mail
     ,ALU.Curso
     ,ALU.Status
     ,ALU.Ano
FROM
      alunos_academicos AC
INNER JOIN turma TUR ON
      TUR.Turma = AC.Turma
INNER JOIN aluno ALU ON
      ALU.Id_Numero = AC.ALUNO
INNER JOIN curso TC ON
      ALU.Curso = TC.Codg_Curso
WHERE
      ALU.situacao = 1
  and ALU.Ano      = ".$_REQUEST['ano']." \n";

if($_REQUEST['curso'] != 0 && $_REQUEST['curso'] != ''){ //Todos os alunos
    $comando .= " AND ALU.Curso = ".$_REQUEST['curso']."\n";
}

if($_REQUEST['nome']){
    $comando .= " AND UPPER(ALU.Nome) LIKE '%".strtoupper($_REQUEST['nome'])."%' \n";
}

$comando .= " 
GROUP BY
      AC.ALUNO
ORDER BY 
      TC.Nome, ALU.Nome COLLATE latin1_swedish_ci, ALU.Curso";

/*
echo "<pre>"; 
print_r($_REQUEST); 
print_r($comando);
echo "</pre>";
*/

$result = mysql_query($comando) or die ("Erro na Consulta do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg)
{
    if(confirm("Confirma a exclusão deste Aluno?"))
        window.location = 'excluir_aluno.php?id_numero='+ codg;
}

// Detalhes do Aluno
function AbrirPagina(codg, ano, curso){
    window.open('../relatorios/detalhe_aluno.php?id_numero='+codg+'&ano='+ano+'&curso='+curso,'Detalhe');
}
function AbrirContrato(codg, ano, curso, tipo){
    window.open('contratoAluno.php?id_numero='+codg+'&ano='+ano+'&curso='+curso+'&tipo='+tipo,'Contrato');
}
</script>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style>
tr.linha:hover{
	background-color: #FFFF99;
}
</style>
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
			<td colspan="2" valign="top" height="25">
				<div id="pageName" style="font-family:Verdana">
					<h3>Rela&ccedil;&atilde;o de Alunos</h3>
				</div>
			</td>
		</tr>
	    <tr>
        <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
	    </tr>
	    <tr>
        <td height="7" colspan="2" background="../../imagens/spacer.gif"></td>
	    </tr>
	    <tr>
        <td height="17" class="Texto" style="color: #FF0000"><strong>Atenção:</strong> para ativar um aluno(a), click no link Ativo ou Inativo.</td>
        <td class="Texto" style="text-align: right;"><a href="listar_alunos.php">Voltar</a></td>
	    </tr>
	    <tr>
        <td height="7" colspan="2" background="../../imagens/spacer.gif"></td>
	    </tr>
      <tr>
        <td colspan="2" valign="top">
          <table width="100%" align="center" cellpadding="0" cellspacing="2">
            <tr>
              <td width="40%" height="20" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Nome</b></td>
              <td width="40%" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>e-Mail</b></td>
              <td width="10%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Situa&ccedil;&atilde;o</b></td>
              <td width="10%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Opções</b></td>
              <td width="10%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Contratos</b></td>
            </tr>
            <?php
              if($num < 1){
            ?>
            <tr>
              <td colspan="5" height="20" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
            </tr>
            <?php
              }else{
                $conta = 0;
                $volta = 0;
                $numero = 1;
                $muda_curso = 0;
                $contaAtivo = 0;
                $contaInativo = 0;
                while($registro = mysql_fetch_array($result)){
                  if($conta % 2 == 1){
                    $cor = '#DDEEFF';
                  }else{
                    $cor = '#FFFFFF';
                  }
                  if($muda_curso != 0){
                    if($muda_curso != $registro['Curso']){
						?>
						<tr>
            	<td align="left" colspan="5" class="Texto" bgcolor="#DDDDDD"><B>TOTAL DE ALUNOS:&nbsp;</B><?php print($volta); ?></td>
						</tr>
						<tr>
              <td background="../../imagens/spacer.gif" height="5" colspan="5"></td>
						</tr>
						<tr>
             <td height="20" bgcolor="#FFECD9" colspan="5" align="left" class="Texto" style="padding-left: 0.3em; font-weight:bold"><?php print($registro['NomeCurso']); ?></td>
      			</tr>
						<?php
                      $volta=0;
                      $numero=1;
                    }
                  }
                  if($conta == 0){
			      ?>
						<tr>
        			<td background="../../imagens/spacer.gif" height="5" colspan="5"></td>
						</tr>
						<tr>
              <td height="20" bgcolor="#FFECD9" colspan="5" align="left" class="Texto" style="padding-left: 0.3em; font-weight:bold"><?php print($registro['NomeCurso']); ?></td>
						</tr>
				    <?php
                  }
				    ?>
						<tr bgcolor="<?php print($cor); ?>" class="linha">
							<td height="20" align="left" class="Texto" style="padding-left: 0.3em;"><?php print(strtoupper($numero.'. '.$registro['Nome'])); ?></td>
							<td align="left" class="Texto" style="padding-left: 0.3em"><?php
								if($registro['e_Mail'] == ''){
									print('<font color="#FF0000">Nenhum e-mail relacionado.</font>');
								}else{
									print($registro['e_Mail']);
								}
            ?>
              </td>
              <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em">
            <?php
								switch($registro['Status']){
                  case 1:
                    print('<a href="ativar_desativar.php?id_numero='.$registro['Id_Numero'].'&status=0&ano='.$_GET['ano'].'&curso='.$_GET['curso'].'" title="Desativar?">Ativo</a>');
                    $contaAtivo++;
                    break;
                  case 0:
                    print('<a href="ativar_desativar.php?id_numero='.$registro['Id_Numero'].'&status=1&ano='.$_GET['ano'].'&curso='.$_GET['curso'].'" title="Ativar?"><div style="color: #FF0000"><b>Inativo</a></b></div>');
						        $contaInativo++;
                    break;
                }
            ?>
              </td>
              <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="JavaScript:AbrirPagina('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,<?php echo $registro['Curso']; ?>);"><img src="../../imagens/gif_imprimir.gif" width="16" height="15" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="alterar_aluno.php?id_numero=<?=$registro['Id_Numero']?>&ano=<?=$registro['Ano']?>"><img src="../../imagens/alterar.gif" title="Alterar" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="#" onClick="Confirma_Exclusao('<?php print($registro['Id_Numero']); ?>')"><img src="../../imagens/excluir.gif" title="Excluir" border="0" align="absmiddle"></a></td>
              <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="JavaScript:AbrirContrato('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,<?php echo $registro['Curso']; ?>,'B');" title="Contrato com boleto"><img alt="Boleto"  src="../imagens/icons/ico_boleto.gif" width="16" height="16" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="JavaScript:AbrirContrato('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,<?php echo $registro['Curso']; ?>,'C');" title="Contrato com cheque"><img src="../imagens/icons/ico_cheque.jpg" alt="Cheque" border="0" align="absmiddle"></a></td>
			      </tr>
				    <?php
                  $conta++;
                  $volta++;
                  $numero++;
                  $muda_curso = $registro['Curso'];
                }
				    ?>
				  <tr>
            <td height="20" align="left" colspan="5" class="Texto" bgcolor="#DDDDDD" style="padding-left: 0.3em"><B>TOTAL DE ALUNOS:&nbsp;</B><?php print($volta); ?></td>
          </tr>
          <?Php
          }
          ?>
			</table>
			<br>
		  </td>
		</tr>
		<tr>
      <td colspan="2" align="center" valign="bottom"><div class="Texto" id="siteInfo">Administra&ccedil;&atilde;o IPECON | &copy;2004 IPECON Ensino e Consultoria Ltda.</div></td>
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