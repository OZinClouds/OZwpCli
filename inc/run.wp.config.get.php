<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run WP config get ***********************/
		if($_POST["run"]=="WPconfigGet"){
			
			if(!isset($_POST["wpPath"])){
				echo "false"; die();
			}



			$result = OZbash::Terminal("wp config get --format=json --path=" . $_POST["wpPath"] );
				

				if($result["exit_status"]==0){

					echo json_encode($result["output"] );

				} else {
					echo "false";
				}
				

			/*********************** run with run.wp.config.get.js :: runWPconfigGet method 
					       runWPconfigGet(path, 'DB_NAME') returns db name as string
			***********************/

		} // end WPconfigGet




	} //end validate

 ?>