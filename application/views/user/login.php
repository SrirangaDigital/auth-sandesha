<script type="text/javascript">

$(document).ready(function() {

	$( "#loginForm" ).submit(submitLoginForm);
});

</script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<!-- <h3>Login</h3> -->
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="loginForm" method="POST">
				<!-- <div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input required type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">Use same email address registered with us.</small>
				</div> -->
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input required type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
					<small id="emailHelp" class="form-text text-muted">Registered Email.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input required type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
					<small id="forgotPasswordHelp" class="text-right form-text text-muted"><a href="<?=BASE_URL?>user/resetPassword">Forgot password?</a></small>
				</div>
				<input type="hidden" name="type" id="type" value="<?=$data['type']?>">
				<input type="hidden" name="returnUrl" id="returnUrl" value="<?=$data['returnUrl']?>">
				<button id="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
