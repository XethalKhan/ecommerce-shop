<form id="formTicket" method="post" action="" clas="form-inline">
	<div class="row formRow">
		<div class="col-md-12 text-center">
			<h1>New ticket<span id="txtErr" class="err"></span></h1>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">
			<textarea id="txtTicket" name="txtTicket" rows="10" class="form-control" placeholder="Describe issue of our services here, at least 50 characters"></textarea>
		</div>
	</div>
	<div class="row formRow">
		<div class="col-md-12 text-center">	
			<input type="reset" name="btnReset" id="btnReset" class="formBtn" value="Reset"/>
			<input type="button" name="btnNewTicket" id="btnNewTicket" class="formBtn" value="New ticket"/>
			<br/><br/>
		</div>
	</div>
</form>