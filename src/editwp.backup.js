import {runDBexport} from "./run.db.export.js";

export function swal_backup(wpPath, DBname){
	swal({
		title:"backup WP",
		text: "WP backup will be both in \n OZwpCli's basedir /tmp folder and \n WP's upload/OZwpCli folder...",
		icon: "warning",
		closeOnClickOutside: false,
		dangerMode: true,
		buttons: {
			cancel: true,
				confirm: {
				text: "OK, backup now",
				value: true,
				visible: true,
				className: "bg-danger",
				closeModal: false
				}
			},
	}).then( (value) => {
		if(value){
			return runDBexport(wpPath, DBname, "tmp");
		}
	}).then( (value) => {
		if(value){
			return runDBexport(wpPath, DBname, "wp");
		} else {
			swal("WP Backup", "something went wrong!","error");
		}
	}).then( (value) => {
		if(value){
			swal("WP Backup", "Successful!","success");
		} else {
			swal("WP Backup", "process canceled","warning");
		}
	});

}//end function