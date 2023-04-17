<?php
class Token
{
	public static function generate(){
		return md5(uniqid());
	}
}
?> 