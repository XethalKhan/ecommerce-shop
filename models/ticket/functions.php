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

?>