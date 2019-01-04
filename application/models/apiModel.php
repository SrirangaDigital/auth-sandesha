<?php

class apiModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function loadSessionVariables() {

		// To be used later

		$sth = $this->dbh->prepare('SELECT * FROM ' . USERDETAILS_TABLE . ' WHERE id=:id');
		$sth->bindParam(':id', $_SESSION['auth_user_id']);
		
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);

		$_SESSION['user_details'] = $result;

		// Include subscription details here, doing it here for the time being
		$isSubscriberUrl = SUBSCRIPTION_URL . 'subscription/isSubscriber/?email=' . $result['email'] . '&type=online';
		if($this->getDataFromCurl($isSubscriberUrl) == SUCCESS_PHRASE) $_SESSION['subscription_type'] = 'subscriber';
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
