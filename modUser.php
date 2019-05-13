<?php 
	session_start();
	error_reporting(E_ALL);
	require_once("utl/db.php");
	$crm = new DB("root", "root");
	$conn = $crm->getInstance();

	$err = "";
	$test = true;
	if(isset($_POST["btnModUser"])){
		$user = trim($_POST["tbUser"]);
		$mail = trim($_POST["tbMail"]);
		$fn = trim($_POST["tbFn"]);
		$ln = trim($_POST["tbLn"]);
		$uid = $_POST["uid"];

		if(empty($fn)){
			$test = false;
			$err = "Firstname must not be empty!<br/>";
		}
		if(empty($ln)){
			$test = false;
			$err = "Lastname must not be empty!<br/>";
		}
		if(!(preg_match("/^[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*@[a-z\.\-]+\.[a-z]{2,3}$/", $mail))){
			$test = false;
			$err = "E-mail is in bad format!<br/>";
		}
		if($test == true){
			$stmt = $conn->prepare(
				"UPDATE user SET firstname = :firstname, lastname = :lastname, username = :username, email = :email WHERE id = :id");
			$stmt->bindParam(":firstname", $fn);
			$stmt->bindParam(":lastname", $ln);
			$stmt->bindParam(":username", $user);
			$stmt->bindParam(":email",$mail);
			$stmt->bindParam(":id",$uid);
			$stmt->execute();
			$err = "User information successfully updated";
		}
	}
	$vid = isset($_GET["uid"]) ? $_GET["uid"] : $_POST["uid"];
	if((isset($_SESSION["gid"]) && $_SESSION["gid"] == 1) || (isset($_SESSION["uid"]) && $_SESSION["UID"] == $id)):
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
			require_once("view/header.php");
			require_once("view/nav.php");

			$stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
			$stmt->bindParam(":id", $vid);
			$stmt->execute();
			$rs = $stmt->fetch();
	?>
		<form id="formSignup" method="post" action="modUser.php" enctype="multipart/form-data" clas="form-inline">
			<div class="row formRow">
				<div class="col-12 text-center">
					<h1>Modify user info</h1>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Firstname:<span class="err" id="fnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<?php echo "<input type=\"text\" id=\"tbFn\" name=\"tbFn\" class=\"form-control\" value=\"" . $rs->firstname . "\"/>"; ?>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Lastname:<span class="err" id="lnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<?php echo "<input type=\"text\" id=\"tbLn\" name=\"tbLn\" class=\"form-control\" value=\"" . $rs->lastname . "\"/>"; ?>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">E-mail:<span class="err" id="mailErr"></span></h4>
				</div>
				<div class="col-md-8">
					<?php echo "<input type=\"text\" id=\"tbMail\" name=\"tbMail\" class=\"form-control\" value=\"" . $rs->email . "\"/>"; ?>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
				</div>
				<div class="col-md-8">
					<?php echo "<input type=\"text\" id=\"tbUser\" name=\"tbUser\" class=\"form-control\" value=\"" . $rs->username . "\"/>"; ?>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<p id="errList">
						<?php echo $err; ?>
					</p>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">	
					<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
					<input type="submit" name="btnModUser" id="btnModUser" class="formBtn" value="Update"/>
					<br/><br/>
					<input type="hidden" id="uid" name="uid" <?php echo "value=\"" . $vid . "\"";?>/>
				</div>
			</div>
		</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>
<?php else: ?>
<?php header("Location: index.php"); ?>
<?php endif; ?>