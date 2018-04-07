<?php 
include "../config.php";
	$wpPath=$_POST["wpPath"];
function wpConfig($conf){
	$wpPath=$_POST["wpPath"];

	$result=OZbash::Terminal("wp config get ".$conf." --path=".$wpPath);
	
	if($result["exit_status"]!==0){
		return false;
	} else {
		return trim($result["output"]);
	}

}

 ?>
<div class="card">
	<div class="card-header">
		<h4><i class="fa fa-sliders"></i>  config</h4>


		<ul class="nav nav-tabs card-header-tabs" id="tabs-config">
			<li class="nav-item">
			<a href="#config-home" class="nav-link active" data-toggle="tab" data-edit="config">
			<i class="fa fa-home"> </i>
			home</a>
			</li>
			<li class="nav-item">
			<a href="#config-lang" class="nav-link" data-toggle="tab" data-edit="config">
			<i class="fa fa-comment"> </i>
			lang</a>
			</li>
			<li class="nav-item">
			<a href="#config-debug" class="nav-link " data-toggle="tab" data-edit="config">
			<i class="fa fa-bug"> </i>
			debug</a>
			</li>
		</ul>
	 </div><!-- end card-header -->

<div class="card-body">
	<div class="tab-content">
			<!-- HOME -->
			<div class="tab-pane active" id="config-home">
				home
			</div>

			<!-- /*********************** LANG ***********************/ -->
			<div class="tab-pane" id="config-lang" >
				<div class="jumbotron" style="padding: 15px;">
				<h4 class="fa fa-comment">  lang</h4>
				</div>
				<div>
				<select id="lang-select" class="custom-select w-50">
				<?php 
				$lang=wpConfig("WP_LANG");
				if($lang==false){
					$lang="en_EN";
				} 
				$langs=array("en_EN", "tr_TR","de_DE");
				foreach($langs as $k){
					echo '<option value="'. $k . '"';
					if($k===$lang){echo "selected";} else {echo "laan";}
					echo ' >';
					echo $k;
					 echo '</option>';
				}
				 ?>
				</select>
				</div>
			</div>
			
			<!-- /*********************** DEBUG ***********************/ -->
			<div class="tab-pane fade " id="config-debug" >
				<button type="button" class="btn btn-info btn-block "
				id="btn-get-debug-values" data-path="<?php echo $wpPath?>">
				<i class="fa fa-bug"></i>  
				get debug values
				</button>
				<!-- buttons -->
				<div class="row invisible" id="row-set-debug">
					<div class="col-4">
						<button type="button" class="btn btn-info btn-block"
						id="btn-set-debug" data-path="<?php echo $wpPath?>">
						<i class="fa fa-plus-circle"></i> 
						set debug values
						</button>
					</div>

					<div class="col-4">
						<button type="button" class="btn btn-warning btn-block"
						id="btn-unset-debug" data-path="<?php echo $wpPath?>">
						<i class="fa fa-minus-circle"></i> 
						unset debug values
						</button>
					</div>

					<div class="col-4">
						<button type="button" class="btn btn-danger btn-block"
						id="btn-del-debug" data-path="<?php echo $wpPath?>">
						<i class="fa fa-times-circle"></i> 
						delete debug values
						</button>
					</div>
					<div class="col-1"></div>
				</div>
				<table class="table table-striped table-sm invisible" id="table-debug">
					<thead>
						<tr>
							<th>config</th> 
							<th></th>
							<th>true</th>
							<th>false</th>
							<th>del</th>
						</tr>
					</thead>
					<tbody>
						
					<tr><td>WP_DEBUG</td>
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="WP_DEBUG" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="WP_DEBUG" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>WP_DEBUG_DISPLAY</td>
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="WP_DEBUG_DISPLAY" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="WP_DEBUG_DISPLAY" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>SCRIPT_DEBUG</td>
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="SCRIPT_DEBUG" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="SCRIPT_DEBUG" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>WP_CACHE</td>
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="WP_CACHE" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="WP_CACHE" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>SAVEQUERIES</td> 
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="SAVEQUERIES" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="SAVEQUERIES" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>WP_DEBUG_LOG</td> 
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="WP_DEBUG_LOG" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="WP_DEBUG_LOG" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
					<tr><td>CONCATENATE_SCRIPTS</td>
						<td><i class="fa fa-bug"></i></td>
						<td>
							<input type="radio" name="CONCATENATE_SCRIPTS" value="true" data-config="debug">true
						</td>
						<td>
							<input type="radio" name="CONCATENATE_SCRIPTS" value="false" data-config="debug">false
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-sm rounded"
							name="btn-del-debug-single" 
							data-path="<?php echo $wpPath?>">
							<i class="fa fa-times-circle"></i>
							</button>
						</td>
					</tr>
						</tr>
					</tbody>
				</table>
			</div><!-- end debug -->

	</div><!-- end tab-content -->

	</div><!-- end d-flex -->

</div> <!-- end card-body -->
</div><!-- end card -->
