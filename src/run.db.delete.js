export function runDBdelete(dbNAME){

	var status=false;

	$.ajax({
		url: "../inc/run.db.delete.php",
		type: "post",
		async:false,
		data: {do:"run", run:"DBdelete", dbNAME:dbNAME}
	}).done(function(data){
		if(data!=="false"){
			status=true;
		} else {
			status=false;
		}
		
	}).fail(function(){
			swal("oops","bad data from rub.db.delete.php", "warning");
	});

	return status;


	/*********************** returns true if database deleted ***********************/



}//end function