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
    <!--/STYLESHEET-->
	<!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->
    <!--JAVASCRIPT-->
    <script src="js/script.js"></script>
    <!--/JAVASCRIPT-->
</head>
<body class="container-fluid">
	<?php 
			session_start();
			error_reporting(E_ALL);
			require_once("view/header.php");
			require_once("view/nav.php");
	?>
		<form id="formLogin" method="post" action="utl/login.php" clas="form-inline">
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Old password:<span class="err" id="oldErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbOld" name="tbOld" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">New password:<span class="err" id="newPassErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbNewPass" name="tbNewPass" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Repeat new password:<span class="err" id="newPassRepErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbNewPassRep" name="tbNewPassRep" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<p id="errList">
					</p>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">	
					<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
					<input type="button" name="btnChangePass" id="btnChangePass" class="formBtn" value="Change"/>
					<br/><br/>
				</div>
			</div>
		</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>