<?php if(isset($_GET["id"])):?>
	<div id="content" class="row">
		<div class="col-sm-12">
			<?php
				$pid = $_GET["id"];
				$stmt = $conn->prepare("SELECT * FROM product WHERE id = :id");
				$stmt->bindParam(":id", $pid);
				$stmt->execute();
				$rs=$stmt->fetch();
			?>
			<div class="row profileRow">
				<div class="col-sm-4 text-center product-img">
						<?php echo "<img src=\"assets/images/" . $rs->img . "\" width=\"auto\" height=\"250\"/>"; ?>
				</div>
				<div class="col-sm-8 text-center">
					<div class="row profileRow">
						<div class="col-sm-4">
							<h3>Name</h3>
						</div>
						<div class="col-sm-8">
							<p><?php echo $rs->name ?></p>
						</div>
					</div>
					<div class="row profileRow">
						<div class="col-sm-4 text-center">
							<h3>Short description</h3>
						</div>
						<div class="col-sm-8 text-center">
							<p><?php echo $rs->short_desc ?></p>
						</div>
					</div>
					<div class="row profileRow">
						<div class="col-sm-3 text-center">
							<h3>Unit</h3>
						</div>
						<div class="col-sm-3 text-center">
							<p><?php echo $rs->unit ?></p>
						</div>
						<div class="col-sm-3 text-center">
							<h3>Price</h3>
						</div>
						<div class="col-sm-3 text-center">
							<p><?php echo $rs->unit_price ?></p>
						</div>
					</div>
					<div class="row profileRow">
						<div class="col-sm-3 text-center">
							<h3>In stock</h3>
						</div>
						<div class="col-sm-3 text-center">
							<p><?php echo $rs->unit_in_stock ?></p>
						</div>
						<div class="col-sm-3 text-center">
							<h3>Discount</h3>
						</div>
						<div class="col-sm-3 text-center">
							<p><?php echo $rs->discount ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="row profileRow">
				<div class="col-sm-4 text-center">
					<h3>Long description</h3>
				</div>
				<div class="col-sm-8 text-center">
					<p><?php echo $rs->long_desc ?></p>
				</div>
			</div>
			<?php if(isset($_SESSION["uid"])): ?>
				<div class="row profileRow" id="order-from-prod">
						<?php
							echo 
								"<div class=\"col-sm-4 text-center\"><h3>Purchase</h3></div>" .
								"<div class=\"col-sm-2 text-center\">" .
			    				"<i class=\"fa fa-plus plus-prod-add\" style=\"font-size:32px\" raia-hidden=\"true\" data-pid=\"" . $_GET["id"] . "\"></i>".
			    				"</div>" .
			    				"<div class=\"col-sm-2 text-center\">" .
			    				"<span class=\"num-of-prod\" id=\"in-prod-num\">" . (isset($_SESSION["order"][$pid]) ? $_SESSION["order"][$pid] : "0"). "</span>" .
			    				"</div>" .
			    				"<div class=\"col-sm-2 text-center\">" .
			    				"<i class=\"fa fa-minus minus-prod-add\" style=\"font-size:32px\" aria-hidden=\"true\" data-pid=\"" . $_GET["id"] . "\"></i>" .
			    				"</div>" .
			    				"<div class=\"col-sm-2 text-center\">" .
			    				"<i class=\"fa fa-times remove-prod\" style=\"font-size:32px\" aria-hidden=\"true\" data-pid=\"" . $_GET["id"] . "\"></i>" .
			    				"</div>";
			    		?>
				</div>
				<?php if($_SESSION["gid"] == 1): ?>
					<hr/>
					<div class="row">
						<div class="col-lg-12">
							<div class="row profileRow">
								<div class="col-sm-6 text-center">
									<?php 
										echo "<input type=\"button\" class=\"formBtn\" value=\"Modify product info\"" .
												" onclick=\"window.open('http://" . BASE_HREF . "/product-change/" . $_GET["id"]. "', '_self')\" />";
									?>
								</div>
								<div class="col-sm-6 text-center">
									Modify product information name, price, discount, category etc.
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row profileRow">
								<div class="col-sm-6 text-center">
									<input type="button" class="formBtn" value="Remove" onclick="window.open('utl/removeProd.php', '_self')" />
								</div>
								<div class="col-sm-6 text-center">
									Remove product from our offer
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>