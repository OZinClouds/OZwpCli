<?php 
	include '../config.php';
	OZtheme::$paletName="yellow-gray";
	OZtheme::enquee("js",siteurl . "dist/newwp.bundle.js");
	OZtheme::top();

	$conn = new OZmysql;



 ?>

<div class="jumbotron">
	<h4><i class="fa fa-wordpress"></i>  new WP</h4>

</div>



<div class="card-deck ">
	<!-- Card: Database Connection -->
	<div class="card">
		<div class="card-header">
			Step 1: DB connection
		</div>
		<div class="card-body">
			<i class="fa fa-database card-body-icon"></i>
			<?php if($conn->connState): ?>
			<div class="alert alert-success">DB connection ok!</div>
			<?php else: ?>
			<div class="alert alert-danger">Erorr! DB connection cannot be established</div>
			<?php endif; ?>
		</div>
	<div class="card-footer smaller"><i class="fa fa-info ">:</i>  connection parameters from <strong>.env</strong> file</div>
	</div>

	<!-- Card: Roort Directory -->
	<div class="card">
		<div class="card-header">
			Step 2: WP Root Directory
		</div>
		<div class="card-body">
			<i class="fa fa-file card-body-icon "></i>
			<div class="alert alert-success"><?php echo rootdir; ?></div>
		</div>
	<div class="card-footer smaller"><i class="fa fa-info">:</i>  default root is localhost root dir</div>
	</div>


</div>
<br>
<div class="card-deck">	
	<!-- Card:  -->
	<div class="card">
		<div class="card-header">
			Step 3: User info 
		</div>
		<div class="card-body">
			<i class="card-body-icon fa fa-user"></i>
<form id="frm_user">
<div class="form-group">
	<label for="user" class="form-control-label">admin user: </label>
	<input type="text" name="user" id="user"  
	placeholder="user" class="form-control" 
	value="<?php echo $_ENV['admin_user'] ?>" 
	minlength=3>
	<br>
	<label for="email" class="form-control-label">admin mail: </label>
	<input type="email" name="email" id="email"  
	placeholder="e-mail" class="form-control" 
	value="<?php echo $_ENV['admin_mail'] ?>" >
	<br>
	<label for="pass" class="form-control-label">admin psw: </label>
	<input type="text" name="pass" id="pass"
	placeholder="pass" class="form-control" 
	value="<?php echo $_ENV['admin_password'] ?>"
	minlength=2>
</div>
</form>

		</div>
	<div class="card-footer smaller"><i class="fa fa-info">:</i>  User info from <strong>.env</strong> file</div>
	</div>

	<!-- Card: WP & DB Name -->
	<div class="card">
		<div class="card-header">
			Step 4: WP & DB Name
		</div>
		<div class="card-body">
			<i class="card-body-icon fa fa-file-o"></i>
<form id="frm_validate">
<div class="form-group">
		<label class="form-control" for="input-validate"> WP & DB Name:
	<input type="text"  value="" class="form-control" id="input_validate" placeholder="Name" name="name" minlength="2" type="text" required>
		</label>
		<button type="button" class="btn btn-outline-info form-control" id="btn_validate">create new WP</button>
</div>
</form>
		</div>
	<div class="card-footer smaller"><i class="fa fa-info">:</i>  WP and DB names have to be same...</div>
	</div>

</div>





 <?php 
OZtheme::bottom();
  ?>