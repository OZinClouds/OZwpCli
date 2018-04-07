<?php 
include "../config.php";
$conn = new OZmysql;

 ?>



<div class="card ">
		<div class="card-body ">
<?php if($conn->connState==false): ?>

 <div class="alert alert-danger">
 	Please Check MySQL connection info in your <strong>.env</strong> file..
 	<br><br>
 	<i><?php echo $conn->connection; ?></i>
 </div>
<?php else: ?>
	<div class="card-text smaller strong-txt-before-semicolon">
		<?php 
			$dbALL=$conn->ListDatabaseArray();
			if(isset($dbALL)){

			echo '<ul class="list-group">';
			foreach($dbALL as $k){
				echo '<li class="list-group-item">' ;  
				echo '<i class="fa fa-database"></i>  ';
				echo  $k . '</li>';
			}
			echo '</ul>';

			} else {

			echo 	'<div class="alert alert-danger">no database found in MySQL!<div>';

			}

			


		?>
	</div>

<?php endif; $conn->disconnect();?>
			
		</div>
	</div>