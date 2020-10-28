<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	
	$Sale = new sale();
	 // debugger($_POST,true);
	if($_POST){
		$data = array(
			'categoryid' => (int)$_POST['categoryid'],
			'productname' => sanitize($_POST['salename']),
			'description' => htmlentities($_POST['description']),
			'productid' => (int)$_POST['productid'],
			'discount' => (int)$_POST['discount'],
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id'],
			// 'updated_date' => $_POST['updated_date']
		);
		// debugger($_FILES,true);
		if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error']==0) {
				$success=uploadImage($_FILES['image'],'sale');
				if ($success) {
					$data['image']=$success;
					if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'sale/'.$_POST['old_img'])) {
						unlink(UPLOAD_PATH.'sale/'.$_POST['old_img']);
					}
				}else{
					redirect('../sale','error','Error while Uploading Image.');
				}
			}

		// debugger($data);
	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$sale_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$sale_id = false;
	}

	if ($sale_id) {
		$sale_info = $Sale->getSalebyId($sale_id);
		// debugger($sale_info,true);	
		if ($sale_info) {
			if ($_SESSION['user_id'] == $sale_info[0]->added_by) {
				$success = $Sale->updateSalebyId($data,$sale_id);
			}else{
				redirect('../sale','error','You are not allowed to edit.');
			}
		}else{
			redirect('../sale','error','Sale Not Found');
		}
	}else{		//Add	
	$success = $Sale->addSale($data);
	}
	if ($success) {
		redirect('../sale','success','Sale '.$act.'ed Succesfully');
	}else{
		redirect('../sale','error','Problem While '.$act.'ing Sale');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$sale_id = (int)$_GET['id'];
		if ($sale_id) {
			$act = substr(md5("Delete-Sale-".$sale_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$sale_info = $Sale->getSalebyId($sale_id);
					if ($sale_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Sale->updateSalebyId($data,$sale_id);
						if ($success) {
							redirect('../sale','success','Sale Deleted Succesfully.');
						}else{
							redirect('../sale','error','Error while Deleting.');
						}
					} else {
						redirect('../sale','error','Sale Not Found.');
					}
				}else{
					redirect('../sale','error',"Invalid Action");
				}
			}else{
				redirect('../sale','error','action is required');
			}
		}else{
			redirect('../sale','error','Id is Invalid');
		}
	}else{
		redirect('../sale','error','Id is required.');
	}
}
else{
	redirect('../sale','error','Error Occurs during submitting');
}
?>