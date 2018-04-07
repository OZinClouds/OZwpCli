export function runDBlist(){

	var status=false;
	var backData;

	$.ajax({
		url: "../inc/run.db.list.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"DBlist"}
	}).done(function(data){

		status=true;
		backData = data;
		
	}).fail(function(){
			swal("oops","bad data from rub.db.list.php", "warning");
	});

	if(status) {
		return backData;
	} else {
		return false;
	}


	/*********************** returns json of databases listed ***********************/



}//end function