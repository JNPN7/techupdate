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
        <link rel="icon" type="image/png" href="assets\images\logo\techx_logo_red_noshadow.png">

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
	<body>
        <div id="loading">
            <i class="fa fa-cog"></i>
        </div>
		<!--Navbar start-->
        <div id="navbar">

            <div id="mainTitle" class="navChild">
                <a href="index"><img src="assets\images\logo\techx_logo_white_with_text_noshadow.png" alt="TECHX"></a>
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

                <div id="user">
                    <button id="userButton">
                        <i class="fa fa-user"></i>
                    </button>
                    <div id="userOptions">
                        <a href="login">Sign In</a>
                        <a href="register">Sign Up</a>
                    </div>
                </div>

            </div>
        </div>
        <!--Navbar end-->
        <button id="gotoTop">
            <i class="fa fa-arrow-up"></i>
        </button>

        <div id="searchPage">
            <div>
                <input class="searchPageBox" type="text" placeholder="Search">
                <i class="fa fa-search"></i>
            </div>
        </div>

        