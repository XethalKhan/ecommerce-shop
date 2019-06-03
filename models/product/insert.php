<?php
	$status = "";
	$test = true;

	if(isset($_POST["btnUploadProd"])){
		$name = $_POST["tbName"];
		$shortDesc = $_POST["tbShortDesc"];
		$longDesc = $_POST["tbLongDesc"];
		$cat = $_POST["ddlProdCategory"];
		$unit = $_POST["tbUnit"];
		$price = $_POST["tbUnitPrice"];
		$stock = $_POST["tbUnitStock"];
		$discount = $_POST["tbDiscount"];

		$img = $_FILES["prodimg"];
		$img_name = $img["name"];
		$img_type = $img["type"];
		$img_tmp_path = $img["tmp_name"];

		if($img_type != "image/jpg" && $img_type != "image/jpeg" && $img_type != "image/png" && $img_type != "image/gif"){
			$test = false;
			$status = "Uploaded file must be .jpg, .jpeg, .png or .gif";
		}

		if($test == true){
			$img_new_name = time() . $img_name;
			move_uploaded_file($img_tmp_path, BASE_FILE . "/assets/images/" . $img_new_name);

			$stmt = $conn->prepare(
				"INSERT INTO product(" .
					"name, " .
					"short_desc, " .
					"long_desc, " .
					"cat_id, " .
					"unit, ".
					"unit_price, ".
					"unit_in_stock, ".
					"img, ".
					"discount) " .
				"VALUES(" .
					":name, " .
					":short_desc, " .
					":long_desc, " .
					":cat_id, " .
					":unit, " .
					":unit_price, " .
					":unit_stock, " .
					":img, " .
					":discount)");

			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":short_desc", $shortDesc);
			$stmt->bindParam(":long_desc", $longDesc);
			$stmt->bindParam(":cat_id", $cat);
			$stmt->bindParam(":unit", $unit);
			$stmt->bindParam(":unit_price", $price);
			$stmt->bindParam(":unit_stock", $stock);
			$stmt->bindParam(":img", $img_new_name);
			$stmt->bindParam(":discount", $discount);

			$test = $stmt->execute();

			if($test == true){
				$status = "Upload successfull!";
			}
		}

		$_SESSION["msg"] = $status;
		header("Location: http://" . BASE_HREF . "/new-product");
	}
?>