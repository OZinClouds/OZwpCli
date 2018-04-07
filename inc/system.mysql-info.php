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
			
			echo " client_info: " . $conn->connection->client_info . "\n ";
			echo "<br> \n";
			echo " server_info: " . $conn->connection->server_info . "\n ";
			echo "<br> \n";
			echo " host_info: " . $conn->connection->host_info . "\n ";
			


		?>
	</div>

<?php endif; $conn->disconnect();?>
			
		</div>
	</div>