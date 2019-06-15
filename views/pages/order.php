<?php
	$test = true;
	$cid = "";
	$oid = "";

	if(isset($_GET["id"])){
		$oid = $_GET["id"];
		$cid = get_user_id_from_order($oid);
	}else{
		$test = false;
	}

	if($test == true && 
		((isset($_SESSION["uid"]) ? ($_SESSION["uid"] == $cid ? true : false) : false) 
			|| (isset($_SESSION["gid"]) ? $_SESSION["gid"] == 1 : false))
		):
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
				
				$rs=get_ordered_products($oid);


				foreach($rs as $prod){
	    			echo 
	    				"<tr>" .
		    				"<td>" . $prod->name . "</td>" .
							"<td>" . $prod->quantity . "</td>" .
		    				"<td>$" . number_format((float)$prod->price, 2, ",", ".") ."</td>" .
		    				"<td>$" . number_format((double)$prod->quantity * ((double)$prod->price) * (100 - (double)$prod->discount) / 100, 2) ."</td>" .
		    				"<td>" . "<a href=\"http://" . BASE_HREF . "/product/" . $prod->id . "\">Details</a>" .  "</td>" .
	    				"</tr>";
	    		}
	    	?>
	    		</tbody>
	    	</table>
		</div>
	</div>
</div>
<?php 
	$rs = get_order($oid);
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
<?php else: ?>
<?php header("Location: http://" . BASE_HREF . "/profile/". $_SESSION["uid"]); ?>
<?php endif; ?>