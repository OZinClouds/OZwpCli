import {runBash} from "./run.bash.js";




	/*********************** reload tab contents and inner-tabs ***********************/
	import {LoadEditTab, loadMe} from "./editwp.js";
	//loadMe("themes","list");


var theTabb;
$(document).on('shown.bs.tab', '#tabs-themes a[data-toggle="tab"]', function (e) {

	theTabb= $(e.target).attr("href").match(/\w+/ig)[1].trim();

});

/*********************** HOME - default themes list dblclikk to read better ***********************/
$(document).on("dblclick","#themes-home table tbody tr",function(e){

	var theme=$(e.target).closest("tr").find("td:eq(0)").text();
	var group=$(e.target).closest("tr").find("td:eq(1)").text();
	var def=$(e.target).closest("tr").find("td:eq(2)").text();
	var desc=$(e.target).closest("tr").find("td:eq(3)").text();
	var comment=$(e.target).closest("tr").find("td:eq(4)").text();
	var msg = "<strong>default (URL):</strong> " + def + "<hr>" +
		"<strong>group:</strong> " + group + "<hr>" +
		"<strong>desc:</strong> " + desc + "<hr>" +
		"<strong>comment:</strong> " + comment

	swal({
			title:theme,
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


/*********************** theme info ***********************/
$(document).on("dblclick","[id^=table-themes-] tbody tr td:nth-child(2)",function(e){
	var theme=$(e.target).text().trim();
	var wpPath=$("table.update-tabs tbody tr:eq(0) td:eq(1)").text();
	runBash("wp theme get " + theme + " --format=json --path="+wpPath).done(function(status,output){

		if(status===0){
			output=$.parseJSON(output);
			var info="";
			$.each(output, function(i,v){
				info+="<strong>" + i + ": </strong>" + v + "<hr>";
			})
			swal({
				title:theme,
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
			swal(theme,"info is available only after install","info");
		}
	});
});

/*********************** single theme update ***********************/
$(document).on("click", "button[name='btn-themes-update']", function(e){
	var theme=$(e.target).attr("data-theme");
	var wpPath=$(e.target).attr("data-path");
	var thisTD=$(e.target).closest("td");
	runBash("wp theme update "+theme+" --path="+wpPath).done(function(status,output){
		if(status===0){
			swal(theme,output,"success", {timer:2000, buttons:false}).then(()=>{
				loadMe("themes",theTabb);
			});
		} else {
			swal("ooops",output,"error");
		}

	});
});

/*********************** single theme delete ***********************/
$(document).on("click","button[name='btn-themes-delete']", function(e){
	var theme=$(e.target).attr("data-theme");
	var wpPath=$(e.target).attr("data-path");

		swal({
			title:theme,
			icon:"warning",
			text: "delete this theme?",
			dangerMode:true,
			buttons:{
				cancel:true,
				confirm:{
					text:"delete theme"
				}
			}

		}).then((value)=>{
			if(value){
				runBash("wp theme delete "+theme+" --path="+wpPath).done(function(status, output){
				if(status===0){
					swal(theme,output,"success", {timer:2000, buttons:false}).then(()=>{
						loadMe("themes",theTabb);
					});
				} else {
					swal("ooops",output,"error");
				}

				});
			}
		});

});

/*********************** single theme Install ***********************/
$(document).on("click","button[name='btn-themes-install']", function(e){
	var theme=$(e.target).attr("data-theme");
	var wpPath=$(e.target).attr("data-path");

	runBash("wp theme install "+theme+"  --path="+wpPath).done(function(status,output){
		if(status===0){
			swal("installed!",theme + " is installed!","success",{buttons:false,timer:2000}).then(()=>{
				loadMe("themes",theTabb);
			});
		} else {
			swal("ooops","something went wrong","error",{buttons:false,timer:2000});
		}
	});


});


/*********************** any checkbox checked ***********************/
$(document).on("change","input[name='check-themes']",function(e){
	if($("#table-themes-"+theTabb+" tbody input:checked").length>0){
		$("#table-themes-"+theTabb+" tfoot").removeClass('d-none');	
	} else {
		$("#table-themes-"+theTabb+" tfoot").addClass('d-none');
	}

});

/*********************** check-pugins-all ***********************/
$(document).on("change","input[name^=check-themes-all-]", function(e){
		var status = $(e.target).prop("checked");
		$("#table-themes-"+theTabb+" tbody input[type='checkbox']").prop("checked", status).trigger("change");
});


/*********************** select-themes-[theTabb]***********************/
$(document).on("click","[id^=btn-select-themes-]", function(e){
	var VaL=$("#select-themes-"+theTabb).val();
	var wpPath=$(e.target).attr("data-path");
	var ps="";
	$("#table-themes-"+theTabb+" tbody input:checked").each(function(i,v){
	 
		ps+=$(v).closest("tr").find("td:eq(1)").text().trim() + " ";

	});
	ps.trim();

	switch(parseInt(VaL)){
		case 3:
			runBash("wp theme install "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all installed",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("themes",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;
		case 4:
			runBash("wp theme update "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all updated",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("themes",theTabb);
					});
				} else {swal("oops",output,"error").then(()=>{
						loadMe("themes",theTabb);
					});}
			});
		break;
		case 5:
			runBash("wp theme delete "+ps+" --path="+wpPath).done(function(status,output){
				if(status===0){
					swal("all deleted",output,"success",{buttons:false,timer:2000}).then(()=>{
						loadMe("themes",theTabb);
					});
				} else {swal("oops",output,"error");}
			});
		break;

	}
});

/*********************** filter themes ***********************/
$(document).on("keyup", "input[name='filter-themes']", function(e){
	var ne=$(e.target);
	var VaL=$(e.target).val();
	$(e.target).attr("AUTOCOMPLETE","OFF");

	switch(e.which){
		case 13:
		$(e.target).blur();
		break;

		case 27:
		$("#table-themes-"+theTabb+" thead th input[name='filter-themes']").blur().val("");
		$("#table-themes-"+theTabb+" tbody tr").show();
		break;

		default:
		$("#table-themes-"+theTabb+" tbody tr").hide();
		$("#table-themes-"+theTabb+" tbody tr td:nth-child(2):contains('"+VaL+"')").closest("tr").show();

		break;
	}

});


/*********************** toggle active/inactive status - dblclick td ***********************/
$(document).on("dblclick","[id^=table-themes-] tbody tr td:nth-child(3)", function(e){
	var status=$(e.target).text().trim();
	var theme=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var wpPath=$("table.update-tabs tbody tr:eq(0) td:eq(1)").text();

	if(status=="active" || status=="inactive"){

		runBash("wp theme activate "+theme+" --path="+wpPath).done(function(exit, output){
			if(exit===0){
				swal(theme,output,"success",{buttons:false,timer:2000}).then(()=>{
					loadMe("themes",theTabb);
				});
			} else {
				swal("ooops",output,"error",{buttons:false,timer:2000});
			}
		});

	} else {

		swal("only installed themes may toggle status!",{buttons:false, timer:2000, icon:"warning"});
	}
	
});







