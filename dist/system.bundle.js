webpackJsonp([5],{

/***/ "./src/run.bash.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = runBash;
function runBash(cmd){
	var status=false;
	var dfd = new $.Deferred();

	$.ajax({
		url: "../inc/run.bash.php",
		type: "post",
		dataType: "json",
		async:false,
		data: {do:"run", run:"bash", cmd:cmd}
	}).done(function(data){
		dfd.resolve(data.exit_status,data.output);
	}).fail(function(jqXHR,textStatus,errorThrown){
			dfd.resolve(false,"ajax failed!\n"+errorThrown);
	});

	return dfd.promise();
}
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/system.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__run_bash_js__ = __webpack_require__("./src/run.bash.js");


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

	

/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./src/system.js");


/***/ })

},[1]);
//# sourceMappingURL=system.bundle.js.map