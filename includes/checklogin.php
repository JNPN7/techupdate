<?php
$user = new user();
		if (isset($_SESSION['token']) && !empty($_SESSION['token'])){
			$user_info = $user->getUserbySessionToken($_SESSION['token']);
			if (!isset($user_info[0]->session_token) || empty($user_info[0]->session_token)) {
				redirect('logout');
			}else{
				if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login') {
				redirect('index','success','You already logged in .');
				}
			}
	}else{
		//session token not available
		if (isset($_COOKIE['_auth_user']) && !empty($_COOKIE['_auth_user'])){
			$token = $_COOKIE['_auth_user'];
			$user_info = $user->getUserbySessionToken($token);
			if (isset($user_info[0]->session_token) && !empty($user_info[0]->session_token)) {
				 $_SESSION['user_id'] = $user_info[0]->id;
				 $_SESSION['user_name'] = $user_info[0]->username;
				 $_SESSION['user_email'] = $user_info[0]->email;
				 $_SESSION['user_role'] = $user_info[0]->role;
				 $_SESSION['user_status'] = $user_info[0]->status;
				 $token = tokenize();
				 $_SESSION['token'] = $token;
				 $data = array(
				 		'session_token' => $token
				 	);
				 $user->updateUserbyEmail($data,$_SESSION['user_email']);
				 setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
				 if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login') {
				redirect('../index','success','Welcome to Dashboard.');
				}	
			}else{
				//logout
				setcookie('_auth_user_','',time()-100,'/');
				if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login') {
					redirect('login','error','You must logged in .');
				}
			}
		}
		if (pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login') {
			redirect('login','error','You must logged in .');
		}
		
	}
	

?>