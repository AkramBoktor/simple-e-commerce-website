<?php
	require("constant.php");
	global $connection;
	 $connection = mysql_connect(DB_SERVER,DB_NAME,DB_PASSWORD);
	if(!$connection)
	{
		echo "Database connection failed".mysql_error();
	}
	$db_select=mysql_select_db("shop2",$connection);
	if(!$db_select)
	{
		echo "Database selection failed".mysql_error();
	}
	
?>