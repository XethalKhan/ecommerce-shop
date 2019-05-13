<?php 
	session_start();
	require_once("utl/db.php");
	$crm = new DB("id8082146_root", "faksc0ece");
	$conn = $crm->getInstance();

	$test = true;
	$cid = "";
	$oid = "";

	if(isset($_GET["oid"])){
		$query = "SELECT c_id AS id FROM `order` WHERE id = :id";
		$oid = $_GET["oid"];
		$stmt = $conn->prepare($query);
		$stmt->bindParam(":id", $oid);
		$stmt->execute();
		$rs = $stmt->fetch();
		$cid = $rs->id;
	}else{
		$test = false;
	}

	if($test == true && 
		((isset($_SESSION["uid"]) ? ($_SESSION["uid"] == $cid ? true : false) : false) 
			|| (isset($_SESSION["gid"]) ? $_SESSION["gid"] == 1 : false))
		):
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce | Order</title>
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
					<h1>Order</h1>
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

					$oid = $_GET["oid"];
					$query = 
						"SELECT " .
							"p.id AS id, ". 
							"p.name AS name, ". 
							"o.quantity AS quantity, " .
							"o.price AS price, " .
							"o.discount AS discount " .
						"FROM order_detail o " . 
						"INNER JOIN product p " . 
						"ON p.id = o.p_id " .
						"WHERE o.id = :id";

					$stmt = $conn->prepare($query);
					$stmt->bindParam(":id", $oid);
					$stmt->execute();
					$rs=$stmt->fetchall();


					foreach($rs as $prod){
		    			echo 
		    				"<tr>" .
			    				"<td>" . substr($prod->name, 0, 30) . "</td>" .
								"<td>" . $prod->quantity . "</td>" .
			    				"<td>$" . number_format((float)$prod->price, 2, ",", ".") ."</td>" .
			    				"<td>" . ((double)$prod->quantity * ((double)$prod->price) * (100 - (double)$prod->discount) / 100) ."</td>" .
			    				"<td>" . "<a href=\"prod.php?pid=" . $prod->id . "\">Details</a>" .  "</td>" .
		    				"</tr>";
		    		}
		    	?>
		    		</tbody>
		    	</table>
			</div>
		</div>
	</div>
	<?php 
			$query = "SELECT * FROM `order` WHERE id = :id";
			$oid = $_GET["oid"];
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $oid);
			$stmt->execute();
			$rs = $stmt->fetch();
		?>
	<div class="row">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Address:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->address; ?>
		</div>
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">City:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->city; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Country:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->country; ?>
		</div>
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Region:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->region; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Postal code:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->postal_code; ?>
		</div>
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Ordered:</h4>
		</div>
		<div class="col-md-3">
			<?php echo date("d.m.Y", strtotime($rs->order_date)); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Status:</h4>
		</div>
		<div class="col-md-3">
			<?php echo $rs->status; ?>
		</div>
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Requiered:</h4>
		</div>
		<div class="col-md-3">
			<?php echo date("d.m.Y", strtotime($rs->order_date)); ?>
		</div>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>
<?php else: ?>
<?php header("Location: profile.php?uid=" . $_SESSION["uid"]) ?>
<?php endif; ?>