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

    <link rel="stylesheet" href="css/search.css">
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
	<div id="search" class="row">
		<div class="col-lg-12">
			<form id="formSearch" action="" method="post">
				<div class="row search-row">
					<div class="col-sm-3 text-center">
						Name
					</div>
					<div class="col-sm-8">
						<input type="text" id="tbName" name="tbName" class="form-control"/>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Maximal price<span class="err" id="maxPErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMaxPrice" name="tbMaxPrice" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Minimum price<span class="err" id="minPErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMinPrice" name="tbMinPrice" class="form-control"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Category
							</div>
							<div class="col-sm-5 text-center">
								<select name="ddlSearchCategory" id="ddlSearchCategory" class="form-control">
									<option value="0">Choose . . .</option>
									<?php 
										$slcCat = "";
										if(isset($_GET["cat"])){
											$slcCat = $_GET["cat"];
										}
										$stmt = $conn->prepare("SELECT * FROM category");
										$stmt->execute();
										$rs=$stmt->fetchall();
										foreach($rs as $cat){
											$slc = "";
											if($slcCat == $cat->id){
												$slc = "selected";
											}
											echo "<option value=\"" . $cat->id . "\" " . $slc . ">".$cat->name."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								On discount&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="cbxDiscount" id="cbxDiscount" value="1"/>
							</div>
							<div class="col-sm-5 text-center">
								In stock&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="cbxStock" id="cbxStock" value="1"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-md-12 text-center">
						<p id="errList">
						</p>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-12 text-center">
						<input type="button" name="btnSearchProducts" id="btnSearchProducts" class="formBtn" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="content" class="row">
		<div id="main" class="col-sm-9">
			<?php 
				$c = "";
				$catAdd = "cat_id = cat_id";
				if(isset($_GET["cat"])){
					$c = $_GET["cat"];
					$catAdd = "cat_id = :cat_id";
				}
				$query = "SELECT * FROM product WHERE " . $catAdd;
				$stmt = $conn->prepare($query);
				if(isset($_GET["cat"])){
					$stmt->bindParam(":cat_id", $c);
				}
				$stmt->execute();
				$rs=$stmt->fetchall();
				$i = 0;
				foreach($rs as $prod){

					if($i % 3 == 0){
						echo "<div class=\"row search-row\">";
					}
					echo "<div class=\"search-prod col-sm-4\">" .
							"<div class=\" text-center\">" .
								"<img src=\"img/prod/" . $prod->img . "\" width=\"auto\" height=\"150\"/>" .
							"</div>" .
							"<div class=\"row search-details\">" .
								"<div class=\"col-sm-9 text-center\">" .
									"<h6>" . $prod->name . "</h6>" .		
								"</div>" .
								"<div class=\"col-sm-3 text-center\">" .
										"<h6 class=\"search-price\">" . 
											"$".number_format((float)$prod->unit_price, 2, ",", ".") . 
										"</h6>" .
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
						"</div>";
					if($i % 3 == 2 || $i + 1 == count($rs)){echo "</div>";}
					$i = $i + 1;
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