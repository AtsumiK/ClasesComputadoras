<?php
    class HevoTCoreIDGenerator {

        public static function generateRandomID($key){
            $random = time();
            $rdnSize = strlen($random);
            $baseSize = strlen($key);
            if(($rdnSize + $baseSize) <= 119 ){
                return $key."_".$random;
            }
            $rdnSize = 119-$baseSize;
            return $key."_".substr($random,(strlen($random)-$rdnSize),$rdnSize);
        }
    }
?>