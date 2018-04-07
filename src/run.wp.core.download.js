export function runWPcoreDownload(wpName){

	var status=false;

	$.ajax({
		url: "../inc/run.wp.core.download.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"WPcoreDownload", wpName:wpName}

	}).done(function(data){

		status=true;
		
	}).fail(function(){
			swal("oops","bad data from run.wp.core.download.php", "warning");
	});

	return status;



}//end function