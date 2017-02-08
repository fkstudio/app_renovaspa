<?php 

namespace App\Classes;

class Utilities {
	/* generate a confirmation number for current reservation */
    public static function getConfirmationNumber($length){
        $string = '';
        $characters = '123456789abcdefgABCDAFG';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }

        return $string;
    }
}
