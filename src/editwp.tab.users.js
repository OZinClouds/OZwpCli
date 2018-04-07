import {runBash} from "./run.bash.js";



	/*********************** reload tab contents and inner-tabs ***********************/
	import {LoadEditTab, loadMe} from "./editwp.js";
	//loadMe("users","admin");

/*********************** get theTabb ***********************/
$(document).on("shown.bs.tab","#tabs-config",function(e){

	var theTabb=$(e.target).attr("href").match(/\w+/ig)[1];


});


/*********************** user details dblclick ***********************/
$(document).on("dblclick", "#users-list table tbody tr", function(e){
	var user=$(e.target).closest("tr").find("td:eq(1)").text().trim();
	var wpPath=$("table.update-tabs tbody td:eq(1)").text().trim();

	runBash("wp user meta list "+user+" --format=json --path="+wpPath).done(function(status, output){
		output=$.parseJSON(output);
		var msg="";
		var VaL="";
		$.each(output, function(i,v){
			if($.type(v["meta_value"])==="object"){
			 VaL=JSON.stringify(v["meta_value"]);
			} else { VaL=v["meta_value"];}
		msg+="<strong>" + v["meta_key"] + "</strong>: " + 
			"<code>" + VaL + "</code><hr>";
						
						});
		

		if(status===0){
			swal({
				title:user,
				content:{
					element:"div",
					attributes:{
						className:"alert alert-warning text-left o-hidden smaller",
						innerHTML:msg
					}
				},
				className:"alert-info"
			});

		} else {

			swal("oops", output, "error");
		}

	});
});


/*********************** on change type of user-value  >> radio + select***********************/
$(document).on("change","[name^=user-value-]", function(e){

	var theNode=$(e.target).prop("nodeName");
	var theType=$(e.target).attr("type");
	
	if(theNode=="SELECT" || theType=="radio"){
		var cmd=updateCMD($(e.target));
		updateUser(cmd);

	}

});

/*********************** on click type of user-value  >> text + textarea***********************/
$(document).on("click","[name^=btn-user-value-]", function(e){

	var theNode=$(e.target).parent().parent().children().eq(0).prop("nodeName");
	var theType=$(e.target).parent().parent().children().eq(0).attr("type");
			//from button > input-group-append > input-group < 1st child =>text/textarea
	
	if(theNode=="TEXTAREA" || theType=="text"){
		var cmd=updateCMD($(e.target));
		updateUser(cmd);

	}


});


/*********************** function update user  ***********************/
function updateCMD(el){
	var theNode=el.prop("nodeName");
	var admin=$("#users-admin").attr("data-admin");
	var wpPath=$("#users-admin").attr("data-path");
	var theGroup=el.closest("tr").attr("data-group");
	var theField=el.closest("tr").find("td:eq(0)").text().trim();
	var theVal=el.val();
		if(theNode=="BUTTON"){
			theVal=el.parent().parent().children().eq(0).val();
		} 
		if(theNode=="I" || theNode=="TD"){
			theVal=el.closest("tr").find("td:eq(1)").attr("data-default");
		}
	
	var cmd="wp user ";
	if(theGroup=="get"){
		cmd+="update " + admin + " ";
		cmd+="--" + theField + "=" + "'" + theVal + "' ";
		cmd+= "--path=" + wpPath
	}
	if(theGroup=="meta"){
		cmd+="meta update " + admin + " ";
		cmd+= theField + " " + "'" + theVal + "' ";
		cmd+= "--path=" + wpPath
	}

	return cmd
	
}//end function updateCMD


function updateUser(cmd){
	runBash(cmd).done(function(status,output){
		if(status===0){
			swal("user updated!",output,"success",{buttons:false,timer:2000}).then(()=>{
				loadMe("users","admin");
			});
		} else {

			swal("ooops!",output,"error").then(()=>{loadMe("users","admin")});
		}

	});
}//end function updateUser



/*********************** dblclick assign default values ***********************/
$(document).on("dblclick","#table-users-admin tbody tr td:nth-child(2)",function(e){

	var cmd=updateCMD($(e.target));
		updateUser(cmd);

});

/*********************** dblclick assign ALL default values ***********************/
$(document).on("dblclick","#table-users-admin thead tr th:nth-child(2)",function(e){

	var fields=$(e.target).closest("table").find("[name^=user-value-]");
	var cmd="";
	$.each(fields, function(i,v){
		cmd+=updateCMD($(v)) + ";  ";
	});

		updateUser(cmd);

});










