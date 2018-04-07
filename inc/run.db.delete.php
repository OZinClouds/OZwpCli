<?php 
	include '../config.php';

	$result = false;

	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run DB create ***********************/
		if($_POST["run"]=="DBdelete"){


			try{
			$conn = new OZmysql;
				if(!isset($_POST["dbNAME"]) ){
					echo $result; die();
				} else {
					$conn->dbNAME=$_POST["dbNAME"];
				}

			if($conn->connState){

			$result = $conn->DELETEaDatabase();
			echo $result;
			
			}
			/*********************** run with run.db.create.js :: runDBcreate(dbNAME) method ***********************/
			$conn->disconnect();
			} catch(Exception $e){
				echo "false";
			}
			
		} // end DB create




	} //end validate


 ?>