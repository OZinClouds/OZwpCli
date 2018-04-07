<?php 
include "../config.php";

if(isset($_POST["do"])){

	if($_POST["do"]=="run" && $_POST["wp"]=="core"){
		$wpPath=$_POST["wppath"];
		$result=OZbash::Terminal("wp core update  --path=" . $wpPath);

		echo json_encode($result);

	}// end run core

	if($_POST["do"]=="run" && $_POST["wp"]=="plugin"){
		$wpPath=$_POST["wppath"];
		$plugin=$_POST["plugin"];

		$result=OZbash::Terminal("wp plugin update  ". $plugin ."   --path=" . $wpPath);

		echo json_encode($result);


	}// end run plugin


	if($_POST["do"]=="run" && $_POST["wp"]=="pluginall"){
		$wpPath=$_POST["wppath"];
		$result=OZbash::Terminal("wp plugin update  --all   --path=" . $wpPath);

		echo json_encode($result);


	}// end run pluginall

	if($_POST["do"]=="run" && $_POST["wp"]=="everything"){
		$wpInstallations=OZwpcli::wpInstallations();


		foreach($wpInstallations as $key => $value){

			$result["wpCore"]=OZbash::Terminal("wp core update --path=".$value)["output"];
			$result["wpPlugins"]=OZbash::Terminal("wp plugin update --all --path=".$value)["output"];

		}

		echo "ok";

	}// end run everything

}//end isset($_POST["do"])


 ?>