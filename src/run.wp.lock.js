export function runWPlock(wpName, lock){

	/*** 
	wpName is the folder name in the root dir
	lock=status returns if the wp install locked or not
	locked status = true means there is no ozwpcli.txt in root dir
	locked status = false means there is ozwpcli.txt in root dir and can be modified
	to set or unlik ozwpcli.txt assign lock = lock / unlock (unlock means free modify)
 	***/

	var status=false;

	$.ajax({
		url: "../inc/run.wp.lock.php",
		type: "post",
		async:false,
		data: {
			do:"run", 
			run:"WPlock", 
			wpName:wpName,
			lock:lock
		}

	}).done(function(data){

		status=$.parseJSON(data);
		
	}).fail(function(){
			swal("oops","bad data from run.wp.lock.php", "warning");
	});

	return status;



}//end function