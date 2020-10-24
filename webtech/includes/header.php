<?php
	define('CAT_COLOR', ['cat-1','cat-2','cat-3','cat-4']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Title -->
		<title>WEBTECH</title>
		

    	<!-- Font Awesome -->
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
		<!--Navbar start-->
        <div id="navbar">
            <!-- Hamburger menu for smaller screens. Placed on rignt side of navbar..... for small screens -->
            <button id="menu" class="hide" onclick="showMenu()">
                <i class="fa fa-bars"></i>
            </button>

            <div id="mainTitle" class="navChild">
                TECHX
            </div>

            <div class="navChild">
                <ul>
                    <li>
                        <div class="dropdown">
                            <a href="index.php">
                                <button class="dropbtn">
                                    HOME
                                </button>
                            </a>
                        </div>
                    </li>
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
                    <li>
                        <div class="dropdown">
                            <a href="#">
                                <button class="dropbtn">
                                    GAMING
                                </button>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="index.php">
                                <button class="dropbtn">
                                    PC
                                </button>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="index.php">
                                <button class="dropbtn">
                                    MOBILE
                                </button>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a href="#">
                                <button class="dropbtn">
                                    MORE
                                </button>
                            </a>
                            <div class="dropdown-content">
                                <a href="about.php">ABOUT US</a>
                                <a href="contact.php">CONTACT</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="navChild sign">
                <a href="#">Sign In</a>
                <a href="#">Sign Up</a>
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
                <div>
                    <input class="search" type="text" name="search" value="Search" onclick="changeSearchBackground(3)" />
                    <button class="search searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <!--Navbar end-->
        <button id="gotoTop">
            <i class="fa fa-arrow-up"></i>
        </button>