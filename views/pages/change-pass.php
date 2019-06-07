<form id="formLogin" method="post" action="utl/login.php" clas="form-inline">
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Old password:<span class="err" id="oldErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="password" id="tbOld" name="tbOld" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">New password:<span class="err" id="newPassErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="password" id="tbNewPass" name="tbNewPass" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Repeat new password:<span class="err" id="newPassRepErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="password" id="tbNewPassRep" name="tbNewPassRep" class="form-control"/>
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
			<input type="button" name="btnChangePass" id="btnChangePass" class="formBtn" value="Change"/>
			<br/><br/>
		</div>
	</div>
</form>