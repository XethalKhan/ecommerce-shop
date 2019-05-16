<?php 
	session_start();
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
    <link rel="stylesheet" href="assets/css/search.css">
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
		error_reporting(E_ALL);

		require_once("views/fixed/header.php");
		require_once("views/fixed/login.php");
		require_once("views/fixed/nav.php");

		require_once("config/connection.php");

		$page = isset($_GET["page"]) ? (empty($_GET["page"]) ? "home" : $_GET["page"]) : "home";
		switch($page){
			case "home":
				require_once("views/pages/home.php");
				break;
			case "about":
				require_once("views/pages/about.php");
				break;
			case "author":
				require_once("views/pages/author.php");
				break;
			case "products":
				require_once("views/pages/products.php");
				break;
			default:
				require_once("views/pages/home.php");
				break;
		}

		require_once("views/fixed/footer.php");
	?>
</body>
</html>