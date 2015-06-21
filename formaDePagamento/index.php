<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Administração :: Ipecon </title>
    <style type="text/css">
    <!--
    @import url("../css/formaPagamento.css");
    -->
    </style>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/prototype.js"></script>
    <script type="text/javascript" src="../js/administracao.js"></script>
    <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
    <!--<script type="text/javascript">
        $(document).ready(function() {
            $('.icone').live('click',function(){
                pai = $(this).parents('td');
                campo = pai.find('input');
                classes = campo.attr('class');
                $("input[class='"+classes+"']").val(campo.val());
            });
        });
        //&nbsp;<a href="#" class="icone">[**]</a>
    </script>-->
</head>
<body>
<?php
require_once '../../conexao.inc.php';
require_once '../../class/util.class.php';
$util = new Util();

$sqlFormaDePagamento = "SELECT * FROM formasDePagamento
                        WHERE idAluno = '".$_REQUEST['id_numero']."' AND
                              ano = ".$_REQUEST['ano'];
$dadosFormaPagamento = mysql_fetch_array(mysql_query($sqlFormaDePagamento));
?>
<form id="formCheques" action="gravarFormaDePagamento.php" method="POST">
    <input type="hidden" name="id_numero" id="id_numero" value="<?php echo $_REQUEST['id_numero']; ?>" />
    <input type="hidden" name="curso" id="curso" value="<?php echo $_REQUEST['curso']; ?>" />
    <input type="hidden" name="nomeCurso" id="nomeCurso" value="<?php echo $_REQUEST['nomeCurso']; ?>" />
    <input type="hidden" name="nomeAluno" id="nomeAluno" value="<?php echo $_REQUEST['nome']; ?>" />
    <input type="hidden" name="ano" id="ano" value="<?php echo $_REQUEST['ano']; ?>" />
    <input type="hidden" name="idFormaDePagamento" id="idFormaDePagamento" value="<?php echo $dadosFormaPagamento['id']; ?>" />
    <input type="hidden" name="valorParcela" id="valorParcela" value="<?php echo ($dadosFormaPagamento['valorParcela'] ? number_format($dadosFormaPagamento['valorParcela'], 2, ',','.') : '') ?>" class="txtPequeno" />
    <table width="100%">
        <tr>
            <td colspan="2" valign="top" height="25"><h3>Forma de pagamento</h3></td>
        </tr>
        <tr>
            <td colspan="2" height="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
        </tr>
        <tr>
            <td class="texto">Ano:</td>
            <td><?php echo $_REQUEST['ano']; ?></td>
        </tr>
        <tr>
            <td class="texto">Curso:</td>
            <td><?php echo $_REQUEST['nomeCurso']; ?></td>
        </tr>
        <tr>
            <td class="texto">Nome:</td>
            <td><?php echo $_REQUEST['nome']; ?></td>
        </tr>
        <tr>
            <td class="texto">Forma de pagamento:</td>
            <td><input type="radio" name="formaPagamento" id="formaPagamento" value="B" onclick="mostrarCheques(this.value);" <?php echo ($dadosFormaPagamento['formaPagamento'] == 'B' ? 'checked' : ''); ?> />Boleto <br/>
                <input type="radio" name="formaPagamento" id="formaPagamento" value="C" onclick="mostrarCheques(this.value);" <?php echo ($dadosFormaPagamento['formaPagamento'] == 'C' ? 'checked' : ''); ?> />Cheque</td>
        </tr>
        <tr>
            <td class="texto">Valor total:</td>
            <td><input type="text" name="valorTotal" id="valorTotal" value="<?php echo ($dadosFormaPagamento['valorTotal'] ? number_format($dadosFormaPagamento['valorTotal'], 2, ',','.') : '')?>" class="txtPequeno" /></td>
        </tr>
        <tr>
            <td class="texto">Parcelas:</td>
            <td><select name="parcela" id="parcela" class="txtMini" onChange="calcularValorParcela();">
                    <option value="">[--]</option>
                    <?php
                    for($volta = 1; $volta <= 24; $volta++){
                        echo '<option value="'.$volta.'" '.($dadosFormaPagamento['parcelas'] == $volta ? 'selected' : '').'>'.str_pad($volta, 2, "0", STR_PAD_LEFT).'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="texto">Valor de cada parcela:</td>
            <td><span id="txtValorParcela"><?php echo ($dadosFormaPagamento['valorParcela'] ? "R$ ".number_format($dadosFormaPagamento['valorParcela'], 2, ',','.') : '') ?></span>
            </td>
        </tr>
        <tr>
            <td class="texto">Dia de vencimento:</td>
            <td><select name="diaDeVencimento" id="diaDeVencimento" class="txtMini">
                    <option value="">[--]</option>
                    <?php
                    for($volta = 1; $volta <= 31; $volta++){
                        echo '<option value="'.$volta.'" '.($dadosFormaPagamento['diaVencimento'] == $volta ? 'selected' : '').'>'.str_pad($volta, 2, "0", STR_PAD_LEFT).'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr id="tabelaDeCheques" style="display: none;">
            <td colspan="2" class="texto" style="vertical-align: top;">Cheques:<br/>
                <table border="0">
                    <tr>
                        <td><strong>Ord.</strong></td>
                        <td><strong>Banco</strong></td>
                        <td><strong>Agência</strong></td>
                        <td><strong>Conta</strong></td>
                        <td><strong>Número</strong></td>
                        <td><strong>Valor (R$)</strong></td>
                        <td><strong>Vencimento</strong></td>
                        <td><strong>Emitente</strong></td>
                    </tr>
                        <?php
                        $volta = 0;
                        // Selecionar os cheques na tabela de cheques
                        $sqlCheques = "SELECT * FROM cheques WHERE idFormaDePagamento = ".$dadosFormaPagamento['id']." ORDER BY vencimento";
                        $rsCheques = mysql_query($sqlCheques);
                        while($dadosCheque = mysql_fetch_assoc($rsCheques)){
                            $arrCheques[] = array("id"=>$dadosCheque['id'],"banco"=>$dadosCheque['banco'],
                                                  "agencia"=>$dadosCheque['agencia'],"conta"=>$dadosCheque['conta'],
                                                  "numero"=>$dadosCheque['numero'],"valor"=>$dadosCheque['valor'],
                                                  "vencimento"=>$dadosCheque['vencimento'],"emitente"=>$dadosCheque['emitente'])  ;
                            $volta++;
                        }
                        foreach($arrCheques as $key => $valorCheques){
                            echo '
                            <tr>
                                <td>'.($key+1).'<input type="hidden" name="id['.$valorCheques['id'].']" id="id['.$valorCheques['id'].']" value="'.$valorCheques['id'].'" class="txtPequeno" /></td>
                                <td><input type="text" name="banco['.$valorCheques['id'].']" id="banco['.$valorCheques['id'].']" value="'.$valorCheques['banco'].'" class="txtPequeno" /></td>
                                <td><input type="text" name="agencia['.$valorCheques['id'].']" id="agencia['.$valorCheques['id'].']" value="'.$valorCheques['agencia'].'" class="txtPequeno" /></td>
                                <td><input type="text" name="conta['.$valorCheques['id'].']" id="conta['.$valorCheques['id'].']" value="'.$valorCheques['conta'].'" class="txtPequeno" /></td>
                                <td><input type="text" name="numero['.$valorCheques['id'].']" id="numero['.$valorCheques['id'].']" value="'.$valorCheques['numero'].'" class="txtPequeno" onkeypress="SomenteNumero(this);" /></td>
                                <td><input type="text" name="valor['.$valorCheques['id'].']" id="valor['.$valorCheques['id'].']" value="'.number_format($valorCheques['valor'],2,',','.').'" class="txtPequeno" /></td>
                                <td><input type="text" name="vencimento['.$valorCheques['id'].']" id="vencimento['.$valorCheques['id'].']" value="'.$util->fmtDataBarra($valorCheques['vencimento']).'" class="txtPequeno" /></td>
                                <td><input type="text" name="emitente['.$valorCheques['id'].']" id="emitente['.$valorCheques['id'].']" value="'.$valorCheques['emitente'].'" class="txtPequeno" /></td>
                            </tr>';
                        }
                        $icone = null;
                        for($i = $volta; $i < 24; $i++){
                            echo '
                            <tr>
                                <td>'.($i+1).'<input type="hidden" name="id[]" id="id[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="banco[]" id="banco[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="agencia[]" id="agencia[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="conta[]" id="conta[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="numero[]" id="numero[]" value="" class="txtPequeno" onkeypress="SomenteNumero(this);" /></td>
                                <td><input type="text" name="valor[]" id="valor[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="vencimento[]" id="vencimento[]" value="" class="txtPequeno" /></td>
                                <td><input type="text" name="emitente[]" id="emitente[]" value="" class="txtPequeno" /></td>
                            </tr>';
                        }
                         
                        ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnGravar" id="btnGravar" value="Gravar" class="botao" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
<?php
if($dadosFormaPagamento['id'] && $dadosFormaPagamento['formaPagamento'] == 'C'){
    echo "mostrarCheques('C');";
}else{
    echo "formataMoeda($('valorTotal'), 2);";
    echo "formataMoeda($('valorParcela'), 2);";
}
?>
</script>
</body>
</html>