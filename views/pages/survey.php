<form id="formSurvey" method="post" action="" clas="form-inline">
			<div class="row formRow">
				<div class="col-12 text-center">
					<h1>Survey</h1>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Your gender<span class="err" id="gndErr"></span></h4>
				</div>
				<div class="col-md-8">
					<input type="radio" id="rbGender" name="rbGender" value="1"/>Male<br/>
					<input type="radio" id="rbGender" name="rbGender" value="2"/>Female<br/>
					<input type="radio" id="rbGender" name="rbGender" value="-1" checked/>Prefer not to say
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Where did you first<br/>hear about us<span class="err" id="lnValErr"></span></h4>
				</div>
				<div class="col-md-8">
					<select id="ddlLearn" name="ddlLearn" class="form-control">
						<option value="0" selected>Choose . . .</option>
						<option value="1">Social media</option>
						<option value="2">Advertise</option>
						<option value="3">Friend</option>
						<option value="4">Other</option>
					</select>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">If you choose "Other"<br/>please tell us where
						<span class="err" id="lnTxtErr"></span>
					</h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbOther" name="tbOther" class="form-control" disabled/>
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">What type of products would you like to see more
						<span class="err" id="prodTypeErr"></span></h4>
				</div>
				<div class="col-md-8 text-center">
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="1"/>Education&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="2"/>Energy&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="3"/>Green Tech&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="4"/>Fashion&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="5"/>Food&nbsp;&nbsp;&nbsp;<br/>
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="6"/>Beverages&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="7"/>Health&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="8"/>Fitness&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="9"/>Home&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="10"/>Phone&nbsp;&nbsp;&nbsp;<br/>
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="11"/>Accessories&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="12"/>Art&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="13"/>Tabletop games&nbsp;&nbsp;&nbsp;
					<input type="checkbox" id="chkProdType" name="chkProdType[]" value="14"/>Video games&nbsp;&nbsp;&nbsp;
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Grade our product offer
						<span class="err" id="prodGradeErr"></span>
					</h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbProductOffer" name="tbProductOffer" class="form-control" placeholder="Grade from 1 (worst) to 10 (best)" />
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Grade our delivery
						<span class="err" id="delivGradeErr"></span>
					</h4>
				</div>
				<div class="col-md-8">
					<input type="text" id="tbDelivery" name="tbDlivery" class="form-control" placeholder="Grade from 1 (worst) to 10 (best)" />
				</div>
			</div>
			<div class="row formRow">
				<div class="col-md-3 text-center">
					<h4 class="signupLabel">Comment</h4>
				</div>
				<div class="col-md-8">
					<textarea id="txtComm" name="txtComm" class="form-control" rows="6"></textarea>
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
					<input type="button" name="btnSurvey" id="btnSurvey" class="formBtn" value="Send"/>
					<br/><br/>
				</div>
			</div>
		</form>