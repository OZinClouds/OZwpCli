<?php 
include "../config.php";

$wpPath=$_POST["wpPath"];

$defaults=json_decode(file_get_contents(basedir."defaults.json"),true);
$defOptions=array_group_by($defaults["options"],"group");
$groups=array_keys($defOptions);

 ?>
 <div class="card">
 <div class="card-header">
 	<h4>
 		<i class="fa fa-cog"></i>   
 		options
 	</h4>

		<ul class="nav nav-tabs card-header-tabs" id="tabs-options">
			<li class="nav-item">
				<a href="#options-home" class="nav-link active" data-toggle="tab">
				<i class="fa fa-home"></i>  
				home</a>
			</li>
			<li class="nav-item">
				<a href="#options-list" class="nav-link" data-toggle="tab">
				<i class="fa fa-list-alt"></i>  
				list</a>
			</li>
			<?php foreach($groups as $grp): ?>
			<li class="nav-item">
				<a href="#options-<?php echo $grp?>" class="nav-link" data-toggle="tab">
				<i class="fa fa-th-list"></i>  
				<?php echo $grp?></a>
			</li>
			<?php endforeach; ?>
		</ul>


 </div><!-- end card-header -->
 <div class="card-body">
<div class="tab-content">

	<!-- HOME -->
	<div class="tab-pane active" id="options-home">
		<button type="button" class="btn btn-warning fa fa-repeat" id="btn-update-all-default-options">
			update options with Default Values
		</button>
		<table class="table table-responsive table-striped table-sm"
		id="table-update-all-default-options"
		>
			<thead>
				<tr>
					<th>option</th>
					<th>default value</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($defaults["options"] as $p): ?>
				<tr>
					<td><?php echo $p["title"] ?></td>
					<td><?php echo $p["default"] ?></td>
					<td class="fa fa-minus"></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<button type="button" class="btn btn-info btn-block btn-sm fa fa-edit" 
		data-location="<?php echo siteurl . 'inc/settings.php';?>"
		id="btn-goto-settings">  
		goto default value settings</button>
	</div><!-- end HOME -->

	<!-- LIST -->
	<div class="tab-pane" id="options-list">
	<?php 

	$result=OZbash::Terminal("wp option list --json --path=".$wpPath);

	$result=json_decode( $result["output"],TRUE );
	/*uasort($result, function($a, $b){
	  	return strcmp($a["option_name"], $b["option_name"]);
		});*/
	$options=[];
	foreach($result as $k){
		$options[$k["option_name"] ]=$k["option_value"]; 
	}

	 ?>
	<input type="text" id="filter-option-table" class="input-sm">
	   <i class="fa fa-cogs"></i>  
	<span>search option name</span>
	<table class="table table-striped table-sm table-responsive text-truncate" 
	id="table-options-all">
		<thead>
			<tr>
				<th>option name</th>
				<th>option value</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $r): ?>
			<tr>
				<td><?php echo $r["option_name"] ?></td>
				<td><code class="text-truncate"><?php echo $r["option_value"]  ?></code></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</div><!-- end LIST -->
	
	<!-- GROUP (e.g. basic) -->
	<?php foreach($groups as $grp): ?>
	<div class="tab-pane" id="options-<?php echo $grp?>">
		<?php 
		$thisTabsOptions=$defOptions[$grp];
		 ?>
		<table class="table table-sm table-striped" id="table-options-<?php echo $grp?>">
			<thead>
				<tr>
					<th>option</th>
					<th><a data-toggle="tooltip" data-placement="top" data-html="true" title="default values <br> dblclicl to assign..." class="fa fa-th-list"></a></th>
					<th>value</th>
					<th>update</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($thisTabsOptions as $b): ?>
				<tr>
					<td data-toggle="tooltip" data-placement="top" 
					title="<?php echo $b['desc']; ?>">
					<?php echo $b["title"]; ?>
					</td>
					<td>
					<a data-toggle="tooltip" data-placement="top" class="fa fa-th-list" 
					data-html="true" data-default="<?php echo $b['default']; ?>"
					title="<?php echo 'default:<br>'.$b['default']; ?>"></a>
					</td>
					<td>
					<?php 
					if(isset($options[$b["title"]])){
						$curVal=$options[$b["title"]];
					} else {
						$curVal="";
					}
					?>
					<input type="text" value="<?php echo $curVal; ?>"
					class="input-lg form-control"
					data-toggle="tooltip" data-placement="top"
					title="<?php echo $b['comment']; ?>"
					>
					</td>
					<td>
					<button type="button" class="btn btn-info fa fa-repeat rounded btn-sm">
					update</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endforeach; ?>
	<!-- end GROUPS -->

</div><!-- end tab-content -->
 </div><!-- end card-body -->
 </div><!-- end card -->