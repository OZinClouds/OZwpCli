<body class="fixed-nav  sticky-footer palet-<?php echo $palet_name?>" id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg fixed-top palet-<?php echo $palet_name?>" id="mainNav">
		
		<a class="navbar-brand" href="<?php echo siteurl;?>">OZwpCli</a>
		
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="fa fa-wordpress"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive" >
			<ul class="navbar-nav navbar-sidenav" id="menu">
				
			<?php 
				$settingsFile = basedir . "settings.json";
				if (file_exists($settingsFile)){
					$settingsJson = json_decode(file_get_contents($settingsFile), true);	
				}

				foreach($settingsJson["menu"] as $m):
			 ?>
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="<?php echo $m['title']?>">
					<a class="nav-link" href="<?php echo siteurl.$m['data']['url'];?>">
						<div>
						<i class="<?php echo $m['icon']?> larger"></i>
						<span class="nav-link-text"><?php echo $m['title']?></span>
						</div>
					</a>
				</li>
			<?php  
				endforeach;
			?>

			</ul>
			<ul class="navbar-nav sidenav-toggler ">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
						<i class="fa fa-fw fa-angle-left"></i>
					</a>
				</li>
			</ul>
			<!-- top right -->

			<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<div class="container text-right">
					<span class="smaller ">
						<i class="fa fa-wordpress"></i>
						Wordpress Development</span>
					</div>
			</li>
			</ul>
		</div>
	</nav>

	<!-- closed in footer -->
	<div class="content-wrapper">
	<div class="container-fluid">