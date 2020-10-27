<?php
    // $header = 'Login';
    include 'includes/header.php';
?>
    <!-- Register Section Begin -->
    <!-------FORM SECTION------->
<div class="main" style="background: rgb(255, 255, 255);">
<div class="container">
  <form action="" method="POST">
  <div class="row">
    <div class="col-md-6" style="position: sticky; top:0; left: 0;">
      <img src="assets/images/laptop.gif" class="login-img">
    </div>
    <div class="col-md-6" style="z-index: 1; max-width: 300px; margin-top: 80px; margin-right: auto; margin-left: auto;">
      <div class="batta">
          <div class="form-content">
            <h4 class="text-center" style="padding-bottom:20px;">SIGN INTO YOUR ACCOUNT</h4>
            <div class="form-content">
              <div class="form-col"><input type="text" placeholder="Username" class="form-control" ></div>
              <div class="form-col"><input type="text" placeholder="Password" class="form-control" name=""></div>
                <button class="btn" type="submit" name="">Sign up</button>
            </div>
            </div>
      </div>
     <div class="batta" style="margin-top:20px;">
        <div style="margin: 20px 0;">
          <h6 class="text-center">DON'T HAVE AN ACCOUNT?</h6>
          <p class="text-center"><a href="register.php" style="text-decoration: none;">REGISTER</a></p>
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