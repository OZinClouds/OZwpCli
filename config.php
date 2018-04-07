<?php 

	/*
		*	config theme settings
		*	all URL and DIR ends with back-slash...
		*	
	*/

ini_set('max_execution_time',500);

define("basedir",__DIR__."/");

	function RootSiteURL()
	{
	$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
	$doc_root  = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
	$base_url  = preg_replace("!^${doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
	$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
	$port      = $_SERVER['SERVER_PORT'];
	$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
	$domain    = $_SERVER['SERVER_NAME'];
	$full_url  = "${protocol}://${domain}${disp_port}${base_url}";
	return $full_url."/";
	}

define( 'siteurl', RootSiteURL() );

	function RootDirPath()
	{
	$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
	$doc_root  = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/
	return $doc_root."/";
	}

define('rootdir',	RootDirPath());




/*OZ in Clouds - built-in-classes*/
/*
*	root classes :: ~/inc/
*	spl_autoload_register function used for conflict with composer autoload...
*/
function OZautoload($classname){
	$file="inc/class.".$classname.".php";
	if(file_exists(basedir.$file)){
		require $file;
	} 
} spl_autoload_register("OZautoload");



//Composer autoload 
require basedir."/vendor/autoload.php";


/*** composer require vlucas/phpdotenv  ***/
/*** https://packagist.org/packages/vlucas/phpdotenv ***/
if(!file_exists(basedir.'.env')){ 
	$envfile = rename(basedir."sample.env", basedir.".env");
} 
	$dotenv = new Dotenv\Dotenv(__DIR__);
	$dotenv->load();


define('ExportPath', 'export PATH="' . $_ENV["EXPORT_PATH"] . '"');


define( 'DB_HOST', $_ENV["DB_HOST"] ); // set database host
define( 'DB_USER', $_ENV["DB_USER"] ); // set database user
define( 'DB_PASS', $_ENV["DB_PASS"] ); // set database password

if(!isset($_ENV["rooturl"])){
	define('rooturl',$_ENV["rooturl"]);
} else {
	define('rooturl',"http://localhost");
}


if(!file_exists(basedir . "tmp")){
	mkdir(basedir . "tmp");
}


 ?>