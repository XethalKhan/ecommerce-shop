<div id="content" class="row">
		<div id="main" class="col-sm-9">
			<?php 
					$stmt = $conn->prepare("SELECT * FROM product");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $prod){
					echo "<div class=\"row product\">" .
							"<div class=\"col-sm-4 text-center product-img\">" .
								"<img src=\"assets/images/" . $prod->img . "\" width=\"auto\" height=\"200\"/>" .
							"</div>" .
							"<div class=\"col-sm-8\">" .
								"<div class=\"row text-center\">" .
									"<div class=\"col-sm-12 product-name\">" .
										"<h5>" . $prod->name . "</h5>" .
									"</div>" .		
								"</div>" .
								"<div class=\"row\">" .
									"<div class=\"col-sm-12\">" .
										"<p class=\"product-desc\">" . $prod->short_desc . "</p>" .
									"</div>" .		
								"</div>" .
								"<div class=\"row text-center\">" .
									"<div class=\"col-sm-12\">" .
										"<h5 class=\"product-price\">" . 
											"$".number_format((float)$prod->unit_price, 2, ",", ".") . 
										"</h5>" .
									"</div>" .
								"</div>" .
								"<div class=\"row text-center product-links\">" .
									"<div class=\"col-sm-6\">" .
										"<a href=\"prod.php?pid=" . $prod->id . "\" class=\"product-detail\">Details</a>" .
									"</div>" .
									"<div class=\"col-sm-6\">" .
										"<a href=\"\" class=\"product-action\" data-pid=\"" . $prod->id . "\" 
									data-cat=\"" . $prod->cat_id . "\">Purchase</a>" .
									"</div>" .		
								"</div>" .
							"</div>" .
						"</div>";
					}
				?>
		</div>
		<div id="aside" class="col-sm-3">
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
						echo "<li><a href=\"http://" . HREF. "/products/" . $cat->id . "\">" . $n ."</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
	</div>