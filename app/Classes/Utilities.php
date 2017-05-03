<?php 

namespace App\Classes;

class Utilities {
	/* generate a confirmation number for current reservation */
    public static function getConfirmationNumber($length){
        return strval(time());
    }
}
