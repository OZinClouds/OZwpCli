import {runWPlock} from "./run.wp.lock.js";
import {runFinder} from "./run.finder.js";
import {runWPconfigGet} from "./run.wp.config.get.js";
import {runBash} from "./run.bash.js";


import {swal_backup} from "./editwp.backup.js";
import {swal_delete} from "./editwp.delete.js";

import "./editwp.tab.config.js";
import "./editwp.tab.options.js";
import "./editwp.tab.plugins.js";
import "./editwp.tab.themes.js";
import "./editwp.tab.users.js";

import "tablesorter/dist/js/jquery.tablesorter.js";
import "tablesorter/dist/css/theme.bootstrap_4.min.css";



$(document).ready(function(){ 
	

	/*********************** select_wp on change ***********************/
	$("#select_wp").on("change", function(e){
		window.location= "./editwp.php?wp=" + $(e.target).val();
	});

	/*********************** wpLock status ***********************/
	$(function(){

		if($("#select_wp").val()!=="0"){
			if(runWPlock($("#select_wp").val(), "status")){
				$("#btn_del_wp").prop("disabled", true)
				.attr("title", "you cannot delete this wp \n ozwpdev.txt must exists in the wp folder...")
				

			}

			$(".update-tabs tr:eq(1) td:eq(1)").text($("#select_wp").val());

		}
	});

	/*********************** open WP in finder + open PhpMyAdmin  + open WP-ADMIN***********************/
     	$(".update-tabs tr").on("click", function(e){
     		var tr=$(e.target).closest("tr");
     		var txt=$(tr).find("td:eq(1)").text();
     		var wpPath=$(tr).parent().find("td:eq(1)").text();
     		if($(tr).find("td:eq(0) i").hasClass("fa-file")){
     			runFinder(txt);
     		} else if($(tr).find("td:eq(0) i").hasClass("fa-database")) {
     			window.open("http://localhost/phpmyadmin/db_structure.php?db="+txt);
     		} else if($(tr).find("td:eq(0) i").hasClass("fa-user-secret")){
     			runBash("wp admin  --path=" + wpPath);
     	
     		}
     		
     	});

     	/*********************** runDBexport - Export DB ***********************/
     	$("#btn_backup_wp").on("click", function(e){
     		var DBname=$(".update-tabs tr:eq(1) td:eq(1)").text();
     		var wpPath=$(".update-tabs tr:eq(0) td:eq(1)").text();
     		swal_backup(wpPath, DBname);
     	});

     	/*********************** runDELwp - Delete WP ***********************/
     	$("#btn_del_wp").on("click", function(e){
     		var wpPath=$(e.target).attr("data-path");
     		var wpName=$(e.target).attr("data-wp");
     		var DBname=$(".update-tabs tr:eq(1) td:eq(1)").text();
     		swal_delete(wpName, wpPath, DBname);
     	});


     	/*********************** tabs-edit on tab shown ***********************/
     	$(document).find('#tabs-edit a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

     		$("#tabs-edit").find("i").removeClass("fa-spin");
     		if($(e.target).attr("href")!=="#home"){
     			$(e.target).find("i").toggleClass('fa-spin');
	     		
	     		var theTab=$(e.target).attr("href").replace("#","");
	     		var wpPath=$(".update-tabs tr:eq(0) td:eq(1)").text();
	     		$.busyLoadFull("show",{text:"tab loading..."});
	     		LoadEditTab(theTab, wpPath).then(()=>{
	     			$.busyLoadFull("hide");
	     		});
	     		
	     		

     		}



     	});//tabs-edit on tab shown



});//end of Document Ready Function

export function LoadEditTab(theTab, wpPath){

	var dfd = new $.Deferred();

	$(document).find("#tab-"+theTab).load("editwp.tab."+theTab+".php",{wpPath:wpPath},function(){
		$('[data-toggle="tooltip"]').tooltip();
		$(document).find("#tabs-edit i").removeClass("fa-spin");
		dfd.resolve("done");

	});
	return dfd.promise();
}

/*********************** Loads or Reloads the tab contents with a given inner-tab ***********************/
export function loadMe(theTab, what="home"){
		$('#tabs-edit a[data-toggle="tab"][href="#'+theTab+'"]').tab("show");
		$.busyLoadFull("show",{text:"tab loading..."});
		LoadEditTab(theTab,$("table.update-tabs tbody tr:eq(0) td:eq(1)").text().trim()).done(function(){

			$("#tabs-"+theTab+" a[href='#"+theTab+"-"+what+"']").tab("show");

		}).then(()=>{
	     			$.busyLoadFull("hide");
	     		});

		/*********************** reload tab on dblclick ***********************/
		$(document).on("dblclick",".card a.nav-link.active",function(e){
					
			var tabs=$(e.target).attr("href").match(/\w+/ig);

			if(tabs.length>1){
				loadMe(tabs[0],tabs[1]);
				swal("reloaded",tabs[0]+"-"+tabs[1],{buttons:false,timer:1000});
			} else {
				var tabs=$(e.target).closest(".card").find(".card a.nav-link.active").attr("href").match(/\w+/ig);
				loadMe(tabs[0],tabs[1]);
				swal("reloaded",tabs[0]+"-"+tabs[1],{buttons:false,timer:1000});
			}
			
		});
	}




