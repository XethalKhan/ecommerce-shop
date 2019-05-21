<?php 
	session_start();

	error_reporting(E_ALL);

	require_once("config/config.php");
	require_once("config/connection.php");
?>
<!DOCTYPE html>
<html>
<?php 
	require_once("views/fixed/head-meta.php");
?>
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
			case "user":
				require_once("views/pages/user.php");
				break;
			default:
				require_once("views/pages/home.php");
				break;
		}

		require_once("views/fixed/footer.php");
	?>
</body>
</html>