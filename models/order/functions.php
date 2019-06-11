<?php
	
	function order_add(
		$pid, 			//PRODUCT ID
		$number 		//NUMBER OF PRODUCTS - add = +1, minus = -1, int = concrete number
	){

		try{

			global $conn;

			if($number == "add"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] + 1;
			}else if($number == "minus"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] - 1;
			}else{
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = intval($number);
			}
			
			$prodids = array();
			foreach($_SESSION["order"] as $key=>$val){
				if($_SESSION["order"][$key] <= 0){
					unset($_SESSION["order"][$key]);
				}else{
					$prodids[] = $key;
				}
			}
			if(!(empty($prodids))){
				$instmt = "(" . implode(",", $prodids) . ")";
				$query = "SELECT id, name FROM product WHERE id IN " . $instmt;

				$stmt = $conn->prepare($query);
				$stmt->execute();
				$rs=$stmt->fetchall();

				$orderQ = array();
				foreach($rs as $names){
					$orderQ[] = 
						array(
							"id" => $names->id,
							"name" => $names->name,
							"number" => $_SESSION["order"][$names->id]);
				}

				return $orderQ;

			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = file(BASE_FILE . "/data/error/" . $name, "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return ["err" => $e->getMessage()];
		}

	}

?>