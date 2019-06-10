<?php if($_SESSION["gid"] == 1): ?>
<div id="content">
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/user-list\"";?>>
			<h2>USERS</h2>
		</a>
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/order-list\"";?>>
			<h2>ORDERS</h2>
		</a>
	</div>
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/ticket-list\"";?>>
			<h2>TICKETS</h2>
		</a>
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/survey-result\"";?>>
			<h2>SURVEY</h2>
		</a>
	</div>
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/new-product\"";?>>
			<h2>NEW PRODUCT</h2>
		</a>
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/categories\"";?>>
			<h2>CATEGORIES</h2>
		</a>
	</div>
	<div class="row admin-row">
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/session-list\"";?>>
			<h2>SESSIONS</h2>
		</a>
		<a class="col-sm-6 text-center admin-cat" href=<?php echo "\"http://" . BASE_HREF . "/session-list\"";?>>
			<h2>CATEGORIES</h2>
		</a>
	</div>
	<div id="tickets" class="row">
		<table id="tickets-table" class="table table-hover text-center">
			<thead>
				<tr>
					<th>Page</th>
					<th>Time</th>
					<th>User ID</th>
					<th>Session ID</th>
					<th>IP address</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$name = date("dmy") . ".txt";
				$log = file(BASE_FILE . "/data/session/" . $name);
				$cnt = count($log);
				$i = $cnt < 15 ? 0 : $cnt - 15;
				for(; $i < $cnt; $i++){
					$row = trim($log[$i]);
					$row = explode("\t", $row);
					echo "<tr>" .
						"<td><a href=\"http://" . BASE_HREF . "/" . $row[0] . "\">" . $row[0] . "</a></td>" .
						"<td>" . $row[1] . "</td>" .
						"<td>" . $row[2] . "</td>" .
						"<td>" . $row[3] . "</td>" .
						"<td>" . $row[4] . "</td>" .
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