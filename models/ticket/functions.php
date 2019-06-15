<?php 
	
	function ticket_insert(
		$uid,		//USER ID
		$txt 		//TICKET TEXT
	){
		try{
			global $conn;

			$conn->beginTransaction();

			$stmt = $conn->prepare("INSERT INTO ticket(id_c, request) VALUES(:id_c, :request)");
			$stmt->bindParam(":id_c", $uid);
			$stmt->bindParam(":request", $txt);
			$test = $stmt->execute();

			if($test == true){
				$id = $conn->lastInsertId();
				$conn->commit();
				return $id;
			}else{
				$conn->rollBack();
				return 0;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return 0;
		}
	}

	function solve_ticket(
		$id 		//TICKET ID
	){
		try{
			global $conn;

			$conn->beginTransaction();

			$query = "UPDATE `ticket` SET status = 2 WHERE id = :id";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $id);
			if($stmt->execute() == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function dismiss_ticket(
		$id 		//TICKET ID
	){
		try{

			global $conn;

			$conn->beginTransaction();

			$query = "UPDATE `ticket` SET status = 1 WHERE id = :id";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $id);
			$test = $stmt->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function get_ticket_data(){
		try{
			global $conn;

			$stmt = $conn->prepare(
				"SELECT " .
					"t.id AS id, " .
				    "u.username AS username, " .
				    "t.date AS date, " .
				    "t.request AS request " .
				"FROM `ticket` t " .
				"INNER JOIN user u " .
				"ON t.id_c = u.id " . 
				"WHERE t.status = 0");
			$stmt->execute();
			$rs=$stmt->fetchall();

			return $rs;
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

	function ticket_search(
		$id,
		$date,
		$customer
	){
		try{
			global $conn;
			$param = [];

			$query = "SELECT " .
				"t.id AS id, " .
			    "u.username AS username, " .
			    "t.date AS date, " .
			    "t.request AS request " .
			"FROM `ticket` t " .
			"INNER JOIN user u " .
			"ON t.id_c = u.id " .
			"WHERE t.status = 0";

			if(!empty($customer)){
				$query = $query . " AND LOWER(u.username) LIKE ?";
				$customer = "%" . strtolower($customer) . "%";
				array_push($param, $customer);
			}else{
				$query = $query . " AND u.username = u.username";
			}

			if(!empty($id)){
				$query = $query . " AND t.id = ?";
				array_push($param, trim($id));
			}

			if(!empty($date)){
				$query = $query . " AND DATE(t.date) = ?";
				array_push($param, date('Y-m-d', strtotime($date)));
			}

			$stmt = $conn->prepare($query);

			$stmt->execute($param);
			$rs=$stmt->fetchAll();

			return $rs;

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

?>