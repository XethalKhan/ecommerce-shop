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
			    				"<td>" . "<a href=\"http://" . BASE_HREF . "/product/" . $prod["id"]. "\">Details</a>" .  "</td>" .
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
<form id="formUploadOrder" method="post" enctype="multipart/form-data" action=<?php echo "\"http://" . BASE_HREF . "/order/complete\""; ?>>
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