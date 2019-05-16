<div id="headerRight" class="col-md-9">
		<div class="row">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-6" id="loginData">
<!--AKO POSTOJI SESIJA PRIKAZATI PROFIL U SUPROTNOM LOGIN FORMU-->
<?php if(!(isset($_SESSION["user"]))): ?>
<form id="formLogin" method="post" action=<?php echo "\"http://" . HREF . "/user/login\""; ?> class="form-inline">
	<div class="row" style="margin-top:3px;">
		<div class="col-md-3 text-center">
			Username:
		</div>
		<div class="col-md-8">
			<input type="text" id="tbUser" name="tbUser" class="form-control"/>
		</div>
	</div>
	<div class="row" style="margin-top:3px;">
		<div class="col-md-3 text-center">
			Password:
		</div>
		<div class="col-md-8">
			<input type="password" id="tbPass" name="tbPass" class="form-control"/>
		</div>
	</div>
	<div class="row" style="margin-top:3px;">
		<div class="col-md-12 text-center">	
			<input type="submit" name="btnLogin" id="btnLogin" class="formBtn" value="Login"/>&nbsp;&nbsp;
			<input type="button" name="btnSignUp" id="btnSignUp" class="formBtn" value="Sign-up" onclick="window.open('signup.php', '_self')" />
		</div>
	</div>
</form>
<?php else: ?>
	<div class="row" style="margin-top:3px;">
		<div class="col-md-12 text-center">
			<?php  echo "<a id=\"profile-name\" href=\"profile.php?uid=" . $_SESSION['uid'] . "\"><b>" . $_SESSION["user"] . "</b></a>"; ?>
		</div>
	</div>
	<div class="row" style="margin-top:3px;">
		<div class="col-md-4 text-center">
			<input type="button" name="btnSignUp" id="btnSignUp" class="formBtn" value="Logout" onclick="window.open('utl/logout.php', '_self')" />
		</div>
		<div class="col-md-4 text-center">
			<?php if($_SESSION["gid"] == 1): ?>
				<input type="button" name="btnAdmin" id="btnAdmin" class="formBtn" value="Admin panel" onclick="window.open('admin.php', '_self')" />
			<?php endif ?>
		</div>
		<div class="row col-sm-4 text-center">
			<div class="dropdown keep-open">
			    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Purchase
			    <span class="caret"></span></button>
			    <ul class="dropdown-menu dropdown-menu-right">
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
							$query = "SELECT id, name FROM product WHERE id IN " . $instmt;

							$stmt = $conn->prepare($query);
							$stmt->execute();
							$rs=$stmt->fetchall();

							$orderQ = array();
							foreach($rs as $names){
								$orderQ[] = 
									array(
										"id" => $names->id,
										"name" => $names->name,
										"number" => $_SESSION["order"][$names->id]);
							}
							foreach($orderQ as $prod){
				    			echo 
				    				"<li>" .
				    					"&nbsp;&nbsp;&nbsp;" .
				    					"<i class=\"fa fa-plus plus-prod-add\" aria-hidden=\"true\" data-pid=\"" . $prod["id"] . "\"></i>".
				    					"&nbsp;&nbsp;&nbsp;" .
				    					"<span class=\"num-of-prod\">" . $prod["number"] . "</span>" .
				    					"&nbsp;&nbsp;&nbsp;" .
				    					"<i class=\"fa fa-minus minus-prod-add\" aria-hidden=\"true\" data-pid=\"" . $prod["id"] . "\"></i>" .
				    					"&nbsp;&nbsp;&nbsp;" .
				    					"<i class=\"fa fa-times remove-prod\" aria-hidden=\"true\" data-pid=\"" . $prod["id"] . "\"></i>" .
				    					"&nbsp;&nbsp;&nbsp;" .
				    					"<a href=\"#\" data-id=\"" . $prod["id"] . "\">" . substr($prod["name"], 0, 30) . "</a>"  . 
				    				"</li>";
				    		}
				    		echo "<li class=\"divider\"><hr/></li><li class=\"text-center\"><a href=\"completeOrder.php\">Complete order</a>";
			    	}else{
			    		echo "<li>&nbsp;&nbsp;&nbsp;No products selected</li>";
					}
			    	?>
			    </ul>
			</div>
		</div>
	</div>
<?php endif ?>
</div>
		</div>
	</div>
</div>