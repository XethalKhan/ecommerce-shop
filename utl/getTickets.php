<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		
		require_once("db.php");
		$crm = new DB("root", "root");
		$conn = $crm->getInstance();

		$query = "SELECT " .
					"t.id AS id, " .
				    "u.username AS username, " .
				    "t.date AS date, " .
				    "t.request AS request " .
				"FROM `ticket` t " .
				"INNER JOIN user u " .
				"ON t.id_c = u.id " .
				"WHERE t.status = 0";

		$id = $_POST["id"];
		$date = $_POST["date"];
		$customer = $_POST["customer"];
		
		if(!empty($customer)){
			$query = $query . " AND u.username = :customer";
		}else{
			$query = $query . " AND u.username = u.username";
		}

		if(!empty($id)){
			$query = $query . " AND t.id = :id";
		}

		if(!empty($date)){
			$query = $query . " AND DATE(t.date) = :date";
		}

		$stmt = $conn->prepare($query);

		if(!empty($customer)){
			$stmt->bindParam(":customer", $customer);
		}

		if(!empty($id)){
			$stmt->bindParam(":id", $id);
		}

		if(!empty($date)){
			$date = date('Y-m-d', strtotime($date));
			$stmt->bindParam(":date", $date);
		}

		$stmt->execute();
		$rs=$stmt->fetchAll();
		if(count($rs) > 0){
			http_response_code(200);
			echo json_encode($rs);
		}else{
			http_response_code(404);
			echo json_encode("Not found");
		}
	}else{
		http_response_code(401);
		echo json_encode("Login");
	}
?>