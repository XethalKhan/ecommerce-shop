<?php
	session_start();

	if(isset($_POST["btnUploadOrder"])){
	require_once("utl/db.php");
	$crm = new DB("id8082146_root", "faksc0ece");
	$conn = $crm->getInstance();

	$query = "SELECT MAX(id) AS cnt FROM `order`";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$rs=$stmt->fetch();

	$cnt = $rs->cnt + 1;
	$freight = 0;

	foreach($_SESSION["order"] as $key=>$val){
		$prodids[] = $key;
	}
	$instmt = "(" . implode(",", $prodids) . ")";
	$query = "SELECT id, name, unit_price AS price, discount AS discount FROM product WHERE id IN " . $instmt;

	$stmt = $conn->prepare($query);
	$stmt->execute();
	$rs=$stmt->fetchall();

	$orderQ = array();
	foreach($rs as $names){
		$orderQ[] = 
			array(
				"id" => $names->id,
				"name" => $names->name,
				"number" => $_SESSION["order"][$names->id],
				"price" => $names->price,
				"discount" => $names->discount);
	}

	foreach($orderQ as $prod){
		$freight = $freight + (double)$prod["number"] * ((double)$prod["price"] * (100 - (double)$prod["discount"]) / 100); 
	}

	$query = 
		"INSERT INTO `order`(id, c_id, req_date, freight, address, city, region, country, postal_code) " .
		"VALUES (:id, :c_id, :req_date, :freight, :address, :city, :region, :country, :postal_code)";

	$c_id = $_SESSION["uid"];
	$req_date = $_POST["tbReqDate"];
	$req_date = date('Y-m-d', strtotime($req_date));
	$address = $_POST["tbAddress"];
	$city = $_POST["tbCity"];
	$country = $_POST["tbCountry"];
	$region = $_POST["tbRegion"];
	$postal = $_POST["tbPostal"];

	$stmt = $conn->prepare($query);
	$stmt->bindParam(":id", $cnt);
	$stmt->bindParam(":c_id", $c_id);
	$stmt->bindParam(":req_date", $req_date);
	$stmt->bindParam(":freight", $freight);
	$stmt->bindParam(":address", $address);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":region", $region);
	$stmt->bindParam(":country", $country);
	$stmt->bindParam(":postal_code", $postal);
	$stmt->execute();

	$newQ = "INSERT INTO order_detail(id, p_id, price, quantity, discount) " .
			"VALUES(:o_id, :p_id, :price, :quantity, :discount)";
	foreach($orderQ as $prod){
		$pid = $prod["id"];
		$price = $prod["price"];
		$quantity = $prod["number"];
		$discount = $prod["discount"];

		$po = $conn->prepare($newQ);
		$po->bindParam(":o_id", $cnt);
		$po->bindParam(":p_id", $pid);
		$po->bindParam(":price", $price);
		$po->bindParam(":quantity", $quantity);
		$po->bindParam(":discount", $discount);
		$po->execute();
	}

	unset($_SESSION["order"]);
	header("Location: profile.php?uid=" . $_SESSION["uid"]);
}?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce | Complete your order</title>
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

			require_once("view/header.php");
			require_once("view/nav.php");
	?>
	<div id="content" class="row">
		<div class="col-sm-12">
			<div class="row profileRow">
				<div class="col-sm-12 text-center">
					<h1>One final step to complete your order</h1>
				</div>
			</div>
			<div class="row table-responsive">
				<table class="table table-hover text-center" id="orderTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Sum</th>
							<th>Product</th>
						</tr>
					</thead>
					<tbody>
				<?php 
		    		$prodids = array();
		    		if(!(empty($_SESSION["order"]))){
		    			require_once("utl/db.php");
		    			$crm = new DB("id8082146_root", "faksc0ece");
						$conn = $crm->getInstance();

						foreach($_SESSION["order"] as $key=>$val){
							$prodids[] = $key;
						}
						$instmt = "(" . implode(",", $prodids) . ")";
						$query = "SELECT id, name, unit_price AS price, discount AS discount FROM product WHERE id IN " . $instmt;

						$stmt = $conn->prepare($query);
						$stmt->execute();
						$rs=$stmt->fetchall();

						$orderQ = array();
						foreach($rs as $names){
							$orderQ[] = 
								array(
									"id" => $names->id,
									"name" => $names->name,
									"number" => $_SESSION["order"][$names->id],
									"price" => $names->price,
									"discount" => $names->discount);
						}

						$value = 0;
						foreach($orderQ as $prod){
							$value = $value + (double)$prod["number"] * ((double)$prod["price"] * (100 - (double)$prod["discount"]) / 100); 
						}

						foreach($orderQ as $prod){
			    			echo 
			    				"<tr>" .
				    				"<td>" . substr($prod["name"], 0, 30) . "</td>" .
									"<td>" . $prod["number"] . "</td>" .
				    				"<td>" . number_format((float)$prod["price"], 2, ",", ".") ."</td>" .
				    				"<td>" . ((double)$prod["number"] * ((double)$prod["price"]) * (100 - (double)$prod["discount"]) / 100) ."</td>" .
				    				"<td>" . "<a href=\"prod.php?pid=" . $prod["id"]. "\">Details</a>" .  "</td>" .
			    				"</tr>";
			    		}
			    	}else{
			    		echo "<div class=\"row profileRow\"><div class=\"col-sm-12\">No product selected</div></div>";
					}
		    	?>
		    		</tbody>
		    	</table>
			</div>
		</div>
	</div>
	<form id="formUploadOrder" method="post" enctype="multipart/form-data" action="completeOrder.php">
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Address:<span class="err" id="nameErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbAddress" name="tbAddress" class="form-control"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">City:<span class="err" id="shortDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbCity" name="tbCity" class="form-control" />
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Country:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbCountry" name="tbCountry" class="form-control"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Region:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbRegion" name="tbRegion" class="form-control"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Postal code:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbPostal" name="tbPostal" class="form-control"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Date the shippment is requiered to arrive:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<input type="text" id="tbReqDate" name="tbReqDate" class="form-control" placeholder="dd.mm.yyyy"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">	
				<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
				<input type="submit" name="btnUploadOrder" id="btnUploadOrder" class="formBtn" value="Upload" onclick=""/>
				<br/><br/>
			</div>
		</div>
	</form>	
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>