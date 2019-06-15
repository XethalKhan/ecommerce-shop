<div class="row" style="margin-top:25px">
	<div class="col-sm-12 text-center">
		<h3>Pages visited today <?php echo date("d.m.Y");?></h3>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<td>Page</td>
					<td>Percent</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$name = date("dmy");
					$today = file(BASE_FILE . "/data/statistics/" . $name . ".txt");
					$cnt = 0;

					foreach($today as $row){
						$row = explode("\t", $row);
						$cnt = $cnt + (int) $row[1];
					}

					foreach($today as $row):
				?>
					<?php $row = explode("\t", $row);?>
					<tr>
						<td><?php echo $row[0];?></td>
						<td><?php echo number_format((float)((int)$row[1] / $cnt * 100), 2, ",", ".") . "%";?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<div class="row" style="margin-top:25px">
	<div class="col-sm-12 text-center">
		<h3>Pages visited total</h3>
	</div>
</div>
<div class="row">
	<div class="col-sm-12 text-center table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<td>Page</td>
					<td>Percent</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$name = date("dmy");
					$today = file(BASE_FILE . "/data/statistics/total.txt");
					$cnt = 0;

					foreach($today as $row){
						$row = explode("\t", $row);
						$cnt = $cnt + (int) $row[1];
					}

					foreach($today as $row):
				?>
					<?php $row = explode("\t", $row);?>
					<tr>
						<td><?php echo $row[0];?></td>
						<td><?php echo number_format((float)((int)$row[1] / $cnt * 100), 2, ",", ".") . "%";?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>