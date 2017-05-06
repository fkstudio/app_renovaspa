<?php 

namespace App\Classes;

class Utilities {
	/* generate a confirmation number for current reservation */
    public static function getConfirmationNumber($length){
        return strval(time());
    }

    public static function checktime($hour, $min, $sec) {
	     if ($hour < 0 || $hour > 23 || !is_numeric($hour)) {
	         return false;
	     }
	     if ($min < 0 || $min > 59 || !is_numeric($min)) {
	         return false;
	     }
	     if ($sec < 0 || $sec > 59 || !is_numeric($sec)) {
	         return false;
	     }
	     return true;
	}
}
