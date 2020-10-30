<?php
  include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
  
  $Contact = new contact();
   debugger($_GET);
  
 if ($_GET) {   //Delete
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $contact_id = (int)$_GET['id'];
    if ($contact_id) {
      $seen_act = substr(md5("Seen-Contact-".$contact_id.$_SESSION['token']), 3,15);
      $delete_act = substr(md5("Delete-Contact-".$contact_id.$_SESSION['token']), 3,15);
        if ($seen_act == $_GET['act']){
          $contact_info = $Contact->getContactbyId($contact_id);
          if ($contact_info) {
            $data =  array(
              'state'=>'Seen'
              );
            $success = $Contact->updateContactbyId($data,$contact_id);
            if ($success) {
              redirect('../contact','success','Contact Seen');
            }else{
              redirect('../contact','error','Error');
            }
          } else {
            redirect('../contact','error','Contact Not Found.');
          }
        }
        else if ($delete_act == $_GET['act']){
          $contact_info = $Contact->getContactbyId($contact_id);
          if ($contact_info) {
            $data =  array(
              'state'=>'deleted'
              );
            $success = $Contact->updateContactbyId($data,$contact_id);
            if ($success) {
              redirect('../contact','success','Contact Deleted Succesfully.');
            }else{
              redirect('../contact','error','Error while Deletinging.');
            }
          } else {
            redirect('../contact','error','Contact Not Found.');
          }
        }
        else{
          redirect('../contact','error',"Invalid Action");
        }
    }else{
      redirect('../contact','error','Id is Invalid');
    }
  }else{
    redirect('../contact','error','Id is required.');
  }
}
else{
  redirect('../contact','error','Error Occurs during submitting');
}
?>