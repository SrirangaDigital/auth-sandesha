<script type="text/javascript">

	$(document).ready(function() {

		$( "#registerForm" ).submit(submitRegisterForm);
	});

</script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="registerForm" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Full Name</label>
					<input required type="text" class="form-control" name="fullname" id="fullname" aria-describedby="fullnameHelp" placeholder="Enter Full name">
					<small id="fullnameHelp" class="form-text text-muted">Full name.</small>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email address">
					<small id="emailHelp" class="form-text text-muted">Email address for registration.</small>
				</div>
				<div class="form-group">
					<label for="phone" class="col-form-label">Phone</label>
					<input pattern="\d*" class="form-control" type="text" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="Enter Contact Number" />
					<small id="phoneHelp" class="form-text text-muted">Phone accepts only digits without spaces</small>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input required type="password" class="form-control" name="password" id="password" placeholder="Password">
					<small id="passwordHelp" class="form-text text-muted">Password</small>
				</div>
				<input type="hidden" name="returnUrl" id="returnUrl" value="<?=$data['returnUrl']?>">
				<button id="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
