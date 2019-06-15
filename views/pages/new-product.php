<form id="formUploadProd" method="post" enctype="multipart/form-data" action=<?php echo "\"http://" . BASE_HREF . "/product/insert\"";?>>
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
			<input type="text" id="tbName" name="tbName" class="form-control" placeholder="150 characters max"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Short description:<span class="err" id="shortDescErr"></span></h4>
		</div>
		<div class="col-md-8">
			<textarea id="tbShortDesc" name="tbShortDesc" class="form-control" placeholder="250 characters max"></textarea>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Long description:<span class="err" id="longDescErr"></span></h4>
		</div>
		<div class="col-md-8">
			<textarea id="tbLongDesc" name="tbLongDesc" class="form-control"></textarea>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Category:<span class="err" id="catErr"></span></h4>
		</div>
		<div class="col-md-8">
			<select name="ddlProdCategory" id="ddlProdCategory" class="form-control">
				<option value="0" selected>Choose . . .</option>
				<?php 
					$rs=get_categories();
					foreach($rs as $cat){
						echo "<option value=\"$cat->id\">".$cat->name."</option>";
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
			<input type="text" id="tbUnit" name="tbUnit" class="form-control" placeholder="piece,kg,cm,l etc."/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Unit price:<span class="err" id="unitPriceErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="text" id="tbUnitPrice" name="tbUnitPrice" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Unit in stock:<span class="err" id="unitStockErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="text" id="tbUnitStock" name="tbUnitStock" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Discount:<span class="err" id="discountErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="text" id="tbDiscount" name="tbDiscount" class="form-control" value="0.00" placeholder="Final price = Price * (100 - Discount) / 100"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Picture:<span class="err" id="userErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="file" id="prodimg" name="prodimg"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">
			<p id="errList">
				<?php 
					if(isset($_SESSION["msg"])){
						echo $_SESSION["msg"];
						unset($_SESSION["msg"]);
					}
				?>
			</p>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">	
			<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
			<input type="submit" name="btnUploadProd" id="btnUploadProd" class="formBtn" value="Upload" onclick="formUploadProd()"/>
			<br/><br/>
		</div>
	</div>
</form>