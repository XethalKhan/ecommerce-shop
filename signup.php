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
			error_reporting(E_ALL);
			require_once("view/header.php");
			require_once("view/nav.php");
	?>
		<form id="formSignup" method="post" action="" clas="form-inline">
			<div class="row formRow">
				<div class="col-12 text-center">
					<h1>Sign-up</h1>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Firstname:<span class="err" id="fnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbFn" name="tbFn" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Lastname:<span class="err" id="lnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbLn" name="tbLn" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">E-mail:<span class="err" id="mailErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbMail" name="tbMail" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbUserSign" name="tbUser" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Password:<span class="err" id="passErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbPassSign" name="tbPass" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Repeat password:<span class="err" id="passRepErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbPassRep" name="tbPassRep" class="form-control"/>
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
					<input type="button" name="btnSignup" id="btnSignup" class="formBtn" value="Sign-up"/>
					<br/><br/>
				</div>
			</div>
		</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>