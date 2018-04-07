<?php 
	include '../config.php';

	$where=$_SERVER["DOCUMENT_ROOT"];
	$wpRootInstallations=OZwpcli::wpInstallations($where);
			

	if(empty($wpRootInstallations)):
		echo "<div class='alert alert-danger'>";
		echo "no WP Installations found in the root:" . "<br>" . $where ;
		echo "</div>";


	
	else:

 ?>

<div class="card ">
		<div class="card-body">
		
			<div class="card-text smaller">
				<table class="table table-striped">
				<thead>
				<tr>
				<th>WP</th> <th>path</th>
				</tr>
				</thead>
				<tbody>
		
				<?php 

				
				foreach($wpRootInstallations as $key=>$value){

				
				echo 	'<tr>';
				
				echo 	'<td>';
				echo 	'<i class="fa fa-wordpress"></i>  ';
				echo 	$key;
				echo 	'</td>';

				echo 	'<td>';
				echo 	$value;
				echo 	'</td>';


				echo 	'</tr>';

				
				}


					
	endif;

				 ?>
		</tbody>
		</table>
			</div>

		</div>
	</div>