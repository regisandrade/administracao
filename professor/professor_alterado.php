<?php 
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Alterar Professor
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

//== Formata��o da Data
$data = explode('/',$data_nascimento);
$data_nascimento = $data[2].'-'.$data[1].'-'.$data[0];

//== Alterar o Professor
$comando = "
UPDATE professor SET
	Nome = '$nome',
	Data_Nascimento = '$data_nascimento',
	Sexo = '$sexo',
	RG = '$rg',
	Orgao = '$orgao',
	CPF = '$cpf',
	e_Mail = '$email',
	Pis = '$pis',
	Banco = '$banco',
	Agencia = '$agencia',
	Conta = '$conta'
WHERE
	Id_Numero = '$id_numero'
";
mysql_query($comando) or die ("Erro na Altera��o do Professor. ".mysql_error());

//== Alterar o Endere�o do Professor
$comando_2 = "
UPDATE endereco SET
	Endereco = '$endereco',
	Bairro = '$bairro',
	CEP = '$cep',
	Cidade = '$cidade',
	UF = '$uf',
	Fone_Residencial = '$fone_residencial',
	Fone_Comercial = '$fone_comercial',
	Celular = '$celular'
WHERE
	Id_Numero = '$id_numero'
";
mysql_query($comando_2) or die ("Erro na Altera��o do Endere�o do Professor(a). ".mysql_error());
?>
<script>
	alert('Professor(a) alterado(a) com sucesso!');
	document.location='listar_professores.php';	
</script>