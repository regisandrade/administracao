function mostrarCheques(tipo){
    if(tipo == 'B'){
        $('tabelaDeCheques').hide();
    }else{
        $('tabelaDeCheques').show();
    }
}

/*** Digitar somente numero ***/
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58)) return true;
    else{
    if (tecla != 8) return false;
    else return true;
    }
}

function mostraErro(transport) {
    fAguarde(false);
    alert ('Erro: '+transport.responseText);
}

function gravarFormaPagamento(){
    if($('formaPagamento').value == ''){
        alert('Selecionar umma forma de pagamento.');
        return false;
    }
    if($('valorTotal').value == ''){
        alert('Digitar o valor total.');
        return false;
    }
    if($('parcela').value == ''){
        alert('Selecionar a quantidade de parcelas.');
        return false;
    }
    if($('valorParcela').value == ''){
        alert('Digitar o valor de cada parcela.');
        return false;
    }
    if($('diaDeVencimento').value == ''){
        alert('Selecionar um dia de vencimento.');
        return false;
    }

    var serializedForm = Form.serialize('formCheques');
    new Ajax.Request('gravarFormaDePagamento.php',
        {
            method:'post',
            encoding: 'ISO-8859-1',
            parameters:serializedForm,
            onFailure: mostraErro,
            onSuccess: retornogravarFormaPagamento
        });
}
function retornogravarFormaPagamento(){
    alert('Cadastro realizado com sucesso!');
    //window.close();
}

function limparCampo(campo){
    campo.value = '';
}

/**** FORMATAR VALOR MONETÁRIO ****/
addEvent = function(o, e, f, s){
    var r = o[r = "_" + (e = "on" + e)] = o[r] || (o[e] ? [[o[e], o]] : []), a, c, d;
    r[r.length] = [f, s || o], o[e] = function(e){
        try{
            (e = e || event).preventDefault || (e.preventDefault = function(){e.returnValue = false;});
            e.stopPropagation || (e.stopPropagation = function(){e.cancelBubble = true;});
            e.target || (e.target = e.srcElement || null);
            e.key = (e.which + 1 || e.keyCode + 1) - 1 || 0;
        }catch(f){}
        for(d = 1, f = r.length; f; r[--f] && (a = r[f][0], o = r[f][1], a.call ? c = a.call(o, e) : (o._ = a, c = o._(e), o._ = null), d &= c !== false));
        return e = null, !!d;
    }
};

removeEvent = function(o, e, f, s){
    for(var i = (e = o["_on" + e] || []).length; i;)
        if(e[--i] && e[i][0] == f && (s || o) == e[i][1])
            return delete e[i];
    return false;
};

function formataMoeda(o, n, dig, dec){
    o.c = !isNaN(n) ? Math.abs(n) : 2;
    o.dec = typeof dec != "string" ? "," : dec, o.dig = typeof dig != "string" ? "." : dig;
    addEvent(o, "keypress", function(e){
        if(e.key > 47 && e.key < 58){
            var o, s, l = (s = ((o = this).value.replace(/^0+/g, "") + String.fromCharCode(e.key)).replace(/\D/g, "")).length, n;
            if(o.maxLength + 1 && l >= o.maxLength) return false;
            l <= (n = o.c) && (s = new Array(n - l + 2).join("0") + s);
            for(var i = (l = (s = s.split("")).length) - n; (i -= 3) > 0; s[i - 1] += o.dig);
            n && n < l && (s[l - ++n] += o.dec);
            o.value = s.join("");
        }
        e.key > 30 && e.preventDefault();
    });
}
/**** FIM ****/

function float2moeda(num) {
   x = 0;
   if(num<0) {
      num = Math.abs(num);
      x = 1;
   }

   if(isNaN(num)) num = "0";
      cents = Math.floor((num*100+0.5)%100);

   num = Math.floor((num*100+0.5)/100).toString();

   if(cents < 10) cents = "0" + cents;
      for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
         num = num.substring(0,num.length-(4*i+3))+'.'
               +num.substring(num.length-(4*i+3));

   ret = num + ',' + cents;

   if (x == 1) ret = ' - ' + ret;return ret;

}

function calcularValorParcela(){
    if($('valorTotal').value != '' && $('parcela').value != ''){
        valorTotal = $F('valorTotal').replace('.','');
        valorTotal = valorTotal.replace(',','.');
        valorDividido = valorTotal / $F('parcela');
        $('valorParcela').value = float2moeda(valorDividido.toFixed(2));
        $('txtValorParcela').innerHTML = "R$ "+float2moeda(valorDividido.toFixed(2));
    }
}