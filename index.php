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

    <link rel="stylesheet" href="css/start.css">
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
			require_once("utl/db.php");
			$crm = new DB("root", "root");
			$conn = $crm->getInstance();

			require_once("view/header.php");
			require_once("view/nav.php");
	?>
	<div id="content" class="row">
		<div id="main" class="col-sm-9">
			<?php 
					$stmt = $conn->prepare("SELECT * FROM product");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $prod){
					echo "<div class=\"row product\">" .
							"<div class=\"col-sm-4 text-center product-img\">" .
								"<img src=\"img/prod/" . $prod->img . "\" width=\"auto\" height=\"200\"/>" .
							"</div>" .
							"<div class=\"col-sm-8\">" .
								"<div class=\"row text-center\">" .
									"<div class=\"col-sm-12 product-name\">" .
										"<h5>" . $prod->name . "</h5>" .
									"</div>" .		
								"</div>" .
								"<div class=\"row\">" .
									"<div class=\"col-sm-12\">" .
										"<p class=\"product-desc\">" . $prod->short_desc . "</p>" .
									"</div>" .		
								"</div>" .
								"<div class=\"row text-center\">" .
									"<div class=\"col-sm-12\">" .
										"<h5 class=\"product-price\">" . 
											"$".number_format((float)$prod->unit_price, 2, ",", ".") . 
										"</h5>" .
									"</div>" .
								"</div>" .
								"<div class=\"row text-center product-links\">" .
									"<div class=\"col-sm-6\">" .
										"<a href=\"prod.php?pid=" . $prod->id . "\" class=\"product-detail\">Details</a>" .
									"</div>" .
									"<div class=\"col-sm-6\">" .
										"<a href=\"\" class=\"product-action\" data-pid=\"" . $prod->id . "\" 
									data-cat=\"" . $prod->cat_id . "\">Purchase</a>" .
									"</div>" .		
								"</div>" .
							"</div>" .
						"</div>";
					}
				?>
		</div>
		<div id="aside" class="col-sm-3">
			<div class="row text-center">
				<h3 class="col-sm-12">Categories</h3>
			</div>
			<div class="row text-center">
				<ul class="col-sm-12">
				<?php 
					$stmt = $conn->prepare("SELECT * FROM category");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $cat){
						$n = strlen($cat->name) > 25 ? substr($cat->name, 0, 25) . ". . ." : $cat->name;
						echo "<li><a href=\"products.php?cat=" . $cat->id . "\">" . $n ."</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>