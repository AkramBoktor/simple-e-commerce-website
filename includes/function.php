<?php
	function confirm_query($result)

	{	
		if(!$result){
			
			echo "Database query failed".mysql_error();
		}
	}
	
	/* function to print the page title and print default title */
	
	function get_title(){
		
		global $page_title;
		if(isset($page_title)){
			echo $page_title;
		}else{
			echo "default";
		}
	}
	
	/************ function to check item in the database ***************/
	
	/*** to retrieve the pending member Function v1.0 */
	function pend_member($item,$table,$value){
				    global $connection;
			        $query = "select count($item) from $table where $item = $value";
					confirm_query($query);
					$result=mysql_query($query,$connection);
					$total = mysql_fetch_array($result);
		           return $total[0];

	}
	
	/** Get Latest Records Function v1.0
	** Function To Get Latest Items From Database [ Users, Items, Comments ]
	** $select = Field To Select
	** $table = The Table To Choose From
	** $order = The Desc Ordering
	** $limit = Number Of Records To Get
	*المتغير هنا اللى انا بدور عليه والجدول*/

	function count_item($item,$table)
	{
				    global $connection;
					$query = "select count($item) from $table";
					confirm_query($query);
					$result=mysql_query($query,$connection);
					$total = mysql_fetch_array($result);
					return $total[0];
		
	}
	/****************************/
   /* function to get the latest item */
   function get_latest($item,$table,$condition,$limit)
   {
	                global $connection;
					$query = "select $item from $table order by $condition  desc limit $limit";
					confirm_query($query);
					$result=mysql_query($query,$connection);
					
					
					while($row = mysql_fetch_array($result))
					{
						
					   echo "<li>".$row['username'].
					   '<a href="members.php?do=edit&user_id='.$row['user_id'].'"><span class="pull-right btn btn-success">
							<i class="fa fa-edit">Edit</a></span></i>';
								if($row['reg_status']==0)
								{
									echo "<a href='members.php?do=active&user_id={$row['user_id']}'
									class='pull-right btn btn-info active'><i class='fa fa-tag'></i> Active </a>";
								}
							echo'</li>';
						
					}
   }

	/************************************/
	/*  ****** check item **********/
		function check_item($item,$table,$value){
				    global $connection;
			        $query = "select count($item) from $table where $item = $value";
					confirm_query($query);
					$result=mysql_query($query,$connection);
					$total = mysql_fetch_array($result);
		           return $total[0];

	}
				
	   
   /************** function retrieve all items *********/
   	function count_item1($item,$table){
				    global $connection;
			        $query = "select count($item) from $table";
					confirm_query($query);
					$result=mysql_query($query,$connection);
					$total = mysql_fetch_array($result);
		           return $total[0];

	}
   
?> 