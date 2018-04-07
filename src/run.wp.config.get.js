export function runWPconfigGet(wpPath,item=null){

	var status=false;
	var backData;

	$.ajax({
		url: "../inc/run.wp.config.get.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"WPconfigGet", wpPath:wpPath}

	}).done(function(data){

		status=true;
		backData = data;
		
	}).fail(function(){
			swal("oops","bad data from run.wp.config.get.php", "warning");
	});

	if(status) {
		if(item==null){
			return backData;
		} else {
			/*** if item given then return its value ***/
			var arr = $.parseJSON(backData);
			$.each(arr, function(i,v){
				if(v["name"]==item){
					backData= v["value"];
				}
			});
			return backData;
		}

	} else {
		return false;
	}


	/*********************** returns json string of WP config list or item value like: DB_NAME ***********************/



}//end function