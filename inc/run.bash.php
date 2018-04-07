<?php 
	include '../config.php';

	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run any command ***********************/
		if($_POST["run"]=="bash"){
			if(!isset($_POST["cmd"])){
				echo json_encode(array(
					"exit_status"=>999,
					"output"=>"no command (cmd) passed by POST!"
				)); 
				die();
			} 
			
			$result = OZbash::Terminal( $_POST["cmd"] );
			echo json_encode(array(
					"exit_status"=>$result["exit_status"],
					"output"=>$result["output"]
							)); 
			

			/*********************** run with run.bash.js :: runBash("command..")method ***********************/
			/*********************** returns exit_status and output as json object ***********************/

		} // end finder




	} //end validate

 ?>