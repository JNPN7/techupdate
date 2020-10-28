<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($_POST,true);
	$data = array();
	if($_POST){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$strip = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
			$data['email'] = filter_var($strip,FILTER_VALIDATE_EMAIL);
			if($data['email']){
				if(isset($_POST['pass']) && !empty($_POST['pass'])){
					$data['pass'] = sha1($data['email'].$_POST['pass']);
					$User = new user();
					$user_info = $User->getUserbyEmail($data['email']);
					// debugger($data);
					// debugger($_POST);
					// debugger($user_info,true);
					if(isset($user_info) && !empty($user_info)){
						if(isset($user_info[0]->email) && !empty($user_info[0]->email)){
							if($user_info[0]->password==$data['pass']){
								if($user_info[0]->status=='Active'){
									 $_SESSION['user_id'] = $user_info[0]->id;
									 $_SESSION['user_name'] = $user_info[0]->username;
									 $_SESSION['user_email'] = $user_info[0]->email;
									 $_SESSION['user_role'] = $user_info[0]->role;
									 $_SESSION['user_status'] = $user_info[0]->status;
									 $token = tokenize();
									 $_SESSION['token'] = $token;
									 $datas = array(
									 	'session_token' =>$token,
									 );
								$User->updateUserbyEmail($datas, $_SESSION['user_email']);
								}
								if (isset($_POST['rememberme']) && !empty($_POST['rememberme']) && $_POST['rememberme']=='on'){
									setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
									// debugger($data);
									// debugger($user_info,true);
								}redirect('../index','success','Welcome '.$user_info[0]->username);
							}else{
								redirect('../login','error',"Password doesn't Match. Please Register");
							}
						}else{
							redirect('../login','error','email not found. Please Register');
						}
					}else{
						redirect('../login','error',"email and password doesn't found");
					}
				}else{
					redirect('../login','error','Password is required.');
				}
			}else{
				redirect('../login','error','Invalid Email/Username.');
			}
		}else{
			redirect('../login','error','email is required.');
		}
	}else{
		redirect('../login','error','Unauthorized Access..');
	}
?>