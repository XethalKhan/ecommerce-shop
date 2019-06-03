<div id="search" class="row">
	<div class="col-lg-12">
		<form id="formSearchCategory" action="" method="post">
			<div class="row search-row">
				<div class="col-sm-2 text-center">
					Name
				</div>
				<div class="col-sm-8">
					<input type="text" id="tbName" name="tbName" class="form-control"/>
				</div>
				<div class="col-sm-2 text-center">
					<input type="button" name="btnSearchCategory" id="btnSearchCategory" class="formBtn" value="Search"/>
				</div>
			</div>
			<div class="row search-row">
				<div class="col-sm-2 text-center">
					Description
				</div>
				<div class="col-sm-10">
					<textarea id="txtDesc" name="txtDesc" placeholder="Short description of category" class="form-control"></textarea>
				</div>
			</div>
			<div class="row search-row">
				<div class="col-md-12 text-center">
					<p id="errList">
					</p>
				</div>
			</div>
			<div class="row search-row">
				<div class="col-sm-12 text-center">
					<input type="button" name="btnResetCategory" id="btnResetCategory" class="formBtn" value="Reset"/>
					<input type="button" name="btnInsertCategory" id="btnInsertCategory" class="formBtn" value="Insert"/>
					<input type="hidden" name="catID" id="catID"/>
				</div>
			</div>
		</form>
	</div>
</div>
<div id="content" class="row table-responsive">
	<table class="table table-hover text-center" id="catTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$stmt = $conn->prepare("SELECT * FROM category");
				$stmt->execute();
				$rs=$stmt->fetchall();
				foreach($rs as $cat){
					echo 
						"<tr>" .
							"<td class=\"cat-name\">" . $cat->name. "</td>" .
							"<td class=\"cat-desc\">" . $cat->info. "</td>" .
							"<td><a href=\"#\" class=\"cat-update\" data-id=\"" . $cat->id . "\">Update</a></td>" .
						"</tr>";
				}
			?>
		</tbody>
	</table>
</div>