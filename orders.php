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
	?>
	<div id="search" class="row">
		<div class="col-lg-12">
			<form id="formSearch" action="" method="post">
				<div class="row search-row">
					<div class="col-sm-3 text-center">
						Customer
					</div>
					<div class="col-sm-8">
						<input type="text" id="tbCustomer" name="tbCustomer" class="form-control"/>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Maximal freight<span class="err" id="maxfErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMaxFreight" name="tbMaxFreight" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Minimum freight<span class="err" id="minfErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMinFreight" name="tbMinFreight" class="form-control"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								City
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbCity" name="tbCity" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Country
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbCountry" name="tbCountry" class="form-control"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Address
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbAddress" name="tbAddress" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Order date<span class="err" id="orderDateErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbOrderDate" name="tbOrderDate" class="form-control" placeholder="dd.mm.yyyy"/>
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
						<input type="button" name="btnSearchOrders" id="btnSearchOrders" class="formBtn" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="content" class="row table-responsive">
		<table class="table table-hover text-center" id="orderTable">
			<thead>
				<tr>
					<th>Order number</th>
					<th>Customer</th>
					<th>Order date</th>
					<th>Freight</th>
					<th>Address</th>
					<th>City/Country</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$stmt = $conn->prepare(
						"SELECT " .
							"o.id AS id, " .
							"u.username AS username, " .
							"o.freight AS freight, " .
							"o.order_date AS order_date, " .
							"o.address AS address, " .
							"CONCAT(o.city, '/', o.country) AS city " .
						"FROM `order` o " .
						"INNER JOIN user u " .
						"ON u.id = o.c_id");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $order){
						echo 
							"<tr>" .
								"<td>" . $order->id . "</td>" .
								"<td>" . $order->username. "</td>" .
								"<td>" . date("d.m.Y", strtotime($order->order_date)). "</td>" .
								"<td>" . $order->freight. "</td>" .
								"<td>" . $order->address. "</td>" .
								"<td>" . $order->city. "</td>" .
								"<td><a href=\"order.php?oid=" . $order->id . "\">Details</a></td>" .
							"</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>