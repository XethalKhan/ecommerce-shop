<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>E-commerce | Profiles | Admin panel</title>
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
			$crm = new DB("root", "root");
			$conn = $crm->getInstance();

			require_once("view/header.php");
			require_once("view/nav.php");
	?>
	<div id="search" class="row">
		<div class="col-lg-12">
			<form id="formSearch" action="" method="post">
				<div class="row search-row">
					<div class="col-sm-3 text-center">
						Customer
					</div>
					<div class="col-sm-8">
						<input type="text" id="tbCustomer" name="tbCustomer" class="form-control"/>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								Firstname</span>
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbFn" name="tbFn" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Lastname
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbLn" name="tbLn" class="form-control"/>
							</div>
						</div>
					</div>
				</div>
				<div class="row search-row">
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6 text-center">
								E-mail
							</div>
							<div class="col-sm-5 text-center">
								<input type="text" id="tbMail" name="tbMail" class="form-control"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-5 text-center">
								Status
							</div>
							<div class="col-sm-5 text-center">
								<select id="ddlStatus" name="ddlStatus" class="form-control">
									<option value="-1">Choose . . .</option>
									<option value="0">Active</option>
									<option value="1">Disabled</option>
									<option value="2">Too many wrong passwords</option>
								</select>
							</div>
						</div>
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
						<input type="button" name="btnSearchUsers" id="btnSearchUsers" class="formBtn" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="content" class="row table-responsive">
		<table class="table table-hover text-center" id="userTable">
			<thead>
				<tr>
					<th>Customer</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>E-mail</th>
					<th>Status</th>
					<th>Profile</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$stmt = $conn->prepare(
						"SELECT " .
							"id, " .
							"username, " .
							"firstname, " .
							"lastname, " .
							"email, " .
							"status " .
						"FROM `user` ");
					$stmt->execute();
					$rs=$stmt->fetchall();
					foreach($rs as $user){
						switch($user->status){
							case 0:
								$stat = "Active";
								break;
							case 1:
								$stat = "Disabled";
								break;
							case 2:
								$stat = "Wrong passwords";
								break;
							default:
								$stat = "N/A";
						}
						echo 
							"<tr>" .
								"<td>" . $user->username . "</td>" .
								"<td>" . $user->firstname . "</td>" .
								"<td>" . $user->lastname . "</td>" .
								"<td>" . $user->email . "</td>" .
								"<td>" . $stat . "</td>" .
								"<td>" . "<a href=\"profile.php?uid=" . $user->id . "\">Profile</a>" . "</td>" .
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