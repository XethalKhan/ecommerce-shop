<form id="formSignup" method="post" action="" clas="form-inline">
			<div class="row formRow">
				<div class="col-12 text-center">
					<h1>Sign-up</h1>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Firstname:<span class="err" id="fnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbFn" name="tbFn" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Lastname:<span class="err" id="lnErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbLn" name="tbLn" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">E-mail:<span class="err" id="mailErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbMail" name="tbMail" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbUserSign" name="tbUser" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Password:<span class="err" id="passErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbPassSign" name="tbPass" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Repeat password:<span class="err" id="passRepErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="password" id="tbPassRep" name="tbPassRep" class="form-control"/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">
					<p id="errList">
					</p>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-12 text-center">	
					<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
					<input type="button" name="btnSignup" id="btnSignup" class="formBtn" value="Sign-up"/>
					<br/><br/>
				</div>
			</div>
		</form>