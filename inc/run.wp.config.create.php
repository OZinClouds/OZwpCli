<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run WP config create ***********************/
		if($_POST["run"]=="WPconfigCreate"){
			
			if(!isset($_POST["wpName"])){
				echo "false"; die();
			}

			if($_ENV["DB_HOST"]=="" && $_ENV["DB_USER"]=="" && $_ENV["DB_PASS"]==""){
				echo "false"; die();
			}

			///give WP config rights to handle mysql job (MAMP)
			$cmd = ('export PATH="' . $_ENV["mysql_PATH"] . '";  ');

			$cmd.="  wp config create ";
			$cmd.= " --path=" . rootdir . $_POST["wpName"];
			$cmd.= " --dbname=" . $_POST["wpName"];
			$cmd.= " --dbhost=" . $_ENV["DB_HOST"];
			$cmd.= " --dbuser=" . $_ENV["DB_USER"];
			$cmd.= " --dbpass=" . $_ENV["DB_PASS"];
			$cmd.= " --dbcharset=utf8";
			$cmd.= " --dbprefix=wp_";
			$cmd.= " --force";
			$result = OZbash::Terminal($cmd);
				

				if($result["exit_status"]==0){

					echo "true";

				} else {
					echo "false";
				}
				

			/*********************** run with run.wp.config.create.js :: runWPconfigCreate method 
					       variable: wpName
			***********************/

		} // end WPconfigCreate




	} //end validate

 ?>