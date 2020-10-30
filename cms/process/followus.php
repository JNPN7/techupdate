<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$FollowUs = new followus();
	    //debugger($_POST,true);
	    //debugger($_FILES,true);
	if($_POST){
		$data = array(
			'iconname' => sanitize($_POST['iconname']),
			'url' => $_POST['url'],
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
		);
		 //debugger($data,true);		

	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$followus_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$followus_id = false;
	}

	if ($followus_id) {
		$followus_info = $FollowUs->getFollowUsbyId($followus_id);
		if ($followus_info) {
			if ($_SESSION['user_id'] == $followus_info[0]->added_by) {
				// $FollowUs>addFollowUs($data);
				$success = $FollowUs->updateFollowUsbyId($data,$followus_id);
			}else{
				redirect('../followus','error','You are not allowed to edit.');
			}
		}else{
			redirect('../followus','error','Data Not Found');
		}
	}else{		//Add	
	$success = $FollowUs->addFollowUs($data);
	}
	if ($success) {
		redirect('../followus','success', $act.'ed Succesfully');
	}else{
		redirect('../followus','error','Problem While '.$act.'ing');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$followus_id = (int)$_GET['id'];
		if ($followus_id) {
			$act = substr(md5("Delete-FollowUs-".$followus_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$followus_info = $FollowUs->getFollowUsbyId($followus_id);
					if ($followus_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $FollowUs->updateFollowUsbyId($data,$followus_id);
						if ($success) {
							redirect('../followus','success',' Deleted Succesfully.');
						}else{
							redirect('../followus','error','Error while Deleting.');
						}
					} else {
						redirect('../followus','error','Data Not Found.');
					}
				}else{
					redirect('../followus','error',"Invalid Action");
				}
			}else{
				redirect('../followus','error','action is required');
			}
		}else{
			redirect('../followus','error','Id is Invalid');
		}
	}else{
		redirect('../followus','error','Id is required.');
	}
}
else{
	redirect('../followus','error','Error Occurs during submitting');
}
?>