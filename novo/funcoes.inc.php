<?php
/**
* Verifica se o agumento é do tipo data.
*
* @param date $data Valor da data
* 
*/
function isDate($date)
{
    return (is_array($date)) && ($date["year"]>0) && ($date["mon"]>0) && ($date["mday"]>0);
}

/**
* Retorna a data do argumento no formato extenso.
* @param date $data Valor da data
*/ 
function dataExtenso($data)
{
	if (!isDate($data))
	{
		$data=getdate();
	}
	$meses = array (
					"Janeiro",
					"Fevereiro",
					"Março",
					"Abril",
					"Maio",
					"Junho",
					"Julho",
					"Agosto",
					"Setembro",
					"Outubro",
					"Novembro",
					"Dezembro"
				 );
	return $data["mday"]." de ".$meses[($data["mon"]-1)]." de ".$data["year"];
}
?>