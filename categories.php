<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce</title>
	<meta charset="utf-8">
	<!--STYLESHEET-->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/search.css">
	<!--/STYLESHEET-->
	<!--FONT AWESOME 5 ICONS-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!--/FONT AWESOME 5 ICONS-->
	<!--BOOTSTRAP-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->
    <script src="js/script.js"></script>
</head>
<body class="container-fluid">
	<?php 
			error_reporting(E_ALL);
			require_once("utl/db.php");
			$crm = new DB("id8082146_root", "faksc0ece");
			$conn = $crm->getInstance();

			require_once("view/header.php");
			require_once("view/nav.php");
	?>
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
	<?php
			require_once("view/footer.php");
	?>
</body>
</html>