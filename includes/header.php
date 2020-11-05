<?php
    // include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	define('CAT_COLOR', ['cat-1','cat-2','cat-3','cat-4']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Logo -->
        <link rel="icon" type="image/png" href="assets\images\logo\logo.png">

		<!-- Title -->
		<title>TECHX</title>
		
    	<!-- Font Awesome -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<!-- <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/> -->

		<!-- Font Awesome Icon -->
		<script src="https://kit.fontawesome.com/4b23978c25.js" crossorigin="anonymous"></script>

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css?pwen"/>
        <link type="text/css" rel="stylesheet" href="assets/css/responsive.css?pwen"/>
		<!-------------------------------------------->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body onload="searchResults()">
        <div id="loading">
            <i class="fa fa-cog"></i>
        </div>
		<!--Navbar start-->
        <div id="navbar">

            <div id="mainTitle" class="navChild">
                <a href="index"><img src="assets\images\logo\logo.png" alt="TECHX"></a>
            </div>

            <div class="navChild">
                <ul>
                    <li>
                        <div class="dropdown">
                            <a href="#">
                                <button class="dropbtn">
                                    NEWS
                                </button>
                            </a>
                            <div class="dropdown-content">
                                <a href="#">Option 1</a>
                                <a href="#">Option 2</a>
                                <a href="#">Option 3</a>
                            </div>
                        </div>
                    </li>
                    <?php
                        $BlogCategory = new blogcategory();
                        $blogcategories = $BlogCategory->getAllBlogCategory();
                        // debugger($blogcategories,true);
                        foreach ($blogcategories as $key => $blogcategory) {
                    ?>
                    <li>
                        <div class="dropdown">
                            <a href="category?id=<?php echo $blogcategory->id ?>">
                                <button class="dropbtn">
                                    <?php echo $blogcategory->categoryname; ?>
                                </button>
                            </a>
                        </div>
                    </li>
                    <?php
                        }

                    ?>
                    
                    <li>
                        <div class="dropdown">
                            <a href="#">
                                <button class="dropbtn">
                                    MORE
                                </button>
                            </a>
                            <div class="dropdown-content">
                                <a href="about">ABOUT US</a>
                                <a href="contact">CONTACT</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            

            <div class="navChild">
                <div class="social">
                    <button class="facebook" onclick="window.location.href='https://www.facebook.com'">    
                        <i class="fa fa-facebook"></i>                        
                    </button>
                    <button class="twitter" onclick="window.location.href='https://www.twitter.com'">    
                        <i class="fa fa-twitter"></i>                        
                    </button>
                    <button class="pinterest" onclick="window.location.href='https://www.pinterest.com'">    
                        <i class="fa fa-pinterest"></i>                        
                    </button>
                    <button class="instagram" onclick="window.location.href='https://www.instagram.com'">    
                        <i class="fa fa-instagram"></i>                        
                    </button>
                    <button class="tumblr" onclick="window.location.href='https://www.tumblr.com'">    
                        <i class="fa fa-tumblr"></i>                        
                    </button>
                </div>

                <!-- Hamburger menu for smaller screens. Placed on rignt side of navbar..... for small screens -->
                <button id="menu" class="hide" onclick="showMenu()">
                    <i class="fa fa-bars"></i>
                </button>

                <div id="search">
                    <!-- <input class="search searchbox" type="text" name="search" value="Search" onclick="changeSearchBackground(3)" /> -->
                    <button class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

                <!-- <form action="login" method="get">
                    <button type="submit" name="signOut">Sign Out</button>
                </form> -->

                <div id="user">
                    <?php
                        $User = new user();
                        $userDetails = isset($_SESSION['token']) ? (array)$User->getUserbySessionToken($_SESSION['token'])[0] : array();
                        $image = isset($userDetails['image']) ? $userDetails['image'] : 'assets/images/bg.jpeg';
                        if (isset($userDetails['session_token']) && $userDetails['session_token'] == $_SESSION['token']) {
                            echo '
                                        <button id="userButton">
                                            <img src="'.$image.'" />
                                        </button>
                                        <div id="userOptions">
                                            <a href="cms/logout">Sign Out</a>
                                            <a href="register">Sign Up</a>
                                        </div>                    
                                    ';
                        }
                        else {
                            echo '
                                        <button id="userButton"
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <div id="userOptions">
                                            <a href="login">Sign In</a>
                                            <a href="register">Sign Up</a>
                                        </div>
                                    ';
                        }
                    ?>
                    
                </div>

            </div>
        </div>
        <!--Navbar end-->
        <button id="gotoTop">
            <i class="fa fa-arrow-up"></i>
        </button>

        <div id="searchPage">
            <div>
                <form action="search" method="get">
                    <input name="keyword" class="searchPageBox" type="text" placeholder="Search">
                    <button  type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div id="signInAlert">
            <div class="alertBox">
                    <div class="message">You must sign in first!!!</div>
                    <div class="options">
                        <button>Cancel</button>
                        <button>Sign In</button>
                        <button>Sign Up</button>
                    </div>
            </div>
        </div>

        <?php
            // print_r($_SESSION);
            // echo isset($_SESSION['noKeyword']);
            if(isset($_SESSION['noKeyword']) && $_SESSION['noKeyword'] == 1) {
                alertUser();
            }

            if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
                alertSignIn();
            }

        ?>