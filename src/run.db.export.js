export function runDBexport(wpPath, DBname, export_path="tmp"){
/*********************** 
export_path is can be 
	"tmp" = ozwpdev basedir/tmp 
	"wp" =wpPath/wp-content/uploads/ozwpdev
	or a specific path 
	if path does not exists, mkdir cmd creates folder
 ***********************/

	var status=false;

	$.ajax({
		url: "../inc/run.db.export.php",
		type: "post",
		async:false,
		data: {do:"run", run:"DBexport", wpPath:wpPath, DBname:DBname, export_path:export_path}
	}).done(function(data){
		if(data!=="false"){
			status=true;
		} else {
			status=false;
		}
		
	}).fail(function(){
			swal("oops","bad data from run.db.export.php", "warning");
	});

	return status;


	/*********************** returns true if database export is successful ***********************/



}//end function