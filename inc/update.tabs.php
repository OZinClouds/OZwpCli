<?php  
include "../config.php";
	$wpInstallations=OZwpcli::wpInstallations();
		
?>

<div class="card">
	<div class="card-body">
		<div class="d-flex flex-row mt-2">
	<ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation" id="update_tabs">
		<li class="nav-item">
		<a href="#intro" class="nav-link active" data-toggle="tab" role="tab" aria-controls="intro">
		<i class="fa fa-info-circle"> </i>
		intro</a>
		</li>
<?php foreach($wpInstallations as $key=>$value): ?>
		<li class="nav-item">
		<a href="#<?php echo $key?>" class="nav-link" data-toggle="tab" role="tab" aria-controls="<?php echo $key?>" data-type="wp" data-status="new" wp-name="<?php echo $key?>"  wp-path="<?php echo $value?>" >
		<i class="fa fa-wordpress"> </i>
		<?php echo $key?></a>
		</li>
<?php endforeach; ?>		
	</ul>
	<div class="tab-content w-100">
		<div class="tab-pane fade show active" id="intro" role="tabpanel">
			<div class="jumbotron">
			
			<h3><i class="fa fa-wordpress"></i>  WP Updates</h3>
			<br>
			</div>
			<button class="btn btn-block btn-warning" data-name="wp-update-everything">
				<i class="fa fa-refresh"></i>
				Update All WP Installations & Plugins
			</button>
			<br>

			<div class="alert alert-success d-none" id="tbl-everything">
				updates ok.
			</div>

		</div>

<?php foreach($wpInstallations as $key=>$value): ?>
		<div class="tab-pane fade" id="<?php echo $key?>" role="tabpanel">
			<button class="btn btn-block" wp-path="<?php echo $value?>" wp-name="<?php echo $key?>" id="btn_update_list_refresh_<?php echo $key?>" ><i class="fa fa-refresh"></i></button>
			
			<div class="jumbotron">

			<h3><i class="fa fa-wordpress "></i>   <?php echo $key?> </h3>

			<table class="table table-hover text-info update-tabs">
				<tbody>
				<tr  data-toggle="tooltip" data-placement="top" title="open in finder...">
					<td class="text-right"><i class="fa fa-file"></i></td>
					<td class="text-left"><?php echo $value?></td>
				</tr>
				<tr data-toggle="tooltip" data-placement="top" title="open in PhpMyAdmin...">
					<td class="text-right"><i class="fa fa-database"></i></td>
					<td class="text-left"><span data-db="<?php echo $value?>"></span></td>
				</tr>
				</tbody>
			</table>

			<div class="row">
				<div class="col-9"></div>
				<div class="col-3">
				<button type="button" class="btn btn-block"
				data-toggle="tooltip" data-placement="top" title="edit this WP..."
				data-wp="<?php echo $key?>"
				>
					<i class="fa fa-edit"></i>
				</button>
				</div>
			</div>
				
			</div>

			<div class="bg-inverse" data-from="<?php echo $key?>"></div>
		</div>
<?php endforeach; ?>		

	</div>
</div>
	</div>
</div>