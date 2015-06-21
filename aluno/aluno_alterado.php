<?php
//=============================================//
// Proprietário.: IPECON - Ensino e Consultoria
// Site.........: www.ipecon.com.br
// Autor........: Régis Rodrigues de Andrade
// Página.......: Alterar Aluno
//=============================================//
session_start();
require('../../conexao.php'); //== Faz a conexão com o banco

//== Descrição do STATUS
//== 0 --> Inativo
//== 1 --> Ativo

//== Formatação da Data
$data = explode('/',$_POST['data_nascimento']);
$_POST['data_nascimento'] = $data[2].'-'.$data[1].'-'.$data[0];

//== Retirar sinais do CPF
$id_numero = str_replace( "." , "" , str_replace("-" , "" , $cpf ));

// Verificar a data de vencimento
if($_POST['vencimento'] == ''){
	$_POST['vencimento'] = 5;
}

//== Alterar a tabela de aluno
$cmd_aluno = "
	UPDATE aluno SET
		Ano = ".$_POST['ano'].",
		Nome = '".ucwords(strtolower($_POST['nome']))."',
		Data_Nascimento = '".$_POST['data_nascimento']."',
		Naturalidade = '".$_POST['naturalidade']."',
		UF_Naturalidade = '".$_POST['uf_1']."',
		Nacionalidade = '".$_POST['nacionalidade']."',
		Sexo = '".$_POST['sexo']."',
		RG = '".$_POST['rg']."',
		Orgao = '".$_POST['orgao']."',
		e_Mail = '".$_POST['email']."',
		Status = ".$_POST['status'].",
		Curso = ".$_POST['codg_curso'].",
		Data_Vencimento = ".$_POST['vencimento'].",
		Usuario_Alteracao = '".$_SESSION['login']."',
		Data_Alteracao = '".date('Y-m-d')."',
		twitter = '".($_POST['twitter'] ? $_POST['twitter'] : null)."'
	WHERE
		Id_Numero = '".$_POST['id_numero']."' AND Ano = ".$_POST['anoAlterar'];
mysql_query($cmd_aluno) or die ("Erro na Alteração do Aluno. <br>".mysql_error());
//== Fim - Alterar a tabela de aluno

//== Alterar a tabela de endereco
$cmd_endereco = "
	UPDATE endereco SET
		Endereco = '".$_POST['endereco']."',
		Bairro = '".$_POST['bairro']."',
		CEP = '".$_POST['cep']."',
		Cidade = '".$_POST['cidade']."',
		UF = '".$_POST['uf_2']."',
		Fone_Residencial = '".$_POST['fone_residencial']."',
		Fone_Comercial = '".$_POST['fone_comercial']."',
		Celular = '".$_POST['celular']."',
		Usuario_Alteracao = '".$_SESSION['login']."',
		Data_Alteracao = '".date('Y-m-d')."'
	WHERE
		Id_Numero = '".$_POST['id_numero']."'";
mysql_query($cmd_endereco) or die ("Erro na Alteração do Endereço do Aluno. <br>".mysql_error());
//== Fim - Alterar a tabela de endereco

//== Alterar a tabela de graduação
$cmd_graduacao = "
	UPDATE graduacao SET
		Curso_Graduacao = '".$_POST['curso']."',
		Instituicao = '".$_POST['instituicao']."',
		Sigla = '".$_POST['sigla']."',
		Ano_Conclusao = '".$_POST['conclusao']."',
		Usuario_Alteracao = '".$_SESSION['login']."',
		Data_Alteracao = '".date('Y-m-d')."'
	WHERE
		Id_Numero = '".$_POST['id_numero']."'";
mysql_query($cmd_graduacao) or die ("Erro na Alteração da Graduação do Aluno.<br>".mysql_error());
//== Fim - Alterar a tabela de graduação

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE `aluno`, `endereco`, `graduacao`';
mysql_query($sql) or die ("Erro na Otimização das Tabelas.<br>Erro:".mysql_error());

?>
<script>
	alert('Aluno(a) alterado(a) com sucesso!');
	document.location="resultado_alunos.php?curso=<?php print($codg_curso); ?>&ano=<?php print($_POST['ano']); ?>";
</script>
