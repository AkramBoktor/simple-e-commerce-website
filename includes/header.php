<?php
		session_start();
		require_once("connect.php");
		require_once("function.php");
	?>
	
<!DOCTYPE>
<html>
	<head>
		<title><?php get_title()?> </title>
		<meta charset="utf-8"/>
		<link href="layout/css/bootstrap.css" rel="stylesheet" type="text/css"/>
		<link href="layout/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="layout/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<link href="layout/css/jquery.selectBoxIt.css" rel="stylesheet" type="text/css"/>
		<link href="layout/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="layout/css/mystyle.css" rel="stylesheet" type="text/css"/>
		
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top"><!-- Navbar -->
				<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="dashboard.php">Home</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="app-nav">
				<ul class="nav navbar-nav">
						<li><a href="categories.php">Categories</a></li>
						<li><a href="items.php">Items</a></li>
						<li><a href="members.php?do=manage">Member</a></li>
						<li><a href="#">statistics</a></li>
						<li><a href="#">Logs</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ariahaspopup="
				true" aria-expanded="false">Akram <span class="caret"></span></a>
				<ul class="dropdown-menu">
				<li><a href="members.php?do=edit&user_id=<?php echo $_SESSION['user_id'];?>">Edit profile</a></li>
				<li><a href="#">Settings</a></li>
				<li><a href="logout.php">Logout</a></li>
				</ul>
				</li>
				</ul>
				</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
	 </nav>