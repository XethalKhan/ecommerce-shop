<?php
	session_start();

	if(isset($_POST["btnUploadOrder"])){

		$c_id = $_SESSION["uid"];
		$req_date = $_POST["tbReqDate"];
		$req_date = date('Y-m-d', strtotime($req_date));
		$address = $_POST["tbAddress"];
		$city = $_POST["tbCity"];
		$country = $_POST["tbCountry"];
		$region = $_POST["tbRegion"];
		$postal = $_POST["tbPostal"];

		$id = order_complete($c_id, $req_date, $address, $city, $country, $region, $postal);

		unset($_SESSION["order"]);

		if($id != 0){
			header("Location: http://" . BASE_HREF . "/order/" . $id);
		}else{
			header("Location: http://" . BASE_HREF . "/order-complete");
		}
	}
?>