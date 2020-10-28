<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	debugger($_POST,true);
	$user = new user();
	if(isset($_POST) && !empty($_POST)){
		if ($_POST['pass'] == $_POST['conPass']) {
				$data = array(
					'status' => 'Active',
				);
			debugger($data);
			if ($data) {
				$success = $user->addUser($data);
			}
			if ($success) {
				redirect('../login','success','Registered');
			}else{
				redirect('../register','error','Problem While Registering');
			}
		}else{
			redirect('../register','error',"Password doesn't match");
		}
	}else{
		redirect('../register','error','Unauthorized Access..');
	}
?>