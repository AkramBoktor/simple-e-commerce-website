<?php include("includes/header.php"); ?>
		
		<?php
			// to destroy the data 
			session_start();
			session_unset();
			$_SESSION=array();
			session_destroy();
			header("location:index.php");
			exit();
		?>

	
		
<?php include("includes/footer.php");?>