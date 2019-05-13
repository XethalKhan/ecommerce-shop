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
	<div id="content">
		<div class="row admin-row">
			<a class="col-sm-6 text-center admin-cat" href="users.php">
				<h2>USERS</h2>
			</a>
			<a class="col-sm-6 text-center admin-cat" href="orders.php">
				<h2>ORDERS</h2>
			</a>
		</div>
		<div class="row admin-row">
			<a class="col-sm-6 text-center admin-cat" href="tickets.php">
				<h2>TICKETS</h2>
			</a>
			<a class="col-sm-6 text-center admin-cat" href="surveyResult.php">
				<h2>SURVEY</h2>
			</a>
		</div>
		<div class="row admin-row">
			<a class="col-sm-6 text-center admin-cat" href="newProd.php">
				<h2>NEW PRODUCT</h2>
			</a>
			<a class="col-sm-6 text-center admin-cat" href="categories.php">
				<h2>CATEGORIES</h2>
			</a>
		</div>
		<div id="tickets" class="row">
			<table id="tickets-table" class="table table-hover text-center">
				<thead>
					<tr>
						<th>Ticket id</th>
						<th>User</th>
						<th>Request</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$stmt = $conn->prepare(
						"SELECT " .
							"t.id AS id, " .
							"u.username AS username, " .
							"t.request AS request, " .
							"t.date AS date ".
						"FROM ticket t " .
						"INNER JOIN user u " .
						"ON u.id = t.id_c " .
						"ORDER BY t.date DESC " .
						"LIMIT 10");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $ticket){
						echo "<tr>" .
							"<td>" . $ticket->id . "</td>" .
							"<td>" . $ticket->username . "</td>" .
							"<td>" . 
								(strlen($ticket->request) > 100 ? substr($ticket->request, 0, 95) . ". . ." : $ticket->request) . 
							"</td>" .
							"<td>" . date("d.m.Y", strtotime($ticket->date)) . "</td>" .
						"</tr>";
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>