<?php
	/*	
	Esta clase es la encargada de armar los mensajes.
	*/
	class CommunicationMensaje{
	
		private $status;
		private $data;
		private $data2;
		private $code;
		private $message;
		
		function CommunicationMensaje($status= null,$msg = null,$code = null,$data = null,$data2=null){
			$this->code = $code;
			$this->data = $data;
			$this->data2 = $data2;
			$this->status = $status;
			$this->message = $msg;
		}
		
		
		public function getStatus(){
			return $this->status;
		}
		public function setStatus($status){
			$this->status=$status;
		}
		public function getData(){
			return $this->data;
		}
		public function setData($data){
			$this->data=$data;
		}
		public function getData2(){
			return $this->data2;
		}
		public function setData2($data2){
			$this->data2=$data2;
		}
		public function getCode(){
			return $this->code;
		}
		public function setCode($code){
			$this->code=$code;
		}
		public function getMessage(){
			return $this->message;
		}
		public function setMessage($msg){
			$this->message=$msg;
		}
		
		
		public function toXML(){
			$tmp="ok";
			if(!$this->status){
				$tmp="fail";
			}
			$res="<".CM.">";
				$tmp="ok";
				if(!$this->status){
					$tmp="fail";
				}
				$res.="<".CM_STATUS."><![CDATA[";
					$res.=$tmp;
				$res.="]]></".CM_STATUS.">";
				$res.="<".CM_ERROR_CODE."><![CDATA[";
					$res.=$this->code;
				$res.="]]></".CM_ERROR_CODE.">";
				$res.="<".CM_MSG."><![CDATA[";
					$res.=$this->message;
				$res.="]]></".CM_MSG.">";
				$res.="<".CM_DATA.">";
					$res.=$this->data;
				$res.="</".CM_DATA.">";
				$res.="<".CM_DATA2.">";
					$res.=$this->data2;
				$res.="</".CM_DATA2.">";
			$res.="</".CM.">";
			return $res;
		}
		public function updateAndBuildXML($status= null, $msg = null, $code = null, $data = null, $data2=null){
			$this->status = $status;
			$this->message = $msg;
			$this->code = $code;
			$this->data = $data;
			$this->data2 = $data2;
			return $this->toXML();
		}
		
    	public static function loadFromXML($cmXML){
    		
    	    $doc = new DOMDocument('1.0', 'utf-8');
    	    
    	    $doc->loadXML($cmXML);
    	    $root = $doc->getElementsByTagName(CM);
    	    
    	    if($root->length == 0){
    	        return null;
    	    }
    	        
    	    
    	    $DOMElement = $root->item(0);
    	
    		//se recopilan todos los flujos discriminados por tipo
    		$codeXML 	= $DOMElement->getElementsByTagName(CM_ERROR_CODE);
    		$statusXML 	= $DOMElement->getElementsByTagName(CM_STATUS);
    		$msgXML 	= $DOMElement->getElementsByTagName(CM_MSG);
    		$dataXML 	= $DOMElement->getElementsByTagName(CM_DATA);
    		$data2XML 	= $DOMElement->getElementsByTagName(CM_DATA2);
    
    	    if($dataXML->length==0 || $codeXML->length==0 || $statusXML->length==0 || $msgXML->length==0 || $data2XML->length==0){
    			return null;
    		}
    		
    	    $dataValue = "";
    	    
    	    
            foreach ($dataXML->item(0)->childNodes as $child) {
            	
                $dataValue .= $doc->saveXML($child);
                
            }
    	    if(empty($dataValue)){
    	    	$dataValue = $dataXML->item(0)->nodeValue;
    	    }
    	        
    	    
    	    
    	    
    		return new CommunicationMensaje
    		                    (
    		                    $statusXML->item(0)->nodeValue=="ok",
    							$msgXML->item(0)->nodeValue,
    							$codeXML->item(0)->nodeValue,
    							$dataValue,
    							$data2XML->item(0)->nodeValue
    							);
    		
    	    /*$doc = new SimpleXMLElement($cmXML);
    		
    	    if($doc == NULL || $doc->count() == 0){
    	        return null;
    	    }
    	        
    	    
    	    $DOMElement = $doc;
    	
    		//se recopilan todos los flujos discriminados por tipo
    		$codeXML 	= $DOMElement->{CM_ERROR_CODE};
    		$statusXML 	= $DOMElement->{CM_STATUS};
    		$msgXML 	= $DOMElement->{CM_MSG};
    		$dataXML 	= $DOMElement->{CM_DATA};
    		$data2XML 	= $DOMElement->{CM_DATA2};
    
    	   
    		 if($dataXML->count()==0 || $codeXML->count()==0 || $statusXML->count()==0 || $msgXML->count()==0 || $data2XML->count()==0){
    			return null;
    		}
    		
    	    $dataValue = "";
    	    
    	    foreach ($dataXML->children() as $child) {
            	
            	$tmp = $dataXML->asXML();
            	
            	echo "--";
            	var_dump($tmp);
            	 				
            	if($tmp){
            		$dataValue .= $tmp; 
            	}else{
            		$dataValue .= ''.$child; 
            	}
            }
            
            if(empty($dataValue) && !is_numeric($dataValue)){
            	$dataValue .= ''.$dataXML;
            }else{
            	echo "*****".$dataValue."*";
            }
            
    	    
            //var_dump($dataXML);
            //echo $dataXML->count();
            //echo "--------------";
    	    
    		return new CommunicationMensaje
    		                    (
    		                    $statusXML == "ok",
    							$msgXML,
    							$codeXML,
    							$dataValue,
    							$data2XML
    							);
    							
    							*/
    	}
	}
?>