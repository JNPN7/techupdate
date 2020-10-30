<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$Contactinfo = new contactinfo();
	 // debugger($_POST,true);
	if($_POST){
		$data = array(
			'maplink' => sanitize($_POST['maplink']),
			'description' => sanitize(htmlentities($_POST['description'])),
			'address' => sanitize($_POST['address']),
			'phone_number' => (int)$_POST['contactnumber'],
			'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id'],
			// 'updated_date' => $_POST['updated_date']
		);

		// debugger($data,true);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$contactinfo_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$contactinfo_id = false;
	}

	if ($contactinfo_id) {
		$contactinfo_info = $Contactinfo->getContactinfobyId($contactinfo_id);
		if ($contactinfo_info) {
			// debugger($contactinfo_info,true);	
			if ($_SESSION['user_id'] == $contactinfo_info[0]->added_by) {
				$success = $Contactinfo->updateContactinfobyId($data,$contactinfo_id);
			}else{
				redirect('../contactinfo','error','You are not allowed to edit.');
			}
		}else{
			redirect('../contactinfo','error','Contactinfo Not Found');
		}
	}else{		//Add	
	$success = $Contactinfo->addContactinfo($data);
	}
	if ($success) {
		redirect('../contactinfo','success','Contactinfo '.$act.'ed Succesfully');
	}else{
		redirect('../contactinfo','error','Problem While '.$act.'ing Contactinfo');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$contactinfo_id = (int)$_GET['id'];
		if ($contactinfo_id) {
			$act = substr(md5("Delete-Contactinfo-".$contactinfo_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$contactinfo_info = $Contactinfo->getContactinfobyId($contactinfo_id);
					if ($contactinfo_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Contactinfo->updateContactinfobyId($data,$contactinfo_id);
						if ($success) {
							redirect('../contactinfo','success','Contactinfo Deleted Succesfully.');
						}else{
							redirect('../contactinfo','error','Error while Deleting.');
						}
					} else {
						redirect('../contactinfo','error','Contactinfo Not Found.');
					}
				}else{
					redirect('../contactinfo','error',"Invalid Action");
				}
			}else{
				redirect('../contactinfo','error','action is required');
			}
		}else{
			redirect('../contactinfo','error','Id is Invalid');
		}
	}else{
		redirect('../contactinfo','error','Id is required.');
	}
}
else{
	redirect('../contactinfo','error','Error Occurs during submitting');
}
?>