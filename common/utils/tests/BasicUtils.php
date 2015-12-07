<?php
    
    include_once VC_CONTROLLER_DIR.VC_MAIN_CONTROLLER;
    
    
    class BasicUtils{
        
        private $mainCtrl;
        
        private $lastId;
        
        function AdminTests($mainCrtl){
            $this->mainCtrl = $mainCrtl;
            $this->lastId = 0;
        }
        
        
        
        private function getEntities($result,$method,$startIdx) {
            $cm = $this->mainCtrl->$method($startIdx);
//print_r($cm->getData());
            if($cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        
        private function getEntitiesByOneAttr($result,$method,$attr, $startIdx) {
            $cm = $this->mainCtrl->$method($attr, $startIdx);
//print_r($cm->getData());
            if($cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function getEntitiesByTwoAttr($result,$method,$attr1,$attr2, $startIdx) {
            $cm = $this->mainCtrl->$method($attr1,$attr2, $startIdx);
//print_r($cm->getData());
            if($cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function getEntitiesByThreeAttr($result,$method,$attr1,$attr2,$attr3, $startIdx) {
            $cm = $this->mainCtrl->$method($attr1,$attr2,$attr3, $startIdx);
            if($cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        
        private function getEntityByOneAttr($result,$method,$attr, $negation = true) {
            $cm = $this->mainCtrl->$method($attr);
//print_r($cm->getData());
            if($negation == $cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        
        private function getEntity($result,$method, $negation = true) {
            $cm = $this->mainCtrl->$method();
//print_r($cm->getData());
            if($negation == $cm->getStatus() && $cm->getData() == $result){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        
        private function setEntity($source,$method) {
            $cm = $this->mainCtrl->$method($source);
            if($cm->getStatus()){
                $this->lastId = $cm->getData();
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function setEntityThreeAdditionalAttr($source,$method, $attr1, $attr2, $attr3) {
            $cm = $this->mainCtrl->$method($source, $attr1, $attr2, $attr3);
            if($cm->getStatus()){
                $this->lastId = $cm->getData();
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function updateEntity($source,$method) {
            $cm = $this->mainCtrl->$method($source);
            if($cm->getStatus()){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function relateTwoEntities($method,$attr1,$attr2) {
            $cm = $this->mainCtrl->$method($attr1,$attr2);
            if($cm->getStatus()){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        private function removeEntity($method, $attr) {
            $cm = $this->mainCtrl->$method($attr);
            if($cm->getStatus()){
                echo "<p>".$method." . . . OK </p>";
                return true;
            }else{
                echo "<p><b> Fail ".$method." ".$cm->getMessage()." (".$cm->getCode().")</b></p>";
                return false;
            }
        }
        
    }
?>