<?php
    // $header = 'Login';
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
    include 'includes/header.php';
?>
    <!-- Register Section Begin -->
    <!-------FORM SECTION------->
<div class="main" style="background: rgb(255, 255, 255);">
  <div class="container">
    <form action="process/register" method="POST">
    <div class="row">
        <div class="batta" style="margin: 0 auto;">
          <div class="form-content">
            <h4 class="text-center" style="padding-bottom:20px;">Verify your Email
            </h4>
            <div class="input-login">
              <input type="text" name="token" required="" value="">
              <label>Enter Code...</label>
            </div>
            <div class="input-login">
              <input type="hidden" name="email" required="" value="<?php  echo $_SESSION['fortoken']; ?>">
            </div>
            <button class="btn-style" type="submit" name="" style="margin: 0 auto;">Verify</button>
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