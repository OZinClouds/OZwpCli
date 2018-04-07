webpackJsonp([2],{

/***/ "./src/run.finder.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = runFinder;
function runFinder(path=" . "){
	var status=false;

	$.ajax({
		url: "../inc/run.finder.php",
		type: "post",
		async:false,
		data: {do:"run", run:"finder", path:path}
	}).done(function(data){

		if(data=="true"){
			//swal("ok","it came", "success");
			status=true;
		} else {
			swal("oops","path not found", "warning");
		}
	}).fail(function(){
			swal("oops","path not found", "warning");
	});

	return status;
}
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/run.wp.config.get.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = runWPconfigGet;
function runWPconfigGet(wpPath,item=null){

	var status=false;
	var backData;

	$.ajax({
		url: "../inc/run.wp.config.get.php",
		type: "post",
		dataType: 'json',
		async:false,
		data: {do:"run", run:"WPconfigGet", wpPath:wpPath}

	}).done(function(data){

		status=true;
		backData = data;
		
	}).fail(function(){
			swal("oops","bad data from run.wp.config.get.php", "warning");
	});

	if(status) {
		if(item==null){
			return backData;
		} else {
			/*** if item given then return its value ***/
			var arr = $.parseJSON(backData);
			$.each(arr, function(i,v){
				if(v["name"]==item){
					backData= v["value"];
				}
			});
			return backData;
		}

	} else {
		return false;
	}


	/*********************** returns json string of WP config list or item value like: DB_NAME ***********************/



}//end function
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.core.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = updateCore;
function updateCore(wpPath, opener){

		swal(
			{
			title: "Update Core",
			text: "Path: " + wpPath ,
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update WP core",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){

				$.ajax(
				{
					url: "update.run.php",
		  			type: "post",
		  			data: {
		  				do:"run",
		  				wp:"core",
		  				wppath:wpPath
		  			}
				}

				).done(function(datas){
					var data=$.parseJSON(datas);
					if(data["exit_status"]!==0){
						var icon="danger";
						$(opener).text("retry update!!");
					} else {
						var icon="success";
						$(opener).text("updated").prop("disabled", true);
					}
					swal({
						title: "Updated!",
						icon: icon,
						text:  wpPath + "\n  \n" + data["output"],
						buttons:false,
						timer:3000
					});
					
				});

			}
		});

	}// end updateCore
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.everything.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = updateEverything;
function updateEverything(){
$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');


	swal(
			{
			title: "Update Everything",
			text: "Core and Plugin Updates of all WP installations",
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update everything",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){
	
			$.ajax({
				url: "../inc/update.run.php",
				type: "post",
				data: {
					do: "run",
					wp: "everything"
					},
			success: function(datas){
				
				$("button[data-name='wp-update-everything']")
					.html("..all updated")
					.removeClass("btn-warning").addClass("btn-success");
				
				swal({
					title: "Updated!",
					icon: "success",
					text: "everything",
					buttons:false,
					timer:3000
				});

				$("#tbl-everything").removeClass("d-none");
				$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');

				},//end success function
			error: function(xhr, status, err){

				swal({
					title: "ERROR!",
					icon: "danger",
					text: "update failed, retry again",
					buttons:{confirm}
				});


				}// end error function	

			});	
			} else {
				$("button[data-name='wp-update-everything'] i").toggleClass('fa-spin');
			}
		});


}// end updateEverything

/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__update_tablist_js__ = __webpack_require__("./src/update.tablist.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__update_everything_js__ = __webpack_require__("./src/update.everything.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__run_finder_js__ = __webpack_require__("./src/run.finder.js");




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
		  		
		  		Object(__WEBPACK_IMPORTED_MODULE_0__update_tablist_js__["a" /* updateTabList */])(e.target);
		  	}

		  	/*********************** open WP in finder + open PhpMyAdmin ***********************/
		     	$(".tab-pane.active .update-tabs tr").on("click", function(e){
		     		var tr=$(e.target).closest("tr");
		     		var txt=$(tr).find("td:eq(1)").text();
		     		if($(tr).find("td:eq(0) i").hasClass("fa-file")){
		     			Object(__WEBPACK_IMPORTED_MODULE_2__run_finder_js__["a" /* runFinder */])(txt);
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
				Object(__WEBPACK_IMPORTED_MODULE_0__update_tablist_js__["a" /* updateTabList */])(e.target);
		});

		/*********************** WP Update Everything ***********************/
		$("button[data-name='wp-update-everything']").on("click", function(e){
			Object(__WEBPACK_IMPORTED_MODULE_1__update_everything_js__["a" /* updateEverything */])();
		});


	});



	
});//end of Document Ready Function



	





/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.pluginall.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = updatePluginAll;

function updatePluginAll(wpPath, opener){
		swal(
			{
			title: "Update All Plugins",
			text: "Path: " + wpPath ,
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update all plugins",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){

				$.ajax(
				{
					url: "update.run.php",
		  			type: "post",
		  			data: {
		  				do:"run",
		  				wp:"pluginall",
		  				wppath:wpPath 
		  			}
				}

				).done(function(datas){
					var data=$.parseJSON(datas);
					if(data["exit_status"]!==0){
						var icon="danger";
						$(opener).text("retry update!!");
					} else {
						var icon="success";
						$(opener).text("all updated!").prop("disabled", true);
						$('[data-btn="btn_plugin_single_update"]').text("updated").prop("disabled", true);
					}
					swal({
						title: "Updated!",
						icon: icon,
						text: wpPath +"\n" + data["output"],
						buttons:false,
						timer:3000
					});
				}).fail(function(){
					swal({
						title: "ERROR!",
						icon: "danger",
						text: "update failed, retry again",
						buttons:{confirm}
					});
				});

			}
		});

	}// end OZsweetPluginAll
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.pluginsingle.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = updatePluginSingle;
function updatePluginSingle(Plugin, wpPath, opener){
		swal(
			{
			title: "Update Plugin",
			text: "Plugin: " + Plugin + "\n  Path: " + wpPath ,
			icon: "warning",
			closeOnClickOutside: false,
			dangerMode: true,
  			buttons: {
  					cancel: true,
  					confirm: {
  					  text: "OK, update plugin",
  					  value: true,
  					  visible: true,
  					  className: "bg-danger",
  					  closeModal: false
  					}
  				},
			}
		). then( (value) => {
			if(value){

				$.ajax(
				{
					url: "update.run.php",
		  			type: "post",
		  			data: {
		  				do:"run",
		  				wp:"plugin",
		  				plugin:Plugin,
		  				wppath:wpPath 
		  			}
				}

				).done(function(datas){
					var data=$.parseJSON(datas);
					if(data["exit_status"]!==0){
						var icon="danger";
						$(opener).text("retry update!!");
					} else {
						var icon="success";
						$(opener).text("updated").prop("disabled", true);
					}
					swal({
						title: "Updated!",
						icon: icon,
						text: Plugin + "\n" + wpPath +"\n" + data["output"],
						buttons:false,
						timer:3000
					});
				});

			}
		});

	}// end updatePluginSingle
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ "./src/update.tablist.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function($) {/* harmony export (immutable) */ __webpack_exports__["a"] = updateTabList;
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__update_pluginall_js__ = __webpack_require__("./src/update.pluginall.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__update_pluginsingle_js__ = __webpack_require__("./src/update.pluginsingle.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__update_core_js__ = __webpack_require__("./src/update.core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__run_wp_config_get_js__ = __webpack_require__("./src/run.wp.config.get.js");





function updateTabList(el){

		  		
		  		$.ajax({
		  			url: "update.list.php",
		  			type: "post",
		  			data: {
		  				do:"get_all_updates",
		  				wpname:$(el).attr("wp-name"),
		  				wppath:$(el).attr("wp-path") 
		  			},
		  			beforeSend: function(){
		  				$(el).parent().find("i").toggleClass("fa-spin");
		  			},
		  			success: function(data){
		  				$(el).parent().find("i").toggleClass("fa-spin");
		  				$("[data-from='" +  $(el).attr("wp-name")  + "']").html(data);
						
						/*********************** btn_core_update ***********************/
						$("[id^='btn_core_update_']").on("click", function(e){

							Object(__WEBPACK_IMPORTED_MODULE_2__update_core_js__["a" /* updateCore */])($(e.target).attr("data-path"), this);
						});

						/*********************** btn_plugin_single_update ***********************/
						$('[data-btn="btn_plugin_single_update"]').on('click', function(e){
							var Plugin = $(e.target).attr("data-plugin");
							var wpPath = $(e.target).attr("data-path");
							
							Object(__WEBPACK_IMPORTED_MODULE_1__update_pluginsingle_js__["a" /* updatePluginSingle */])(Plugin, wpPath, this );
						});

						/*********************** data-btn="update_pluginall" ***********************/
						$('[data-btn="update_pluginall"]').on("click", function(e){
							var wpPath = $(e.target).attr("data-path");

							Object(__WEBPACK_IMPORTED_MODULE_0__update_pluginall_js__["a" /* updatePluginAll */])(wpPath, this);
						});


		  			}
		  		});
		  $(".tab-pane.active span").html( Object(__WEBPACK_IMPORTED_MODULE_3__run_wp_config_get_js__["a" /* runWPconfigGet */])($(".tab-pane.active span").attr("data-db"), "DB_NAME")  );
		  	
	} //end of updateTabList
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__("./node_modules/jquery/dist/jquery.js-exposed")))

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./src/update.js");


/***/ })

},[2]);
//# sourceMappingURL=update.bundle.js.map