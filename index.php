<?php $page_title='login'; include("includes/header.php"); ?>
		
		<?php
				
			if(isset($_SESSION['username'])){
				
				header("location:dashboard.php");
			}
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$username = trim($_POST['username']);
				$password = trim($_POST['password']);
				$hash_password = sha1($password);
				$query ="select * from users where username = '{$username}' and password = '{$hash_password}' limit 1";
				$result=mysql_query($query,$connection);
				confirm_query($result);
				if(mysql_num_rows($result)==1)
				{
					$found_user = mysql_fetch_array($result);
					 $_SESSION['username'] = $found_user['username'] ; // Make Session username
					 $_SESSION['user_id'] = $found_user['user_id'] ; // Make Session id
					 header("location:dashboard.php");
					 exit(); // Don't forget it
				}else{
					echo "Please Make an Account to login". mysql_error();
				}
			}
		?>

		<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"><!-- Create login form -->
			<h2> Admin Login </h2>
				<div> 
				<div class="form-group">
				<input type="text" class="form-control input-lg" name="username" placeholder="username" autocomplete="off">
				</div>
				<div class="form-group">
				<input type="password" class="form-control input-lg"  name="password" placeholder="Password" autocomplete="off">
				</div>
				<button type="submit" class="btn btn-primary btn-lg">Login</button>
		</form><!-- end form ----->
		
		
		
<?php include("includes/footer.php");?>