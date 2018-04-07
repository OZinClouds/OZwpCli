<?php 
include "../config.php";

if(isset($_POST["do"])){

	if($_POST["do"]=="get_all_updates"){
		$wpName=$_POST["wpname"];
		$wpPath=$_POST["wppath"];

		$wpVersionStatus= json_decode(OZbash::Terminal("wp core check-update --format='json' --path=".$wpPath)["output"]);

		if(!isset($wpVersionStatus)){

			echo '<div class="alert alert-success">';
				echo 'Wordpress core is up-to-date...';
			echo '</div>';
		} else {

			echo '<div class="alert alert-danger">';
				echo 'Wordpress core needs update...<br>';
				echo '<button class="btn btn-block btn-danger" id="btn_core_update_' .  $wpName . '"' ;
				echo ' data-path="' . $wpPath . '" ';
				echo  ' >update now</button>';
			echo '</div>';
		}

		$wpPluginStatus= json_decode( 
			OZbash::Terminal("wp plugin list --all --format='json' --path=". $wpPath )["output"], 
			true );

		uasort($wpPluginStatus, function($a, $b){
			return strcmp($a["update"], $b["update"]);
		});

		echo "<br>";

		echo 	'<caption>Plugins</caption>';
		echo 	'<table class="table table-striped table-bordered">';
		
		echo 	'<thead class="bg-info text-white">';
		echo 	'<tr><td>#</td><td>name</td><td>status</td><td>update</td><td>version</td></tr>';
		echo 	'</thead>';

		echo 	'<tbody>';
		$i=0;
		foreach($wpPluginStatus as $w){ $i++;
			echo 	'<tr>';
			echo 	'<td>'. $i  .'</td>';
			echo 	'<td>'. $w["name"]  .'</td>';
			echo 	'<td>'. $w["status"]  .'</td>';
			echo 	'<td>'; 
				if($w["update"] =="available") {
					echo '<button class="btn btn-block btn-danger" data-btn="btn_plugin_single_update" data-plugin="'.$w["name"] .'" data-path="'.$wpPath.'" >';
					echo '<i class="fa fa-refresh"></i>';
					echo '  update';
					echo '</button>';
				} else {
					echo $w["update"] ;
				}
			echo	'</td>';
			echo 	'<td>'. $w["version"]  .'</td>';
			echo 	'</tr>';
		}
		echo 	'</tbody>';

		echo 	'</table>';

		echo 	'<div class="alert alert-warning">';
		echo 	'<button class="btn btn-block btn-danger" data-btn="update_pluginall" data-path="'. $wpPath .'" >';
		echo 	'<i class="fa fa-refresh"></i>';
		echo 	'  update all plugins';
		echo 	'</button>';
		echo 	'</div>';

	}//end get_all_updates



}//end isset($_POST["do"])


 ?>






