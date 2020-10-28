<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';

	// Mailer-Header Starts
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require $_SERVER['DOCUMENT_ROOT'].'/mail/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'].'/mail/SMTP.php';
    // Mailer-Header Ends
	// debugger($_POST,true);
	$localtoken = time();
	// debugger(strtotime($localtoken),true);
	$user = new user();
	if(isset($_POST) && !empty($_POST)){
		if(isset($_POST['token']) && !empty($_POST['token'])){
			$req_email = $_POST['email'];
			$users = $user->getUserbyEmailPassive($req_email);
			$req_token = $users['0']->activate_token;
			if($_POST['token']==$req_token){
				$data = array(
					'status' => 'Active',
				);
				if ($data) {
					// debugger($req_email,true);
					$success = $user->updateUserbyEmail($data, $req_email);
				}
				if($success){
					// debugger($req_email, true);
					redirect('../login','success','Registered');
				}
			}else{
				echo "token incorrect";
			} 
		}else{
			$_SESSION['fortoken'] = $_POST['email'];
		if ($_POST['pass'] == $_POST['conPass']) {
				$data = array(
					'fullname' => sanitize($_POST['name']),
					'username' => sanitize($_POST['username']),
					'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
					'password' => sha1(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL).sanitize($_POST['pass'])),
					'activate_token' => time(),
					'status' => 'Passive',
				);
			// debugger($data,true);
			if ($data) {
				$success = $user->addUser($data);
				// debugger($_POST,true);
			}
			$to_email = array("manandharsudip8@gmail.com");
			if ($success) {
				$mail = new PHPMailer;
			    $mail->isSMTP(); 
			    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
			    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
			    $mail->Port = 587; // TLS only
			    $mail->SMTPSecure = 'tls'; // ssl is deprecated
			    $mail->SMTPAuth = true;
			    $mail->Username = 'manandharsudip4@gmail.com'; // email
			    $mail->Password = 'validatepwd456'; // password
			    $mail->setFrom('manandharsudip4@gmail.com', 'Tech Max'); // From email and name
			    $mail->addAddress($_POST['email'], 'TechGais'); // to email and name
			    $mail->Subject = 'Verification Token';
			    $mail->msgHTML("Verification token: ".$data['activate_token']); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
			    $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
			    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
			    $mail->SMTPOptions = array(
			                        'ssl' => array(
			                            'verify_peer' => false,
			                            'verify_peer_name' => false,
			                            'allow_self_signed' => true
			                        )
			                    );
			                    
			                    if(!$mail->send()){
			                        echo "Mailer Error: " . $mail->ErrorInfo;
			                    }else{
			                        redirect('../verification','success',$data['email']);
			    }
			}else{
				redirect('../register','error','Problem While Registering');
			}
		}else{
			redirect('../register','error',"Password doesn't match");
		}
	}
	}else{
		redirect('../register','error','Unauthorized Access..');
	}
?>