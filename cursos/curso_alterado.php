<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Curso
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Formatação da Data
$data = explode('/',$_GET['data_inicio']);
$data_inicio = $data[2].'-'.$data[1].'-'.$data[0];

//== Formatação da Data
$data1 = explode('/',$_GET['data_fim']);
$data_fim = $data1[2].'-'.$data1[1].'-'.$data1[0];

/*
Campo status
1 => Ativo
2 => Inativo
*/
$comando = "
	UPDATE curso SET
		Nome = '".$_GET['nome']."',
		Qtde_Horas = '".$_GET['qtde_horas']."',
		Status = ".$_GET['status'].",
		Data_Inicio = '".$data_inicio."',
		Data_Fim = '".$data_fim."'
	WHERE
		Codg_Curso = ".$_GET['codg_curso'];
mysql_query($comando) or die ("Erro na Alteração do Curso. ".mysql_error());
?>
<script>
	alert('Curso alterado com sucesso!');
	document.location='listar_cursos.php';	
</script>