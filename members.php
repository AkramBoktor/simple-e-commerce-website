<?php $page_title='members'; include("includes/header.php"); ?>
	<?php
	if(isset($_SESSION['username'])){
		
			if(isset($_GET['do'])){ /* to know the value of do */
				
				$do = $_GET['do'];
				
			}else{
				
				$do = 'manage';
			}
					if($do=="manage"){ 
					// Manage page
					//select all the users from user except the admin
						
						if(isset($_GET['page']) && $_GET['page']=='pending'){ //to make query for members wait active
							$stat="and reg_status=0";
						}
						$query = "select * from users where group_id !=1 $stat";
						confirm_query($query);
						$result = mysql_query($query,$connection);
					?>
							<div class="container">
							
								<h1 class="text-center">Manage Members</h1>
									
						<!-- Responsive table with all of the options applied -->
								<div class="table-responsive">
									<table class="table table-condensed table-hover table-bordered table-striped text-center">
									<tr class="active">
										<td>User_id</td>
										<td>Username</td>
										<td>Email</td>
										<td>Fullname</td>
										<td>Registerd Date</td>
										<td>Control</td>
						
									</tr>
										<?php
											// to get variables from table users 
											while($found_user = mysql_fetch_array($result)){
												echo '<tr class="info">';
													echo "<td>".$found_user['user_id']."</td>";
													echo "<td>".$found_user['username']."</td>";
													echo "<td>".$found_user['email']."</td>";
													echo "<td>".$found_user['fullname']."</td>";
													echo "<td>".$found_user['Date']."</td>";
													echo "<td><a href='members.php?do=edit&user_id={$found_user['user_id']}'
													class='btn btn-primary'><i class='fa fa-edit'></i> Edit </a>
											                  <a href='members.php?do=delete&user_id={$found_user['user_id']}'
													class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>&nbsp;"; 
														if($found_user['reg_status']==0)// if member not activated
														{
															echo "<a href='members.php?do=active&user_id={$found_user['user_id']}'
															class='btn btn-success active'><i class='fa fa-tag'></i> Active </a>";
														}
														 echo"</td>";
												echo "</tr>";
											}

										?>
									
											
									
									</table>
								</div><!-- end table responsive -->
								
								<a href="members.php?do=add" class="btn btn-info newmember"><i class="fa fa-plus"></i>Add New Members</a>
								
							</div>	<!-- end div container -->

					<?php 
					
			}/*end manage page */elseif($do=="add"){?>
						
						 
								<!-- Add New Member --->
								<h1 class="members"> Add New Member </h1>

									<form class="form-horizontal form-group-lg" action="?do=insert" method="post">
												<div class="form-group">
												<label class="col-sm-3 control-label">username</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" name="username" required="required" >
												   </div>
												</div>
												<div class="form-group">
												<label class="col-sm-3 control-label">password</label>
													<div class="col-sm-6">
														<input type="password" class="password form-control" name="password" required="required"
														autocomplete="new-password"  >
														<i class="show-pass fa fa-eye fa-2x"></i>
												   </div>
												</div>
												<div class="form-group">
												<label class="col-sm-3 control-label">Email</label>
													<div class="col-sm-6">
														<input type="email" class="form-control" name="email" required="required">
														 
												   </div>
												</div><div class="form-group">
												<label class="col-sm-3 control-label">fullname</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" name="fullname"  required="required">
														
												   </div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-3 col-sm-6">
												<button type="submit" value="save" class="btn btn-success btn-lg">Add New Member</button>
												   </div>
												</div>

							      </form>
							<?php
					}//end of do = add
					elseif($do=="insert"){
						// insert data into users
						if($_SERVER['REQUEST_METHOD']=='POST')
						{	
							$user=trim($_POST['username']);
							$password=trim($_POST['password']);
							$email=trim($_POST['email']);
							$fullname=trim($_POST['fullname']);
							$hash_pass=sha1($password);
							$formerror=array();
							if(empty($user)||empty($password)||empty($email)||empty($fullname))
							{
								$formerror[] = '<div class="alert alert-danger"> please fill the field </div>';
							}
							
							if(empty($formerror)){
								$query ="insert into users (username,password,email,fullname,reg_status,Date) 
								        values('{$user}','{$hash_pass}','{$email}','{$fullname}',1,now())";
								confirm_query($query);
								if(mysql_query($query,$connection))
								{
									echo '<div class="alert alert-success"> The member added </div>';
									header("location:members.php");
								}else{
									echo " Can't add member ".mysql_error();
								}
							}else{
								foreach($formerror as $errors)
									{
										echo $errors .'</br>';
									}
							}
							
						}/*end if of insert*/
						else{
							echo "can't Access directly";
						}
					}
					elseif($do=="edit"){ 
						
							// to retrive users data from database 
							if(isset($_GET['user_id'])&& is_numeric($_GET['user_id'])){
								$user_id = $_GET['user_id'];
								$query = "select * from users where user_id = {$user_id} limit 1" ;
								confirm_query($query);
								$result = mysql_query($query,$connection);
								$found_user = mysql_fetch_array($result);
								
							
						?>
							<h1 class="members"> Edit Member </h1>

							<form class="form-horizontal form-group-lg" action="?do=update" method="post">
								<input type="hidden" name="user_id" 
								value="<?php echo $user_id  //to update data by user_id and send it hidden?>" /> 
										<div class="form-group">
										<label class="col-sm-3 control-label">username</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" name="username" required="required"
							                 value ="<?php echo $found_user['username'];?>"autocomplete="off" >
										   </div>
										</div>
										<div class="form-group">
										<label class="col-sm-3 control-label">password</label>
											<div class="col-sm-6">
												<input type="hidden" class="form-control" name="old_password" autocomplete="new-password" value="<?php echo $found_user['password']; // to get old password if no one type new password?>" >
												<input type="password" class="form-control" name="new_password" required="required"
												autocomplete="new-password"  >
										   </div>
										</div>
										<div class="form-group">
										<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-6">
												<input type="email" class="form-control" name="email" required="required"
												 value ="<?php echo $found_user['email'];?>">
										   </div>
										</div><div class="form-group">
										<label class="col-sm-3 control-label">fullname</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" name="fullname"  required="required"
												 value ="<?php echo $found_user['fullname'];?>">
										   </div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-6">
										<button type="submit" value="save" class="btn btn-success btn-lg">save</button>
										   </div>
										</div>

							</form>
							<?php }else { echo "There isn't such this user ".mysql_error();} // end if belong to retrive users data from database?>
					
				<?php
				} // end else if $do==edit
	     elseif($do=='update'){ 
					
						
							echo "<h1 class='members'> Update Member </h1>";
							 if($_SERVER['REQUEST_METHOD']=='POST')
							 {
								$id = $_POST['user_id'];
								$username = $_POST['username'];
								$email = $_POST['email'];
								$fullname = $_POST['fullname'];
								// check to know take old password or new password
								if(empty($_POST['new_password'])){
									$password = $_POST['new_password'];
								}else{
									$password = sha1($_POST['new_password']);
								}
								//check the validation of the form 
									$formerrors = array(); // array errors
									if(empty($username)||empty($email)||empty($fullname)){
										$formerrors[] = '<div class="alert alert-danger"> Please complete the required field </div>';
									}
									if(strlen($username)<4|| strlen($username)>20)
									{
											$formerrors[] = '<div class="alert alert-danger"> Username must be less than 20 and more than 4 </div>';

									}
									
									
									if(empty($formerrors)) // there aren't no error 
									{
							
									// update the users table
										$query =" update users set 
										username = '$username',
										email = '$email',
										fullname = '$fullname',
										password = '$password'
										where user_id = $id ";
										confirm_query($query);
										$result=mysql_query($query,$connection);
										if(mysql_affected_rows()==1)
										{
											echo " <div class='alert alert-success'> Data is successful update</div> " ;
										}else{
											echo " <div class='alert alert-danger'>can't update data</div> ".mysql_error();
										}
								}else{
									foreach($formerrors as $errors)
									{
										echo $errors .'</br>';
									}
								}
									
							  
			 }/* end if form come from the same page*/
			 else{echo "can't Access the page " ;}
		 }// end if do == update
		 elseif($do=="delete"){
			 // delete mebers
			 if(isset($_GET['user_id'])){
				 $id = $_GET['user_id'];
			    $query = "delete from users where user_id ={$_GET['user_id']}";
				 confirm_query($query);
				 $result = mysql_query($query,$connection);
				 if(mysql_affected_rows()==1){
					 header("location:members.php?do=manage");
				 }else{
					  header("location:members.php?do=manage");
				 }
				 
			 }else{ header("location:members.php?do=manage");}
		 }//end if do == delete
		 elseif($do=="active")// start of active
		 {
			if(isset($_GET['user_id'])){
				 $id = $_GET['user_id'];
			    $query = "update users set 	reg_status=1 where user_id ={$_GET['user_id']}";
				 confirm_query($query);
				 $result = mysql_query($query,$connection);
				 if(mysql_affected_rows()==1){
					 header("location:members.php?do=manage");
				 }else{
					  header("location:members.php?do=manage");
				 } 
		 }
		 }//end of do == active
			include("includes/footer.php");}//end of isset$_Session['id']
			else{
				header("location:index.php");
				exit();	
			}			
?>
