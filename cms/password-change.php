
<?php
    $header = "Change Password";
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
                flashMessage();
            ?>
            <div class="page-title">
              <div class="title_left">               
                <h3>Change Password</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change your password here</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/password-change" method="post">
                          <div class="form-group col-md-7">
                            <label for="">Old Password</label>
                              <input type="password" name="oldpassword" id="oldpassword" class="form-control">
                          </div>
                          <div class="form-group col-md-7">
                            <label for="">New Password</label>
                              <input type="password" name="password" id="password" class="form-control">  
                          </div>
                          <div class="form-group col-md-7">
                            <label for="">Re-Type New Password</label>
                              <input type="password" name="newpassword" id="newpassword" class="form-control">  
                          </div>
                          <div class="form-group col-md-5">
                            <span id="error" class="hidden"></span> 
                          </div>                        
                          <div class="form-group col-md-7">
                            <button class="btn btn-default" type="reset" id="reset">Reset</button>
                            <button class="btn btn-success" type="submit" id="submit">Submit</button>
                          </div>    
                        </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php 
    include 'inc/footer.php';
?>
<script type="text/javascript">
    $('#newpassword').keyup(function(){
      var password = $('#password').val();
      var newpassword = $('#newpassword').val();
      console.log(password);
      console.log(newpassword);    
    
    if(password==newpassword){
      $('#error').addClass('hidden').removeClass('alert').removeClass('alert-danger').html('');
      $('#submit').removeAttr('disabled','disabled');
    }else{
      $('#error').removeClass('hidden').addClass('alert').addClass('alert-danger').html("Password doesn't Match");
      $('#submit').attr('disabled','disabled');
    }
  });
    $('#reset').click(function(){
        $('#error').addClass('hidden').removeClass('alert').removeClass('alert-danger').html('');
        $('#submit').attr('disabled','disabled');
      });
</script>
