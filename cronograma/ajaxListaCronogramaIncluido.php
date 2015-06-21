<?php
if($_REQUEST['turma']){
    require('../conexao.inc.php'); //== Conexão com o Banco de Dados
    $comando = "SELECT DISTINCT
          CRO.Id_Numero,
          CRO.Turma,
          TUR.Nome AS NomeTurma,
          CRO.Disciplina AS CodgDisciplina,
          DISC.Nome AS Disciplina,
          DATE_FORMAT(Data_01,'%d/%m/%Y') AS Data_01,
          DATE_FORMAT(Data_02,'%d/%m/%Y') AS Data_02,
          DATE_FORMAT(Data_03,'%d/%m/%Y') AS Data_03,
          DATE_FORMAT(Data_04,'%d/%m/%Y') AS Data_04,
          DATE_FORMAT(Data_05,'%d/%m/%Y') AS Data_05,
          DATE_FORMAT(Data_06,'%d/%m/%Y') AS Data_06
    FROM
        cronograma CRO
    INNER JOIN turma TUR ON
        TUR.Turma = CRO.Turma
    INNER JOIN disciplina DISC ON
        DISC.Codg_Disciplina = CRO.Disciplina
    WHERE
        CRO.Turma = '". $_REQUEST['turma'] ."'";
    $resultado = mysql_query($comando) or die('Erro na consulta do Cronograma. '.$query);
    $numero = mysql_num_rows($resultado);
    echo "<table width=\"100%\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">";
    if($numero == 0){
        echo "\t<tr>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center; color: red;\">Sem cronograma cadastrado para esta turma.</td>";
        echo "\t</tr>";
        echo "</table>";
        exit;
    }
    $mudaTurma = null;
    $conta=0;
    while ($dados = mysql_fetch_object($resultado)){
        if($conta % 2 == 1){
            $cor = '#DDEEFF';
        }else{
            $cor = '#FFFFFF';
        }
        if($mudaTurma != $dados->Turma){
            echo "\t<tr bgcolor=\"#FFECD9\">";
            echo "\t\t<th>&nbsp;</th>";
            echo "\t\t<th class=\"Texto\"><strong>".$dados->Turma." | ".iconv("iso-8859-1", "UTF-8", $dados->NomeTurma)."</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>1&ordf; Data</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>2&ordf; Data</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>3&ordf; Data</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>4&ordf; Data</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>5&ordf; Data</strong></th>";
            echo "\t\t<th class=\"Texto\"><strong>6&ordf; Data</strong></th>";
            echo "\t</tr>";
            $mudaTurma = $dados->Turma;
        }
        echo "\t<tr bgcolor=\"".$cor."\">";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\"><a href=\"alterar_cronograma.php?codg=".$dados->Id_Numero."&codgDisciplina=".$dados->CodgDisciplina."&codgTurma=".$dados->Turma."&local=1\" title=\"Alterar\"><img src=\"../../imagens/alterar.gif\" alt=\"Alterar Cronograma\" width=\"16\" height=\"16\" border=\"0\"></a>&nbsp;|&nbsp;
        		  <a href=\"JavaScript:ConfirmaExclusaoCronograma(".$dados->Id_Numero.",1,'".$_REQUEST['turma']."')\" title=\"Excluir\"><img src=\"../../imagens/excluir.gif\" alt=\"Excluir Cronograma\" width=\"16\" height=\"16\" border=\"0\"></a></td>";
        echo "\t\t<td class=\"Texto\">".iconv("iso-8859-1", "UTF-8", $dados->Disciplina)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_01 == "00/00/0000" ? "&nbsp;" : $dados->Data_01)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_02 == "00/00/0000" ? "&nbsp;" : $dados->Data_02)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_03 == "00/00/0000" ? "&nbsp;" : $dados->Data_03)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_04 == "00/00/0000" ? "&nbsp;" : $dados->Data_04)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_05 == "00/00/0000" ? "&nbsp;" : $dados->Data_05)."</td>";
        echo "\t\t<td class=\"Texto\" style=\"text-align: center\">".($dados->Data_06 == "00/00/0000" ? "&nbsp;" : $dados->Data_06)."</td>";
        echo "\t</tr>";

        $conta++;
    }
    echo "</table>";
}
?>
