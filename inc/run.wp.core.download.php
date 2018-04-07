<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run WP core download ***********************/
		if($_POST["run"]=="WPcoreDownload"){
			
			if(!isset($_POST["wpName"])){
				echo "false"; die();
			}

			$cmd = "wp core download ";
			$cmd.= " --path=" . rootdir . $_POST["wpName"];
			
			$result = OZbash::Terminal($cmd);

				if($result["exit_status"]==0){

					echo "true";

				} else {

					echo "false";
				}
				

			/*********************** run with run.wp.core.download.js :: runWPcoreDownload method 
					      variable: wpName
			***********************/

		} // end WPcoreDownload




	} //end validate

 ?>