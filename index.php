<?php 
	session_start();

	error_reporting(E_ALL);

	require_once("config/config.php");
	require_once("config/connection.php");
	require_once("config/logging.php");
?>
<!DOCTYPE html>
<html>
<?php 
	require_once("views/fixed/head-meta.php");
	require_once("config/session.php");
	require_once("config/statistics.php");
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
			case "categories":
				require_once("views/pages/categories.php");
				break;
			case "change-pass":
				require_once("views/pages/change-pass.php");
				break;
			case "home":
				require_once("views/pages/home.php");
				break;
			case "login":
				require_once("views/pages/login.php");
				break;
			case "new-product":
				require_once("views/pages/new-product.php");
				break;
			case "new-ticket":
				require_once("views/pages/new-ticket.php");
				break;
			case "order":
				require_once("views/pages/order.php");
				break;
			case "order-complete":
				require_once("views/pages/order-complete.php");
				break;
			case "order-list":
				require_once("views/pages/order-list.php");
				break;
			case "product":
				require_once("views/pages/product.php");
				break;
			case "product-change":
				require_once("views/pages/product-change.php");
				break;
			case "product-list":
				require_once("views/pages/product-list.php");
				break;
			case "session-list":
				require_once("views/pages/session-list.php");
				break;
			case "sign-up":
				require_once("views/pages/sign-up.php");
				break;
			case "survey":
				require_once("views/pages/survey.php");
				break;
			case "survey-result":
				require_once("views/pages/survey-result.php");
				break;
			case "ticket-list":
				require_once("views/pages/ticket-list.php");
				break;
			case "user":
				require_once("views/pages/user.php");
				break;
			case "user-change":
				require_once("views/pages/user-change.php");
				break;
			case "user-list":
				require_once("views/pages/user-list.php");
				break;
			default:
				require_once("views/pages/home.php");
				break;
		}

		require_once("views/fixed/footer.php");
	?>
	</body>
</html>