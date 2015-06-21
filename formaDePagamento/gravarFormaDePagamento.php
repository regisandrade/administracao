<?php
require_once '../../conexao.inc.php';
require_once '../../class/util.class.php';
$util = new Util();

//echo "<pre>";
//print_r($_REQUEST);
//foreach ($_REQUEST['id'] as $key => $value) {
//    if($value){
//        echo "tem valor\n";
//    }else{
//        echo "não tem valor\n";
//    }
//    //echo $value.'='.$key."\n";
//}
//die();


if(!empty($_REQUEST['idFormaDePagamento'])){
    //Alteração
    $var = "Alterção";
    $sql_insert = "UPDATE formasDePagamento SET formaPagamento = '".$_REQUEST['formaPagamento']."',
                        valorTotal = '".$util->fmtValorBD($_REQUEST['valorTotal'])."',
                        parcelas = ".$_REQUEST['parcela'].",
                        valorParcela = '".$util->fmtValorBD($_REQUEST['valorParcela'])."',
                        diaVencimento = ".$_REQUEST['diaDeVencimento']."
                   WHERE id = ".$_REQUEST['idFormaDePagamento'];
    mysql_query($sql_insert) or die ("Erro na ".$var.  mysql_error());
    $ultimoId = $_REQUEST['idFormaDePagamento'];
}else{
    // Inclusão
    $var = "Inclusão";
    $sql_insert = "INSERT INTO formasDePagamento (idCurso, idAluno, ano, nomeCurso, nomeAluno,
                        formaPagamento, valorTotal, parcelas, valorParcela,
                        diaVencimento)
                    VALUES (".$_REQUEST['curso'].",'".$_REQUEST['id_numero']."',
                        ".$_REQUEST['ano'].",'".$_REQUEST['nomeCurso']."',
                        '".$_REQUEST['nomeAluno']."','".$_REQUEST['formaPagamento']."',
                        '".$util->fmtValorBD($_REQUEST['valorTotal'])."',".$_REQUEST['parcela'].",
                        '".$util->fmtValorBD($_REQUEST['valorParcela'])."',".$_REQUEST['diaDeVencimento']."
                        )";
    mysql_query($sql_insert) or die ("Erro na ".$var.  mysql_error());
    $ultimoId = mysql_insert_id();
}

if(isset($_REQUEST['banco']) && isset($_REQUEST['agencia']) && isset($_REQUEST['conta']) &&
   isset($_REQUEST['numero']) && isset($_REQUEST['valor']) && isset($_REQUEST['vencimento']) &&
   isset($_REQUEST['emitente']) && isset($ultimoId)){
    
    foreach ($_REQUEST['id'] as $key => $value) {
        if($value){
            $gravar = "UPDATE cheques SET banco = '".$_REQUEST['banco'][$key]."',
                        agencia = '".$_REQUEST['agencia'][$key]."',
                        conta = ".$_REQUEST['conta'][$key].",
                        numero = '".$_REQUEST['numero'][$key]."',
                        valor = '".$util->fmtValorBD($_REQUEST['valor'][$key])."',
                        vencimento = '".$util->fmtDataBD($_REQUEST['vencimento'][$key])."',
                        emitente = '".$_REQUEST['emitente'][$key]."'
                   WHERE id = ".$key;
            mysql_query($gravar) or die ("Erro ao alterar cheques. ".  mysql_error());
        }
    }
    foreach ($_REQUEST['banco'] as $chave => $value) {
        if(!$_REQUEST['id'][$chave] && $_REQUEST['banco'][$chave]){
            $gravar = "INSERT INTO cheques (idFormaDePagamento, banco, agencia, conta,
                           numero, valor, vencimento, emitente)
                   VALUES (".$ultimoId.",'".iconv("UTF-8", "ISO-8859-1", $_REQUEST['banco'][$chave])."',
                           '".$_REQUEST['agencia'][$chave]."', '".$_REQUEST['conta'][$chave]."',
                           ".$_REQUEST['numero'][$chave].",'".$util->fmtValorBD($_REQUEST['valor'][$chave])."',
                           '".$util->fmtDataBD($_REQUEST['vencimento'][$chave])."',
                           '".$_REQUEST['emitente'][$chave]."')";
            mysql_query($gravar) or die ("Erro ao gravar cheques. ".  mysql_error());
        }
    }
    $msg = "Forma de pagamento incluída com sucesso!";
}else{
    $msg = "Não foi possível gravar os cheques, tente novamente com todos os campos preenchidos.";
}
?>
<script type="text/javascript" >
	alert('<?php echo $msg; ?>');
        window.close();
	//document.location='index.php';
</script>