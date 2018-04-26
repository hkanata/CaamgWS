<?php
/** 
	WebService Caamg para validação de CPF
	@author Leonardo Musashi <hkanata@gmail.com> 
	@data 26/04/2018
	@version 0.1 
	@access private
	@package WebService
	@Classe WebServiceWsdlCaamg.
	
	Resultados:
	Resultados: $result
	0 = NÃO ACHOU O CPF
	1 = ACHOU O CPF
	2 = HASH DE ACESSO INVÁLIDA
	3 = CPF INVÁLIDO (SÓ PODE SER NÚMERICO)  
*/ 

namespace WebService;

class WebServiceWsdlCaamg{

	/** 
		Cliente do WSDL webservice
		@access private 
		@name $client 
	*/ 
	private $client;

	/** 
		Parametros do WSDL webservice
		@access private 
		@name $params 
	*/ 
	private $params = array();
	
	/** 
		URL do WebService
		@access private 
		@name $urlServer 
	*/ 
	private $urlServer = "http://valid.caamg.com.br/servicos.asmx?wsdl";

	/** 
		Hash fornecido pelo CAAMG
		@access private 
		@name $hash 
	*/ 
	private $hash = "";
	
	/** 
		Definindo variáveis padrão
		@Construct
	*/ 	
	function __construct() {
		//Criando o Objeto
		$this->client = new \SoapClient($this->urlServer);
		
		//Adicionando parametro HASHdeAcesso
		//Requerido para acessar o WEBSERVICE
		$this->addParam(array(
			"HashdeAcesso" => $this->hash
		));
	}
	
	/** 
		Valida o CPF junto ao WebService
		@access public 
		@param String $cpf 
		@return JSON 
	*/ 	
	public function callService($cpf){
		
		try{
			//Validando CPF
			$validate = $this->validateCpf($cpf);
			
			if( !$validate ){
					throw new Exception('CPF Inválido.');
			}
			
			//Adicionando novo parametro CPF
			$this->addParam(array(
				"CPF" => $cpf
			));
			
			//Chamando o Webservice e recuperando a resposta
			$result = $this->client->__soapCall(
				'ValidaAdvogado', array(
					'parameters' => $this->params
				)
			);
			
			//Resposta Padrão em JSON
			return json_encode(array(
				"success" => true,
				"response" => $result
			));
		} catch (Exception $e) {
			return json_encode(array(
				"success" 	=> false,
				"response" => $e->getMessage()
			));
			
		}
		
		
	}
	
	/** 
		Adiciona Parametros
		@access private
		@param Array $param
		@return void 
	*/ 	
	private function addParam($param){
		array_push($this->params, $param);
	}
	
	/** 
		Valida o Numero do CPF
		@access public 
		@param String $cpf 
		@return Boolean 
	*/ 	
	public function validateCpf($cpf) {
		
		$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
		
		// Valida tamanho
		if (strlen($cpf) != 11)
			return false;
		
		// Calcula e confere primeiro dígito verificador
		for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
			$soma += $cpf{$i} * $j;
		
		$resto = $soma % 11;
		
		if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
			return false;
		
		// Calcula e confere segundo dígito verificador
		for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
			$soma += $cpf{$i} * $j;
		
		$resto = $soma % 11;
		
		return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
	}
}