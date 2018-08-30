<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run WP Lock***********************/
		if($_POST["run"]=="WPlock"){
			
			if(!isset($_POST["wpName"])){
				echo "false"; die();
			}

			$sFile=rootdir.$_POST["wpName"]."/ozwpcli.txt";

			if($_POST["lock"]=="status"){
				/*** get the loack status ***/
				if(file_exists($sFile)){
					
					echo "false";

				} else {

					echo "true";
				}
				
			} elseif($_POST["lock"]=="unlock"){

				if(!file_exists($sFile)){
				$thefile=fopen($sFile,"w");
				fwrite($thefile, "can be modified by OZwpCli");
				fclose($thefile);
				}
				echo "true";

			} elseif($_POST["lock"]=="lock"){
				if(file_exists($sFile)){
				unlink($sFile);
				} 
				echo "true";

			}

				
				

			/*********************** run with run.wp.lock.js :: runWPlock method 
					      variable: wpName, lock=status/lock/unlock
			***********************/

		} // end WPlock




	} //end validate

 ?>