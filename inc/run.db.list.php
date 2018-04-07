<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run DB list ***********************/
		if($_POST["run"]=="DBlist"){
			
			$conn = new OZmysql;

			if($conn->connState){

			$list = $conn->ListDatabaseArray();
				
				if(isset($list)){
					echo json_encode($list);
				} else {

					echo "false";
				}

			} else {

				echo "false";
			}

			/*********************** run with run.db.list.js :: runDBlist method ***********************/
			$conn->disconnect();
		} // end DB list




	} //end validate


 ?>