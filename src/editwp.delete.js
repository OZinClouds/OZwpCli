import {runBash} from "./run.bash.js";
import {runDBdelete} from "./run.db.delete.js";
import {runDBexport} from "./run.db.export.js";

export function swal_delete(wpName, wpPath, DBname){

	swal({
		title:"DELETE WP",
		content:{
			element:"span",
			attributes:{
			className:"alert alert-danger",
			innerHTML:"Do you want to delete <b>"+wpName+"</b> folder and drop <b>"+DBname+"</b>?",
			}
		},
		dangerMode:true,
		icon: "warning",
		closeOnClickOutside: false,
		buttons: {
			cancel: true,
				confirm: {
				text: "OK, delete everything",
				value: true,
				visible: true,
				className: "bg-danger",
				closeModal: false
				}
			},
	}).then((value)=>{
		if(value){
			return runDBexport(wpPath, DBname, "tmp");
		}
	}).then((value)=>{
		if(value){
			return runDBdelete(DBname);
		} else {
			swal("oops","DB Export \n something went wrong","error");
		}
	}).then((value)=>{
		if(value){
			return runBash("rm -rf "+wpPath);
		} else {
			swal("oops","DB delete \n something went wrong","error");
		}
	}).then((value)=>{
		if(value){
			swal("DELETED","WP: "+wpName,"success").then((value)=>{
				window.location="./editwp.php";
			});
		} else{
			swal("oops","process canceled","warning");
		}
	});


}//end of function