import {updateTabList} from "./update.tablist.js";
import {updateEverything} from "./update.everything.js";
import {runFinder} from "./run.finder.js";

$(window).on("load", function() {

	$("#update_tabs_php").parent().find(".card-body-icon").toggleClass("fa-spin");


});



$(document).ready(function(){ 


	/*********************** update.tabs.php ***********************/
	$("#update_tabs_php").load("../inc/update.tabs.php", function( response, status, xhr){
		
		
	     	$(function () {
		  $('[data-toggle="tooltip"]').tooltip();
		});


	     	/*********************** Tab List ***********************/
		$("#update_tabs_php").parent().find(".card-body-icon").toggleClass("fa-spin");
	
		$("#update_tabs").find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$("#update_tabs").find("[data-type='wp'] i").removeClass("fa-spin");
		  	if($(e.target).attr("data-type")=="wp" && $(e.target).attr("data-status")=="new" ){ 
		  		$(e.target).attr("data-status", "loaded");
		  		
		  		updateTabList(e.target);
		  	}

		  	/*********************** open WP in finder + open PhpMyAdmin ***********************/
		     	$(".tab-pane.active .update-tabs tr").on("click", function(e){
		     		var tr=$(e.target).closest("tr");
		     		var txt=$(tr).find("td:eq(1)").text();
		     		if($(tr).find("td:eq(0) i").hasClass("fa-file")){
		     			runFinder(txt);
		     		} else {
		     			window.open("http://localhost/phpmyadmin/db_structure.php?db="+txt);
		     		}
		     		
		     	});

		     	/*********************** Edit this WP ***********************/
		  	$(".tab-pane.active button[data-wp]").on("click", function(e){
		  		window.location="./editwp.php?wp=" + $(e.target).attr("data-wp");
		  	});

		});

		$("button[id^='btn_update_list_refresh_']").on("click", function(e){
				updateTabList(e.target);
		});

		/*********************** WP Update Everything ***********************/
		$("button[data-name='wp-update-everything']").on("click", function(e){
			updateEverything();
		});


	});



	
});//end of Document Ready Function



	




