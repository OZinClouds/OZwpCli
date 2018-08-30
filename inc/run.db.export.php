<?php 
	include '../config.php';

	$result = "false";

	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run DB export ***********************/
		if($_POST["run"]=="DBexport"){

			if(!isset($_POST["wpPath"])){
				echo $result; die();
			}
			if(!isset($_POST["export_path"])){
				echo $result; die();
			}
			if(!isset($_POST["DBname"])){
				echo $result; die();
			}

			/*********************** export_path ***********************/
			$export_path=rtrim($_POST["export_path"]);

			if($export_path=="tmp"){
				$export_path=basedir."tmp";
			} elseif ($export_path=="wp") {
				$export_path=$_POST["wpPath"] ."/wp-content/uploads/ozwpcli";
			} 
			
			if(!file_exists($export_path)){
				mkdir($export_path);
			}


		
			$fileName=$_POST["DBname"] . "_" . date("Y_m_d-H_i_s") . "_DBbackup.sql";



			///give WP config rights to handle mysql job (MAMP)
			$cmd = ('export PATH="' . $_ENV["mysql_PATH"] . '";  ');

			$cmd .= "wp db export";
			$cmd .= " --path=" . $_POST["wpPath"];
			$cmd .= " " . $export_path . "/" . $fileName;

			$result=OZbash::Terminal($cmd);

			if($result["exit_status"]===0){
				echo "true";
			} else {
				echo "false";
			}
		
		/*********************** run with run.db.export.js :: runDBcreate(wpPath, dbNAME, export_path) method 
				export_path is can be 
					"tmp" = OZwpCli basedir/tmp 
					"wp" =wpPath/wp-content/uploads/ozwpcli
					or a specific path 
					if path does not exists, mkdir cmd creates folder
		***********************/	
		} // end DB export




	} //end validate


 ?>