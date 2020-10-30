<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$Query = new query();
	 debugger($_GET);
	
 if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$query_id = (int)$_GET['id'];
		if ($query_id) {
			$accept_act = substr(md5("Accept-Query-".$query_id.$_SESSION['token']), 3,15);
			$reject_act = substr(md5("Reject-Query-".$query_id.$_SESSION['token']), 3,15);
				if ($accept_act == $_GET['act']){
					$query_info = $Query->getQuerybyId($query_id);
					if ($query_info) {
						$data =  array(
							'state'=>'accept'
							);
						$success = $Query->updateQuerybyId($data,$query_id);
						if ($success) {
							redirect('../query','success','Query Accepted Succesfully.');
						}else{
							redirect('../query','error','Error while Accepting.');
						}
					} else {
						redirect('../query','error','Query Not Found.');
					}
				}
				else if ($reject_act == $_GET['act']){
					$query_info = $Query->getQuerybyId($query_id);
					if ($query_info) {
						$data =  array(
							'state'=>'reject'
							);
						$success = $Query->updateQuerybyId($data,$query_id);
						if ($success) {
							redirect('../query','success','Query Rejected Succesfully.');
						}else{
							redirect('../query','error','Error while Rejecting.');
						}
					} else {
						redirect('../query','error','Query Not Found.');
					}
				}
				else{
					redirect('../query','error',"Invalid Action");
				}
		}else{
			redirect('../query','error','Id is Invalid');
		}
	}else{
		redirect('../query','error','Id is required.');
	}
}
else{
	redirect('../query','error','Error Occurs during submitting');
}
?>