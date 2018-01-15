<?php 	ob_start();//start buffer
		$page_title='Dashboard'; include("includes/header.php");	
?>
	<?php
			if(isset($_SESSION['username'])){
				/* Start Dashboard */ 
					
												
				?>
				
					<div class="container">
						<h1> Dashborad </h1>

							<div class="row text-center"> <!-- start row --->
								<div class="col-sm-6 col-md-3">
									<div class="stat st-member">
										Total Member
										<span><a href="members.php?do=manage"><?php echo count_item("user_id","users");?></a></span>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="stat st-pending">
										Pending Member
										<span><a href="members.php?do=manage&page=pending"><?php echo pend_member('reg_status','users',0);?></a></span>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="stat st-item">
										Total Items
										<a href="items.php?do=manage"><span><?php echo count_item1("*","items");?></span></a>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="stat st-commecnt">
										Total Comments
										<span>500</span>
									</div>
								</div>
								
							</div><!--End row -->
					</div><!-- end container -->
				
				<div class="container latest-info">
							<div class="row"> <!-- start row --->
								<div class="col-sm-6"> <!-- start col -->
									<div class="panel panel-primary">
										<div class="panel-heading text-center">
											<i class="fa fa-users"></i> Latest Registerd Users
										</div>
										<div class="panel-body">
											<ul class="list-unstyled last-user">
												<?php
													
													 get_latest("*","users","user_id",5);
													   
												?>
											</ul>
										</div>
									</div>
								</div><!-- End col -->
								
								<div class="col-sm-6 col-md-6"> <!-- start col -->
									<div class="panel panel-danger">
										<div class="panel-heading text-center">
											<i class="fa fa-tag"></i> Latest Registerd Users
										</div>
										<div class="panel-body">
											Test
										</div>
									</div>
								</div><!-- End col -->
									
							
								
							</div><!--End row -->
					</div><!-- end container -->
				
			
			
			<?php
				/* end dashbord */
				include("includes/footer.php");
			}else{
				header("location:index.php");
				exit();	
			}
			ob_end_flush();
	?>
	
		
			
