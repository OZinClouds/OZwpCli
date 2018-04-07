	<div class="card ">
		<div class="card-body ">
		
			<div class="card-text smaller strong-txt-before-semicolon">
				<?php 
				include "../config.php";
				echo nl2br(
					OZbash::Terminal("wp --info")["output"]
					); 
				?>
			</div>
			
		</div>
	</div>