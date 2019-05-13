<?php 
	session_start();
	require_once("utl/db.php");
	$crm = new DB("root", "root");
	$conn = $crm->getInstance();

	$test = true;
	$cid = "";
	$oid = "";

	if(isset($_GET["tid"])){
		$query = "SELECT id_c AS id FROM `ticket` WHERE id = :id";
		$tid = $_GET["tid"];
		$stmt = $conn->prepare($query);
		$stmt->bindParam(":id", $tid);
		$stmt->execute();
		$rs = $stmt->fetch();
		$cid = $rs->id;
	}else{
		$test = false;
	}

	if($test == true && 
		((isset($_SESSION["uid"]) ? ($_SESSION["uid"] == $cid ? true : false) : false) 
			|| (isset($_SESSION["gid"]) ? $_SESSION["gid"] == 1 : false))
		):
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce | Ticket</title>
	<meta charset="utf-8">
	<!--STYLESHEET-->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/profile.css">
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
		<div class="col-sm-12">
			<div class="row profileRow">
				<div class="col-sm-12 text-center">
					<h1>One final step to complete your order</h1>
				</div>
			</div>
		</div>
	</div>
		
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>
<?php else: ?>
<?php header("Location: profile.php?uid=" . $_SESSION["uid"]) ?>
<?php endif; ?>