$(document).ready( function() {
    $("#formLogin").validate({
        // Define as regras
        rules:{
            login: {
                required: true, minlength: 5
            },
            senha: {
                required: true, minlength: 5
            },
            user_code: {
                required: true, maxlength: 4
            },
        },
        // Define as mensagens de erro para cada regra
        messages:{
            login:{
                required: "Digite o usuário",
                minLength: "O seu usuário deve conter, no mínimo, 5 caracteres."
            },
            senha:{
                required: "Digite a senha do usuário",
                minLength: "O seu usuário deve conter, no mínimo, 5 caracteres."
            },
            user_code:{
                required: "Digite os caracteres de validação.",
                maxlength: "São 4 caracteres no máximo para validação."
            },
        },
        errorClass:'help-inline',
        validClass:'success',
        errorElement:'span',
        highlight: function(label) {
            $(label).closest('.control-group').removeClass('success').addClass('error');
        },
        /*success: function(label) {
            label
                //.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');
        },*/ 
        unhighlight: function (element, errorClass, validClass)
        {
            $(element).parents(".error")
                    .removeClass(errorClass)
                    .addClass(validClass); 
        }
    });
});