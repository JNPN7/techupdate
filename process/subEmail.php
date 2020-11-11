<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';

	// $User = new user();
	// $user_info = $User->getUserbySessionToken($_SESSION['token']);
	$Contact = new contact();
	//$Categor = new contact();
	// debugger($_POST, true);
	 $act="Add";
	if($_POST){
		if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['message']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty(($_POST['message']))){
			$data = array(
			'username' => sanitize($_POST['username']),
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'message' => sanitize(htmlentities($_POST['message'])),
			'type' => 'message',
			'status' =>	'Active',
		);
		}else if(isset($_POST['email']) && empty($_POST['username']) && !empty($_POST['email']) && empty(($_POST['message']))){
			$data = array(
			'username' => 'user',
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'message' => $user_info[0]->username.' has subscribed you',
			'type' => 'subscription',
			'status' =>	'Active',
		);
		}
		if ($data) {
				$success = $Contact->addContact($data);
				// debugger($data, true);
		}else{
			redirect('../index','error','Contact Not Found');
		}
	if ($success) {
		redirect('../index','success','Contact '.$act.'ed Succesfully');
	}else{
		redirect('../index','error','Problem While '.$act.'ing Contact');
	}
}

?>