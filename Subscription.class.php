<?php

/**
 * Subscription class
 */
class Subscription {

	public static function listMagazines(&$mag_array){
        foreach($mag_array as $obj){
        	$checked_string = "";
        	if($obj->checked == true) {
        		$checked_string = "checked";
        	}
            echo "<input type='checkbox' name='".$obj->id."' value='1'" . $checked_string. ">"
            . $obj->name . ":</br>";

        }
    }
    public static function listPrice(&$mag_array){
        foreach($mag_array as $obj){

            echo
                  $obj->price .  "<align=center>NOK/year</br>";

        }
    }
    public static $subscribe_associative = array();

    public static function subscribe($magazine_id, $email){
        array_push(Subscription::$subscribe_associative, $magazine_id, $email);
    }



}

?>
