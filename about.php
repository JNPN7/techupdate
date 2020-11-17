<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
	$Blog = new blog();
?>

<main role="main" class="col">
	<!-- main content -->
	<section class="row">
		<!-- main section -->
		<article class="main-section">
			<div class="main-pad">
			<section id ="Overview">
				<h4 class="ttxt1">Overview</h4>
					<p>Techx is one of the most popular e-business and technology news publishers in Nepal. Our network of business and technology news publications attracts a targeted audience of buyers and decision-makers who need news and reliable analysis about present industries up to date.
					The site currently includes several e-business and technology news sites. Techx also publishes daily newsletters and Techx Weekly Newsletter.
					These publications are some of the most and widely-read business and technology news sites of the Internet age. Techx features an aspiring team of writers who produce daily news and industry analysis. Content throughout the blog covers the following areas:
					</p>
					<ul>
					<li>E-Commerce and E-Business</li>
					<li>Information Technology (IT)</li>
					<li>Customer Relationship Management (CRM)</li>
					<li>Cloud Computing</li>
					<li>Internet Trends</li>
					<li>Enterprise Networking</li>
					<li>Internet and Network Security</li>
					<li>Mobile Devices and Wireless Technologies</li>
					<li>Mobile Commerce (M-Commerce)</li>
					<li>Linux and Open Source</li>
					<li>Operating Systems</li>
					<li>Tech Stocks & Financial Deals</li>
					</ul>
					
				</section><br>
				<!-- <img src="assets\images\about.jpg" style="width:100%; height: auto;"> -->
				<!-- <section id="testimonials">
				<h4 class="ttxt1">Developer Team</h4>
					<div class="container row" style="text-align: center;">
							<div class="dev">
								<img src="img\insta-1.jpg">
								<br>
								Juhel Phanju
								<p style="margin-top: 0; font-size: 20px; color: blue;">
									<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
						            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
						            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
						            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
						            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
					        	</p>
							</div>
							<div class="dev">
								<img src="img\insta-2.jpg">
								<br>
								Bibek Manandhar
									<p style="margin-top: 0; font-size: 20px; color: blue;">
										<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
						        	</p>
							</div>
							<div class="dev">
								<img src="img\insta-3.jpg">
								<br>
								Sudip Manandhar
									<p style="margin-top: 0; font-size: 20px; color: blue;">
										<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
						        	</p>
							</div>
							<div class="dev">
								<img src="img\insta-5.jpg">
								<br>
								Abhinandan Shrestha
									<p style="margin-top: 0; font-size: 20px; color: blue;">
										<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
							            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
						        	</p>
							</div>
					</div>
				</section> -->
			</div>
		</article>

		<!-- right section -->
		<aside class="right-section">
			<div class="main-pad col" style="padding-top: 20px;">
				<div class="ad" style=" height: 250px; background: grey;"></div>

				<!-- Featured news -->
						<div>
							<h2>Featured News</h2>
							<div class="col">
								<?php
									$allftblogs = $Blog->getAllFeaturedBlogWithLimit(0,4);
									// debugger($allftblogs);
									if (isset($allftblogs) && !empty($allftblogs)) {
										foreach ($allftblogs as $key => $blog) {
								?>
											<div class="post post-col">
												<?php
													if (isset($blog->image) && !empty($blog->image)) {
														$imageArray = explode(" ", $blog->image);
														// debugger($imageArray, true);
														if(file_exists(UPLOAD_PATH.'blog/'.$imageArray[0])){	
															$thumbnail = UPLOAD_URL.'blog/'.$imageArray[0];
														}else{
															$thumbnail = UPLOAD_URL.'noimg.png';
														}	
													}else{
														$thumbnail = UPLOAD_URL.'noimg.png';
													}
												?>
												<a class="post-img col-img" href="blog?id=<?php echo $blog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail; ?>" alt="Snow" style="width:100%; min-height: 15vh"></a>
												<div class="meta-col">
													<div class="post-date"><?php echo date('M d, Y',strtotime($blog->created_date)); ?></div>
													<div class="post-topic"><a href="blog?id=<?php echo $blog->id ?>" ><?php echo $blog->title; ?></a></div>
												</div>
											</div>
											<div style="height: 10px"></div>
								<?php
										}
									}
								?>
							</div>
						</div>

				<!-- keep up with us -->
				<div>
					<h2>Keep up with us</h2>
					<div class="row">
						<p style="margin-top: 0; font-size: 20px; color: blue;">
							<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
			        	</p>
					</div>
				</div>
			</div>
		</aside>
	</section>
</main>


<?php
	include 'includes/footer.php';
?>