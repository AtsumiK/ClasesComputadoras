<?php
//include_once "../VariablesGlobales.php";
include_once MENSAJE;


class MensajeHandler{
	var $mensaje;
	function MensajeHandler(){
	}

	function darMensaje($DOMElement){

		//se recopilan todos los flujos discriminados por tipo
		$dataXML 	= $DOMElement->getElementsByTagName(TAG_DATA);
		$codeXML 	= $DOMElement->getElementsByTagName(TAG_CODE);
		$statusXML 	= $DOMElement->getElementsByTagName(TAG_STATUS);
		$msgXML 	= $DOMElement->getElementsByTagName(TAG_MSG);
		$dataXML 	= $DOMElement->getElementsByTagName(TAG_DATA);
		$data2XML 	= $DOMElement->getElementsByTagName(TAG_DATA2);

		if($dataXML->length==0){
			return null;
		}
		if($codeXML->length==0){
			return null;
		}
		if($statusXML->length==0){
			return null;
		}
		if($msgXML->length==0){
			return null;
		}
		if($data2XML->length==0){
			return null;
		}
		
		$data = $dataXML->item(0)->nodeValue;
		
		return new Mensaje(	$statusXML->item(0)->nodeValue=="ok",
							$msgXML->item(0)->nodeValue,
							$codeXML->item(0)->nodeValue,
							$dataXML->item(0)->nodeValue,
							$data2XML->item(0)->nodeValue);
	}
}


?>