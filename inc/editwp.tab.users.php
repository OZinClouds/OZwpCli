<?php 
include "../config.php";
	$wpPath=$_POST["wpPath"];

	$result=OZbash::Terminal("wp user list --format=json --path=".$wpPath);
		if($result["exit_status"]===0){
			$result=json_decode($result["output"], true);
		} else {$result=false;}

	/*********************** check .env file for admin / if not exits then false else admin_user ***********************/
	if(!empty($_ENV["admin_user"])){
		$admin=$_ENV["admin_user"];
		$meta=OZbash::Terminal("wp user meta list ".$admin." --format=json --path=".$wpPath);
		if($meta["exit_status"]!==0){
			$admin=false;} else {
			$meta=json_decode($meta["output"], true);
			$meta=array_column($meta,"meta_value","meta_key");
			$get=OZbash::Terminal("wp user get --format=json ".$admin." --path=".$wpPath);
			$get=json_decode($get["output"],true);
			}
	} else {$admin=false;}
		/*********************** get defaults from json ***********************/
		$defaults=json_decode(file_get_contents(basedir."defaults.json"),true);
		$defaults=array_group_by($defaults["users"],"title");
		
 ?>
<div class="card">
	<div class="card-header">
		<h4><i class="fa fa-user"></i>  users</h4>


		<ul class="nav nav-tabs card-header-tabs" id="tabs-users">
			<li class="nav-item">
			<a href="#users-home" class="nav-link active" data-toggle="tab">
			<i class="fa fa-home"> </i>
			home</a>
			</li>
			<li class="nav-item">
			<a href="#users-list" class="nav-link" data-toggle="tab">
			<i class="fa fa-th-list"> </i>
			list</a>
			</li>
			<?php if($admin): ?>
			<li class="nav-item">
			<a href="#users-admin" class="nav-link" data-toggle="tab">
			<i class="fa fa-user"> </i>
			<?php echo $admin ?></a>
			</li>
			<?php endif; ?>

		</ul>
	 </div><!-- end card-header -->

<div class="card-body">
	<div class="tab-content">
			<!-- HOME -->
			<div class="tab-pane active" id="users-home">
				home
			</div>

			<!-- /*********************** list ***********************/ -->
			<div class="tab-pane" id="users-list" >
				<div class="jumbotron" style="padding: 15px;">
				<h4 class="fa fa-users">  list</h4>
				</div>
				<table class="table table-striped table-responsive"
				onmouseover="$(this).tablesorter({theme:'bootstrap'});">
					<thead>
						<tr 
						style="cursor:pointer;"
						>
							<th>ID</th>
							<th>user_login</th>
							<th>display_name</th>
							<th>user_email</th>
							<th>roles</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach($result as $r):?>
						<tr
						style="cursor:help"
						data-toggle="tooltip" data-placement="top"
						title="dblclick for user meta list"
						>
							<td><?php echo $r['ID'];?></td>
							<td><?php echo $r['user_login'];?></td>
							<td><?php echo $r['display_name'];?></td>
							<td><?php echo $r['user_email'];?></td>
							<td><?php echo $r['roles'];?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- end list -->
			
			<!-- ADMIN (as in .env file => admin_user) -->
			<?php if($admin): ?>
			<div class="tab-pane" id="users-admin" 
			data-admin="<?php echo $admin; ?>"
			data-path="<?php echo $wpPath; ?>"
			>
				<div class="jumbotron" style="padding: 15px;">
					<h4 class="fa fa-user">  <?php echo $admin ?></h4>
				</div>
				<table class="table table-responsive-lg table-striped table-bordered" 
				id="table-users-admin">
					<thead>
						<tr>
							<th>field</th>
							<th
							data-toggle="tooltip" data-placement="top"
							title="dblclick to assign default values"
							style="cursor: pointer;"
							class="align-middle text-center"
							><i class="fa fa-user"></i></th>
							<th>value</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					function theVal($field,$def=false,$dv,$dk,$meta,$get) {
						
						if(!array_key_exists($field,$dv[0])&&$field!=="value"){
							return $def;
						}

						switch($field){
						case "value":
							if($dv[0]["group"]=="get"){
								return $get[$dk];
							} elseif($dv[0]["group"]=="meta"){
								return $meta[$dk];
							} else {return false;}
						break;
						case "default":
							if($dv[0]["default"]==".env"){
								if(!empty($_ENV[$dk])){
									return $_ENV[$dk];
								} else {
									return $def;
								}
							} else {
							return $dv[0]["default"];
							}
						break;
						case "type":
							return $dv[0]["type"];
						break;
						case "options":
							if(is_array($dv[0]["options"])){
							return $dv[0]["options"];
							} else {return false;}
						break;
						}
					}					
					 ?>
						<?php foreach($defaults as $dk=>$dv): ?>
						<?php 
						

							$theVal=theVal("value",false,$dv,$dk,$meta,$get);
							$theType=theVal("type","text",$dv,$dk,$meta,$get);
							$theOptions=theVal("options",false,$dv,$dk,$meta,$get);
							$theDefault=theVal("default",false,$dv,$dk,$meta,$get);
							$tooltip_field= "<i class='fa fa-user text-danger'></i>  " . $dv[0]["desc"]."<br><span style='color:red'>".$dv[0]["comment"]."</span>";
							$tooltip_default="<i class='fa fa-user text-danger'></i>  default: <br><span style='color:red'>".$theDefault."</span>"; 
						 ?>
						<tr data-group="<?php echo $dv[0]['group'];?>">
						<!-- field -->
						<td
						data-toggle="tooltip" data-placement="right" data-html="true"
						title="<?php echo $tooltip_field;?>"
						style="cursor: help;"
						>
							<?php echo $dk;?>
								
						</td>
						
						<!-- defaults -->
						<td
						data-toggle="tooltip" data-placement="top" data-html="true"
						title="<?php echo $tooltip_default;?>"
						data-default="<?php echo $theDefault;?>"
						class="align-middle text-center"
						style="cursor: pointer;"
						>
							<?php if($theDefault): ?>
							<i class="fa fa-user"></i>
							<?php endif; ?>
						</td>
						<!-- value -->	
						<td>
			<!-- options with text -->	
			<?php if(is_array($theOptions)&&$theType=="text"):?>	
				<select class="form-control form-control-sm" 
				name="user-value-<?php echo $dk;?>"
				>
				<?php foreach($theOptions as $op):?>
				<option value="<?php echo $op;?>" 
				<?php if($op==$theVal){echo "selected";}?>>
				<?php echo $op; ?></option>
				<?php endforeach; ?>
				</select>
			<?php endif;?>

			<!-- options with boolean -->
			<?php if($theType=="boolean"):?>
				<div class="form-check form-check-inline">
				<input type="radio" name="user-value-<?php echo $dk;?>" value="true"  
				class="form-check-input"
				<?php if($theVal=="true"){echo "checked";} ?>
				><label class="form-check-label">true</label>&nbsp;&nbsp;
				<input type="radio" name="user-value-<?php echo $dk;?>" value="false"  
				class="form-check-input"
				<?php if($theVal=="false"){echo "checked";} ?>
				><label class="form-check-label">false</label>
				</div>
			<?php endif;?>

			<!-- text -->
			<?php if($theType=="text" && $theOptions==false):?>
				<div class="input-group">
				<input type="text" name="user-value-<?php echo $dk;?>" 
				class="form-control"
				value="<?php echo $theVal;?>">
				<div class="input-group-append">
				<button type="button" class="btn btn-info fa fa-save"
				name="btn-user-value-<?php echo $dk;?>"
				></button>
				</div>
				</div>
			<?php endif;?>

			<!-- textarea -->
			<?php if($theType=="textarea"):?>
				<div class="input-group">
				<textarea type="textarea" name="user-value-<?php echo $dk;?>" 
				class="form-control" cols="20"
				><?php echo $theVal;?></textarea>
				<div class="input-group-append">
				<button type="button" class="btn btn-info fa fa-save"
				name="btn-user-value-<?php echo $dk;?>"
				></button>
				</div>
				</div>

			<?php endif;?>

							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php endif; ?>
			<!-- end ADMIN -->
			

	</div><!-- end tab-content -->

	</div><!-- end d-flex -->

</div> <!-- end card-body -->
</div><!-- end card -->
