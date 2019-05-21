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
                case "home":
                    echo "Home";
                    break;
                case "login":
                    echo "Log in";
                    break;
                case "product-list":
                    echo "Products";
                    break;
                case "sign-up":
                    echo "Sign up";
                    break;
                case "survey":
                    echo "Survey";
                    break;
                case "user":
                    echo "User profile";
                    break;
                default:
                    echo "Home";
                    break;
            }
        ?>
    </title>
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