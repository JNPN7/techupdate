<div style="height: 20px;"></div>
<div class="f-line"></div>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3"><div class="f-space"></div>
              <a href="index">
                <b class="nname" style="color: #fff; font-size: 50px; font-weight:900;"><img src="assets\images\logo\logo.png" alt="TECHX"></b>
              </a>
            </div>
              
            <div class="col-md-3"><br>
            <h6 class="f-header">QUICK LINKS</h6>
              <a class="f-link texts" href="#">NEWS</a><br>
              <a class="f-link texts" href="#">GAMING</a><br>
              <a class="f-link texts" href="about">ABOUT US</a><br>
              <a class="f-link texts" href="contact">CONTACTS</a><br>
              <div style="height: 4px;"></div>
              <p class="texts">
              <a href="#"><i class="fa fa-facebook-official"></i></a>
              <a href="#"><i class="fa fa-snapchat-ghost"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-twitter-square"></i></a>
              <a href="#"><i class="fa fa-github-square"></i></a>
              </p> 
            </div>    
            <div class="col-md-3"><br>
              <h6 class="f-header">COMMUNITY</h6>
              <a class="f-link texts" href="#">SUPPORT</a><br>
              <a class="f-link texts" href="#">COMMUNITY GUIDELINES</a><br>
              <a class="f-link texts" href="#">PRIVACY & SECURITY</a><br>
            </div>
            <div class="col-md-3"><br>
            <form >
              <h6 class="f-header">Join Newsletter</h6>
              <p class="texts" href="#">Get email about our latest updates</p>
              <div class="emailbox">
                <i class="fa fa-envelope"></i>
                <input class="tbox" type="email" name="email" id="email" value="" placeholder="Enter your email...">
                <button class="btn" type="button" name="button" onclick="emailForm()" style="padding: 0 5px;">Subscribe</button>
              </div>
            </form>
            </div>      
        </div>
    </div>
    <div class="f-space"></div>
</section>
<div class="end">
  <div class="end-text">
  Copyright <i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date("Y"); ?>
  </div>
</div>
<script src="assets/js/main.js"></script>
<!-- MS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    function emailForm(){
        var email = $('#email').val();
        // console.log(email);
        $.ajax({
            url:"process/subEmail",
            type:"POST",
            data:{email:email},
            success:function(data,success){
              // console.log(data);
            }
        });
    }
</script>
</body>
</html>