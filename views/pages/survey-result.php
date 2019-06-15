<div class="row" style="margin-top:25px">
	<div class="col-sm-8 text-center">
		<h3>Number of users who answered survey</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			$br = survey_count();
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
			$gender = survey_gender();
			$male = 0;
			$female = 0;
			$none = 0;

			foreach($gender as $row){
				switch($row->gender){
					case 1:
						$male = $row->cnt;
						break;
					case 2:
						$female = $row->cnt;
						break;
					case -1:
						$none = $row->cnt;
						break;

				}
			}

			echo $male . " (". (double)$male/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Female</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			echo $female . " (". (double)$female/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Prefer not to say</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			echo $none . " (". (double)$none/(double)$br*100 . "%)";
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
			$findout = survey_findout();
			$social = 0;
			$advertise = 0;
			$friend = 0;
			$other = 0;

			foreach($findout as $row){
				switch($row->findout){
					case 1:
						$social = (int)$row->cnt;
						break;
					case 2:
						$advertise = (int)$row->cnt;
						break;
					case 3:
						$friend = (int)$row->cnt;
						break;
					case 4:
						$other = (int)$row->cnt;
						break;

				}
			}
			echo $social . " (". (double)$social/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Advertise</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			echo $advertise . " (". (double)$advertise/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Friend</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			echo $friend . " (". (double)$friend/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 text-center">
		<h3>Other</h3>
	</div>
	<div class="col-sm-4 text-center">
		<?php 
			echo $other . " (". (double)$other/(double)$br*100 . "%)";
		?>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center">
		<h1>Product offer grade</h1>
	</div>
</div>
<?php  
	$rs=survey_product_grade();
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
	$rs=survey_delivery_grade();
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
	$rs=survey_product_types();
	foreach($rs as $grade){
		echo "<div class=\"row\">" .
				"<div class=\"col-sm-8 text-center\">" .
					"<h3>". $grade->name . "</h3>" .
				"</div>";
		echo "<div class=\"col-sm-4 text-center\">" . $grade->cnt . " (". (double)$grade->cnt/(double)$br*100 . "%)</div></div>";
	}
?>