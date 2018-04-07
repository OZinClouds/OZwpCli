
import "bootstrap";
import "popper.js";

import 'bootstrap/dist/css/bootstrap.min.css';
import "font-awesome/css/font-awesome.min.css";

import swal from 'sweetalert';
import "./hmr.js";

import "./theme/scss/theme.scss";
import "./theme/sb-admin.js";

import 'busy-load';




$(function(){
	
	//siteurl may need to be defined without http: part...
	var siteurl = window.location.href.replace(/^https?\:\/\//i, "\/\/").replace(/\?.*/i,"");

	/*********************** activate menu item corresponding the current path ***********************/
	$("#menu").find(".nav-link").removeClass("active");
	$("#menu").find(".nav-link[href='" + siteurl + "']").addClass("active");




});


