<div class="row" style="margin-top:25px">
	<div class="col-sm-8 text-center">
		<h3>Number of users who answered survey</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey");
			$stmt->execute();
			$rs=$stmt->fetch();
			$br = $rs->cnt;
			echo $br;
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>Gender</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Male</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE gender = 1");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Female</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE gender = 2");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Prefer not to say</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE gender = -1");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>How did you hear about us</h1>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Social media</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE findout = 1");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Advertise</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE findout = 2");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Friend</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE findout = 3");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Other</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM survey WHERE findout = 4");
			$stmt->execute();
			$rs=$stmt->fetch();
			echo $rs->cnt . " (". (double)$rs->cnt/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>Product offer grade</h1>
	</div>
</div>
<?php  
	$stmt = $conn->prepare("SELECT product, COUNT(*) AS cnt FROM survey GROUP BY product ORDER BY product ASC");
	$stmt->execute();
	$rs=$stmt->fetchall();
	foreach($rs as $grade){
		echo "<div class=\"row\">" .
				"<div class=\"col-sm-8 text-center\">" .
					"<h3>". $grade->product . "</h3>" .
				"</div>";
		echo "<div class=\"col-sm-4 text-center\">" . $grade->cnt . " (". (double)$grade->cnt/(double)$br*100 . "%)</div></div>";
	}
?>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>Delivery system grade</h1>
	</div>
</div>
<?php  
	$stmt = $conn->prepare("SELECT delivery, COUNT(*) AS cnt FROM survey GROUP BY delivery ORDER BY delivery ASC");
	$stmt->execute();
	$rs=$stmt->fetchall();
	foreach($rs as $grade){
		echo "<div class=\"row\">" .
				"<div class=\"col-sm-8 text-center\">" .
					"<h3>". $grade->delivery . "</h3>" .
				"</div>";
		echo "<div class=\"col-sm-4 text-center\">" . $grade->cnt . " (". (double)$grade->cnt/(double)$br*100 . "%)</div></div>";
	}
?>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>Type of products wanted</h1>
	</div>
</div>
<?php  
	$stmt = $conn->prepare("SELECT val, COUNT(*) AS cnt FROM survey_cbx GROUP BY val ORDER BY val ASC");
	$stmt->execute();
	$rs=$stmt->fetchall();
	foreach($rs as $grade){
		$type = "";
		switch($grade->val){
			case "1":
				$type = "Education";
				break;
			case "2":
				$type = "Energy";
				break;
			case "3":
				$type = "Green Tech";
				break;
			case "4":
				$type = "Fashion";
				break;
			case "5":
				$type = "Food";
				break;
			case "6":
				$type = "Beverages";
				break;
			case "7":
				$type = "Health";
				break;
			case "8":
				$type = "Fitness";
				break;
			case "9":
				$type = "Home";
				break;
			case "10":
				$type = "Phone";
				break;
			case "11":
				$type = "Accessories";
				break;
			case "12":
				$type = "Art";
				break;
			case "13":
				$type = "Tabletop games";
				break;
			case "14":
				$type = "Video games";
				break;
			default:
				$type = "N/A";
		}
		echo "<div class=\"row\">" .
				"<div class=\"col-sm-8 text-center\">" .
					"<h3>". $type . "</h3>" .
				"</div>";
		echo "<div class=\"col-sm-4 text-center\">" . $grade->cnt . " (". (double)$grade->cnt/(double)$br*100 . "%)</div></div>";
	}
?>