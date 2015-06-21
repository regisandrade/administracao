<?php
//=============================================//
// Proprietário: IPECON - Ensino e Consultoria
// Site........: www.ipecon.com.br
// Autor.......: Régis Rodrigues de Andrade
// Página......: Inclusão de Aluno
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

// Envio de e-mail
function enviarEmail($assunto,$msg){
	$to  = 'regisandrade@gmail.com';

	// subject
	$subject = $assunto;

	// message
	$message = '
	<html>
	<head>
		<title>'.$assunto.'</title>
	</head>
	<body>'.$msg.'
	</body>
	</html>';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: Regis Andrade <regisandrade@gmail.com>' . "\r\n";
	$headers .= 'From: Sistema Administrativo - IPECON <ipecon@ipecon.com.br>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
}

//== Descrição do STATUS
//== 0 --> Inativo
//== 1 --> Ativo

//== Formatação da Data
$data = explode('/',$_POST['data_nascimento']);
$_POST['data_nascimento'] = $data[2].'-'.$data[1].'-'.$data[0];

//== Retirar sinais do CPF
$id_numero = str_replace( "." , "" , str_replace("-" , "" , $_POST['cpf']));

/*
	Verificação completa para o cadastro do aluno:
	1. Verificar se o aluno esta cadastrado no curso escolhido;
	2. Verificar se o aluno já tem endereço cadastrado;
	3. Verificar se o aluno ja tem graduação cadastrada;
	4. Verificar se o aluno já tem usuário(login) cadastrado;
		4.1 Verificar se o login escolhido já existe.
*/

// 1. Verificar se o aluno esta cadastrado no curso escolhido;
$sql = "SELECT 
                     ALU.*
                    ,CUR.Nome NomeCurso 
              FROM 
                     aluno ALU
              INNER JOIN curso CUR ON
                     CUR.Codg_Curso = ALU.Curso 
              WHERE 
                     ALU.Id_Numero = '".$id_numero."' 
                 AND ALU.Ano       = ".$_POST['ano']." 
                 AND ALU.Curso     = ".$_POST['codg_curso'];
$resultado = mysql_query($sql);
$numero = mysql_num_rows($resultado);
$registro = mysql_fetch_array($resultado);

if($numero > 0){
?>
	<script language="JavaScript">
		alert('O aluno(a) <?php echo $registro["Nome"]?> já esta cadastrado no curso <?php echo $registro["NomeCurso"]?> no ano de <?php echo $_POST["ano"]; ?>.');
		history.back(-1);
	</script>
<?php
	exit();
}else{
	// 1. Verificar se o aluno já tem usuário(login) cadastrado
	$sql_usuario = "SELECT * FROM usuario_aluno WHERE Id_Numero = '".$id_numero."'";
	$res_usuario = mysql_query($sql_usuario);
	$num_usuario = mysql_num_rows($res_usuario);
	if($num_usuario == 0){
		// 1.1 Verificar se o login escolhido já existe.
		$sql_usuario = "SELECT * FROM usuario_aluno WHERE Login = '".$_POST['txtUsuario']."'";
		$res_usuario = mysql_query($sql_usuario);
		$num_usuario = mysql_num_rows($res_usuario);

		if($num_usuario > 0){
	?>
			<script language="javascript">
				alert('Este usuário já existe, por favor, tente um outro diferente.');
				history.back(-1);
			</script>
	<?php
			exit;
		}

		//== Gravar Login e Senha do Aluno
		$cmd_usuario_aluno = "
			INSERT INTO	usuario_aluno (
				Login,
				Nome,
				Senha,
				Id_Numero
			)VALUES(
				'".($_POST['txtUsuario'] == '' ? 'NULL' : $_POST['txtUsuario'])."',
				'".($_POST['nome'] == '' ? 'NULL' : ucwords(strtolower($_POST['nome'])))."',
				'".($_POST['txtSenha'] == '' ? 'NULL' : $_POST['txtSenha'])."',
				'".($id_numero == '' ? 'NULL' : $id_numero)."'
			)
		";
		mysql_query($cmd_usuario_aluno);
	}	

	// Inserir aluno
	$comando = "
		INSERT INTO	aluno (
			Ano,
			Id_Numero,
			Nome,
			Data_Nascimento,
		  	Naturalidade,
			UF_Naturalidade,
			Nacionalidade,
			Sexo,
			RG,
			Orgao,
			CPF,
			e_Mail,
			Data_Cadastro,
			Status,
			Curso,
			Web,
			Data_Vencimento,
			twitter
		)VALUES(
			".($_POST['ano'] == '' ? 0 : $_POST['ano']).",
			'".($id_numero == '' ? 'NULL' : $id_numero)."',
			'".($_POST['nome'] == '' ? 'NULL' : ucwords(strtolower($_POST['nome'])))."',
			'".($_POST['data_nascimento'] == '' ? '0000-00-00' : $_POST['data_nascimento'])."',
			'".($_POST['naturalidade'] == '' ? 'NULL' : $_POST['naturalidade'])."',
			'".($_POST['uf_1'] == '' ? 'NULL' : $_POST['uf_1'])."',
			'".($_POST['nacionalidade'] == '' ? 'NULL' : $_POST['nacionalidade'])."',
			'".($_POST['sexo'] == '' ? 'NULL' : $_POST['sexo'])."',
			'".($_POST['rg'] == '' ? 'NULL' : $_POST['rg'])."',
			'".($_POST['orgao'] == '' ? 'NULL' : $_POST['orgao'])."',
			'".($id_numero == '' ? 'NULL' : $id_numero)."',
			'".($_POST['email'] == '' ? 'NULL' : $_POST['email'])."',
			'".date('Y-m-d')."',
			'1',
			".($_POST['codg_curso'] == '' ? 0 : $_POST['codg_curso']).",
			2,
			".($_POST['vencimento'] == '' ? 0 : $_POST['vencimento']).",
			'".($_POST['twitter'] == '' ? 'null' : $_POST['twitter'])."'
		)
	";
	mysql_query($comando) or die ("Erro na Gravação do Aluno.<br>Comando: ".$comando."<br>Erro:".mysql_error());

	// Inserir endereço
	$cmd_endereco = "SELECT * FROM endereco WHERE Id_Numero = '".$id_numero."'";
	$res_endereco = mysql_query($cmd_endereco);
	$num_endereco = mysql_num_rows($res_endereco);

	if($num_endereco == 0){
		//== Incluir dados do Endereço do Aluno
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
				'".($id_numero == '' ? 'NULL' : $id_numero)."',
				'".($_POST['endereco'] == '' ? 'NULL' : $_POST['endereco'])."',
				'".($_POST['bairro'] == '' ? 'NULL' : $_POST['bairro'])."',
				'".($_POST['cep'] == '' ? 'NULL' : $_POST['cep'])."',
				'".($_POST['cidade'] == '' ? 'NULL' : $_POST['cidade'])."',
				'".($_POST['uf_2'] == '' ? '00' : $_POST['uf_2'])."',
				'".($_POST['fone_residencial'] == '' ? 'NULL' : $_POST['fone_residencial'])."',
				'".($_POST['fone_comercial'] == '' ? 'NULL' : $_POST['fone_comercial'])."',
				'".($_POST['celular'] == '' ? 'NULL' : $_POST['celular'])."',
				'".date('Y-m-d')."',
				'".($_POST['tipo_pessoa'] == '' ? 'NULL' : $_POST['tipo_pessoa'])."'
			)
		";
		mysql_query($cmd_endereco) or die ("Erro na Gravação do Endereço do Aluno.<br>Comando: ".$cmd_endereco."<br>Erro:".mysql_error());
	}


	//== Verificar o graduação.
	$cmd_graduacao = "SELECT * FROM graduacao WHERE Id_Numero = '".$id_numero."'";
	$res_graduacao = mysql_query($cmd_graduacao);
	$num_graduacao = mysql_num_rows($res_graduacao);

	if($num_graduacao == 0){
		//== Incluir dados do Endereço do Aluno
		$cmd_graduacao = "
			INSERT INTO	graduacao (
				Id_Numero,
				Curso_Graduacao,
				Instituicao,
				Sigla,
				Ano_Conclusao,
				Data_Cadastro
			)VALUES(
				'".($id_numero == '' ? 'NULL' : $id_numero)."',
				'".($_POST['curso'] == '' ? 'NULL' : $_POST['curso'])."',
				'".($_POST['instituicao'] == '' ? 'NULL' : $_POST['instituicao'])."',
				'".($_POST['sigla'] == '' ? 'NULL' : $_POST['sigla'])."',
				'".($_POST['conclusao'] == '' ? 'NULL' : $_POST['conclusao'])."',
				'".date('Y-m-d')."'
			)
		";
		mysql_query($cmd_graduacao) or die ("Erro na Gravação da Graduação do Aluno.<br>Comando: ".$cmd_graduacao."<br>Erro:".mysql_error());
	}

}

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE `aluno`, `endereco`, `graduacao`, `usuario_aluno`';
mysql_query($sql) or die ("Erro na Otimização das Tabelas.<br>Erro:".mysql_error());
?>
<script>
	alert('Aluno(a) incluído(a) com sucesso!');
	document.location='incluir_aluno.php';
</script>