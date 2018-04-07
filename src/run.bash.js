export function runBash(cmd){
	var status=false;
	var dfd = new $.Deferred();

	$.ajax({
		url: "../inc/run.bash.php",
		type: "post",
		dataType: "json",
		async:false,
		data: {do:"run", run:"bash", cmd:cmd}
	}).done(function(data){
		dfd.resolve(data.exit_status,data.output);
	}).fail(function(jqXHR,textStatus,errorThrown){
			dfd.resolve(false,"ajax failed!\n"+errorThrown);
	});

	return dfd.promise();
}