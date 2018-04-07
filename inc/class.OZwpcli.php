<?php 

class OZwpcli {


	/*********************** find WP Installations: default in root ***********************/
	/*
	*	returns 	Array of wp installations 
	*	or NULL
	*/
	public static function wpInstallations($where=null){

		if($where == null) {$where=$_SERVER["DOCUMENT_ROOT"];}
		else{$where=rtrim($where, '/\\');}

		$cmdFind="wp find " . $where . " --field=version_path --max_depth=1 --format=json";

		$wpFind=OZbash::Terminal($cmdFind);
			if ($wpFind["exit_status"]===0){
				$wpFind=json_decode($wpFind["output"]);
			} else { return null; }

		if(!empty($wpFind)){			
			$wp=[];
			foreach($wpFind as $j){
				$wpFoundRoot=str_replace("/wp-includes", "", dirname($j));		
					if($wpFoundRoot==$where){
						$lastwhere=explode('/', $where);
						$wpName=end($lastwhere);
						$wp[$wpName]=$where;
						return json_encode($wp);
					} else {

						$wpName= str_replace($where . "/", "", $wpFoundRoot);
						$wpPath=$where . "/" . $wpName;
						$wp[$wpName]=$wpPath;
					}
				
				
				}
			return $wp;
		} else {
			return null;
		}
	
	}



	public static function InstallPackage($package){
		$cmd='php -d memory_limit=512M "$(which wp)" package install wp-cli/'.$package;
		$result=OZbash::Terminal($cmd);
		return $result["exit_status"];
		///note: unfortunately this operation time outs...
	}




} //end of class

 ?>