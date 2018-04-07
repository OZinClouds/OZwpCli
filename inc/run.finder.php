<?php 
	include '../config.php';

	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run finder ***********************/
		if($_POST["run"]=="finder"){
			if(isset($_POST["path"])){
				$path = $_POST["path"];
				if(!file_exists($path)){$path=" . ";}
			} else {
				$path = " . ";
			}
			
			$result = OZbash::Terminal("open " . $path );

			if ($result["exit_status"]===0){
				echo "true";
			} else { echo "false";
			}

			/*********************** run with run.finder.js :: runFinder method ***********************/

		} // end finder




	} //end validate

 ?>