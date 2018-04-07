<?php 
include '../config.php';

	OZtheme::$paletName="red-gray";
	OZtheme::enquee("js",siteurl . "dist/defaults.bundle.js");
	OZtheme::top();

 ?>

<div class="jumbotron" style="padding: 15px;">
	<h3><i class="fa fa-bookmark"></i>  defaults</h3>
	<br>
</div>



<?php 

$defaults=json_decode(file_get_contents(basedir."defaults.json"),true);

	$conf=array_keys($defaults); //setting keys like options/config etc...

foreach($conf as $k):

?>

<div class="card">
	<div class="card-header">
		<h4 class="fa fa-bookmark">  <?php echo $k?></h4>
	</div>
	<div class="card-body">
<?php
$groups=array_group_by($defaults[$k],"group");
	$grp=array_keys($groups);
foreach ($grp as $g): 
 ?>
 		<div class="card border-warning">
 		<div class="card-header fa fa-sliders">  <?php echo $g;?></div>
 			<div class="card-body">
			<table class="table table-striped table-sm" name="table-defaults">
				<thead>
					<tr>
						<th>title</th>
						<th data-toggle="tooltip" data-placement="left"
						title="double click default value to edit...">
						default</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($groups[$g] as $t): ?>
					<tr data-config="<?php echo $k;?>"
						style="cursor: pointer;"
						>
						<td data-toggle="tooltip" data-placement="top" 
						title="<?php echo $t["desc"] ?>">
							<?php echo $t["title"];?>
								
						</td>
						<td data-toggle="tooltip" data-placement="top" 
						title="<?php echo $t["comment"] ?>">
							<?php echo $t["default"];?>
								
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
		</div>
			<br>

<?php endforeach; ?>
	</div><!-- card-body -->

</div>
<br>

<?php endforeach; ?>










 <?php  OZtheme::bottom(); ?>