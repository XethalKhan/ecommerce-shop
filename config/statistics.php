<?php 
	if(STATISTICS=="on"){
		$name = date("dmy");

		$stats = file(BASE_FILE . "/data/statistics/" . $name . ".txt");

		$s = fopen(BASE_FILE . "/data/statistics/". $name . ".txt", "w");
		$page = substr($_SERVER['REDIRECT_URL'], strlen(SUBFOLDER));
		$found = false;
		$string = "";

		foreach($stats as $row){
			$row = explode("\t", trim($row));
			if($row[0] == $page){
				$cnt = intval($row[1]) + 1;
				$found = true;
				$string = $string . $row[0] . "\t" . $cnt . "\n";
			}else{
				$string = $string . $row[0] . "\t" . $row[1] . "\n";
			}
		}

		if($found == false){
			$string = $string . $page . "\t" . "1\n";
		}		

		fwrite($s, $string);

		fclose($s);
	}
?>