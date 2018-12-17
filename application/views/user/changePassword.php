<script type="text/javascript"> $(document).ready(function() { 	success_phrase = '<?=SUCCESS_PHRASE?>'; $( "#passwordChangeForm" ).submit(submitPasswordChangeForm); }); </script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<!-- <h3>Change Password</h3> -->
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="passwordChangeForm" method="POST">
				<div class="form-group">
					<label for="oldPassword">Old password</label>
					<input required type="password" class="form-control" name="oldPassword" id="oldPassword" aria-describedby="oldPassword" placeholder="Enter old password"><br />
					<label for="newPassword">New password</label>
					<input required type="password" class="form-control" name="newPassword" id="newPassword" aria-describedby="newPassword" placeholder="Enter new password">
				</div>
				<button id="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>