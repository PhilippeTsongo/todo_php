<?php ob_start();
session_start();
// ini_set('session.save_path',realpath(dirname('sessions')));
//error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting( E_ALL ^ E_DEPRECATED );

function def(){
	define("view_session_off","views/app_session_off");
	define("PL",".php");
	define("_PATH_","/");
	define("DN",Config::get('url/home'));
}


$GLOBALS['config'] = array(
	'mysql' => array(
		// DB Local
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'todo_db',
		'port' => '3306'
	),
);

// Load Classes
spl_autoload_register (function ($class) {	
	$pathArray = explode("\\", $class);
	if(count($pathArray)>1){
		require_once $class . '.php';
	}else{
		require_once 'classes/'.$class . '.php';
	}
});

//Initialize Define
def();
$HASH	 = new Hash();

?>