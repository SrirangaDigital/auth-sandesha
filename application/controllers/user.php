<?php

class user extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function testSession() {

		var_dump($_SESSION);
	}
	
	public function login($query = [], $type = '') {

		$returnUrl = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;

		$data['type'] = $type;
		$data['returnUrl'] = $returnUrl;
		$this->view('user/login', $data);
	}

	public function logout($query = []) {

		// Ideally this work should be done by the api, die to lack of inheritance, it is done here for now.
		$data['returnUrl'] = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;
		try {
		    $this->auth->logOutEverywhere();
		    $this->auth->destroySession();
		}
		catch (\Delight\Auth\NotLoggedInException $e) {

		    echo 'Not logged in';
		}

		$this->absoluteRedirect($data['returnUrl']);
	}

	public function resetPassword() {

		$this->view('user/resetPasswordEmail');
	}

	public function getResetPassword($query = []) {

		if(!isset($query['s']) || !isset($query['t'])) { $this->view('error/blah'); return;}

		$data['selector'] = $query['s'];
		$data['token'] = $query['t'];

		$this->view('user/getResetPassword', $data);
	}

	public function changePassword() {

		$this->view('user/changePassword');
	}

	public function register($query = []){

		$returnUrl = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;

		$data['returnUrl'] = $returnUrl;
		$this->view('user/register', $data);
	}

	public function assignRoleAsSubscriber($query, $email) {

		try {

		    $this->auth->admin()->addRoleForUserByEmail($email, \Delight\Auth\Role::SUBSCRIBER);
		    array_push($_SESSION['auth_roles_assigned'], 'SUBSCRIBER');
		}

		catch (\Delight\Auth\InvalidEmailException $e) {

		    echo 'Unknown email address';
		}
	}
}

?>
