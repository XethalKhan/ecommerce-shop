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

	function get_categories(){
		try{
			global $conn;

			$stmt = $conn->prepare("SELECT * FROM category");
			$stmt->execute();
			$rs=$stmt->fetchAll();

			if($rs){
				return $rs;
			}else{
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

	function category_search(
		$name,
		$desc
	){
		try{

			global $conn;

			$query = "SELECT * FROM category";
			$input = false;
			$searchParam = [];

			if(!empty($name)){
				$input = true;
				$query = $query . " WHERE LOWER(name) LIKE ?";
				$name = "%" . strtolower($name) . "%";
				array_push($searchParam, $name);
			}else{
				$query = $query . " WHERE name = name";
			}

			if(!empty($desc)){
				$input = true;
				$query = $query . " AND LOWER(info) LIKE ?";
				$desc = "%" . strtolower($desc) . "%";
				array_push($searchParam, $desc);
			}else{
				$query = $query . " AND info = info";
			}

			$stmt = $conn->prepare($query);
			
			if($input){
				$stmt->execute($searchParam);
			}else{
				$stmt->execute();
			}

			$rs = $stmt->fetchAll();

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