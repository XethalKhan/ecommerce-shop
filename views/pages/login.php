<form id="formLogin" method="post" action=<?php echo "\"http://" . BASE_HREF . "/user/login\"";?>>
	<div class="row formRow">
		<div class="col-md-12 text-center">
			<img src = "assets/img/logo.png" width="150px" height="150px"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="text" id="tbUser" name="tbUser" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-3 text-center">
			<h4 class="signupLabel">Password:<span class="err" id="passErr"></span></h4>
		</div>
		<div class="col-md-8">
			<input type="password" id="tbPass" name="tbPass" class="form-control"/>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">
			<p id="errList">
				<?php 
					if(isset($_SESSION["msg"])){
						echo $_SESSION["msg"];
						unset($_SESSION["msg"]);
					}
				?>
			</p>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">	
			<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
			<input type="submit" name="btnSignup" id="btnSignup" class="formBtn" value="Sign-up"/>
			<br/><br/>
		</div>
	</div>
</form>