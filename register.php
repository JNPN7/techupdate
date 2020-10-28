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
        <div class="col-md-6" style="position: sticky; top:0; left: 0;">
          <img src="assets/images/laptop.gif" class="login-img">
        </div>
        <div class="col-md-6" style="z-index: 1; max-width: 500px; margin-top: 80px; margin-right: auto; margin-left: auto;">
          <div class="batta">
              <div class="form-content">
                <h4 class="text-center" style="padding-bottom:20px;">SIGN INTO YOUR ACCOUNT</h4>
                <div class="input-login">
                  <input type="text" name="name" required="" value="">
                  <label>Full Name *</label>
                </div>
                <div class="input-login">
                  <input type="text" name="username" required="" value="">
                  <label>Username *</label>
                </div>
                <div class="input-login">
                  <input type="text" name="email" required="" value="">
                  <label>Email *</label>
                </div>
                <div class="input-login">
                  <input name="pass" type="password" required="" id="pass">
                  <label>Password *</label>
                </div>
                <div class="input-login">
                    <span id="error" class="hidden"></span> 
                </div>
                <div class="input-login">
                  <input name="conPass" type="password" required="" id="con-pass">
                  <label>Re-write Password *</label>
                </div>

                <button class="btn-style" type="submit" name="" id="submit" >Sign up</button>
                <!-- <button type="submit" disabled="false" id="submit" class="btn-style">Sign up</button> -->
              </div>
          </div>
         <div class="batta" style="margin-top:20px;">
            <div style="margin: 20px 0;">
              <h6 class="text-center">HAVE AN ACCOUNT?</h6>
              <p class="text-center"><a href="login" style="text-decoration: none;">LOG IN</a></p>
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

<script type="text/javascript">
    $('#con-pass').keyup(function(){
        var password = $('#pass').val();
        var conPass = $('#con-pass').val();
        console.log(password);
        console.log(conPass);
        if(password==conPass){
            $('#error').addClass('hidden').removeClass('alert').removeClass('alert-danger').html('');
            $('#submit').removeAttr('disabled','disabled');
            console.log('confirm');
        }else{
            $('#error').removeClass('hidden').addClass('alert').addClass('alert-danger').html("Password doesn't Match");
            $('#submit').attr('disabled','disabled');
            console.log('not Confirm');
        }
    });
    $('#pass').keyup(function(){
        var password = $('#pass').val();
        var conPass = $('#con-pass').val();
        console.log(password);
        console.log(conPass);
        if(password==conPass){
            $('#error').addClass('hidden').removeClass('alert').removeClass('alert-danger').html('');
            $('#submit').removeAttr('disabled','disabled');
            console.log('confirm');
        }else{
            $('#error').removeClass('hidden').addClass('alert').addClass('alert-danger').html("Password doesn't Match");
            $('#submit').attr('disabled','disabled');
            console.log('not Confirm');
        }
    });
</script>