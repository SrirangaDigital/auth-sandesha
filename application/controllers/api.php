<?php

class api extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function login() {

		$postData = $this->model->getPostData();
		
		try {

		    $this->auth->login($postData['lemail'], $postData['lpassword']);
		    $this->model->loadSessionVariables();
		    
    		$_SESSION['auth_roles_assigned'] = $this->auth->getRoles();

		    echo($postData['lreturnUrl']);
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    
		    echo 'Wrong email address';
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    
		    echo 'Wrong password';
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    
		    echo 'Email not verified';
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    
		    echo 'Too many requests';
		}
	}

	public function initiateResetPassword() {

		
		try {
				$postData = $this->model->getPostData();
				
		    	$this->auth->forgotPassword($postData['email'], function ($selector, $token) use ($postData){
					
					// Send mail
					$this->model->sendLetterToPostman($postData['email'], DEFAULT_RETURN_URL . 'user/resetPassword?s=' . $selector . '&t=' . $token);
			    	echo SUCCESS_PHRASE;

		    	});

		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo ('invalid email address');
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    echo ('email not verified');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('An email have been already sent to your email, Please check out');
		}
	}

	public function confirmResetPasswordValidity() {

		$getData = $this->model->getGETData();

		try {
		    $this->auth->canResetPasswordOrThrow($getData['s'], $getData['t']);

		    echo SUCCESS_PHRASE;
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    echo ('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    echo ('token expired');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('too many requests');
		}
	}

	public function resetPassword() {

		$postData = $this->model->getPostData();
		if($postData['password'] != $postData['confirmPassword']) { echo "Passwords Don't Match"; return; }

		try {
		    $this->auth->resetPassword($postData['selector'], $postData['token'], $postData['password']);

		    echo SUCCESS_PHRASE;
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    echo ('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    echo ('token expired');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo ('invalid password');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('too many requests');
		}
	}

	public function register() {

		$postData = $this->model->getPostData();
		$postData['username'] = '';
		
		try {

		    $postData['id'] = $this->auth->admin()->createUser($postData['email'], $postData['password'], $postData['username']);
			$this->model->insertUserDetails($postData);

			try {
			    
			    $this->auth->admin()->logInAsUserByEmail($postData['email']);
			    $_SESSION['auth_roles_assigned'] = [];
				$this->model->loadSessionVariables();

			    echo $postData['returnUrl'];		    
			}
			catch (\Delight\Auth\InvalidEmailException $e) {
			    
			    echo 'Unknown email address';
			}
			catch (\Delight\Auth\EmailNotVerifiedException $e) {
			    
			    echo 'Email address not verified';
			}
		}

		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo 'Invalid email address';
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo 'Invalid password';
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    echo 'User already exists';
		}
	}

	public function confirmEmail() {

		$selector = 'v4NBLJuEHRuyXDvU';
		$token = "6MbPmChc_LrYpX9d";

		try {
		    $this->auth->confirmEmail($selector, $token);

		    echo('email address has been verified');
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    
		    echo('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    
		    echo('token expired');
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    
		    echo('email address already exists');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    
		    echo('too many requests');
		}
	}

	public function logout() {

		try {
		    $this->auth->logOutEverywhere();
		    $this->auth->destroySession();
		}
		catch (\Delight\Auth\NotLoggedInException $e) {

		    echo 'Not logged in';
		}
	}

	private function changePassword() {

		$postData = $this->model->getPostData();

		try {

		    $this->auth->changePassword($postData['oldPassword'], $postData['newPassword']);

		    echo SUCCESS_PHRASE;
		}
		catch (\Delight\Auth\NotLoggedInException $e) {
		
			echo('Not logged in');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
			
			echo('Invalid password(s)');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
			
			echo('Too many requests');
		}
	}
}
?>
