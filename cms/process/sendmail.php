<?php
  include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
  // header for mailer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require $_SERVER['DOCUMENT_ROOT'].'/mail/Exception.php';
  require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer.php';
  require $_SERVER['DOCUMENT_ROOT'].'/mail/SMTP.php';
  // header for mailer
  $Blog = new blog();
  $Contacts = new contact();
  $contacts = $Contacts->getAllContact();
  // debugger($contacts,true);
if ($_GET) {    // SendMail
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    if ($blog_id) {
      $act = substr(md5("Send-Blog-".$blog_id.$_SESSION['token']), 3,15);
      if ($act) {
        if ($act == $_GET['act']){
          $blog_info = $Blog->getBlogbyId($blog_id);
          // debugger($blog_info,true);
          if ($blog_info) {
            if (isset($contacts) && !empty($contacts)) {
              foreach ($contacts as $key => $contact) {
                // debugger($blog_info['0']->title,true);
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
                $mail->addAddress($contact->email, $contact->email); // to email and name
                $mail->Subject = html_entity_decode($blog_info['0']->title);
                // $mail->msgHTML("Blog URL: http://www.manandharsudip.com.np/blog-post?id=23"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
                $mail->IsHTML(true);
                $mail->msgHTML(file_get_contents('http://techxx.ml/blogemail?id='.$blog_id));
                $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
                if (isset($blog_info['0']->image) && !empty($blog_info['0']->image)) {
                  $imageArray = explode(" ", $blog_info['0']->image);
                  // debugger($imageArray, true);
                  if(file_exists(UPLOAD_PATH.'blog/'.$imageArray[0])){  
                    $thumbnail = UPLOAD_URL.'blog/'.$imageArray[0];
                  }else{
                    $thumbnail = 'assets\images\logo\logo.png';
                  } 
                }else{
                  $thumbnail = 'assets\images\logo\logo.png';
                }
                $mail->addAttachment($thumbnail); //Attach an image file
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
                          // redirect('../index','success', $emails);
                          echo "Message sent";
                          $success = true;
                    }
            }
            // if ($success) {
            //   redirect('../blog','success','Mail Send Succesfully.');
            // }else{
            //   redirect('../blog','error','Error while Sending Mail.');
            // }
          } else {
            redirect('../blog','error','Blog Not Found.');
          }
        }else{
          redirect('../blog','error',"Invalid Action");
        }
      }else{
        redirect('../blog','error','action is required');
      }
    }else{
      redirect('../blog','error','Id is Invalid');
    }
  }else{
    redirect('../blog','error','Id is required.');
  }
}else{
  redirect('../blog','error','Error Occurs during submitting');
}
}
?>