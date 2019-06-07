<?php if(isset($_SESSION["uid"]) && !isset($_GET["id"])):?>
	<?php
		if(empty($_SESSION["uid"])){
			header("Location: http://" . BASE_HREF . "/login");
		}else{
			header("Location: http://" . BASE_HREF . "/user/" . $_SESSION["uid"]);
		}
	?>
<?php elseif(!isset($_SESSION["uid"]) && !isset($_GET["id"])):?>
	<?php header("Location: http://" . BASE_HREF . "/login");?>
<?php else: ?>
<?php
	$query = 
		"SELECT " .
			"id, " .
			"username, " .
			"firstname, " .
			"lastname, " .
			"email, " .
			"status, " .
			"grp " .
		"FROM `user` " .
		"WHERE id = :id";

	$id = $_GET["id"];
	$stmt = $conn->prepare($query);
	$stmt->bindParam(":id", $id);
	$stmt->execute();
	$rs=$stmt->fetch();
?>
<div class="row">
	<div class="col-lg-8">
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>Username</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php echo $rs->username; ?>
			</div>
		</div>
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>E-mail</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php echo $rs->email; ?>
			</div>
		</div>
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>Firstname</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php echo $rs->firstname; ?>
			</div>
		</div>
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>Lastname</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php echo $rs->lastname; ?>
			</div>
		</div>
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>Account type</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php 
					$acc = "";
					switch($rs->grp){
						case 0:
							$acc = "Customer";
							break;
						case 1:
							$acc = "Administrator";
							break;
						default:
							$acc = "N/a";
					}
					echo $acc;
				?>
			</div>
		</div>
		<div class="row profileRow">
			<div class="col-sm-6 text-center">
				<h4>Status</h4>
			</div>
			<div class="col-sm-6 text-center">
				<?php 
					$stat = "";
					switch($rs->status){
						case 0:
						$stat = "Active";
						break;
					case 1:
						$stat = "Disabled";
						break;
					case 2:
						$stat = "Wrong passwords";
						break;
					default:
						$stat = "N/A";
					}
					echo $stat;
				?>
			</div>
		</div>
		<?php if($_SESSION["uid"] == $_GET["id"]):?>
			<hr/>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="Modify personal info" onclick="window.open(
					<?php echo "'modUser.php?uid=" . $_GET["id"]. "'";?>, '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					Modify personal information <br/>(username, e-mail, firstname, lastname)
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="Change password" onclick="window.open('changePass.php', '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					New login password
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="New ticket" onclick="window.open(
						<?php echo "'http://" . BASE_HREF . "/new-ticket'";?>, '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					Contact us if there are any issues with our services
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="Disable account" onclick="window.open(
						<?php echo "'http://" . BASE_HREF . "/user/disable/" . $_GET["id"]. "'";?>, '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					In order to disable account, all orders must be fullfilled<br/>
					User will no longer be able to use our services
				</div>
			</div>
		<?php  endif; ?>
		<?php if($_SESSION["gid"] == 1 && $_SESSION["uid"] != $_GET["id"]):?>
			<hr/>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="Modify personal info" onclick="window.open(
					<?php echo "'modUser.php?uid=" . $_GET["id"]. "'";?>, '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					Modify personal information <br/>(username, e-mail, firstname, lastname)
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<input type="button" class="formBtn" value="Change password" onclick="window.open('utl/resetPass.php', '_self')" />
				</div>
				<div class="col-sm-6 text-center">
					Reset password
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-6 text-center">
					<?php 
						echo "<input type=\"button\" class=\"formBtn\"";
						if($rs->status == 0){
							echo "value=\"Disable account\" onclick=\"window.open('utl/disableAcc.php?uid=" . $_GET["id"]. "', '_self')\" />";
						}else{
							echo "value=\"Enable account\" onclick=\"window.open('utl/enableAcc.php?uid=" . $_GET["id"]. "', '_self')\" />";
						}
					 ?>
				</div>
				<div class="col-sm-6 text-center">
					<?php 
						if($rs->status == 0){
							echo "In order to disable account, all orders must be fullfilled<br/>User will no longer be able to use our services";
						}else if($rs->status == 1){
							echo "User disabled account";
						}else if($rs->status == 2){
							echo "User entered wrong password 5 times";
						}
					?>
				</div>
			</div>
		<?php  endif; ?>
	</div>
	<div class="col-lg-4 text-center" id="asideSearch">
		<?php 
			$query = "SELECT id, DATE(order_date) AS date FROM `order` WHERE c_id = :c_id AND status = 1";

			$cid = $_GET["id"];
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":c_id", $cid);
			$stmt->execute();
			$rs=$stmt->fetchall();
			echo "<ul><li><h3>Orders pending</h3></li>";
			foreach($rs as $order){
				echo "<li><a href=\"http://" . BASE_HREF . "/order/" . $order->id . "\">" . 
						"Order #" . $order->id .  
						" Ordered:" . date("d.m.Y", strtotime($order->date)) . 
					"</a></li>";
			}

			$query = "SELECT id, date FROM `ticket` WHERE id_c = :id_c AND status = 0";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id_c", $cid);
			$stmt->execute();
			$rs=$stmt->fetchall();
			echo "<li><h3>Tickets pending</h3></li>";
			foreach($rs as $ticket){
				echo "<li><a href=\"order.php?oid=" . $ticket->id .
						 "\">Ticket #" . $ticket->id . 
						 " Created:" . date("d.m.Y", strtotime($ticket->date)) . 
					"</a></li>";
			}

			echo "</ul>";
		?>
	</div>
</div>
<?php endif;?>