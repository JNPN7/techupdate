<?php
    // $header = 'Login';
    include 'includes/header.php';
?>
    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form action="process/login" method="post">
                            <div class="group-input">
                                <label for="Email">Email address *</label>
                                <input type="email" id="email" name="email" required="required">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="Password" id="pass" name="pass" required="required">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" name="save-pass" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="/register" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

<?php
    include 'includes/footer.php';
?>