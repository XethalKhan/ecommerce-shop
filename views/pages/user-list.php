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
					$rs=get_users();
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
								"<td>" . "<a href=\"http://" . BASE_HREF . "/user/" . $user->id . "\">Profile</a>" . "</td>" .
							"</tr>";
					}
				?>
			</tbody>
		</table>
	</div>