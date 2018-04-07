import {runBash} from "./run.bash.js";

/*********************** reload tab contents and inner-tabs ***********************/
	import {LoadEditTab, loadMe} from "./editwp.js";
	//loadMe("options","list");

/*********************** search / filter option name ***********************/
$(document).on("keyup", "#filter-option-table", function(e){
	var ne=$(e.target);
	var VaL=ne.val();

	switch(e.which){
		case 13:
		$(e.target).blur();
		break;

		case 27:
		$(e.target).blur().val("");
		$("#table-options-all tbody tr").show();
		break;

		default:
		if(VaL.length>2){
			$("#table-options-all tbody tr").hide();
			$("#table-options-all tbody tr:contains('"+VaL+"')").show();
		}
		break;
	}

});

/*********************** on dbl click option ***********************/
$(document).on("dblclick","#table-options-all tr", function(e){

	var TR = $(e.target).closest('tr');
	var option_name=TR.find("td:eq(0)").text();
	var option_value=TR.find("td:eq(1)").text();
	swal(
		option_name,
		option_value
		)

});

/*********************** update options ***********************/
$(document).on("click","table[id^='table-options-'] button", function(e){
	var option=$(e.target).closest("tr").find("td:eq(0)").text().trim();
	var VaL=$(e.target).closest("tr").find("input").val();
	var cmd="wp option update " + option + " '" + VaL + "' --path=" + $(".update-tabs tr:eq(0) td:eq(1)").text();
	$(e.target).toggleClass('fa-spin fa-2x');
	var status=runBash(cmd);
	$(e.target).toggleClass('fa-spin fa-2x');
	if(status){
		swal({
			title:"updated",
			timer:2000,
			icon:"success",
			text: option + ": \n" + VaL,
			buttons:false
		});
	}

});

/*********************** dblclik default value of options ***********************/
$(document).on("dblclick","table[id^='table-options-'] tbody a", function(e){
	var option=$(e.target).closest("tr").find("td:eq(0)").text().trim();
	var defVal=$(e.target).attr("data-default");
	var inp=$(e.target).closest("tr").find("input");
	inp.val(defVal);
	inp.focus();
	
});

/*********************** goto settings page ***********************/
$(document).on("click", "#btn-goto-settings", function(e){

window.location=$(e.target).attr("data-location");

});

/*********************** update all option with default values ***********************/
$(document).on("click", "#btn-update-all-default-options", function(e){
	var TR=$(document).find("#table-update-all-default-options tbody tr");
	$(e.target).toggleClass("fa-spin");
	$.each(TR, function(i,v){
		var cmd="wp option update ";
		cmd+=$(v).find("td").eq(0).text().trim();
		cmd+=" '";
		cmd+=$(v).find("td").eq(1).text().trim();
		cmd+="' ";
		cmd+="--path=" + $(".update-tabs tr:eq(0) td:eq(1)").text();
		
		var status=runBash(cmd);
		if(status){
			$(v).find("td").eq(2).removeClass('fa-minus').addClass('fa-check').css("color", "green");
		} else {
			$(v).find("td").eq(2).removeClass('fa-minus').addClass('fa-times').css("color", "red");
		}
		
	});
	$(e.target).toggleClass("fa-spin");
	
});










