<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	include '../inc/checklogin.php';


	if($_POST){
		if(isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])){
			if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['newpassword']) && !empty($_POST['newpassword'])) {
				if($_POST['password']==$_POST['newpassword']){
					$user = new user();
					$user_info = $user->getUserbyEmail($_SESSION['user_email']);
					if($user_info){
						$password = sha1($_SESSION['user_email'].$_POST['oldpassword']);
						if($password==$user_info[0]->password){
							$data = array(
									'password' => sha1($user_info[0]->email.$_POST['password'])
								);
							$success=$user->updateUserbyEmail($data,$user_info[0]->email);
							if ($success) {
								redirect('../password-change','success','Password changed succesfully');
							}else{
								redirect('../password-change','error','Error during changing Password, Re-Try');
							}
						}else{
							redirect('../password-change','error','Old password is not correct');
						}
					}else{
						redirect('../logout');
					}
				}else{
					redirect('../password-change','error',"Password doesn't match!");
				}
			}else{
				redirect('../password-change','error','New Password Fields should not be empty');
			}
		}else{
			redirect('../password-change','error','Old Password Required!');
		}
	}else{
		redirect('../password-change','error','Unauthorized Access!');
	}
?>