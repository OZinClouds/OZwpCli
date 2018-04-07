import {runWPcoreDownload} from "./run.wp.core.download.js";
/*** runWPcoreDownload(wpName) ***/

import {runWPlock} from "./run.wp.lock.js";
/*** runWPlock(wpName, lock) ***/
/*** 
	wpName is the folder name in the root dir
	lock=status returns if the wp install locked or not
	locked status = true means there is no ozwpdev.txt in root dir
	locked status = false means there is ozwpdev.txt in root dir and can be modified
	to set or unlik ozwpdev.txt assign lock = lock / unlock (unlock means free modify)
***/

import {runWPconfigCreate} from "./run.wp.config.create.js"
/*** runWPconfigCreate(wpName) ***/
/*** DB_HOST, DB_USER, DB_PASS parameters taken from .env file ***/

import {runWPcoreInstall} from "./run.wp.core.install.js";
/*** runWPcoreInstall(wpName, usr, email, pass) ***/

import {runDBcreate} from "./run.db.create.js";
/*** runDBcreate(DBname) ***/



import   "jquery-validation";

	$("#frm_validate").submit(function(e){
	    return false;
	});
	$("#frm_user").submit(function(e){
	    return false;
	});

	$("#frm_user").validate();

	$("#btn_validate").hide();
	$("#frm_validate").validate({
		success:function(){
			$("#btn_validate").show();
			//$("#btn_validate").click();
		}
	});


$("#btn_validate").on("click", function(e){
	var wpName=$("#input_validate").val();
	var usr=$("#user").val();
	var email=$("#email").val();
	var pass=$("#pass").val();


	$.ajax({
		url:"../inc/newwp.validate.php",
		type:"post",
		async:false,
		data:{
			do:"run",
			run:"validate",
			wpName:wpName
		}
	}).done(function(datas){
		var data = $.parseJSON(datas);
		if(data){
			//valid name!
			createWP(wpName,usr,email,pass);
			
		} else {
			swal("invalid", "WP Name / DB Name already exists, \n please try another name","warning");
		}

	}). fail(function(){
		swal("oops","failed to validate!","warning");
	});
});


function createWP(wpName,usr,email,pass){

	swal(
		{
		title: "Create new WP",
		text: 	"WP & DB name: " + wpName + " \n " 
			+ "User: " + usr + " \n" 
			+ "e-Mail: " + email + " \n"
			+ "Pass: " + pass ,
		icon: "warning",
		closeOnClickOutside: false,
		dangerMode: true,
			buttons: {
					cancel: true,
					confirm: {
					  text: "OK, create WP",
					  value: true,
					  visible: true,
					  className: "bg-danger",
					  closeModal: false
					}
				},
		}
	)
	. then( (value) => { if(value){ return runWPcoreDownload(wpName); }})

	.then((value) =>{ if(value){ return runWPlock(wpName,"unlock");} else {swal("oops","something went wrong!","warning");}})

	.then((value) =>{ if(value){ return runWPconfigCreate(wpName);} else {swal("oops","something went wrong!","warning");}})
	.then((value) =>{ if(value){ return runDBcreate(wpName);} else {swal("oops","something went wrong!","warning");}})

	.then((value) =>{ if(value){ return runWPcoreInstall(wpName,usr,email,pass);} else {swal("oops","something went wrong!","warning");}})

	.then((value) =>{
			if(value){
				swal("DONE", wpName + " is ready!", "success").then((value)=>{
					window.location="./editwp.php?wp="+wpName;
				});

			} else {swal("oops","something went wrong!","warning");}
		});

	

} // end create WP




