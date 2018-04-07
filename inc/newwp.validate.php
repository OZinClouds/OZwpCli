<?php 
include '../config.php';
$response=false;
	
	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		if($_POST["run"]=="validate"){


			/*** validate DBname = wpName ***/
			$conn = new OZmysql;

			if($conn->connState){

			$list = $conn->ListDatabaseArray();
				if(isset($list)){
					if(in_array($_POST["wpName"],$list)){
						$response=false;
					} else {
						$response=true;
						/*** validate wpName ***/
						$dir=rootdir . "/" . $_POST["wpName"];
						if (!file_exists($dir) && !is_dir($dir)) {
							$response=true;
						} else {
							$response=false;
						}
					}
				} else {
					$response=false;
				}
				
			} else {
				$response=false;
			}

			$conn->disconnect();


		}
		
	}

echo json_encode($response);
 ?>