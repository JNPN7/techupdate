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
				<h4 class="ttxt1">ABOUT DEVELOPERS</h4>
				<!-- <img src="assets\images\about.jpg" style="width:100%; height: auto;"> -->
				<section id="testimonials">
					<div class="container row">
							<div class="dev">
								<img src="img\insta-1.jpg">
								<br>
								Juhel Phanju
							</div>
							<div class="dev">
								<img src="img\insta-2.jpg">
								<br>
								Bibek Manandhar
							</div>
							<div class="dev">
								<img src="img\insta-3.jpg">
								<br>
								Sudip Manandhar
							</div>
							<div class="dev">
								<img src="img\insta-5.jpg">
								<br>
								Abhinandan Shrestha
							</div>
					</div>
				</section>
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