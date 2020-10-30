<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$Product = new product();
	 // debugger($_POST);
	 // debugger($_FILES,true);
	if($_POST){
		$data = array(
			'productname' => sanitize($_POST['productname']),
			'description' => htmlentities($_POST['description']),
			'madeof' => htmlentities($_POST['madeof']),
			'acprice' => (int)$_POST['acprice'],
			'cprice' => (int)$_POST['cprice'],
			'featured' => sanitize($_POST['featured']),
			'size' => $_POST['size'],
			'weight' => $_POST['weight'],
			'categoryid' => (int)$_POST['categoryid'],
			'status' =>	'Active',
			'added_by' => $_SESSION['user_id']
		);
		//debugger(array_filter($_FILES['image']['name']),true);
		//debugger($_FILES['image'],true);

		if (isset($_FILES) && !empty($_FILES)){
			foreach ($_FILES['image']['error'] as $key => $err) {
				if($err==0){
					$condition = "valid";
				}
			}
		}
		if($condition=="valid"){
				$success = uploadMultiImage($_FILES['image'],'product');
				$data['image'] = $success;
				if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'product/'.$_POST['old_img'])) {
						unlink(UPLOAD_PATH.'product/'.$_POST['old_img']);
				}
		}else{
			redirect('../addproduct','error','Error while Uploading Image.');
		}
	// if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error']==0) {
	// 			$success = uploadImage($_FILES['image'],'product');
	// 			//debugger($success,true);
	// 			if ($success) {
	// 				$data['image'] = $success;
	// 				if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'product/'.$_POST['old_img'])) {
	// 					unlink(UPLOAD_PATH.'product/'.$_POST['old_img']);
	// 				}
	// 			}else{
	// 				redirect('../addproduct','error','Error while Uploading Image.');
	// 			}
	// 		}		

	if (isset($_POST['id']) && !empty($_POST['id'])) {
		$act = 'Updat';
		$product_id = (int)$_POST['id'];
	}else{
		$act = 'Add';
		$product_id = false;
	}

	if ($product_id) {
		$product_info = $Product->getProductbyId($product_id);
		//debugger($product_info);
		if ($product_info) {
				//debugger($_SESSION['user_id'],true);
			if ($_SESSION['user_id'] == $product_info[0]->added_by) {
				// $Product>addProduct($data);
				$success = $Product->updateProductbyId($data,$product_id);
			}else{
				redirect('../addproduct','error','You are not allowed to edit.');
			}
		}else{
			redirect('../addproduct','error','Product Not Found');
		}
	}else{		//Add	
	$success = $Product->addProduct($data);
	}
	if ($success) {
		redirect('../product','success','Product '.$act.'ed Succesfully');
	}else{
		redirect('../addproduct','error','Problem While '.$act.'ing Product');
	}
}else if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$product_id = (int)$_GET['id'];
		if ($product_id) {
			$act = substr(md5("Delete-Product-".$product_id.$_SESSION['token']), 3,15);
			if ($act) {
				if ($act == $_GET['act']){
					$product_info = $Product->getProductbyId($product_id);
					if ($product_info) {
						$data =  array(
							'status'=>'Passive'
							);
						$success = $Product->updateProductbyId($data,$product_id);
						if ($success) {
							redirect('../product','success','Product Deleted Succesfully.');
						}else{
							redirect('../product','error','Error while Deleting.');
						}
					} else {
						redirect('../product','error','Product Not Found.');
					}
				}else{
					redirect('../product','error',"Invalid Action");
				}
			}else{
				redirect('../product','error','action is required');
			}
		}else{
			redirect('../product','error','Id is Invalid');
		}
	}else{
		redirect('../product','error','Id is required.');
	}
}
else{
	redirect('../product','error','Error Occurs during submitting');
}
?>