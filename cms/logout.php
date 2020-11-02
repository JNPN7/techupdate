<?php
  include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$user = new user();
	$datas = array(
			'session_token' => ""
			);
	$user->updateUserbyEmail($datas,$_SESSION['user_email']);

	if (isset($_COOKIE['_auth_user']) && !empty($_COOKIE['_auth_user'])) {
		setcookie('_auth_user',"",time()-(60*60*24*7),'/');
	}
	session_unset();
	//echo $_SERVER['HTTP_REFERER'];
	if (strpos($_SERVER['HTTP_REFERER'], "cms") === false) {
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	else {
		redirect('login');
	}
?>