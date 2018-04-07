<?php 
include '../config.php';
	
	OZtheme::$paletName="red-gray";
	OZtheme::enquee("js",siteurl . "dist/tmp.bundle.js");
	OZtheme::enquee("css",siteurl . "dist/tmp.bundle.css");

	OZtheme::top();

	$folder=basedir."tmp";
	$files=preg_grep("/^[^\.]\w+/i",scandir($folder,1));
	$dbBackups=preg_grep("/(_DBbackup.sql)$/i",$files);
	$otherFiles=array_diff( $files,$dbBackups);
 ?>


<div class="jumbotron" style="padding: 15px;">
	<h4 class="fa fa-briefcase">  tmp</h4>
	<h5 class="smaller">temporary folder</h5>
</div>

<?php if(!empty($dbBackups)):?>
<div class="card">
	<div class="card-header"><h4 class="fa fa-database"> DB Backups</h4></div>
<div class="card-body">
<table class="table table-striped table-hover table-info table-responsive-lg"
id="table-dbBackups" onmouseover="$(this).tablesorter({theme:'bootstrap'});" 
>
	<thead>
		<tr>
			<th>#</th>
			<th>file</th>
			<th>wp</th>
			<th>time</th>
			<th>del</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=0;foreach($dbBackups as $db): $i++; ?>
			<?php 
				$wp=explode("_",$db)[0];
				$time=str_replace("_DBbackup.sql","",str_replace($wp."_","",$db));

			 ?>
		<tr
		data-wp="<?php echo $wp ?>"
		data-file="<?php echo $folder."/".$db ?>"
		data-siteurl="<?php echo siteurl ?>"
		>
			<td><?php echo $i; ?></td>
			<td
			data-toggle="tooltip" data-placement="top"
			title="dblclick to reveal in finder..."
			style="cursor: pointer;"
			>
			<i class="fa fa-file-o"></i>  <?php echo $db ?>
			</td>

			<td
			data-toggle="tooltip" data-placement="top"
			title="dblclick to edit WP..."
			class="text-left"
			style="font-weight: 600;cursor:pointer;"
			><i class="fa fa-wordpress"></i>  <?php echo $wp; ?></td>

			<td><?php echo $time; ?></td>

			<td>
			<button type="button" class="btn btn-danger fa fa-trash btn-sm rounded"
			name="btn-del-dbBackup"
			></button>
			</td>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
</div><!-- end card - DBbackups -->

<?php endif; ?>

<!-- OTHER FILES -->
<?php if(!empty($otherFiles)):?>
<div class="card">
	<div class="card-header"><h4 class="fa fa-file-o"> Other Files</h4></div>
<div class="card-body">
<table class="table table-striped table-hover table-primary table-responsive-lg"
id="table-otherfiles" onmouseover="$(this).tablesorter({theme:'bootstrap'});" 
>
	<thead>
		<tr>
			<th>#</th>
			<th>file</th>
			<th>modified time</th>
			<th>del</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=0;foreach($otherFiles as $of): $i++; ?>
			<?php 
				$time=date("Y_m_d-H_i_s",filemtime($folder."/".$of));

			 ?>
		<tr
		data-file="<?php echo $folder."/".$of ?>"
		data-siteurl="<?php echo siteurl ?>"
		>
			<td><?php echo $i; ?></td>
			<td>
			<i class="fa fa-file-o"></i>  <?php echo $of ?>
			</td>

			<td><?php echo $time; ?></td>

			<td>
			<button type="button" class="btn btn-danger fa fa-trash btn-sm rounded"
			name="btn-del-otherfiles"
			></button>
			</td>

		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
</div><!-- end card - other files -->

<?php endif; ?>


  <?php  OZtheme::bottom(); ?>