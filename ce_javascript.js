// JavaScript Document

// Validar formulário do Cliente
function Validar_Cliente(){
	// Verificar o Nome do Cliente
	if(document.form_cliente.nome.value == ''){
		alert('Por favor, digitar o Nome do Cliente.');
		document.form_cliente.nome.focus();
		return false;
	}
	// Verificar o Endereço
	if(document.form_cliente.endereco.value == ''){
		alert('Por favor, digitar o Endereço do Cliente.');
		document.form_cliente.endereco.focus();
		return false;
	}
	// Verificar a Cidade
	if(document.form_cliente.cidade.value == ''){
		alert('Por favor, digitar a Cidade do Cliente.');
		document.form_cliente.cidade.focus();
		return false;
	}
	// Verificar o 1º Telefone
	if(document.form_cliente.fone_1.value == '' && document.form_cliente.fone_2.value == ''){
		alert('Por favor, digitar pelomenos um Telefone.');
		document.form_cliente.fone_1.focus();
		return false;
	}
	// Verificar o C.P.F / C.N.P.J.
	if(document.form_cliente.cpf_cnpj.value == ''){
		alert('Por favor, digitar o C.P.F. ou C.N.P.J. do Cliente.');
		document.form_cliente.cpf_cnpj.focus();
		return false;
	}
}