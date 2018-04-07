import {runBash} from "./run.bash.js";

	/*********************** reload tab contents and inner-tabs ***********************/
	import {LoadEditTab, loadMe} from "./editwp.js";
	//loadMe("config","lang");


$(document).on("shown.bs.tab","#tabs-config",function(e){

	var theTabb=$(e.target).attr("href").match(/\w+/ig)[1];
	
	if(theTabb=="debug"){
		//$(e.target).parent().find("i").toggleClass('fa-spin');
		runDebugValues(e, "get");
		//$(e.target).parent().find("i").toggleClass('fa-spin');
	}

});



/*********************** WP_LANG ***********************/
$(document).on("change", "#lang-select", function(e){
	
	var cmd = "wp config set WP_LANG " + $(e.target).val() 
			+ " --type=constant "
			+ " --path=" + $(".update-tabs tr:eq(0) td:eq(1)").text();
	runBash(cmd);
	swal("config", "WP_LANG = "+ $(e.target).val(), "success");
});

/*********************** DEBUG GET VALUES ***********************/
$(document).on("click","#btn-get-debug-values", function(e){
	runDebugValues(e, "get");
});

/*********************** DEBUG SET DEFAULT VALUES ***********************/
$(document).on("click","#btn-set-debug", function(e){
	runDebugValues(e, "set");
});

/*********************** DEBUG UNSET DEFAULT VALUES ***********************/
$(document).on("click","#btn-unset-debug", function(e){
	runDebugValues(e, "unset");
});

/*********************** DEBUG DELETE VALUES ***********************/
$(document).on("click","#btn-del-debug", function(e){
	runDebugValues(e, "del");
});

/*********************** DEBUG DELETE single VALUES ***********************/
$(document).on("click","button[name=btn-del-debug-single]", function(e){
	var debug=$(e.target).closest("tr").find("td:eq(0)").text();
	var wpPath=$(e.target).closest("tr").find("td:eq(4) button").attr("data-path");
	runBash("wp config delete " + debug + " --path=" + wpPath + " --type=constant");
	runDebugValues(e, "get");
});

/*********************** Change Debug Value - INPUT ***********************/
$(document).on("change","input[data-config='debug']", function(e){
	var valyu=$(e.target).val();
	var debug=$(e.target).attr("name");
	var wpPath=$(".update-tabs tr:eq(0) td:eq(1)").text();
	runBash("wp config set " + debug + " " + valyu + " --type=constant --raw --path=" + wpPath );
	runDebugValues(e, "get");
});



/*********************** function: runDebugValues ***********************/
function runDebugValues(e, run){
	$.ajax({
		url:"editwp.tab.config.debug.php",
		dataType:"json",
		method:"post",
		async: true,
		data:{
			do:"run",
			wp:"debug",
			run:run,
			wpPath:$(".update-tabs tr:eq(0) td:eq(1)").text()
		},
		beforeSend: function(){
			$(e.target).parent().find("i").addClass('fa-spin');
			$(e.target).prop("disabled", true);
		},
		success:function(data){
			$(e.target).parent().find("i").removeClass('fa-spin');
			$(e.target).prop("disabled", false);
			if(run=="get"){
			$("#table-debug").removeClass("invisible");
			$("#btn-get-debug-values").addClass("invisible");
			$("#row-set-debug").removeClass("invisible");
			} 

			$.each(data, function(i,v){

				var TR=$("#table-debug tr td").filter(function(){
					return $(this).text()===i;
				}).parent()

				switch(v){
					case "TRUE":
					TR.find("td:eq(1)").css("color","green");
					TR.find("td:eq(2) input").prop("checked", "checked");
					break;

					case "FALSE":
					TR.find("td:eq(1)").css("color","red");
					TR.find("td:eq(3) input").prop("checked", "checked");
					break;

					default:
					TR.find("td:eq(1)").css("color","darkorange");
					TR.find("td:eq(2) input").prop("checked", false);
					TR.find("td:eq(3) input").prop("checked", false);
					break;

				}

			switch (run){
				case "set":
				swal("Debug Set", "all debug default values are set", "success");
				break;
				case "unset":
				swal("Debug UnSet", "all debug default values are unset", "success");
				break;
				case "del":
				swal("Debug Delete", "all debug values are deleted from config.php", "success");
			}


			});

		},
		error:function(jqXHR,textStatus,errorThrown){
			swal("oops!", errorThrown, "error");
		}
	});
}//end getDebugValues













