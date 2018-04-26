<?php
include("WebService/WebServiceWsdlCaamg.php");

$Caamg = new WebService\WebServiceWsdlCaamg();

/*
	Alguns Casos de Teste
*/

//{"success":true,"response":{"ValidaAdvogadoResult":2}}
$result = $Caamg->callService("068.368.896-01");

//{"success":true,"response":{"ValidaAdvogadoResult":2}}
//$result = $Caamg->callService("06836889601");

//{"success":true,"response":{"ValidaAdvogadoResult":2}}
//$result = $Caamg->callService("00000000000");

//{"success":false,"response":"CPF Invalido."}
//$result = $Caamg->callService("teste");

//{"success":false,"response":"CPF Invalido."}
//$result = $Caamg->callService("");


print_r($result);

?>