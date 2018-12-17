<script type="text/javascript"> $(document).ready(function() { $( "#passwordResetForm" ).submit(submitPasswordResetForm); }); </script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<h3>Forgot Password</h3>
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="passwordResetForm" method="POST">
				<div class="form-group">
					<label for="email">Email address</label>
					<input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email address">
					<small id="emailHelp" class="form-text text-muted">Use same email address registered with us.</small>
				</div>
				<button id="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>