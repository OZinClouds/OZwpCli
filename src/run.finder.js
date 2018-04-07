export function runFinder(path=" . "){
	var status=false;

	$.ajax({
		url: "../inc/run.finder.php",
		type: "post",
		async:false,
		data: {do:"run", run:"finder", path:path}
	}).done(function(data){

		if(data=="true"){
			//swal("ok","it came", "success");
			status=true;
		} else {
			swal("oops","path not found", "warning");
		}
	}).fail(function(){
			swal("oops","path not found", "warning");
	});

	return status;
}