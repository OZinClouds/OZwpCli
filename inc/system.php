<?php 
	include "../config.php" ;
	OZtheme::$paletName="green-gray";
	OZtheme::enquee("js",siteurl . "dist/system.bundle.js");
	OZtheme::top() 
?>




<?php 

	
 ?>


<div class="card-deck">
<div class="card ">
	<div class="card-header">
		WP-CLI Control 
  	</div>
	  <div class="card-body">
	  	<i class="fa fa-wordpress card-body-icon "></i>
	  	<div class="card-title "><h3>WP-CLI</h3></div>
			<span id="inc_wp_info_php"></span>
	  </div>
	  <div class="card-footer smaller">
	  	$: wp --info
	  </div>

</div>

<div class="card ">
	<div class="card-header">
		WP-Installations 
  	</div>
	  <div class="card-body">
	  	<i class="fa fa-wordpress card-body-icon "></i>
	  	<div class="card-title "><h3>WP-Find</h3></div>
			<span id="inc_wp_find_php"></span>
	  </div>
	  <div class="card-footer smaller strong-txt-before-semicolon">
	  	document root:  <?php echo $_SERVER["DOCUMENT_ROOT"]; ?>
	  </div>
	  
</div>

</div>

<br>

<div class="card-deck">
	<div class="card ">
	<div class="card-header">
		PhpMyAdmin 
  	</div>
	  <div class="card-body">
	  	<i class="fa fa-wordpress card-body-icon "></i>
	  	<div class="card-title "><h3>MySQL</h3></div>
			<span id="inc_mysql_info_php"></span>
	  </div>
	  <div class="card-footer smaller">
	  	mysqli
	  </div>
	</div>

	<div class="card ">
	<div class="card-header">
		PhpMyAdmin 
  	</div>
	  <div class="card-body">
	  	<i class="fa fa-wordpress card-body-icon "></i>
	  	<div class="card-title "><h3>MySQL List of DBs</h3></div>
			<span id="inc_mysql_listdb_php"></span>
	  </div>
	  <div class="card-footer smaller">
	  	mysql
	  </div>
	</div>


</div>





<?php  OZtheme::bottom(); ?>