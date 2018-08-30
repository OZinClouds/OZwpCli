<?php 
	include "./config.php" ;

	OZtheme::$paletName="red-gray";
	OZtheme::top() 
?>



	

<div class="jumbotron">
	<h1>OZwpCli</h1>
	<h3>Wordpress Cli Development Environment</h3>
</div>


<br>
<div class="row">
	<div class="col-12">
<div class="card">
  <div class="card-header text-center text-danger">README.md</div>
  <div class="card-body">
	  	<?php 
	  		/*********************** Parsedown ***********************/
	  		echo Parsedown::instance()
  				 ->setBreaksEnabled(true) # enables automatic line breaks
  				->text(file_get_contents(basedir."README.md"));
	  	 ?>
  </div> 
  <div class="card-footer smaller">parsedown</div>
</div>
	</div>
</div>



<?php OZtheme::bottom() ?>