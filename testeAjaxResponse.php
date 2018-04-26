<?php
include("WebService/WebServiceWsdlCaamg.php");

$CPF = $_POST["cpf"];

$Caamg = new WebService\WebServiceWsdlCaamg();

$result = $Caamg->callService($CPF);
print_r($result);
?>