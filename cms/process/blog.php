<?php
  include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
  
  $Blog = new blog();
   // debugger($_POST);
   // debugger($_FILES,true);
  if($_POST){
    $data = array(
      'title' => sanitize($_POST['title']),
      'content' => htmlentities($_POST['content']),
      'quote' => htmlentities($_POST['quote']),
      'bloggername' => sanitize($_POST['bloggername']),
      'featured' => sanitize($_POST['featured']),
      'blogcategoryid' => (int)$_POST['blogcategoryid'],
      'status' => 'Active',
      'added_by' => $_SESSION['user_id']
    );
    // debugger($data,true);
    // debugger(array_filter($_FILES['image']['name']),true);
    // debugger($_FILES['image'],true);

  if (isset($_FILES) && !empty($_FILES)){
      foreach ($_FILES['image']['error'] as $key => $err) {
        if($err==0){
          $condition = "valid";
        }
      }
    }
    if($condition=="valid"){
        $success = uploadMultiImage($_FILES['image'],'blog');
        $data['image'] = $success;
        if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'blog/'.$_POST['old_img'])) {
            unlink(UPLOAD_PATH.'blog/'.$_POST['old_img']);
        }
    }else{

      redirect('../addblog','error','Error while Uploading Image.');
    }  

  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $act = 'Updat';
    $blog_id = (int)$_POST['id'];
  }else{
    $act = 'Add';
    $blog_id = false;
  }

  if ($blog_id) {
    $blog_info = $Blog->getBlogbyId($blog_id);
    // debugger($blog_info);
    if ($blog_info) {
        //debugger($_SESSION['user_id'],true);
      if ($_SESSION['user_id'] == $blog_info[0]->added_by) {
        // $Blog>addBlog($data);
        $success = $Blog->updateBlogbyId($data,$blog_id);
      }else{
        redirect('../addblog','error','You are not allowed to edit.');
      }
    }else{
      redirect('../addblog','error','Blog Not Found');
    }
  }else{    // Add 
  $success = $Blog->addBlog($data);
  }
  if ($success) {
    redirect('../blog','success','Blog '.$act.'ed Succesfully');
  }else{
    redirect('../addblog','error','Problem While '.$act.'ing Blog');
  }
}else if ($_GET) {    // Delete
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $blog_id = (int)$_GET['id'];
    if ($blog_id) {
      $act = substr(md5("Delete-Blog-".$blog_id.$_SESSION['token']), 3,15);
      if ($act) {
        if ($act == $_GET['act']){
          $blog_info = $Blog->getBlogbyId($blog_id);
          if ($blog_info) {
            $data =  array(
              'status'=>'Passive'
              );
            $success = $Blog->updateBlogbyId($data,$blog_id);
            if ($success) {
              redirect('../blog','success','Blog Deleted Succesfully.');
            }else{
              redirect('../blog','error','Error while Deleting.');
            }
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
}
else{
  redirect('../blog','error','Error Occurs during submitting');
}
?>