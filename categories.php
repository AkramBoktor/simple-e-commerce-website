<?php $page_title='categories'; include("includes/header.php"); ?>
	<?php
	if(isset($_SESSION['username'])){
		if(isset($_GET['do'])){
			$do = $_GET['do'];
		}else{
			$do = 'manage';
		}
		if($do == "manage"){ // do ==manage*/
				$sort = '';
				$sort_array = array("ASC","DESC");
				if(isset($_GET['sort'])&& in_array($_GET['sort'],$sort_array)){
					$sort = $_GET['sort'];
				}
				$query = "select * from categories order by ordering $sort ";
				confirm_query($query);
				$result = mysql_query ($query , $connection)
				?>
					<div class="container category">
						<h1 class="text-center"> Manage category </h1>
						<div class="panel panel-default">
							<div class="panel-heading"> 
								Manage Category 
								<div class="ordering pull-right">
			<i class="fa fa-tag"></i> Ordering
									<a href="?sort=ASC">ASC</a> |
									<a href="?sort=DESC">DESC</a>
			<i class="fa fa-eye"></i> View
									<span data-view='full'>Full</span> |
									<span>classic</span>
								</div>
							</div>
							<div class="panel-body">
								<?php
								/* retrieve the data from categories table */
									while($found_cat=mysql_fetch_array($result)){
										echo "<div class='cat'>";
											echo "<div class='button-cat'>";
												echo '<a href="categories.php?do=edit&cat_id='.$found_cat['cat_id'].'"class="btn btn-xs btn-primary"><i class="fa fa-tag"></i> Edit </a>';
												echo "<a href='categories.php?do=delete&cat_id={$found_cat['cat_id']}' class='btn btn-xs btn-danger'><i class='fa fa-close'></i> delete </a>";
											echo "</div>";
											echo "<h2>".$found_cat['catname']."</h2>";
											echo "<div class='full-view'>";/* for make jquery accordian */
													echo "<p>".$found_cat['description']."</p>";
													/* check if visible comment ads ==1 or ==0 */
													if($found_cat['ordering']==0){}
													else{echo '<span class="unvisible"><i class="fa fa-tag"></i> Hidden</span>';}
													if($found_cat['visibe']==0){}
													else{echo '<span class="unvisible"><i class="fa fa-close"></i> Visibility Hidden </span>';}
													if($found_cat['allow_comment']==0){}
													else{echo '<span class="unvisible"><i class="fa fa-home"></i> Comment Hidden </span>';}
													if($found_cat['allow_ads']==0){}
													else{echo '<span class="unvisible"><i class="fa fa-taxi"></i> Advertise Hidden </span>';}
											echo "</div>";
										echo "</div>";
										echo "<hr>";
									}
								?>
							</div>
						</div>
							<a href="categories.php?do=add" class="btn btn-info newmember"><i class="fa fa-plus"></i>Add New Category</a>

					</div>
				<?php
			
		}elseif($do == "add") /* start of add*/
		{?>
			
					<!-- Add New Category --->
					<h1 class="members"> Add New Category </h1>

						<form class="form-horizontal form-group-lg" action="?do=insert" method="post">
									<div class="form-group">
									<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="name" required="required" >
									   </div>
									</div>
									
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="description">
											 
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Ordering</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="ordering">
											
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">visiblity</label>
										<div class="col-sm-6">
											<div>
												<input id="visi-yes" type="radio" value="0" name="visible" checked="checked" >
												<label for="visi-yes">Yes </label>
											</div>
												<div><input id="visi-no" type="radio" value="1" name="visible" >
												<label for="visi-no">No </label>
											</div>

									   </div>
									</div>	
									<div class="form-group">
									<label class="col-sm-3 control-label">Allow_Comment</label>
										<div class="col-sm-6">
											<div>
												<input id="com-yes" type="radio" value="0" name="allow_comment" checked="checked">
												<label for="com-yes">Yes </label>
											</div>
												<div><input id="com-no" type="radio" value="1" name="allow_comment" >
												<label for="com-no">No </label>
											</div>

									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Allow_Ads</label>
										<div class="col-sm-6">
											<div>
												<input id="ad-yes" type="radio" value="0" name="allow_ads" checked="checked" >
												<label for="ad-yes">Yes </label>
											</div>
												<div><input id="ad-no" type="radio" value="1" name="allow_ads" >
												<label for="ad-no">No </label>
											</div>

									   </div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
									<button type="submit" value="save" class="btn btn-success btn-lg">Add New Category</button>
									   </div>
									</div>

					  </form>
					  
		<?php
			
		}//end of add */
		elseif($do =="insert"){
			if($_SERVER['REQUEST_METHOD']=='POST')
						{	
							$catname=trim($_POST['name']);
							$description=trim($_POST['description']);
							$ordering=trim($_POST['ordering']);
							$visibe=$_POST['visible'];
							$allow_comment=$_POST['allow_comment'];
							$allow_ads=$_POST['allow_ads'];
							
							$check= check_item('catname','categories','1',$catname);
							if($check == 1){ /** if cat is exisits **/
								echo"<div class='container'>";
							    	echo '<div class="alert alert-danger"> The categorie is exists </div>';

								echo"</div>";
							}else{
								
									$query ="insert into categories (catname,description,ordering,visibe,allow_comment,allow_ads) 
											values('{$catname}','{$description}','{$ordering}','{$visibe}','{$allow_comment}','{$allow_ads}')";
									confirm_query($query);
									if(mysql_query($query,$connection))
									{
										echo '<div class="alert alert-success"> The categorie added </div>';
										header("location:categories.php?do=add");
										exit();
									}else{
										echo " Can't add categorie ".mysql_error();
											header("location:categories.php?do=add");
									}
								
							}
							
						}/*end if of insert*/
						else{
										header("location:categories.php?do=add");
										exit();
						}
					} /* end of do = insert*/
				elseif($do==edit)
				{
					
							// to retrive users data from database 
							if(isset($_GET['cat_id'])&& is_numeric($_GET['cat_id'])){
								$cat_id = $_GET['cat_id'];
								$query = "select * from categories where cat_id = {$cat_id} limit 1" ;
								confirm_query($query);
								$result = mysql_query($query,$connection);
								$found_cat = mysql_fetch_array($result);
								
							
						?>
							<h1 class="members"> Edit Category </h1>

						<form class="form-horizontal form-group-lg" action="?do=update" method="post">
									<div class="form-group">
										<input type="hidden" name="cat_id" 
								value="<?php echo $cat_id //to update data by user_id and send it hidden?>" />
									<label class="col-sm-3 control-label">Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="name" 
											value="<?php echo $found_cat['catname'];?>">
									   </div>
									</div>
									
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="description"
											value="<?php echo $found_cat['description'];?>">
											 
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Ordering</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="ordering"
											value="<?php echo $found_cat['ordering'];?>">
											
									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">visiblity</label>
										<div class="col-sm-6">
											<div>
												<input id="visi-yes" type="radio" value="0" name="visibe"
												 <?php if($found_cat['visibe']==0){echo " checked";}?>  >
												<label for="visi-yes">Yes </label>
											</div>
												<div><input id="visi-no" type="radio" value="1" name="visibe"
												<?php if($found_cat['visibe']==1){echo " checked" ;}?> >
												<label for="visi-no">No </label>
											</div>

									   </div>
									</div>	
									<div class="form-group">
									<label class="col-sm-3 control-label">Allow_Comment</label>
										<div class="col-sm-6">
											<div>
												<input id="com-yes" type="radio" value="0" name="allow_comment"
												<?php if($found_cat['allow_comment']==0){echo "checked" ;}?> >
												<label for="com-yes">Yes </label>
											</div>
												<div><input id="com-no" type="radio" value="1" name="allow_comment"
												<?php if($found_cat['allow_comment']==1){echo "checked" ;}?> >
												<label for="com-no">No </label>
											</div>

									   </div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">Allow_Ads</label>
										<div class="col-sm-6">
											<div>
												<input id="ad-yes" type="radio" value="0" name="allow_ads"
							                    <?php if($found_cat['allow_ads']==0){echo "checked" ;}?> >
												<label for="ad-yes">Yes </label>
											</div>
												<div><input id="ad-no" type="radio" value="1" name="allow_ads"
												<?php if($found_cat['allow_ads']==1){echo "checked" ;}?> >
												<label for="ad-no">No </label>
											</div>

									   </div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
									<button type="submit" value="save" class="btn btn-success btn-lg">Save</button>
									   </div>
									</div>

					  </form>
							<?php }else { echo "There isn't such this Category ".mysql_error();} // end if belong to retrive category data from database?>
					
				<?php
				} // end else if $do==edit
				elseif($do=="update")
				{
				
							echo "<h1 class='members'> Update Category </h1>";
							 if($_SERVER['REQUEST_METHOD']=='POST')
							 {
								$cat_id = $_POST['cat_id'];
								$catname=trim($_POST['name']);
							$description=trim($_POST['description']);
							$ordering=trim($_POST['ordering']);
							$visibe=$_POST['visibe'];
							$allow_comment=$_POST['allow_comment'];
							$allow_ads=$_POST['allow_ads'];
							
							$check= check_item('catname','categories','1',$catname);
							if($check == 1){ /** if cat is exisits **/
								echo"<div class='container'>";
								
							    	echo '<div class="alert alert-danger"> The categorie is exists </div>';

								echo"</div>";
							}else{
									// update the users table
										$query =" update categories set 
										catname = '$catname',
										description = '$description',
										ordering = '$ordering',
										visibe = '$visibe',
										allow_comment = '$allow_comment',
										allow_ads = '$allow_ads'
										where cat_id = $cat_id ";
										confirm_query($query);
										$result=mysql_query($query,$connection);
										if(mysql_affected_rows()==1)
										{
											echo " <div class='alert alert-success'> Data is successful update</div> " ;
										}else{
											echo " <div class='alert alert-danger'>can't update data</div> ".mysql_error();
										}
								}
								
									
							  
			 }/* end if form come from the same page*/
			 else{echo "can't Access the page " ;}
		 }// end if do == update
			
			elseif($do==delete)
			{
					/*delete mebers*/
					 if(isset($_GET['cat_id'])){
						 $id = $_GET['cat_id'];
						$query = "delete from categories where cat_id ={$_GET['cat_id']}";
						 confirm_query($query);
						 $result = mysql_query($query,$connection);
						 if(mysql_affected_rows()==1){
							 header("location:categories.php?do=manage");
						 }else{
							  header("location:categories.php?do=manage");
						 }
						 
					 }else{ header("location:categories.php?do=manage");}
		 }//end if do == delete
				
				include("includes/footer.php");

			}//end if isset session
			else{
				header("location:index.php");
				exit();	
			}			
?>
