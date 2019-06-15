<?php 
		$id = isset($_GET["id"]) ? $_GET["id"] : $_POST["uid"];
		if((isset($_SESSION["gid"]) && $_SESSION["gid"] == 1) || (isset($_SESSION["uid"]) && $_SESSION["uid"] == $id)):
?>
	<?php

			$rs = get_user_data_id($_GET["id"]);
	?>
	<form id="formSignup" method="post" action=<?php echo "'http://" . BASE_HREF."/user/change-info'";?> enctype="multipart/form-data" clas="form-inline">
		<div class="row formRow">
			<div class="col-12 text-center">
				<h1>Modify user info</h1>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Firstname:<span class="err" id="fnErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php echo "<input type=\"text\" id=\"tbFn\" name=\"tbFn\" class=\"form-control\" value=\"" . $rs->firstname . "\"/>"; ?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Lastname:<span class="err" id="lnErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php echo "<input type=\"text\" id=\"tbLn\" name=\"tbLn\" class=\"form-control\" value=\"" . $rs->lastname . "\"/>"; ?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">E-mail:<span class="err" id="mailErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php echo "<input type=\"text\" id=\"tbMail\" name=\"tbMail\" class=\"form-control\" value=\"" . $rs->email . "\"/>"; ?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-3 text-center">
				<h4 class="signupLabel">Username:<span class="err" id="userErr"></span></h4>
			</div>
			<div class="col-md-8">
				<?php echo "<input type=\"text\" id=\"tbUser\" name=\"tbUser\" class=\"form-control\" value=\"" . $rs->username . "\"/>"; ?>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">
				<p id="errList">
					<?php 
						if(isset($_SESSION["msg"])){
							echo $_SESSION["msg"] . "<br/>";
							unset($_SESSION["msg"]);
						}
					?>
				</p>
			</div>
		</div>
		<div class="row formRow">
			<div class="col-md-12 text-center">	
				<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
				<input type="submit" name="btnModUser" id="btnModUser" class="formBtn" value="Update"/>
				<br/><br/>
				<input type="hidden" id="uid" name="uid" <?php echo "value=\"" . $id . "\"";?>/>
			</div>
		</div>
	</form>
<?php else: ?>
<?php header("Location: http://" . BASE_HREF . "/home"); ?>
<?php endif; ?>