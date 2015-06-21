<?php
//=============================================//
// Proprietário ? IPECON - Ensino e Consultoria
// Site ? www.ipecon.com.br
// Autor ? Régis Rodrigues de Andrade
// Página ? Inclusão de Professor
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Formatação da Data
$data = explode('/',$_POST['data_nascimento']);
$_POST['data_nascimento'] = $data[2].'-'.$data[1].'-'.$data[0];

//== Retirar sinais do CPF e RG
$_POST['cpf'] = str_replace( "." , "" , str_replace("-" , "" , $_POST['cpf'] ));
$_POST['rg'] = str_replace("." , "", $_POST['rg']);
//$codigo_vendedor = str_replace("/","",str_replace( "." , "" , str_replace("-" , "" , $codvendedor)));

//== Verificar Professor
$cmd_pro = "SELECT * FROM professor WHERE Id_Numero = '".$_POST['cpf']."'";
$res_pro = mysql_query($cmd_pro);
$num_pro = mysql_num_rows($res_pro);

if($num_pro > 0){
	$mensagem = "Este Professor já esta cadastrado.";
	header("location? incluir_professor.php?msg=$mensagem");
	exit;
}


//== Incluir dados do Professor
$cmd_professor = "
	INSERT INTO	professor (
		Id_Numero,
		Nome,
		Data_Nascimento,
		Sexo,
		RG,
		Orgao,
		CPF,
		e_Mail,
		Pis,
		Banco,
		Agencia,
		Conta,
		Data_Cadastro
	)VALUES(
		'".$_POST['cpf']."',
		'".($_POST['nome'] == '' ? 'NULL' : $_POST['nome'])."',
		'".($_POST['data_nascimento'] == '' ? '0000-00-00' : $_POST['data_nascimento'])."',
		'".($_POST['sexo'] == '' ? '0' : $_POST['sexo'])."',
		'".($_POST['rg'] == '' ? 'NULL' : $_POST['rg'])."',
		'".($_POST['orgao'] == '' ? 'NULL' : $_POST['orgao'])."',
		'".($_POST['cpf'] == '' ? 'NULL' : $_POST['cpf'])."',
		'".($_POST['email'] == '' ? 'NULL' : $_POST['email'])."',
		'".($_POST['pis'] == '' ? 'NULL' : $_POST['pis'])."',
		'".($_POST['banco'] == '' ? 'NULL' : $_POST['banco'])."',
		'".($_POST['agencia'] == '' ? 'NULL' : $_POST['agencia'])."',
		'".($_POST['conta'] == '' ? 'NULL' : $_POST['conta'])."',
		'".date('Y-m-d')."'
	)
";

mysql_query($cmd_professor) or die ("Erro na Gravação do Professor. ".mysql_error());


//== Incluir dados do Endereço do Professor
$cmd_endereco = "
	INSERT INTO	endereco (
		Id_Numero,
		Endereco,
		Bairro,
		CEP,
		Cidade,
		UF,
		Fone_Residencial,
		Fone_Comercial,
		Celular,
		Data_Cadastro,
		Tipo_Pessoa
	)VALUES(
		'".$_POST['cpf']."',
		'".($_POST['endereco'] == '' ? 'NULL' : $_POST['endereco'])."',
		'".($_POST['bairro'] == '' ? 'NULL' : $_POST['bairro'])."',
		'".($_POST['cep'] == '' ? 'NULL' : $_POST['cep'])."',
		'".($_POST['cidade'] == '' ? 'NULL' : $_POST['cidade'])."',
		'".($_POST['uf'] == '' ? 'NU' : $_POST['uf'])."',
		'".($_POST['fone_residencial'] == '' ? '0' : $_POST['fone_residencial'])."',
		'".($_POST['fone_comercial'] == '' ? '0' : $_POST['fone_comercial'])."',
		'".($_POST['celular'] == '' ? '0' : $_POST['celular'])."',
		'".date('Y-m-d')."',
		'".$_POST['tipo_pessoa']."'
	)
";
mysql_query($cmd_endereco) or die ("Erro na Gravação do Endereço do Professor. ".mysql_error());
?>
<script>
	alert('Professor(a) incluído(a) com sucesso!');
	document.location='incluir_professor.php';	
</script>