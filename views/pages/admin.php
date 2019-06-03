<?php if($_SESSION["gid"] == 1): ?>
<div id="content">
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "http://" . BASE_HREF . "/user-list";?>>
			<h2>USERS</h2>
		</a>
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "http://" . BASE_HREF . "/order-list";?>>
			<h2>ORDERS</h2>
		</a>
	</div>
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "http://" . BASE_HREF . "/ticket-list";?>>
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
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "http://" . BASE_HREF . "/categories";?>>
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
<?php else: ?>
	<?php 
		$_SESSION["msg"] = "Insufficient privileges";
		header("Location: http://" . BASE_HREF . "/login");
	?>
<?php endif;?>