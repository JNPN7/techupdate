<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$Comment = new comment();
	 debugger($_GET);
	
 if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$comment_id = (int)$_GET['id'];
		if ($comment_id) {
			$accept_act = substr(md5("Accept-Comment-".$comment_id.$_SESSION['token']), 3,15);
			$reject_act = substr(md5("Reject-Comment-".$comment_id.$_SESSION['token']), 3,15);
				if ($accept_act == $_GET['act']){
					$comment_info = $Comment->getCommentbyId($comment_id);
					if ($comment_info) {
						$data =  array(
							'state'=>'accept'
							);
						$success = $Comment->updateCommentbyId($data,$comment_id);
						if ($success) {
							redirect('../comment','success','Comment Accepted Succesfully.');
						}else{
							redirect('../comment','error','Error while Accepting.');
						}
					} else {
						redirect('../comment','error','Comment Not Found.');
					}
				}
				else if ($reject_act == $_GET['act']){
					$comment_info = $Comment->getCommentbyId($comment_id);
					if ($comment_info) {
						$data =  array(
							'state'=>'reject'
							);
						$success = $Comment->updateCommentbyId($data,$comment_id);
						if ($success) {
							redirect('../comment','success','Comment Rejected Succesfully.');
						}else{
							redirect('../comment','error','Error while Rejecting.');
						}
					} else {
						redirect('../comment','error','Comment Not Found.');
					}
				}
				else{
					redirect('../comment','error',"Invalid Action");
				}
		}else{
			redirect('../comment','error','Id is Invalid');
		}
	}else{
		redirect('../comment','error','Id is required.');
	}
}
else{
	redirect('../comment','error','Error Occurs during submitting');
}
?>