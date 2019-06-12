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

			list($sirina, $visina) = getimagesize($img_tmp_path);
			$smallSirina= 150;
			$mediumSirina= 200;
			$postojecaSlika = null;
			if( $img_type== "image/jpeg" ){ 
				$postojecaSlika= imagecreatefromjpeg($img_tmp_path); 
			}elseif( $img_type== "image/gif" ){
			  $postojecaSlika= imagecreatefromgif($img_tmp_path); 
			}elseif( $img_type== "image/png" ){
			 $postojecaSlika= imagecreatefrompng($img_tmp_path);
			}

			$smallPrazna = imagecreatetruecolor($smallSirina, ($smallSirina / $sirina) * $visina);
			imagecopyresampled($smallPrazna, $postojecaSlika, 0, 0, 0, 0, $smallSirina, ($smallSirina / $sirina) * $visina, $sirina, $visina);
			$novaSmall = $smallPrazna;

			$mediumPrazna = imagecreatetruecolor($mediumSirina, ($mediumSirina / $sirina) * $visina);
			imagecopyresampled($mediumPrazna, $postojecaSlika, 0, 0, 0, 0, $mediumSirina, ($mediumSirina / $sirina) * $visina, $sirina, $visina);
			$novaMedium = $mediumPrazna;

			if( $img_type== "image/jpeg" ){
			  imagejpeg($novaSmall,BASE_FILE . "/assets/images/small_" . $img_new_name,75);
			  imagejpeg($novaMedium,BASE_FILE . "/assets/images/medium_" . $img_new_name,75);
			}elseif( $img_type== "image/gif" ){
			  imagegif($novaSmall,BASE_FILE . "/assets/images/small_" . $img_new_name);
			  imagegif($novaMedium,BASE_FILE . "/assets/images/medium_" . $img_new_name);
			}elseif( $img_type== "image/png" ){
			  imagepng($novaSmall,BASE_FILE . "/assets/images/small_" . $img_new_name);
			  imagepng($novaMedium,BASE_FILE . "/assets/images/medium_" . $img_new_name); 
			 }

			move_uploaded_file($img_tmp_path, BASE_FILE . "/assets/images/original_" . $img_new_name);

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