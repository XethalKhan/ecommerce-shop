<?php 
	session_start();
	$status = "";
	if(isset($_POST["btnModProd"])){
		error_reporting(E_ALL);
		require_once("utl/db.php");
		$crm = new DB("id8082146_root", "faksc0ece");
		$conn = $crm->getInstance();

		$name = $_POST["tbName"];
		$shortDesc = $_POST["tbShortDesc"];
		$longDesc = $_POST["tbLongDesc"];
		$cat = $_POST["ddlProdCategory"];
		$unit = $_POST["tbUnit"];
		$price = $_POST["tbUnitPrice"];
		$stock = $_POST["tbUnitStock"];
		$discount = $_POST["tbDiscount"];
		$pid = $_POST["pid"];
		$test = true;

		$img;
		$img_name;
		$img_type;
		$img_tmp_path;

		if($_FILES["prodimg"]["size"] > 0){
			$img = $_FILES["prodimg"];
			$img_name = $img["name"];
			$img_type = $img["type"];
			$img_tmp_path = $img["tmp_name"];

			if($img_type != "image/jpg" && $img_type != "image/jpeg" && $img_type != "image/png" && $img_type != "image/gif"){
				$test = false;
				$status = "Uploaded file must be .jpg, .jpeg, .png or .gif";
			}
		}

		if($test == true){
			$imgUpl = "";
			$img_new_name;

			if($_FILES["prodimg"]["size"] > 0){
				$img_new_name = time() . $img_name;
				move_uploaded_file($img_tmp_path, "img/prod/" . $img_new_name);
				$imgUpl = ",img = :img ";
			}

			$query = 
				"UPDATE product " .
				"SET " .
					"name = :name, " .
					"short_desc = :short_desc, " .
					"long_desc = :long_desc, " .
					"cat_id = :cat_id, " .
					"unit = :unit, " .
					"unit_price = :unit_price, " .
					"unit_in_stock = :unit_in_stock, " .
					"discount = :discount " .
					$imgUpl .
				"WHERE id = :pid";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":short_desc", $shortDesc);
			$stmt->bindParam(":long_desc", $longDesc);
			$stmt->bindParam(":cat_id", $cat);
			$stmt->bindParam(":unit", $unit);
			$stmt->bindParam(":unit_price", $price);
			$stmt->bindParam(":unit_in_stock", $stock);
			$stmt->bindParam(":discount", $discount);
			$stmt->bindParam(":pid", $pid);

			if($_FILES["prodimg"]["size"] > 0){
				$stmt->bindParam(":img", $img_new_name);
			}

			$test = $stmt->execute();

			if($test == true){
				header("Location: prod.php?pid=" . $pid);
			}
		}
	}

	if(isset($_SESSION["gid"]) ? ($_SESSION["gid"] == 1 ? true: false) : false ):
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce | Change product info</title>
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
			require_once("utl/db.php");
			$crm = new DB("id8082146_root", "faksc0ece");
			$conn = $crm->getInstance();

			require_once("view/header.php");
			require_once("view/nav.php");

			$stmt = $conn->prepare("SELECT * FROM product WHERE id = :pid");
			$pid = $_GET["pid"];
			$stmt->bindParam(":pid", $pid);
			$stmt->execute();
			$rs = $stmt->fetch();
	?>
	<form id="formModProd" method="post" enctype="multipart/form-data" action="modProd.php">
		<div class="row formRow">
			<div class="col-md-12 text-center">
				<img src = "img/logo.png" width="150px" height="150px"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Name:<span class="err" id="nameErr"></span></h4>
			</div>
			<div class="col-md-8">

				<?php
					echo "<input type=\"text\" id=\"tbName\" name=\"tbName\" class=\"form-control\" " .
							"value=\"" . $rs->name . "\" placeholder=\"150 characters max\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Short description:<span class="err" id="shortDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<textarea id=\"tbShortDesc\" name=\"tbShortDesc\" class=\"form-control\" placeholder=\"250 characters max\">" .
						$rs->short_desc .
					"</textarea>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Long description:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<textarea id=\"tbLongDesc\" name=\"tbLongDesc\" class=\"form-control\">" .
						$rs->long_desc .
					"</textarea>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Category:<span class="err" id="catErr"></span></h4>
			</div>
			<div class="col-md-8">
				<select name="ddlProdCategory" id="ddlProdCategory" class="form-control">
					<option value="0">Choose . . .</option>
					<?php 
						$cat = $conn->prepare("SELECT * FROM category");
						$cat->execute();
						$rsCat=$cat->fetchall();
						foreach($rsCat as $category){
							$slc = "";
							if($rs->cat_id == $category->id){
								$slc = "selected";
							}
							echo "<option value=\"" . $category->id . "\" " . $slc . ">".$category->name."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit:<span class="err" id="unitErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnit\" name=\"tbUnit\" class=\"form-control\" " .
							"value=\"" . $rs->unit . "\" placeholder=\"piece,kg,cm,l etc.\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit price:<span class="err" id="unitPriceErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnitPrice\" name=\"tbUnitPrice\" value=\"" . $rs->unit_price . "\" class=\"form-control\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit in stock:<span class="err" id="unitStockErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnitStock\" name=\"tbUnitStock\" value=\"" . $rs->unit_in_stock . "\" class=\"form-control\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Discount:<span class="err" id="discountErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbDiscount\" name=\"tbDiscount\" class=\"form-control\"" .
					" value=\"" . $rs->discount . "\" placeholder=\"Final price = Price * (100 - Discount) / 100\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Picture:<span class="err" id="userErr"></span></h4>
			</div>
			<div class="col-md-3">
				<input type="file" id="prodimg" name="prodimg"/>
			</div>
			<div class="col-md-6 text-center">
				<?php
					echo "<img src=\"img/prod/" . $rs->img . "\" width=\"auto\" height=\"200\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">
				<p id="errList">
					<?php 
						echo $status;
					?>
				</p>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">	
				<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
				<input type="submit" name="btnModProd" id="btnModProd" class="formBtn" value="Upload"/>
				<br/><br/>
				<?php echo "<input type=\"hidden\" id=\"pid\" name=\"pid\" value=\"" . $_GET["pid"] . "\"/>"; ?>
			</div>
		</div>
	</form>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>
<?php 
	else:
		header("Location: login.php");
	endif;
?>