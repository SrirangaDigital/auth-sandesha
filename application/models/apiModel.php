<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function loadSessionVariables($data) {

		// To be used later
		//$this->db->getData(USERDETAILS_TABLE, $this->dbh, $data);
	}

	public function insertUserDetails($data){

		unset($data['password']); unset($data['returnUrl']); unset($data['submit']);
		$this->db->insertData(USERDETAILS_TABLE, $this->dbh, $data);
	}

	public function setUserSessionVariables($auth, $data){

		if (!$auth->isLoggedIn()) {
		    return null;
		}

		if (!isset($_SESSION['_internal_user_info'])) {
		    // TODO: load your custom user information and assign it to the session variable below
		    // $_SESSION['_internal_user_info'] = ...

			$_SESSION['_internal_user_info'] = $data['phone'];
		}

		//return $_SESSION['_internal_user_info'];

	}
}

?>
