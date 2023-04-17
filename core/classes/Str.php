<?php
class Str
{

	public static function clean($string){
		return $string == null?"":$string;
	}

	public static function data_in($data){
	   $data  = htmlentities($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}
		
		
}
?>