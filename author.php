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
					<h1>Author's profile</h1>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-sm-6">
					<img src="img/profil.png" wifth="auto" height="300px"/>
				</div>
				<div class="col-sm-6 text-center">
					<h3>Petar Bojovic</h3><br/>
					<p>Currently on a break from my first job in order to finish at least one studies.</p><br/>
					<h5>Usefull links</h5>
					<a href="https://www.linkedin.com/in/petar-bojovic-57a493164/">LinkedIn</a><br/>
					<a href="https://github.com/XethalKhan">Github</a>
				</div>
			</div>
			<hr/>
			<div class="row text-center" style="margin-bottom:20px;">
				<div class="col-sm-12">
					<h2>Education</h2>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-sm-6">
					<h4>ICT College of Vocational Studies</h4>
				</div>
				<div class="col-sm-6">
					2015-present<br/>
					Field of study: Internet technologies, network administration
				</div>
			</div>
			<div class="row text-center" style="margin-top:20px;">
				<div class="col-sm-6">
					<h4>Faculty of Economics, University of Belgrade</h4>
				</div>
				<div class="col-sm-6">
					2014-present<br/>
					Field of study: Accounting, Audit and Financial management
				</div>
			</div>
			<hr/>
			<div class="row text-center">
				<div class="col-sm-12">
					<h2>Work experience</h2>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-sm-6">
					<h4>Societe Generale Serbia</h4>
				</div>
				<div class="col-sm-6">
					02.04.2018 - present<br/>
					IT Design and Development Engineer
				</div>
			</div>
			<div class="row text-center" style="margin-top:20px;margin-bottom:20px">
				<div class="col-sm-6">
					<h4>Societe Generale Serbia</h4>
				</div>
				<div class="col-sm-6">
					15.01.2018 - 02.04.2018<br/>
					IT Developer - Intern
				</div>
			</div>
		</div>
		<div id="aside" class="col-sm-3">
			<div class="row text-center">
				<h3 class="col-sm-12">Skills</h3>
			</div>
			<div class="row text-center">
				<ul class="col-sm-12">
					<li>HTML</li>
					<li>CSS</li>
					<li>JavaScript</li>
					<li>JQuery</li>
					<li>Bootstrap</li>
					<li>PHP</li>
					<li>Java</li>
					<li>MySQL</li>
					<li>PL-SQL</li>
					<li>T-SQL</li>
					<li>Linux(CentOS, Ubuntu)</li>
					<li>Network administration</li>
					<li>Financial accounting</li>
					<li>Management accounting</li>
					<li>Business plan creation</li>
				</ul>
			</div>
		</div>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>