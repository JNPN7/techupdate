<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$BlogCategory = new blogcategory();
	 // debugger($_POST,true);
	if($_POST){
		$data = array(
			'categoryname' => sanitize($_POST['categoryname']),
			'description' => htmlentities($_POST['description']),
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id'],
			// 'updated_date' => $_POST['updated_date']
		);
		// debugger($_FILES,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error']==0) {
				$success=uploadImage($_FILES['image'],'blogcategory');
				if ($success) {
					$data['image']=$success;
					if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'blogcategory/'.$_POST['old_img'])) {
						unlink(UPLOAD_PATH.'blogcategory/'.$_POST['old_img']);
					}
				}else{
					redirect('../blogcategory','error','Error while Uploading Image.');
				}
			}

		// debugger($data);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$blogcategory_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$blogcategory_id = false;
	}

	if ($blogcategory_id) {
		$blogcategory_info = $BlogCategory->getBlogCategorybyId($blogcategory_id);
		// debugger($blogcategory_info,true);	
		if ($blogcategory_info) {
			if ($_SESSION['user_id'] == $blogcategory_info[0]->added_by) {
				$success = $BlogCategory->updateBlogCategorybyId($data,$blogcategory_id);
			}else{
				redirect('../blogcategory','error','You are not allowed to edit.');
			}
		}else{
			redirect('../blogcategory','error','BlogCategory Not Found');
		}
	}else{		//Add	
	$success = $BlogCategory->addBlogCategory($data);
	}
	if ($success) {

		redirect('../blogcategory','success','BlogCategory '.$act.'ed Succesfully');
	}else{
		redirect('../blogcategory','error','Problem While '.$act.'ing BlogCategory');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$blogcategory_id = (int)$_GET['id'];
		if ($blogcategory_id) {
			$act = substr(md5("Delete-BlogCategory-".$blogcategory_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$blogcategory_info = $BlogCategory->getBlogCategorybyId($blogcategory_id);
					if ($blogcategory_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $BlogCategory->updateBlogCategorybyId($data,$blogcategory_id);
						if ($success) {
							redirect('../blogcategory','success','BlogCategory Deleted Succesfully.');
						}else{
							redirect('../blogcategory','error','Error while Deleting.');
						}
					} else {
						redirect('../blogcategory','error','BlogCategory Not Found.');
					}
				}else{
					redirect('../blogcategory','error',"Invalid Action");
				}
			}else{
				redirect('../blogcategory','error','action is required');
			}
		}else{
			redirect('../blogcategory','error','Id is Invalid');
		}
	}else{
		redirect('../blogcategory','error','Id is required.');
	}
}
else{
	redirect('../blogcategory','error','Error Occurs during submitting');
}
?>