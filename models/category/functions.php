<?php 
	function category_insert(
		$name,        	//CATEGORY NAME
		$desc   		//CATEGORY DESCRIPTION
	){

		try{

			global $conn;

			$query = "INSERT INTO category(name, info) VALUES(:name, :info)";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":info", $desc);
			return $stmt->execute();

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}

	}

	function category_update(
		$id, 		//CATEGORY ID
		$name,		//CATEGORY NAME
		$desc   	//CATEGORY DESCRIPTION
	){
		try{
			global $conn;

			$query = "UPDATE category SET name = :name, info = :info WHERE id = :id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":id", $id);
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":info", $desc);
			return $stmt->execute();
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