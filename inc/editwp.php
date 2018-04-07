<?php 
include '../config.php';

	OZtheme::$paletName="tomato-gray";
	OZtheme::enquee("js",siteurl . "dist/editwp.bundle.js");
	OZtheme::enquee("css",siteurl . "dist/editwp.bundle.css");
	
	OZtheme::top();

	$wpInstallations=OZwpcli::wpInstallations();

	if(!empty($_GET["wp"]) && isset($_GET["wp"]) ){
		$wp=$_GET["wp"];
		$wpPath=$wpInstallations[$wp];
	} else {$wp="0";}

 ?>


<div class="jumbotron" style="padding: 15px;">
	<h3><i class="fa fa-edit"></i>  edit WP</h3>
	<br>
	<div class="row">
		<div class="col-1">
			<i class="fa fa-wordpress fa-2x"></i>
		</div>
		<div class="col-6">
			<form id="frm_select_wp">
				<div class="form-group">
					<select name="select_wp" id="select_wp" class="form-control" >
						<option value="0" 
						<?php if($wp=="0"){echo "selected";} ?>
						>Select WP From List</option>
				<?php foreach($wpInstallations as $key => $value): ?>
					
					<option 
					value="<?php echo $key?>"
					<?php if($wp===$key){echo "selected";} ?>
					><?php echo $key?></option>

				<?php endforeach; ?>
					</select>
				</div>
			</form>
			<br>

			<?php if($wp!=="0"): ?>
			<table class="table table-hover text-info update-tabs">
				<tbody>
				<tr  data-toggle="tooltip" data-placement="top" title="open in finder...">
					<td class="text-right"><i class="fa fa-file"></i></td>
					<td class="text-left"><?php echo $wpPath?></td>
				</tr>
				<tr data-toggle="tooltip" data-placement="top" title="open in PhpMyAdmin...">
					<td class="text-right"><i class="fa fa-database"></i></td>
					<td class="text-left"><span data-db="<?php echo $wp?>"></span></td>
				</tr>
				<tr data-toggle="tooltip" data-placement="top" title="open in WP-ADMIN...">
					<td class="text-right"><i class="fa fa-user-secret"></i></td>
					<td class="text-left"><span data-wp="<?php echo $wp?>"><?php echo $wp?></span></td>
				</tr>
				</tbody>
			</table>
			<?php endif; ?>

		</div>
		<div class="col-3"></div>
		<div class="col-2">

			<button type="button" class="btn btn-danger btn-block"
			id="btn_del_wp" data-wp="<?php echo $wp?>"
			data-path="<?php echo $wpPath?>"
			<?php if($wp==="0"){echo " hidden";}?>
			 data-toggle="tooltip" title="delete <?php echo $wp?>"
			>
			<i class="fa fa-trash"></i>
			   delete WP
			</button>
		</div>
	</div>

	<div class="row">
		<div class="col-10"></div>
		<div class="col-2">
			<button type="button" class="btn btn-info btn-block"
			id="btn_backup_wp" data-wp="<?php echo $wp?>"
			data-path="<?php echo $wpPath?>"
			<?php if($wp==="0"){echo " hidden";}?>
			 data-toggle="tooltip" title="backup <?php echo $wp?>"
			>
			<i class="fa fa-database"></i>
			   backup WP
			</button>
		</div>
	</div>

</div>

<?php if($wp!=="0"): ?>


<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs" id="tabs-edit">
			<li class="nav-item">
				<a href="#home" class="nav-link active" data-toggle="tab">
				<i class="fa fa-home"></i>  
				home</a>
			</li>
			<li class="nav-item">
				<a href="#config" class="nav-link" data-toggle="tab">
				<i class="fa fa-sliders"></i>  
				config</a>
			</li>
			<li class="nav-item">
				<a href="#options" class="nav-link" data-toggle="tab">
				<i class="fa fa-cog"></i>  
				options</a>
			</li>
			<li class="nav-item">
				<a href="#plugins" class="nav-link" data-toggle="tab">
				<i class="fa fa-plug"></i>  
				plugins</a>
			</li>
			<li class="nav-item">
				<a href="#themes" class="nav-link" data-toggle="tab">
				<i class="fa fa-newspaper-o"></i>  
				themes</a>
			</li>
			<li class="nav-item">
				<a href="#users" class="nav-link" data-toggle="tab">
				<i class="fa fa-user"></i>  
				users</a>
			</li>
		</ul>
	</div>
	
	<div class="card-body">
		<div class="tab-content">

			<!-- tab-home -->
			<div class="tab-pane active" id="home">
				home
			</div>
			
			<!-- tab-config -->
			<div class="tab-pane" id="config">
				<div id="tab-config"></div>
			</div>
			
			<!-- tab-options -->
			<div class="tab-pane" id="options">
				<div id="tab-options"></div>
			</div>

			<!-- tab-plugins -->
			<div class="tab-pane" id="plugins">
				<div id="tab-plugins"></div>
			</div>

			<!-- tab-themes -->
			<div class="tab-pane" id="themes">
				<div id="tab-themes"></div>
			</div>

			<!-- tab-users -->
			<div class="tab-pane" id="users">
				<div id="tab-users"></div>
			</div>

		</div>

	</div>
	<div class="card-footer"></div>
</div>





<?php endif; ?>
<?php  OZtheme::bottom(); ?>
