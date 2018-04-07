import {runBash} from "./run.bash.js";

$(window).on("load", function() {

	$("#inc_wp_info_php").parent().find(".card-body-icon").toggleClass("fa-spin");
	$("#inc_wp_find_php").parent().find(".card-body-icon").toggleClass("fa-spin");
	$("#inc_mysql_info_php").parent().find(".card-body-icon").toggleClass("fa-spin");
	$("#inc_mysql_listdb_php").parent().find(".card-body-icon").toggleClass("fa-spin");
     
});

$(document).ready(function(){

	/*********************** WP CLI INFO ***********************/
	$("#inc_wp_info_php").load("../inc/system.wp-info.php", function( response, status, xhr){
		
		$("#inc_wp_info_php").parent().find(".card-body-icon").toggleClass("fa-spin");

		/*********************** strong-txt-before-semicolon ***********************/
		$("body").find(".strong-txt-before-semicolon").each(function(){
		var html = $(this).html();
		$(this).html(html.replace(/^(.+?\:)/gim, '<br><i class="fa fa-cog"></i>  <strong>$1</strong>'));
		});
		
	});

	/*********************** WP FIND ***********************/
	$("#inc_wp_find_php").load("../inc/system.wp-find.php", function( response, status, xhr){
		
		$("#inc_wp_find_php").parent().find(".card-body-icon").toggleClass("fa-spin");
		
	});	

	/*********************** PhpMyAdmin info ***********************/
	$("#inc_mysql_info_php").load("../inc/system.mysql-info.php", function(response, status, xhr){

		$("#inc_mysql_info_php").parent().find(".card-body-icon").toggleClass("fa-spin");

	});
	
	/*********************** PhpMyAdmin List DBs ***********************/
	$("#inc_mysql_listdb_php").load("../inc/system.mysql-listdb.php", function(response, status, xhr){

		$("#inc_mysql_listdb_php").parent().find(".card-body-icon").toggleClass("fa-spin");

	});


});//end of Document Ready Function

	
