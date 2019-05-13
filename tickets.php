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
			session_start();
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
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Ticket ID
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbID" name="tbID" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Ticket date<span class="err" id="ticketDateErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbTicketDate" name="tbTicketDate" class="form-control" placeholder="dd.mm.yyyy"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-3 text-center">
						Customer
					</div>
					<div class="col-sm-8">
						<input type="text" id="tbCustomer" name="tbCustomer" class="form-control"/>
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
						<input type="button" name="btnSearchTickets" id="btnSearchTickets" class="formBtn" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="content" class="row table-responsive">
		<table class="table table-hover text-center" id="ticketTable">
			<thead>
				<tr>
					<th>Ticket ID</th>
					<th>Customer</th>
					<th>Date</th>
					<th>Text</th>
					<th>Resolve</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$stmt = $conn->prepare(
						"SELECT " .
							"t.id AS id, " .
						    "u.username AS username, " .
						    "t.date AS date, " .
						    "t.request AS request " .
						"FROM `ticket` t " .
						"INNER JOIN user u " .
						"ON t.id_c = u.id " . 
						"WHERE t.status = 0");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $ticket){
						echo 
							"<tr>" .
								"<td>" . $ticket->id . "</td>" .
								"<td>" . $ticket->username. "</td>" .
								"<td>" . date("d.m.Y", strtotime($ticket->date)). "</td>" .
								"<td>" . $ticket->request. "</td>" .
								"<td>" .
									"<a href=\"#\" class=\"solve-ticket\" data-id=\"" . $ticket->id . "\">Solved</a><br/>" . 
									"<a href=\"#\" class=\"dissmiss-ticket\" data-id=\"" . $ticket->id . "\">Dissmiss</a>" .
								"</td>" . 
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