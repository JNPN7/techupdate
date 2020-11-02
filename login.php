<?php
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    include 'includes/header.php';
    if (isset($_COOKIE['_auth_user_']) && !empty($_COOKIE['_auth_user_'])) {
      $token = $_COOKIE['_auth_user_'];
      setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
      $_SESSION['token'] = $token;
      redirect('../index','success','Welcome '.$user_info[0]->username);
    }
?>
    <!-- Register Section Begin -->
    <!-------FORM SECTION------->
<div class="main" style="background: rgb(255, 255, 255);">
  <div class="container">
    <form action="process/login" method="POST">
    <div class="row">
      <div class="col-md-6" style="position: sticky; top:0; left: 0;">
        <img src="assets/images/laptop.gif" class="login-img">
      </div>
      <div class="col-md-6" style="z-index: 1; max-width: 450px; margin-top: 80px; margin-right: auto; margin-left: auto;">
        <div class="batta">
          <div class="form-content">
            <h4 class="text-center" style="padding-bottom:20px;">SIGN INTO YOUR ACCOUNT</h4>
            <div class="input-login">
              <input type="text" name="email" required="" value="">
              <label>Email</label>
            </div>
            <div class="input-login">
              <input type="password" name="pass" required="">
              <label>Password</label>
            </div>
            <div class="input-login">
              <input type="checkbox" name="rememberme" /> Remember me 
            </div>
            <button class="btn-style" type="submit" name="">Sign in</button>
          </div>
        </div>
       <div class="batta" style="margin-top:20px;">
          <div style="margin: 20px 0;">
            <h6 class="text-center">DON'T HAVE AN ACCOUNT?</h6>
            <p class="text-center"><a href="register" style="text-decoration: none;">REGISTER</a></p>
          </div>
        </div>
      </div>
   
    </div>
     </form>
  </div>
</div>
    <!-- Register Form Section End -->

<?php
    include 'includes/footer.php';
?>