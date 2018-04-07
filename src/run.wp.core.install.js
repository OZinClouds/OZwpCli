export function runWPcoreInstall(wpName, usr, email, pass){

	var status=false;

	$.ajax({
		url: "../inc/run.wp.core.install.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"WPcoreInstall", wpName:wpName, usr:usr, email:email, pass:pass}

	}).done(function(data){

		status=true;
		
	}).fail(function(){
			swal("oops","bad data from run.wp.core.download.php", "warning");
	});

	return status;



}//end function