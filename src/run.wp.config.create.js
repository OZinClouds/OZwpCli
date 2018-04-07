export function runWPconfigCreate(wpName){

	var status=false;

	$.ajax({
		url: "../inc/run.wp.config.create.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"WPconfigCreate", wpName:wpName}

	}).done(function(data){

		status=true;

		
	}).fail(function(){
			swal("oops","bad data from run.wp.config.get.php", "warning");
	});

	return status;




}//end function