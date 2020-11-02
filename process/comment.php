<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$User = new user();
	$Comment = new comment();
	//$Categor = new comment();
	if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
		$user_info = $User->getUserbySessionToken($_SESSION['token']);
	}
	// debugger($_POST, true);
	 $act="Add";
	if($_POST){
		$data = array(
			'name' => $user_info[0]->username,
			'message' => sanitize(htmlentities($_POST['message'])),
			'status' =>	'Active',
			'blogid' => (int)$_POST['blogid'],
			'state' => 'accept'
			// 'updated_date' => 
		);
	if (isset($_POST['commentid']) && !empty($_POST['commentid'])) {
		//reply
		$comment_id = (int)$_POST['commentid'];
		$data['commentid'] = $comment_id;
		$data['commentType'] = 'reply';
		// debugger($data, true);
	}else{
		//comment
		$comment_id = false;
		$data['commentType'] = 'comment';
	}
	// debugger($comment_id, true);	
	if ($comment_id) {
		$comment_info = $Comment->getCommentbyId($comment_id);
		if ($comment_info) {
				$success = $Comment->addComment($data);
				// debugger($data, true);
		}else{
			redirect('../blog?id='.$data['blogid'],'error','Comment Not Found');
		}
	}else{		//Add	
	$success = $Comment->addComment($data);
	// debugger($data, true);
	}
	if ($success) {
		redirect('../blog?id='.$data['blogid'],'success','Comment '.$act.'ed Succesfully');
	}else{
		redirect('../blog?id='.$data['blogid'],'error','Problem While '.$act.'ing Comment');
	}
}

?>