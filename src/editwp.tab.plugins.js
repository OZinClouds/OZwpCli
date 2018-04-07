import {runBash} from "./run.bash.js";




	/*********************** reload tab contents and inner-tabs ***********************/
	import {LoadEditTab, loadMe} from "./editwp.js";
	//loadMe("plugins","list");


var theTabb;
$(document).on('shown.bs.tab', '#tabs-plugins a[data-toggle="tab"]', function (e) {

	theTabb= $(e.target).attr("href").match(/\w+/ig)[1].trim();

});

/*********************** HOME - default plugins list dblclikk to read better ***********************/
$(document).on("dblclick","#plugins-home table tbody tr",function(e){

	var plugin=$(e.target).closest("tr").find("td:eq(0)").text();
	var group=$(e.target).closest("tr").find("td:eq(1)").text();
	var def=$(e.target).closest("tr").find("td:eq(2)").text();
	var desc=$(e.target).closest("tr").find("td:eq(3)").text();
	var comment=$(e.target).closest("tr").find("td:eq(4)").text();
	var msg = "<strong>default (URL):</strong> " + def + "<hr>" +
		"<strong>group:</strong> " + group + "<hr>" +
		"<strong>desc:</strong> " + desc + "<hr>" +
		"<strong>comment:</strong> " + comment

	swal({
			title:plugin,
			content:{
				element:"div",
				attributes:{
					className:"alert alert-warning text-left",
					innerHTML:msg
				}
			},
			className:"alert-info"
			});



});


/*********************** plugin info ***********************/
$(document).on("dblclick","[id^=table-plugins-] tbody tr td:nth-child(2)",function(e){
	var plugin=$(e.target).text().trim();
	var wpPath=$("table.update-tabs tbody tr:eq(0) td:eq(1)").text();
	runBash("wp plugin get " + plugin + " --format=json --path="+wpPath).done(function(status,output){

		if(status===0){
			output=$.parseJSON(output);
			var info="";
			$.each(output, function(i,v){
				info+="<strong>" + i + ": </strong>" + v + "<hr>";
			})
			swal({
				title:plugin,
				content:
				{
				element:"div",
					attributes:{
					className:"alert alert-info text-left",
					innerHTML:info
						
					}
				},

			});
		} else {
			swal(plugin,"info is available only after install","info");
		}
	});
});

/*********************** single plugin update ***********************/
$(document).on("click", "button[name='btn-plugins-update']", function(e){
	var plugin=$(e.target).attr("data-plugin");
	var wpPath=$(e.target).attr("data-path");
	var thisTD=$(e.target).closest("td");
	runBash("wp plugin update "+plugin+" --path="+wpPath).done(function(status,output){
		if(status===0){
			swal(plugin,output,"success", {timer:2000, buttons:false}).then(()=>{
				loadMe("plugins",theTabb);
			});
		} else {
			swal("ooops",output,"error");
		}

	});
});

/*********************** single plugin delete ***********************/
$(document).on("click","button[name='btn-plugins-delete']", function(e){
	var plugin=$(e.target).attr("data-plugin");
	var wpPath=$(e.target).attr("data-path");

		swal({
			title:plugin,
			icon:"warning",
			text: "delete this plugin?",
			dangerMode:true,
			buttons:{
				cancel:true,
				confirm:{
					text:"delete Plugin"
				}
			}

		}).then((value)=>{
			if(value){
				runBash("wp plugin delete "+plugin+" --path="+wpPath).done(function(status, output){
				if(status===0){
					swal(plugin,output,"success", {timer:2000, buttons:false}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {
					swal("ooops",output,"error");
				}

				});
			}
		});

});

/*********************** single plugin Install ***********************/
$(document).on("click","button[name='btn-plugins-install']", function(e){
	var plugin=$(e.target).attr("data-plugin");
	var wpPath=$(e.target).attr("data-path");

	runBash("wp plugin install "+plugin+"  --path="+wpPath).done(function(status,output){
		if(status===0){
			swal("installed!",plugin + " is installed!","success",{buttons:false,timer:2000}).then(()=>{
				loadMe("plugins",theTabb);
			});
		} else {
			swal("ooops","something went wrong","error",{buttons:false,timer:2000});
		}
	});


});


/*********************** any checkbox checked ***********************/
$(document).on("change","input[name='check-plugins']",function(e){
	
	if($("#table-plugins-"+theTabb+" tbody input:checked").length>0){
		$("#table-plugins-"+theTabb+" tfoot").removeClass('d-none');	
	} else {
		$("#table-plugins-"+theTabb+" tfoot").addClass('d-none');
	}
 
});

/*********************** check-pugins-all ***********************/
$(document).on("change","input[name^=check-plugins-all-]", function(e){
		var status = $(e.target).prop("checked");
		$("#table-plugins-"+theTabb+" tbody input[type='checkbox']").prop("checked", status).trigger("change");
});


/*********************** select-plugins-[theTabb]***********************/
$(document).on("click","[id^=btn-select-plugins-]", function(e){
	var VaL=$("#select-plugins-"+theTabb).val();
	var wpPath=$(e.target).attr("data-path");
	var ps="";
	$("#table-plugins-"+theTabb+" tbody input:checked").each(function(i,v){
	 
		ps+=$(v).closest("tr").find("td:eq(1)").text().trim() + " ";

	});
	ps.trim();

	switch(parseInt(VaL)){
		case 1:
			runBash("wp plugin activate "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all activated",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;
		case 2:
			runBash("wp plugin deactivate "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all deactivated",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;
		case 3:
			runBash("wp plugin install "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all installed",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;
		case 4:
			runBash("wp plugin update "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all updated",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {swal("oops",output,"error").then(()=>{
						loadMe("plugins",theTabb);
					});}
			});
		break;
		case 5:
			runBash("wp plugin delete "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all deleted",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("plugins",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;

	}
});

/*********************** filter plugins ***********************/
$(document).on("keyup", "input[name='filter-plugins']", function(e){
	var ne=$(e.target);
	var VaL=$(e.target).val();
	$(e.target).attr("AUTOCOMPLETE","OFF");

	switch(e.which){
		case 13:
		$(e.target).blur();
		break;

		case 27:
		$("#table-plugins-"+theTabb+" thead th input[name='filter-plugins']").blur().val("");
		$("#table-plugins-"+theTabb+" tbody tr").show();
		break;

		default:
		$("#table-plugins-"+theTabb+" tbody tr").hide();
		$("#table-plugins-"+theTabb+" tbody tr td:nth-child(2):contains('"+VaL+"')").closest("tr").show();

		break;
	}

});


/*********************** toggle active/inactive status - dblclick td ***********************/
$(document).on("dblclick","[id^=table-plugins-] tbody tr td:nth-child(3)", function(e){
	var status=$(e.target).text().trim();
	var plugin=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var wpPath=$("table.update-tabs tbody tr:eq(0) td:eq(1)").text();

	if(status=="active" || status=="inactive"){

		runBash("wp plugin toggle "+plugin+" --path="+wpPath).done(function(exit, output){
			if(exit===0){
				swal(plugin,output,"success",{buttons:false,timer:2000}).then(()=>{
					loadMe("plugins",theTabb);
				});
			} else {
				swal("ooops",output,"error",{buttons:false,timer:2000});
			}
		});

	} else {

		swal("only installed plugins may toggle status!",{buttons:false, timer:2000, icon:"warning"});
	}
	
});







