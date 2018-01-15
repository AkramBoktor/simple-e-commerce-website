<?php $page_title='items'; include("includes/header.php"); ?>
	<?php
	if(isset($_SESSION['username'])){
		if(isset($_GET['do'])){
			$do = $_GET['do'];
		}else{
			$do = 'manage';
		}
		if($do == "manage"){ // do ==manage*/
				// Manage page
					//select all the users from user except the admin
						
						
						$query = "SELECT items.* ,
           						categories.catname as categories_name , 
								users.username as usersname 
					           	from items
                                  inner join categories on categories.cat_id = items.cat_id
                                  inner join users on users.user_id = items.user_id";
						confirm_query($query);
						$result = mysql_query($query,$connection);
					?>
							<div class="container">
							
								<h1 class="text-center">Manage Items</h1>
									
						<!-- Responsive table with all of the options applied -->
								<div class="table-responsive">
									<table class="table table-condensed table-hover table-bordered table-striped text-center">
									<tr class="active">
										<td>Item_id</td>
										<td>Name</td>
										<td>Description</td>
										<td>Price</td>
										<td>Adding Date</td>
										<td>Category</td>
										<td>Username</td>
										<td>Control</td>
						
									</tr>
										<?php
											// to get variables from table users 
											while($found_item = mysql_fetch_array($result)){
												echo '<tr class="info">';
													echo "<td>".$found_item['item_id']."</td>";
													echo "<td>".$found_item['name']."</td>";
													echo "<td>".$found_item['description']."</td>";
													echo "<td>".$found_item['price']."</td>";
													echo "<td>".$found_item['add_date']."</td>";
													echo "<td>".$found_item['categories_name']."</td>";
													echo "<td>".$found_item['usersname']."</td>";
													echo "<td><a href='items.php?do=edit&item_id={$found_item['item_id']}'
													class='btn btn-primary'><i class='fa fa-edit'></i> Edit </a>
											                  <a href='items.php?do=delete&item_id={$found_item['item_id']}'
													class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>&nbsp;"; 
														
														 echo"</td>";
												echo "</tr>";
											}

										?>
									
											
									
									</table>
								</div><!-- end table responsive -->
								
								<a href="items.php?do=add" class="btn btn-info newmember"><i class="fa fa-plus"></i>Add New Items</a>
								
							</div>	<!-- end div container -->

					<?php 
					
			}/*end manage page */
			elseif($do=="add"){?>
				<h1 class="members"> Add New Items </h1>

						<form class="form-horizontal form-group-lg" action="items.php?do=insert" method="post">
									<div class="form-group">
									<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="name" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="description" required="required" >
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Price</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="price" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Country</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="country" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Status</label>
										<div class="col-sm-6">
											<select name="status">
												<option vlaue="0"> ... </option>
												<option vlaue="1"> New </option>
												<option vlaue="2"> Like New </option>
												<option vlaue="3"> Used </option>
											</select>
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Member</label>
										<div class="col-sm-6">
											<select name="member">
												<option value="0">...</option>
												<?php
													$query="select * from users ";
													confirm_query($query);
													$result=mysql_query($query,$connection);
													while($found_user = mysql_fetch_array($result))
													{
                                                      echo"<option value={$found_user['user_id']}>{$found_user['username']}</option>";

													}
												?>
											</select>
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Category</label>
										<div class="col-sm-6">
											<select name="category">
												<option value="0">...</option>
												<?php
													$query="select * from categories ";
													confirm_query($query);
													$result=mysql_query($query,$connection);
													while($found_user = mysql_fetch_array($result))
													{
                                                      echo"<option value={$found_user['cat_id']}>{$found_user['catname']}</option>";

													}
												?>
											</select>
									   </div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
									<button type="submit" value="save" class="btn btn-success btn-md">
									<i class="fa fa-plus"> Add New Items</i></button>
									   </div>
									</div>

					  </form>
			<?php
				
			}/* end code of do == add */
			elseif($do=="insert"){
						// insert data into users
						if($_SERVER['REQUEST_METHOD']=='POST')
						{	
							$item_name=trim($_POST['name']);
							$description=trim($_POST['description']);
							$price=trim($_POST['price']);
							$country_made=trim($_POST['country']);
							$status=trim($_POST['status']);
							$member=trim($_POST['member']);
							$category=trim($_POST['category']);
							$formerror = array();
							if(empty($item_name)||empty($description)||empty($price)||empty($country_made))
							{
								$formerror[] = '<div class="alert alert-danger"> please fill the field </div>';
							}
							
							if(empty($formerror)){
								$query ="insert into items (name,description,price,country_made,status,user_id,cat_id) 
								        values('{$item_name}','{$description}','{$price}','{$country_made}',
										'{$status}','{$member}','{$category}')";
								confirm_query($query);
								if(mysql_query($query,$connection))
								{
									echo '<div class="alert alert-success"> The items added </div>';
									header("location:items.php");
								}else{
									echo " Can't add items ".mysql_error();
								}
							}else{
								foreach($formerror as $errors)
									{
										echo $errors .'</br>';
									}
							}
							
						}
						else{
							echo "can't Access directly";
						}
					}/*end if of insert*/
					elseif($do=="edit")
					{
						
							// to retrive users data from database 
							if(isset($_GET['item_id'])&& is_numeric($_GET['item_id'])){
								$item_id = $_GET['item_id'];
								$query = "select * from items where item_id = {$item_id} limit 1" ;
								confirm_query($query);
								$result = mysql_query($query,$connection);
								$found_item = mysql_fetch_array($result);
								
							
						?>
							<h1 class="members"> Edit Items </h1>

						<form class="form-horizontal form-group-lg" action="items.php?do=update" method="post">
									<div class="form-group">
									<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="name" 
											value="<?php echo $found_item['name']?>" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="description" 
											value="<?php echo $found_item['description']?>" required="required" >
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Price</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="price" 
											value="<?php echo $found_item['price']?>" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Country</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="country"
                                            value="<?php echo $found_item['country_made']?>" required="required" >
									   </div>
									</div>
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Status</label>
										<div class="col-sm-6">
											<select name="status">
											<?php
													
											?>
											</select>
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Member</label>
										<div class="col-sm-6">
											<select name="member">
												<?php
													$query="select * from users ";
													confirm_query($query);
													$result=mysql_query($query,$connection);
													while($found_user = mysql_fetch_array($result))
													{
                                                      echo"<option value={$found_user['user_id']} ";
													  if($found_item['user_id']==$found_user['user_id'])
													  {echo 'selected';}
													  echo ">{$found_user['username']}</option>";

													}
												?>
											</select>
									   </div>
									</div>	
									
									<div class="form-group">
									<label class="col-sm-3 control-label">Category</label>
										<div class="col-sm-6">
											<select name="category">												
												<?php
													$query="select * from categories ";
													confirm_query($query);
													$result=mysql_query($query,$connection);
													while($found_cat = mysql_fetch_array($result))
													{
                                                      echo"<option value={$found_cat['cat_id']} ";
													  if($found_item['cat_id']==$found_cat['cat_id'])
													  {echo 'selected';}
													  echo ">{$found_cat['catname']}</option>";

													}
												?>
												
											</select>
									   </div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
									<button type="submit" value="save" class="btn btn-success btn-md">
									<i class="fa fa-plus"> Add New Items</i></button>
									   </div>
									</div>

					  </form>
							<?php }else { echo "There isn't such this user ".mysql_error();} // end if belong to retrive users data from database?>
					
				<?php
				} // end else if $do==edit
				include("includes/footer.php");

			}//end if isset session
			else{
				header("location:index.php");
				exit();	
			}			
?>
