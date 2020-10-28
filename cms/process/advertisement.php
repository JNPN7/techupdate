<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Advertisement = new advertisement();
	    //debugger($_POST,true);
	    //debugger($_FILES,true);
	if($_POST){
		$data = array(
			'url' => $_POST['url'],
			'caption' => htmlentities($_POST['caption']),
			'type' => $_POST['type'],
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
		);
		 // debugger($_FILES,true);

	if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error']==0) {
				$success=uploadImage($_FILES['image'],'advertisement');
				if ($success) {
					$data['image']=$success;
					if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'advertisement/'.$_POST['old_img'])) {
						unlink(UPLOAD_PATH.'advertisement/'.$_POST['old_img']);
					}
				}else{
					redirect('../ads','error','Error while Uploading Image.');
				}
			}		

	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$advertisement_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$advertisement_id = false;
	}

	if ($advertisement_id) {
		$advertisement_info = $Advertisement->getAdvertisementbyId($advertisement_id);
		if ($advertisement_info) {
			if ($_SESSION['user_id'] == $advertisement_info[0]->added_by) {
				// $Advertisement>addAdvertisement($data);
				$success = $Advertisement->updateAdvertisementbyId($data,$advertisement_id);
			}else{
				redirect('../ads','error','You are not allowed to edit.');
			}
		}else{
			redirect('../ads','error','Advertisement Not Found');
		}
	}else{
	debugger($data);		//Add	
	$success = $Advertisement->addAdvertisement($data);
	}
	if ($success) {
		redirect('../ads','success','Advertisement '.$act.'ed Succesfully');
	}else{
		redirect('../ads','error','Problem While '.$act.'ing Advertisement');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$advertisement_id = (int)$_GET['id'];
		if ($advertisement_id) {
			$act = substr(md5("Delete-Advertisement-".$advertisement_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$advertisement_info = $Advertisement->getAdvertisementbyId($advertisement_id);
					if ($advertisement_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Advertisement->updateAdvertisementbyId($data,$advertisement_id);
						if ($success) {
							redirect('../ads','success','Advertisement Deleted Succesfully.');
						}else{
							redirect('../ads','error','Error while Deleting.');
						}
					} else {
						redirect('../ads','error','Advertisement Not Found.');
					}
				}else{
					redirect('../ads','error',"Invalid Action");
				}
			}else{
				redirect('../ads','error','action is required');
			}
		}else{
			redirect('../ads','error','Id is Invalid');
		}
	}else{
		redirect('../ads','error','Id is required.');
	}
}
else{
	redirect('../ads','error','Error Occurs during submitting');
}
?>