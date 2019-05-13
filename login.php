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
			/*
			require_once("view/header.php");
			*/
			require_once("view/nav.php");
			session_start();
	?>
		<form id="formLogin" method="post" action="utl/login.php" clas="form-inline">
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<img src = "img/logo.png" width="150px" height="150px"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbUser" name="tbUser" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Password:<span class="err" id="passErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbPass" name="tbPass" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<p id="errList">
						<?php 
							if(isset($_SESSION["msg"])){
								echo $_SESSION["msg"];
								unset($_SESSION["msg"]);
							}
						?>
					</p>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">	
					<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
					<input type="submit" name="btnSignup" id="btnSignup" class="formBtn" value="Sign-up"/>
					<br/><br/>
				</div>
			</div>
		</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>