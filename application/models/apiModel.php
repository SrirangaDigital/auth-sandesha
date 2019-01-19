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
		$isOnlineSubscriberUrl = SUBSCRIPTION_URL . 'subscription/isSubscriber/?email=' . $result['email'] . '&type=online';
		$isPrintSubscriberUrl = SUBSCRIPTION_URL . 'subscription/isSubscriber/?email=' . $result['email'] . '&type=print';

		$_SESSION['subscription_type'] = [];
		if($this->getDataFromCurl($isOnlineSubscriberUrl) == SUCCESS_PHRASE) array_push($_SESSION['subscription_type'], 'subscriber;online');
		if($this->getDataFromCurl($isPrintSubscriberUrl) == SUCCESS_PHRASE) array_push($_SESSION['subscription_type'], 'subscriber;print');
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

	public function getFullname($email) {

		$sth = $this->dbh->prepare('SELECT * FROM ' . USERDETAILS_TABLE . ' WHERE email=:email');
		$sth->bindParam(':email', $email);
		
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);

		return ($result) ? $result['fullname'] : '';
	}

	public function sendLetterToPostman ($data, $url) {

		$mail = new PHPMailer();

	    $mail->isSMTP();
    	$mail->Host = 'smtp.gmail.com';
    	$mail->Port = 587;
    	$mail->SMTPSecure = 'tls';
    	$mail->SMTPAuth = true;
    	$mail->Username = SERVICE_EMAIL;
    	$mail->Password = SERVICE_EMAIL_PASSWORD;
    	$mail->setFrom(SERVICE_EMAIL, SERVICE_NAME);
    	$mail->addAddress($data['email'], $data['fullName']);
    	$mail->Subject = PASSWORD_RESET;
    	$mail->msgHTML($this->generateBody($url, $data['fullName']));

        return ( $mail->send() ) ? 'true' : $mail->ErrorInfo;
 	}

 	public function generateBody($url, $name) {

 		$html = 'Dear, ' . $name . '<br />';
		$html .= '<p>Here is a link you can use within the next 24 hours to reset your password. If you haven\'t requested for this, you may ignore this email.</p>';
		$html .= '<p><a href="' . $url . '">' . $url . '</a></p>';
		$html .= '<p>Regards,<br />' . SERVICE_NAME . '</p>';
		
		return $html;
 	}
}

?>
