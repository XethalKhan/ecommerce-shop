<?php
	if(isset($_SESSION["gid"]) ? ($_SESSION["gid"] == 1 ? true: false) : false):
?>
	<?php 
			error_reporting(E_ALL);

			$stmt = $conn->prepare("SELECT * FROM product WHERE id = :pid");
			$pid = $_GET["id"];
			$stmt->bindParam(":pid", $pid);
			$stmt->execute();
			$rs = $stmt->fetch();
	?>
	<form id="formModProd" method="post" enctype="multipart/form-data" <?php echo "action='http://" . BASE_HREF . "/product/update'";?>>
		<div class="row formRow">
			<div class="col-md-12 text-center">
				<img src = "assets/img/logo.png" width="150px" height="150px"/>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Name:<span class="err" id="nameErr"></span></h4>
			</div>
			<div class="col-md-8">

				<?php
					echo "<input type=\"text\" id=\"tbName\" name=\"tbName\" class=\"form-control\" " .
							"value=\"" . $rs->name . "\" placeholder=\"150 characters max\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Short description:<span class="err" id="shortDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<textarea id=\"tbShortDesc\" name=\"tbShortDesc\" class=\"form-control\" placeholder=\"250 characters max\">" .
						$rs->short_desc .
					"</textarea>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Long description:<span class="err" id="longDescErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<textarea id=\"tbLongDesc\" name=\"tbLongDesc\" class=\"form-control\">" .
						$rs->long_desc .
					"</textarea>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Category:<span class="err" id="catErr"></span></h4>
			</div>
			<div class="col-md-8">
				<select name="ddlProdCategory" id="ddlProdCategory" class="form-control">
					<option value="0">Choose . . .</option>
					<?php 
						$cat = $conn->prepare("SELECT * FROM category");
						$cat->execute();
						$rsCat=$cat->fetchall();
						foreach($rsCat as $category){
							$slc = "";
							if($rs->cat_id == $category->id){
								$slc = "selected";
							}
							echo "<option value=\"" . $category->id . "\" " . $slc . ">".$category->name."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit:<span class="err" id="unitErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnit\" name=\"tbUnit\" class=\"form-control\" " .
							"value=\"" . $rs->unit . "\" placeholder=\"piece,kg,cm,l etc.\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit price:<span class="err" id="unitPriceErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnitPrice\" name=\"tbUnitPrice\" value=\"" . $rs->unit_price . "\" class=\"form-control\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Unit in stock:<span class="err" id="unitStockErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbUnitStock\" name=\"tbUnitStock\" value=\"" . $rs->unit_in_stock . "\" class=\"form-control\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Discount:<span class="err" id="discountErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php
					echo "<input type=\"text\" id=\"tbDiscount\" name=\"tbDiscount\" class=\"form-control\"" .
					" value=\"" . $rs->discount . "\" placeholder=\"Final price = Price * (100 - Discount) / 100\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Picture:<span class="err" id="userErr"></span></h4>
			</div>
			<div class="col-md-3">
				<input type="file" id="prodimg" name="prodimg"/>
			</div>
			<div class="col-md-6 text-center">
				<?php
					echo "<img src=\"assets/images/" . $rs->img . "\"/>";
				?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">
				<p id="errList">
					<?php 
						if(isset($_SESSION["msg"])){
							echo $_SESSION["msg"] . "<br/>";
							unset($_SESSION["msg"]);
						}
					?>
				</p>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">	
				<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
				<input type="submit" name="btnModProd" id="btnModProd" class="formBtn" value="Upload"/>
				<br/><br/>
				<?php echo "<input type=\"hidden\" id=\"pid\" name=\"pid\" value=\"" . $_GET["id"] . "\"/>"; ?>
			</div>
		</div>
	</form>
<?php 
	else:
		header("Location: http://" . BASE_HREF . "/login");
	endif;
?>