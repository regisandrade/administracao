<?php
require('../../conexao.php');

$comando = "SELECT * FROM usuario_adm WHERE Login = '$login'";
$result = mysql_query($comando);
$registro = mysql_fetch_array($result);
?>
<html>
<head>
<title>IPECON - Ensino e Consultoria</title>
<link href="../../ipecon.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function Verificar(){
	if(document.form_usuario.nome.value==''){
		alert('Favor, digitar o Nome do Usuário.');
		document.form_usuario.nome.focus();
		return false;
	}

	if(document.form_usuario.login.value==''){
		alert('Favor, digitar o Login do Usuário.');
		document.form_usuario.login.focus();
		return false;
	}

	if(document.form_usuario.senha.value==''){
		alert('Favor, digitar a Senha do Usuário.');
		document.form_usuario.senha.focus();
		return false;
	}

	if(document.form_usuario.confirmar.value==''){
		alert('Favor, digitar a Confirmação da Senha do Usuário.');
		document.form_usuario.confirmar.focus();
		return false;
	}
	
	if(document.form_usuario.senha.value == document.form_usuario.confirmar.value){
		return true;
	}else{
		alert('A Senha esta diferente da Confirma Senha.');
		document.form_usuario.senha.focus();
		return false;
	}
}
</script>
</head>
<body bgcolor="#ffffff" topmargin="0" leftmargin="0">
<table width="600" height="100%" border="0" cellpadding="0" cellspacing="0" style="border: solid 1px #999999">
	<tr> 
		<td height="7" background="../../imagens/ponto_branco.gif"></td>
	</tr>
	<tr>
		<td valign="top">
			<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #CCCCCC">
				<tr bgcolor="#336699"> 
					<td><img src="../../imagens/bot_esquerda.gif"></td>
					<td align="right" class="Texto" style="padding-left: 0.3em"><b><font color="#FFFFFF">Incluir Usuário</font></b>&nbsp;</td>
				</tr>
			</table>
		<table bgcolor="#EEEEEE" width="99%" border="0" align="center" cellpadding="0" cellspacing="0" style="border: solid 1px #CCCCCC">
		<form name="form_usuario" method="get" action="usuario_alterado.php" onSubmit="return Verificar()">
          <input type="hidden" name="login" value="<?php print($login); ?>">
          <tr> 
            <td height="7" colspan="2" background="../../imagens/spacer.gif"></td>
          </tr>
          <tr> 
            <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Nome:</td>
            <td width="78%" style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" size="46" maxlength="150" value="<?php print($registro['Nome']); ?>"></td>
          </tr>
          <tr> 
            <td height="22" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Sexo:</td>
            <td style="padding-left: 0.3em"><input name="sexo" type="radio" value="M" <?php if($registro['Sexo'] == 'M'){ print('checked'); }?>>
              Masculino<br> <input type="radio" name="sexo" value="F" <?php if($registro['Sexo'] == 'F'){ print('checked'); }?>>
              Feminino </td>
          </tr>
          <tr> 
            <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Login:</td>
            <td style="padding-left: 0.3em"><input readonly name="login" type="text" class="TextoFormulario" id="login" size="15" maxlength="15" value="<?php print($registro['Login']); ?>">
              <font color="#FF0000">*</font></td>
          </tr>
          <tr> 
            <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Senha:</td>
            <td style="padding-left: 0.3em"><input name="senha" type="password" class="TextoFormulario" id="senha" size="15" maxlength="10"></td>
          </tr>
          <tr> 
            <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Confirmar 
              Senha:</td>
            <td style="padding-left: 0.3em"><input name="confirmar" type="password" class="TextoFormulario" id="confirmar" size="15" maxlength="10"></td>
          </tr>
          <tr>
            <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
            <td style="padding-left: 0.3em"><font color="#FF0000" size="1">* O usu&aacute;rio 
              n&atilde;o pode ser alterado.</font></td>
          </tr>
          <tr> 
            <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
            <td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Alterar">
              &nbsp;&nbsp;
              <input type="button" name="cancelar" value="Cancelar" onClick="history.back()"></td>
          </tr>
          <script language="JavaScript">document.form_usuario.nome.focus()</script>
        </form>
      </table>
		</td>
	</tr>
</table>
</body>
</html>_usuario.nome.focus()</script>
        </form>
      </table>
		</td>
	</tr>
</table>
</body>
</html>