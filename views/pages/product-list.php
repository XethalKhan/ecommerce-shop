<div id="search" class="row">
		<div class="col-lg-12">
			<form id="formSearch" action="" method="post">
				<div class="row search-row">
					<div class="col-sm-3 text-center">
						Name
					</div>
					<div class="col-sm-8">
						<input type="text" id="tbName" name="tbName" class="form-control"/>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Maximal price<span class="err" id="maxPErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMaxPrice" name="tbMaxPrice" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Minimum price<span class="err" id="minPErr"></span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMinPrice" name="tbMinPrice" class="form-control"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Category
							</div>
							<div class="col-sm-5 text-center">
								<select name="ddlSearchCategory" id="ddlSearchCategory" class="form-control">
									<option value="0">Choose . . .</option>
									<?php 
										$slcCat = "";
										if(isset($_GET["id"])){
											$slcCat = $_GET["id"];
										}
										$stmt = $conn->prepare("SELECT * FROM category");
										$stmt->execute();
										$rs=$stmt->fetchall();
										foreach($rs as $cat){
											$slc = "";
											if($slcCat == $cat->id){
												$slc = "selected";
											}
											echo "<option value=\"" . $cat->id . "\" " . $slc . ">".$cat->name."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								On discount&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="cbxDiscount" id="cbxDiscount" value="1"/>
							</div>
							<div class="col-sm-5 text-center">
								In stock&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="cbxStock" id="cbxStock" value="1"/>
							</div>
						</div>
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
						<input type="button" name="btnSearchProducts" id="btnSearchProducts" class="formBtn" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="content" class="row">
		<div id="main" class="col-sm-9">
			<?php 
				require_once("models/product/functions.php");
				$c = "";
				if(isset($_GET["id"]) && !empty($_GET["id"])){
					$c = $_GET["id"];
				}
				$rs = product_pagination(0, $c);
				$i = 0;
				foreach($rs as $prod){

					if($i % 3 == 0){
						echo "<div class=\"row search-row\">";
					}
					echo "<div class=\"search-prod col-sm-4\">" .
							"<div class=\" text-center\">" .
								"<img src=\"assets/images/small_" . $prod->img . "\"/>" .
							"</div>" .
							"<div class=\"row search-details\">" .
								"<div class=\"col-sm-9 text-center\">" .
									"<h6>" . $prod->name . "</h6>" .		
								"</div>" .
								"<div class=\"col-sm-3 text-center\">" .
										"<h6 class=\"search-price\">" . 
											"$".number_format((float)$prod->unit_price, 2, ",", ".") . 
										"</h6>" .
								"</div>" .
							"</div>" .
							"<div class=\"row text-center product-links\">" .
								"<div class=\"col-sm-6\">" .
									"<a href=\"http://" . BASE_HREF . "/product/" . $prod->id . "\" class=\"product-detail\">Details</a>" .
								"</div>" .
								"<div class=\"col-sm-6\">" .
									"<a href=\"\" class=\"product-action\" data-pid=\"" . $prod->id . "\" 
									data-cat=\"" . $prod->cat_id . "\">Purchase</a>" .
								"</div>" .		
							"</div>" .
						"</div>";
					if($i % 3 == 2 || $i + 1 == count($rs)){echo "</div>";}
					$i = $i + 1;
				}
			?>
			<div class="row" id="pagination">
				<div class="col-sm-12 text-center">
					<?php  
						$paged = product_pagination_number();
						echo "<span class=\"product-pagination pagination-link text-center\" data-pag=\"0\">|&lt;&lt;</span>&nbsp;&nbsp;&nbsp;";
						echo "<span class=\"product-pagination pagination-link text-center\" data-pag=\"0\">&lt;&lt;</span>&nbsp;&nbsp;&nbsp;";
						for($i = 0; $i < 6 && $i < $paged; $i++):
					?>
						<span class="product-pagination pagination-link text-center" data-pag=<?php echo "\"{$i}\"";?>><?php echo ($i + 1);?></span>&nbsp;&nbsp;&nbsp;
					<?php endfor;
						echo "<span class=\"product-pagination pagination-link text-center\" data-pag=\"0\">&gt;&gt;</span>&nbsp;&nbsp;&nbsp;";
						echo "<span class=\"product-pagination pagination-link text-center\" data-pag=\"{$paged}\">&gt;&gt;|</span>&nbsp;&nbsp;&nbsp;";
					?>
				</div>
			</div>
		</div>
		<div id="asideSearch" class="col-sm-3">
			<div class="row text-center">
				<h3 class="col-sm-12">Categories</h3>
			</div>
			<div class="row text-center">
				<ul class="col-sm-12">
				<?php 
					$stmt = $conn->prepare("SELECT * FROM category");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $cat){
						$n = strlen($cat->name) > 25 ? substr($cat->name, 0, 25) . ". . ." : $cat->name;
						echo "<li><a href=\"http://" . BASE_HREF. "/product-list/" . $cat->id . "\">" . $n ."</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>