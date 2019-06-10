<?php 
	if(STATISTICS=="on"){
		$name = date("dmy");
		$page = substr($_SERVER['REDIRECT_URL'], strlen(SUBFOLDER));

		//<DAILY STATISTICS>
		if(file_exists(BASE_FILE . "/data/statistics/" . $name . ".txt")){
			$stats = file(BASE_FILE . "/data/statistics/" . $name . ".txt");

			$s = fopen(BASE_FILE . "/data/statistics/". $name . ".txt", "w");
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
				$string = $string . $page . "\t1\n";
			}		

			fwrite($s, $string);

			fclose($s);
		}else{
			$s = fopen(BASE_FILE . "/data/statistics/". $name . ".txt", "a");
			fwrite($s, $page . "\t1\n");
			fclose($s);
		}
		//</DAILY STATISTICS>

		//<TOTAL STATISTICS>
		if(file_exists(BASE_FILE . "/data/statistics/total.txt")){
			$total_stats = file(BASE_FILE . "/data/statistics/total.txt");

			$s = fopen(BASE_FILE . "/data/statistics/total.txt", "w");
			$found = false;
			$string = "";

			foreach($total_stats as $row){
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
				$string = $string . $page . "\t1\n";
			}		

			fwrite($s, $string);

			fclose($s);
		}else{
			$s = fopen(BASE_FILE . "/data/statistics/total.txt", "a");
			fwrite($s, $page . "\t1\n");
			fclose($s);
		}
		//</TOTAL STATISTICS>
	}
?>