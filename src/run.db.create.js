export function runDBcreate(dbNAME){

	var status=false;

	$.ajax({
		url: "../inc/run.db.create.php",
		type: "post",
		async:false,
		data: {do:"run", run:"DBcreate", dbNAME:dbNAME}
	}).done(function(data){
		if(data!=="false"){
			status=true;
		} else {
			status=false;
		}
		
	}).fail(function(){
			swal("oops","bad data from rub.db.create.php", "warning");
	});

	return status;


	/*********************** returns true if database created ***********************/



}//end function