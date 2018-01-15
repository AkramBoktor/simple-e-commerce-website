<?php include("includes/header.php"); ?>
		<?php
				/* catogories */
				$do='';
				if(isset($_GET['do'])){ /* to know the value of do */
					
					$do = $_GET['do'];
					
				}else{
					
					$do = 'manage';
				}
				if($do=="manage"){
					echo "welcome to manage page";
				}elseif($do=="add"){
					echo "welcome to add";
				}else{/* if do not equal manage or add or '' */
					echo "No values here ";
				}				
		?>
	
		
			
<?php include("includes/footer.php");?>