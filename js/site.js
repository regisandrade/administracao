function preInscricao(id){
	document.location = "?inscricao=1&codigo="+id;
}

function Recomende(largura,altura){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px status=1" ;
	window.open('recomende.php','mail',propriedades);
}

function mostrarCidadeCurso(){
    if($('#codg_curso').val() == 6){
        $('#trCidadeCurso').show();
    }else{
        $('#trCidadeCurso').hide();
    }
}

function abrirPagina(url,titulo,largura,altura){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px status=1, scrollbars=1" ;
	window.open(url,titulo,propriedades);
}

// Visualizar materia para imprimir
function ImprimirMateria(valor,largura,altura){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px, scrollbars=1, status=1" ;

	window.open('printMateria.php?idMateria='+valor,'Imprimir',propriedades);
}

function esqueceSenha(largura,altura){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px status=1" ;
	window.open('esqueceu_senha.php','esqueceu',propriedades);
}

jQuery(function($){
	$("#data_nascimento").mask("99/99/9999");

	$("#fone_residencial").mask("(99) 9999-9999");
	$("#fone_comercial").mask("(99) 9999-9999");
	$("#celular").mask("(99) 9999-9999");
	$("#cep").mask("99999-999");

	$("#cpf").mask("999.999.999-99");
	$("#numCpf").mask("999.999.999-99");
	$("#conclusao").mask("9999");
});

function VerificarEsqueceuSenha(){
    if($('#usuario').val() == ''){
        alert('Por favor, digite seu Usuário.');
        $('#usuario').focus();
        return false;
    }

    if($('#code').val() == ''){
        alert('Por favor, digite o Código de Segurança.');
        $('#code').focus();
        return false;
    }
}

function mostraErro(transport) {
    alert ('Erro: '+transport.responseText);
}

function gravarNewsletter(){

    if($('#nome').val() == 'Seu nome' || $('#nome').val() == ''){
        alert('Newsletter: Digitar seu nome.');
        return false;
    }
    if($('#email').val() == 'Seu e-mail' || $('#email').val() == ''){
        alert('Newsletter: Digitar seu e-mail.');
        return false;
    }else if(!checkMail($('#email').val())){
    	alert("Digitar um e-mail válido!");
    	return false;
    }


    var serializedForm = $("#formNewsletter").serialize();
    
    $.ajax({
        type: "POST",
        url: "gravarNewsletter.php",
        data: serializedForm,
        success: retornoGravarNewsletter
    });
}
function retornoGravarNewsletter(){
    $('#nome').val('Seu nome');
    $('#email').val('Seu e-mail');
    alert('Cadastro realizado com sucesso!');
}

/*function limparCampo(campo){
	//alert("$('#"+campo.id+"')");
    "$('#"+campo.id+"')".val() = "";
}*/
$('#nome').live('click',function(){
	$('#nome').val('');
});
$('#email').live('click',function(){
	$('#email').val('');
});

function VerificarInscricao(){
	if($('#codg_curso').val() == ''){
		alert('Favor, selecionar um Curso.');
		$('#codg_curso').focus();
		return false;
	}

	if($('#nome').val() == ''){
		alert('Favor, digitar o Nome do Aluno.');
		$('#nome').focus();
		return false;
	}

	if($('#data_nascimento').val() == '' || $('#data_nascimento').val() == '__/__/____'){
		alert('Favor, digitar a Data de Nascimento do Aluno.');
		$('#data_nascimento').focus();
		return false;
	}

	if($('#naturalidade').val() == ''){
		alert('Favor, digitar a Naturalidade do Aluno.');
		$('#naturalidade').focus();
		return false;
	}

	if($('#uf_1').val() == ''){
		alert('Favor, selecionar o Estado da Naturalidade do Aluno.');
		$('#uf_1').focus();
		return false;
	}

	if($('#cpf').val() == '' || $('#cpf').val() == '___.___.___-__'){
		alert('Favor, digitar o CPF do Aluno.');
		$('#cpf').focus();
		return false;
	}

	if($('#endereco').val() == ''){
		alert('Favor, digitar o Endereço do Aluno.');
		$('#endereco').focus();
		return false;
	}

	if($('#bairro').val() == ''){
		alert('Favor, digitar o Bairro do Aluno.');
		$('#bairro').focus();
		return false;
	}

	if($('#cidade').val() == ''){
		alert('Favor, digitar a Cidade do Aluno.');
		$('#cidade').focus();
		return false;
	}

	if($('#uf_2').val() == ''){
		alert('Favor, digitar o Estado do Aluno.');
		$('#uf_2').focus();
		return false;
	}

	if($('#cep').val() == '' || $('#cep').val() == '_____-___'){
		alert('Favor, digitar o CEP do Aluno.');
		$('#cep').focus();
		return false;
	}

	if($('#email').val() == ''){
		alert('Favor, digitar o e-mail.');
		$('#email').focus();
		return false;
	}

	if($('#curso').val() == ''){
		alert('Favor, digitar o Curso de Graduação do Aluno.');
		$('#curso').focus();
		return false;
	}

	if($('#instituicao').val() == ''){
		alert('Favor, digitar a Instituição do Aluno.');
		$('#instituicao').focus();
		return false;
	}

	if($('#sigla').val() == ''){
		alert('Favor, digitar a Sigla da Instituição do Aluno.');
		$('#sigla').focus();
		return false;
	}

	if($('#conclusao').val() == ''){
		alert('Favor, digitar o Ano de Conclusão do Aluno.');
		$('#conclusao').focus();
		return false;
	}
}

function checkMail(mail){
	var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
	if(typeof(mail) == "string"){
		if(er.test(mail)){ return true; }
	}else if(typeof(mail) == "object"){
		if(er.test(mail.value)){ 
			return true; 
		}
	}else{
		return false;
	}
}