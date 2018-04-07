<?php 
	include "../config.php" ;
	OZtheme::$paletName="cyan-gray";
	OZtheme::enquee("js",siteurl . "dist/update.bundle.js");
	OZtheme::top() 
?>


<div class="card">
<div class="card-header"><i class="fa fa-download"></i> Updates</div>
<div class="card-body">
	<i class="fa fa-wordpress card-body-icon "></i>
	<div id="update_tabs_php"></div>
</div>
<div class="card-footer"></div>
</div>












<?php  OZtheme::bottom(); ?>