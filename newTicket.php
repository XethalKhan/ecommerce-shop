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
		<form id="formTicket" method="post" action="" clas="form-inline">
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<h1>New ticket<span id="txtErr" class="err"></span></h1>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<textarea id="txtTicket" name="txtTicket" rows="10" class="form-control" placeholder="Describe issue of our services here, at least 50 characters"></textarea>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">	
					<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
					<input type="button" name="btnNewTicket" id="btnNewTicket" class="formBtn" value="New ticket"/>
					<br/><br/>
				</div>
			</div>
		</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>