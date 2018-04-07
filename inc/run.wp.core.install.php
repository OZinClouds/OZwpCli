<?php 
	include '../config.php';


	if(isset($_POST["do"]) && $_POST["do"] =="run" && isset($_POST["run"])){

		/*********************** run WP core install ***********************/
		if($_POST["run"]=="WPcoreInstall"){
			
			if(!isset($_POST["wpName"])){
				echo "false"; die();
			}

			$cmd = "wp core install ";
			$cmd.= " --path=" . rootdir . $_POST["wpName"];
			$cmd.= " --admin_user=" . $_POST["usr"];
			$cmd.= " --admin_email=" . $_POST["email"];
			$cmd.= " --admin_password=" . $_POST["pass"];
			$cmd.= " --title='newWP by OZwpDev'";
			$cmd.= " --url=" . rooturl . "/" . $_POST["wpName"];
			$result = OZbash::Terminal($cmd);

				if($result["exit_status"]==0){

					echo "true";

				} else {

					echo "false";
				}
				

			/*********************** run with run.wp.core.install.js :: runWPcoreInstall method 
					      variable: wpName, usr, email, pass
			***********************/

		} // end WPcoreInstall




	} //end validate

 ?>