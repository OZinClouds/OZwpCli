<?php 

class OZtheme {
	



	
	public static $paletName="red-gray";

    	public static function top(){
    		$palet_name=self::$paletName;
    		include basedir . "inc/theme.head.php";
    		include basedir . "inc/theme.nav.php";

     	}


     	public static function bottom(){
     		include basedir . "inc/theme.footer.php";
     	}


     	/*enquee scripts ::: js or css */ // --START
	public static $enquee_footer=[];
	public static $enquee_header=[];
            public static function enquee($type,$src,$place=''){
            		$enqueeTemplate=[
			'js' => "<script src='%s'></script>\n",
       		'css' => "<link rel='stylesheet' href='%s'>\n"
            		];

            		if($place==''){
            			if($type=='js'){
            				$place='footer';
            			}elseif($type='css'){
            				$place='header';
            			}
            		}

	     		switch($place) {
	     			case 'header':
	     			self::$enquee_header[].=sprintf($enqueeTemplate[$type],$src);
	     			break;
	     			case 'footer':
	     			self::$enquee_footer[].=sprintf($enqueeTemplate[$type],$src);
	     			break;
			}

            }

           public static function enquee_scripts_in_footer(){
           		if(!empty(self::$enquee_footer)){
           			foreach(self::$enquee_footer as $k){
           				echo $k;
           			}
           		}
           }
           public static function enquee_scripts_in_header(){
		   	if(!empty(self::$enquee_header)){
           			foreach(self::$enquee_header as $k){
           				echo $k;
           			}
           		}
           }
           /*enquee scripts ::: js or css */ // --END




}


 ?>