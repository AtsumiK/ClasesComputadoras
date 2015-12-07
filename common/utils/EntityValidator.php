<?php
    class EntityValidator {

        public static function validateId($id){
            return is_numeric( $id ) && $id > 0;
        }
        
        public static function validateString($string){
            return !empty($string);
        }
        
        public static function validateNumber($num){
            return is_numeric( $num );
        }
        
        public static function validatePositiveNumber($num){
            return is_numeric( $num ) && $num >= 0;
        }
        
        public static function validateDate($date){
            return true;
        }
        
        public static function validatePassword($pass){
            return strlen($pass) > 5;
        }
        
        public static function validateGlobalYesNO($str){
            return ($str == GLOBAL_YES || $str == GLOBAL_NO);
        }
        
        public static function validateGlobalOpenedClosed($str){
            return ($str == GLOBAL_OPENED || $str == GLOBAL_CLOSED);
        }
        
        public static function validateGlobalUserStatus($str){
            return ($str == GLOBAL_USER_STATUS_DISABLED || $str == GLOBAL_USER_STATUS_OK || $str == GLOBAL_USER_STATUS_PASSIVE || $str == GLOBAL_USER_STATUS_TO_ERASE);
        }
        
    	public static function validateGlobalOrderPriority($str){
            return ($str == SQL_ASCENDING_ORDER || $str == SQL_DESCENDENT_ORDER);
        }
        
    }
?>