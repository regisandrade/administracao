<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Inclus�o de Notas/Frequ�ncias
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados
//echo "<pre>";
//print_r($_REQUEST);
//echo "</pre>";
//die;
if (isset($_REQUEST['nota']) && isset($_REQUEST['frequencia']) && isset($_REQUEST['aluno'])){
	$conta = count($_REQUEST['nota']);
	for ($ind = 0; $ind < $conta; $ind++)
	{
		//== Formatar Notas
		$nota = str_replace(',','.',$_REQUEST['nota'][$ind]);

		$comando = "
		UPDATE alunos_academicos SET
			Nota = ".$nota.",
			Frequencia = ".($_REQUEST['frequencia'][$ind] == '' ? "0" : $_REQUEST['frequencia'][$ind])."
		WHERE
			Ano = ".$_POST['ano']."
			AND
			Aluno = '".($_REQUEST['aluno'][$ind] == '' ? "NULL" : $_REQUEST['aluno'][$ind])."'
			AND
			Turma = '".$_REQUEST['turma']."'
			AND
			Disciplina = ".$_REQUEST['disciplina'];
		mysql_query($comando) or die ("Erro na Grava��o das Notas/Frequ�ncias.<br>Comando: ".$comando."<br>Erro:".mysql_error());
	}
}
?>
<script>
	alert('Notas/Frequ�ncias inclu�das com sucesso!');
	document.location='gride_nota_frequencia.php?ano=<?php print($_REQUEST['ano']); ?>&turma=<?php print($_REQUEST['turma']); ?>&disciplina=<?php print($_REQUEST['disciplina']); ?>&curso=<?=$_REQUEST['curso']?>';
</script>