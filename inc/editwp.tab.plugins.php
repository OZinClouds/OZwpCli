<?php 
include '../config.php';
	
	$wpPath=$_POST["wpPath"];
	$defaults=json_decode(file_get_contents(basedir."defaults.json"),true);
	$defPlugins=array_keys(array_group_by($defaults["plugins"],"title"));
	

	/*********************** list installed plugins ***********************/
	$result=OZbash::Terminal("wp plugin list --all --format=json --path=".$wpPath);
	if($result["exit_status"]===0):
		$result=json_decode($result["output"], true);
		foreach($result as &$r){
			$r["group"]="N/A";
		}
	endif;
		/*********************** push not-installed pugins ***********************/
		$diff=array_diff($defPlugins,array_column($result,"name"));
		if(!empty($diff)){
			foreach($diff as $d){
				array_push($result,array(
				"name"=>$d, 
				"status"=>"notinstalled",
				"update"=>"install",
				"version"=>"0",
				"group"=>"N/A"
				));
			}
		}

		/*********************** assign group + default (url) info to plugins ***********************/
		$grp=array_column($defaults["plugins"],"group","title");
		$url=array_column($defaults["plugins"],"default","title");
		foreach($result as &$r){
			//group info
			if(!empty( $grp[ trim( $r["name"] ) ] )){
				$r["group"] = $grp[ trim( $r["name"] ) ];
			} else { $r["group"] = "N/A"; }
			//URL = Default = (for most) name
			if(!empty( $url[ trim( $r["name"] ) ] )){
				$r["default"] = $url[ trim( $r["name"] ) ];
			} else { $r["default"] = trim( $r["name"] ); }
		}

		/*********************** sort result by group asc ***********************/
		OZphp::array_sort_by_column($result, 'group',SORT_ASC);
		
		/*********************** Tabs (list tab first)***********************/
		$grp=array_keys(array_group_by($result,"group"));
		array_walk($grp,function($k, $v) use(&$grp){
			if($grp[$v]=="list" || $grp[$v]=="N/A"){
				unset($grp[$v]);
			}
		});

		array_unshift($grp,"list");
	
 ?>

<div class="card">
<div class="card-header">
	<h4 class="fa fa-plug">  plugins</h4>
	<ul class="nav nav-tabs card-header-tabs" id="tabs-plugins">
			<li class="nav-item">
				<a href="#plugins-home" class="nav-link active" data-toggle="tab">
				<i class="fa fa-home"></i>  
				home</a>
			</li>
			<?php foreach($grp as $gr): ?>
			<li class="nav-item">
				<a href="#plugins-<?php echo $gr?>" class="nav-link" data-toggle="tab">
				<i class="fa fa-<?php echo ($gr=='list')?'th-list':'plug' ;?>"></i>  
				<?php echo $gr?></a>
			</li>
			<?php endforeach; ?>
	</ul>
</div>	<!-- end card-header -->
<div class="card-body">
<div class="tab-content">

	<!-- HOME -->
	<div class="tab-pane active" id="plugins-home">
		<div class="card">
			<div class="card-header">
				<h4 class="fa fa-plug">  default plugins</h4>
			</div>
			<div class="card-body">
				<table class="table table-responsive table-striped table-hover" 
				onmouseover="$(this).tablesorter({theme:'bootstrap'});">
					<thead>
						<tr style="cursor:pointer;">
							<th>plugin</th>
							<th>group</th>
							<th>default</th>
							<th>desc</th>
							<th>comment</th>
						</tr>
					</thead>
					<tbody style="cursor:help;">
						<?php foreach($defaults["plugins"] as $def ): ?>
						<tr>
							<td><?php echo $def["title"] ?></td>
							<td><?php echo $def["group"] ?></td>
							<td><?php echo $def["default"] ?></td>
							<td><?php echo $def["desc"] ?></td>
							<td><?php echo $def["comment"] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- end HOME -->

		
	<!-- LIST + Group Tabs -->
	<?php foreach($grp as $gr): ?>
		<?php 
			if($gr!=="list"){
				$resultx=array_values(array_filter($result,function($el) use($gr){
					return $el["group"]==$gr;
				}));
			} else {$resultx=$result;}

		 ?>
	<div class="tab-pane" id="plugins-<?php echo $gr;?>">
		<div class="jumbotron" style="padding: 5px;">
			<?php echo $gr; ?>
		</div>
		<table class="table table-striped table-responsive table-hover" 
		id="table-plugins-<?php echo $gr;?>"
		onmouseover="$(this).tablesorter({theme:'bootstrap'});"
		>
			<thead>
				<tr style="cursor:pointer;">
					<th>
						<div class="form-check">
						<input type="checkbox" 
							name="check-plugins-all-<?php echo $gr;?>">
						</div>
					</th>
					<th >
					<input type="text" class="form-control" value=""
					data-toggle="tooltip" data-placement="bottom"
					title="filter results..." name="filter-plugins"
					<?php if($gr!=="list"){echo " hidden ";}?>
					>	
					plugin</th>
					<th name="status">
					status</th>
					<th>
					group
					</th>
					<th>update</th>
					<th>delete</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
			<?php foreach($resultx as $rr):?>
				<?php $i++;   ?>
				<tr>
					<!-- checkbox -->
					<td>
					<div class="form-check">
					<?php echo $i; ?>
						<input type="checkbox" 
						class=""
						name="check-plugins"
						>
					</div>
					</td>
					<!-- PLUGIN -->
					<td 
					data-toggle="tooltip" data-placement="top"
					title="dblclick for info"
					style="cursor:help;"
					>
						<?php echo trim($rr["name"]);?>
					</td>
					<!-- STATUS -->
					<td
					data-toggle="tooltip" data-placement="top"
					title="dblclick to toggle status"
					style="cursor:help;"
					>
						<span class="
						<?php 
						switch(trim($rr["status"]))
						{ case "inactive": echo "text-warning"; break;
						  case "active": echo "text-success"; break;
						  case "notinstalled": echo "text-muted"; break;
						}
						 ?>
						">
						<?php echo trim($rr["status"]);?>
						</span>
					</td>
					<!-- GROUP -->
					<td>
						<?php echo $rr["group"]; ?>
					</td>
					<!-- UPDATE / INSTALL -->
					<td>
						<?php switch(trim($rr["update"])):
							case "available":
						?>
						<button type="button" 
						class="btn btn-warning fa fa-download rounded btn-sm"
						name="btn-plugins-update"
						data-toggle="tooltip" data-placement="top" data-html="true"
						data-plugin="<?php echo $rr['name'];?>"
						data-path="<?php echo $wpPath;?>"
						title="update: <br> <?php echo $rr['name'];?>"
						></button>
						<?php break; ?>
						<?php case "none":;?>
						<i class="fa fa-check-circle fa-2x align-middle" style="color:green;"
						data-toggle="tooltip" data-placement="top" title="up-to-date"
						></i>
						<?php break; ?>
						<?php case "install": ;?>
						<button type="button" 
						class="btn btn-warning fa fa-arrow-circle-o-down rounded btn-sm"
						name="btn-plugins-install"
						data-toggle="tooltip" data-placement="top" data-html="true"
						data-plugin="<?php echo $rr['default'];?>"
						data-path="<?php echo $wpPath;?>"
						title="install: <br> <?php echo $rr['name'];?>"
						></button><!-- default is install url or just plugin name -->
						<?php break; ?>
						<?php endswitch; ?>
					</td>
					<!-- DELETE -->
					<td>
						<?php if($rr["status"]!=="notinstalled"): ?>
						<button type="button" 
						class="btn btn-danger fa fa-trash rounded btn-sm"
						name="btn-plugins-delete"
						data-toggle="tooltip" data-placement="top" data-html="true"
						data-plugin="<?php echo $rr['name'];?>"
						data-path="<?php echo $wpPath;?>"
						title="delete: <br> <span style='color:red;'><?php echo $rr['name'];?></span>"
						></button>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot class="d-none">
				<tr>
					<td colspan="1"></td>
					<td colspan="2">
						<div class="form-group">
							<select id="select-plugins-<?php echo $gr;?>" class="form-control" >
								<option value="1">activate selected</option>
								<option value="2">de-activate selected</option>
								<option value="3">install selected</option>
								<option value="4">update selected</option>
								<option value="5">delete selected</option>

							</select>
						</div>
					</td>
					<td colspan="3">
						<button type="button" 
						class="btn btn-warning btn-block fa fa-refresh"
						id="btn-select-plugins-<?php echo $gr;?>"
						data-path="<?php echo $wpPath;?>"
						>
						do
						</button>
					</td>
				</tr>
			</tfoot>
		</table>

	</div><?php endforeach; ?><!-- tab-list-foreach $gr -->
</div><!-- end tab-content -->
</div><!-- end card-body -->
</div><!-- end card -->