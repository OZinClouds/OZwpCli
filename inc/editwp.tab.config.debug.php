<?php 
include '../config.php';
	
if(isset($_POST["do"])){

	if($_POST["do"]=="run" && $_POST["wp"]=="debug"){


		$wpPath=$_POST["wpPath"];

		/*********************** GET ***********************/
		if($_POST["run"]=="get"){

			$debugs=array(
				"WP_DEBUG"=>"NA",
				"WP_DEBUG_DISPLAY"=>"NA",
				"SCRIPT_DEBUG"=>"NA",
				"WP_CACHE"=>"NA",
				"SAVEQUERIES"=>"NA",
				"WP_DEBUG_LOG"=>"NA", 
				"CONCATENATE_SCRIPTS"=>"NA"
			);//given values are default


			foreach($debugs as $k=>$v){

				$result=OZbash::Terminal("wp config get ".$k." --path=".$wpPath);
				if($result["exit_status"]===0){
					if($result["output"]==1){
					$debugs[$k]="TRUE";
					} else {
					$debugs[$k]="FALSE";
					}

				} else {

					$debugs[$k]="NA";
				}

			}

			echo json_encode($debugs);

		}//end get

		/*********************** SET ***********************/
		if($_POST["run"]=="set"){

			$debugs=array(
				"WP_DEBUG"=>"TRUE",
				"WP_DEBUG_DISPLAY"=>"TRUE",
				"SCRIPT_DEBUG"=>"TRUE",
				"WP_CACHE"=>"FALSE",
				"SAVEQUERIES"=>"FALSE",
				"WP_DEBUG_LOG"=>"FALSE", 
				"CONCATENATE_SCRIPTS"=>"FALSE"
			);//given values are default


			foreach($debugs as $k=>$v){

				$result=OZbash::Terminal("wp config set ".$k." ".$v." --type=constant --raw --path=".$wpPath);
				if($result["exit_status"]!==0){
					$debugs[$k]="NA";
				} 

			}

			echo json_encode($debugs);

		}//end set

		/*********************** SET ***********************/
		if($_POST["run"]=="unset"){

			$debugs=array(
				"WP_DEBUG"=>"FALSE",
				"WP_DEBUG_DISPLAY"=>"FALSE",
				"SCRIPT_DEBUG"=>"FALSE",
				"WP_CACHE"=>"TRUE",
				"SAVEQUERIES"=>"TRUE",
				"WP_DEBUG_LOG"=>"TRUE", 
				"CONCATENATE_SCRIPTS"=>"TRUE"
			);//given values are default


			foreach($debugs as $k=>$v){

				$result=OZbash::Terminal("wp config set ".$k." ".$v." --type=constant --raw --path=".$wpPath);
				if($result["exit_status"]!==0){
					$debugs[$k]="NA";
				} 

			}

			echo json_encode($debugs);

		}//end set	

		/*********************** DEL ***********************/
		if($_POST["run"]=="del"){

			$debugs=array(
				"WP_DEBUG"=>"NA",
				"WP_DEBUG_DISPLAY"=>"NA",
				"SCRIPT_DEBUG"=>"NA",
				"WP_CACHE"=>"NA",
				"SAVEQUERIES"=>"NA",
				"WP_DEBUG_LOG"=>"NA", 
				"CONCATENATE_SCRIPTS"=>"NA"
			);//given values are default


			foreach($debugs as $k=>$v){

				$result=OZbash::Terminal("wp config delete ".$k." --path=".$wpPath);
				

			}

			echo json_encode($debugs);

		}//end set	


	}




} //end check do
 ?>