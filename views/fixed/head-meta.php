<head>
	<title>E-commerce | 
        <?php
            $page = isset($_GET["page"]) ? (empty($_GET["page"]) ? "home" : $_GET["page"]) : "home";
            switch($page){
                case "about":
                    echo "About";
                    break;
                case "admin":
                    echo "Admin panel";
                    break;
                case "author":
                    echo "Author";
                    break;
                case "categories":
                    echo "Admin panel | Categories";
                    break;
                case "change-pass":
                    echo "Change password";
                    break;
            case "home":
                echo "Home";
                break;
            case "login":
                echo "Login";
                break;
            case "new-product":
                echo "Admin panel | New product";
                break;
            case "new-ticket":
                echo "New ticket";
                break;
            case "order":
                echo "Order #" . $_GET["id"];
                break;
            case "order-complete":
                echo "Complete order";
                break;
            case "order-list":
                echo "Admin panel | Orders";
                break;
            case "product":
                echo "Product";
                break;
            case "product-change":
                echo "Modify product";
                break;
            case "product-list":
                echo "Products";
                break;
            case "session-list":
                echo "Admin panel | Active sessions";
                break;
            case "sign-up":
                echo "Sign up";
                break;
            case "survey":
                echo "Survey";
                break;
            case "survey-result":
                echo "Admin panel | Survey result";
                break;
            case "statistics":
                echo "Admin panel | Page statistics";
                break;
            case "ticket-list":
                echo "Admin panel | All tickets";
                break;
            case "user":
                echo "User profile";
                break;
            case "user-change":
                echo "Modify user";
                break;
            case "user-list":
                echo "Admin panel | User list";
                break;
            default:
                echo "Online book store";
                break;
            }
        ?>
    </title>
    <script>var BASE_HREF = <?php echo "\"" . BASE_HREF . "/\"";?>
    </script>
	<meta charset="utf-8">
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
    <script src="assets/js/script.js"></script>
    <!--JAVASCRIPT-->
    <!--STYLESHEET-->
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <link rel="stylesheet" href="assets/css/start.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/pagination.css">
    <!--/STYLESHEET-->
</head>