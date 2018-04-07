<?php 
include '../config.php';

$defaults=json_decode(file_get_contents(basedir."defaults.json"),true);

if(!empty($_POST["do"])){
	if($_POST["do"]=="run"&$_POST["run"]=="update"){

	$defaults=updateDefaults($defaults, $_POST["config"], $_POST["title"], $_POST["newValue"]);

	file_put_contents(basedir."defaults.json",json_encode($defaults, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
		
	}

}


function updateDefaults($defaults, $config, $title, $newValue){
		$ind=array_search($title, array_column($defaults[$config],"title"));
		$defaults[$config][$ind]["default"]=$newValue;
		return $defaults;
	}


 ?>