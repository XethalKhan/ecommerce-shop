<?php 
	session_start();

	error_reporting(E_ALL);

	require_once("config/config.php");
	require_once("config/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce</title>
	<meta charset="utf-8">
	<!--STYLESHEET-->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <link rel="stylesheet" href="assets/css/start.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="css/admin.css">
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
    <script src="assets/js/script.js"></script>
</head>
<body class="container-fluid">
	<?php 
		require_once("views/fixed/header.php");
		require_once("views/fixed/login.php");
		require_once("views/fixed/nav.php");

		$page = isset($_GET["page"]) ? (empty($_GET["page"]) ? "home" : $_GET["page"]) : "home";
		switch($page){
			case "about":
				require_once("views/pages/about.php");
				break;
			case "admin":
				require_once("views/pages/admin.php");
				break;
			case "author":
				require_once("views/pages/author.php");
				break;
			case "home":
				require_once("views/pages/home.php");
				break;
			case "login":
				require_once("views/pages/login.php");
				break;
			case "product-list":
				require_once("views/pages/product-list.php");
				break;
			case "sign-up":
				require_once("views/pages/sign-up.php");
				break;
			case "survey":
				require_once("views/pages/survey.php");
				break;
			default:
				require_once("views/pages/home.php");
				break;
		}

		require_once("views/fixed/footer.php");
	?>
</body>
</html>