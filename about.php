<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce</title>
	<meta charset="utf-8">
	<!--STYLESHEET-->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/start.css">
	<!--/STYLESHEET-->
	<!--FONT AWESOME 5 ICONS-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!--/FONT AWESOME 5 ICONS-->
	<!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->
    <script src="js/script.js"></script>
</head>
<body class="container-fluid">
	<?php 
			error_reporting(E_ALL);

			require_once("view/header.php");
			require_once("view/nav.php");
	?>
	<div id="content" class="row">
		<div id="main" class="col-sm-9 text-center">
			<div class="row text-center" style="margin-top:20px;">
				<div class="col-sm-12">
					<h1>About</h1>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-sm-12">
					<p>This is a project for a course "Web programming PHP1" at ICT College of Vocational Studies. It is a e-commerce website where buyers can make orders and purchase goods, and administrators manage user profiles, solve issues with a ticket system and send ordered products over shipping</p>
				</div>
			</div>
			<hr/>
			<div class="row text-center">
				<div class="col-sm-12">
					<h2>Contact</h2>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-sm-6">
					<h4>Phone</h4>
				</div>
				<div class="col-sm-6">
					+3210123456789
				</div>
			</div>
			<div class="row text-center" style="margin-top:20px;">
				<div class="col-sm-6">
					<h4>Email</h4>
				</div>
				<div class="col-sm-6">
					contact.Ecommerce@gmail.com
				</div>
			</div>
			<hr/>
			<div class="row text-center" style="margin-top:20px;margin-bottom:20px">
				<div class="col-sm-6">
					<h4>Address</h4>
				</div>
				<div class="col-sm-6">
					Lucky Luke 17/89<br/>
					Belgrade, Belgrade county, Serbia 
				</div>
			</div>
		</div>
		<div id="aside" class="col-sm-3">
			<div class="row text-center">
				<h3 class="col-sm-12">Technologies used</h3>
			</div>
			<div class="row text-center">
				<ul class="col-sm-12">
					<li>HTML</li>
					<li>CSS</li>
					<li>JavaScript</li>
					<li>JQuery</li>
					<li>Bootstrap</li>
					<li>PHP</li>
					<li>Font awesome 5</li>
				</ul>
			</div>
		</div>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>