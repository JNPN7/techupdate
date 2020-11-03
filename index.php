<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
	$Blog = new blog(); 
?>
		<section class="hot-news">
			<?php
				$featuredblog = $Blog->getAllFeaturedBlogWithLimit(0,2);
				// debugger($featuredblog);
				if (isset($featuredblog) && !empty($featuredblog)) {
			?>
				<div class="row">
					<div class="hot-news-left">
						<div class="post ht-50 post-rel">
							<?php
								if (isset($featuredblog[0]->image) && !empty($featuredblog[0]->image)) {
									$imageArray = explode(" ", $featuredblog[0]->image);
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
							<a class="post-img" href="blog?id=<?php echo $featuredblog[0]->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" ></a>
							<div class="post-meta">
								<div class="post-date"><?php echo date('M d, Y',strtotime($featuredblog[0]->created_date)) ?></div>
								<div class="post-topic"><a href="blog?id=<?php echo $featuredblog[0]->id ?>" style="color: white"><?php echo $featuredblog[0]->title; ?></a></div>
							</div>
						</div>
					</div>
					<div class="hot-news-right">
						<div class="post ht-50 post-rel">
							<?php
								if (isset($featuredblog[1]->image) && !empty($featuredblog[1]->image)) {
									$imageArray = explode(" ", $featuredblog[1]->image);
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
							<a class="post-img" href="blog?id=<?php echo $featuredblog[1]->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%;"></a>
							<div class="post-meta">
								<div class="post-date"><?php echo date('M d, Y',strtotime($featuredblog[1]->created_date)) ?></div>
								<div class="post-topic"><a href="blog?id=<?php echo $featuredblog[1]->id ?>" style="color: white"><?php echo $featuredblog[1]->title; ?></a></div>
							</div>
						</div>
					</div>
					
				</div>

			<?php
				}
			?>
		</section>
		<main role="main" class="main">
			<div class="row">
				<section class="main-section">

					<!-- trending -->
					<div class="main-pad">
						<h1>Trending</h1>
						<div class="grid-container">
						<?php
							$trendingblogs = $Blog->getAllPopularBlogWithLimit(0,5);
							$count = 1;
							// debugger($trendingblogs,true);
							if(isset($trendingblogs) && !empty($trendingblogs)){
								foreach ($trendingblogs as $key => $tblog) {
							?>
								<div class="grid-item<?php echo $count?>">
									<div class="post ht-50 post-rel">
										<?php
											if (isset($tblog->image) && !empty($tblog->image)) {
												$imageArray = explode(" ", $tblog->image);
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
										<a class="post-img" href="blog?id=<?php echo $tblog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%;"></a>
										<div class="post-meta">
											<div class="post-date"><?php echo date('M d,Y',strtotime($tblog->created_date)); ?></div>
											<div class="post-topic"><a href="blog?id=<?php echo $tblog->id ?>" style="color: white"><?php echo $tblog->title; ?></a></div>
										</div>
									</div>
								</div>
							<?php
							    $count++;
								}
							}
						?>
						</div>
					</div>

					<!-- don't miss -->
					<div class="main-pad">
						<h1>Don't Miss</h1>
						<div class="row dontmissup" style="justify-content: space-between;">
							<?php
								$featuredblog = $Blog->getAllFeaturedBlogWithLimit(2,2);
								if(isset($featuredblog) && !empty($featuredblog)){
									foreach ($featuredblog as $key => $fblog) {
							?>
								<div class="post dontmissup-content"  >
									<?php
										if (isset($fblog->image) && !empty($fblog->image)) {
											$imageArray = explode(" ", $fblog->image);
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
									<a class="post-img" href="blog?id=<?php echo $fblog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%; height: 40vh"></a>
									<div class="post-meta meta-outside">
										<div class="post-date color-grey"><?php echo date('M d,Y',strtotime($fblog->created_date)); ?></div>
										<div class="post-topic"><a href="blog?id=<?php echo $fblog->id ?>" ><?php echo $fblog->title; ?></a></div>
									</div>
								</div>
							<?php
								}
								}
							?>
						</div>
						<div class="grid-dontmiss">
							<?php
								$featuredblog = $Blog->getAllFeaturedBlogWithLimit(4,4);
								if(isset($featuredblog) && !empty($featuredblog)){
									foreach ($featuredblog as $key => $fblog) {
							?>
							<div class="post post-col">
								<?php
									if (isset($fblog->image) && !empty($fblog->image)) {
										$imageArray = explode(" ", $fblog->image);
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
								<a class="post-img col-img" href="blog?id=<?php echo $fblog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%;"></a>
								<div class="meta-col">
									<div class="post-date color-grey"><?php echo date('M d,Y',strtotime($fblog->created_date)); ?></div>
									<div class="post-topic"><a href="blog?id=<?php echo $fblog->id ?>" ><?php echo $fblog->title; ?></a></div>
								</div>
							</div>
							<?php
								}
								}
							?>
						</div>
					</div>

					<!-- stories -->
					<div class="main-pad">
						<h1>Stories</h1>
							<div class="col">
								<?php
									// $allblogs = $Blog->getAllFeaturedBlogByCategoryWithLimit($blogcat_id,0,4);
									$allblogs=$Blog->getAllRecentBlogWithLimit(4,4);
									if (isset($allblogs) && !empty($allblogs)) {
										foreach ($allblogs as $key => $blog) {
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
												<a class="post-img col-img" href="#"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%;"></a>
												<div class="meta-col">
													<div class="post-date color-grey"><?php echo date('M d, Y',strtotime($blog->created_date)); ?></div>
													<div class="post-topic"><a href="blog?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></div>
													<div class="post-des"><?php echo html_entity_decode(substr(explode('..break..', $blog->content)[0], 0, 300).'.......') ?><a href="blog?id=<?php echo $blog->id ?>">Show More</a></div>
												</div>
											</div>
											<div style="height: 10px"></div>
								<?php
										}
									}
								?>
							</div>
					</div>
				</section>
				<aside class="right-section">
					<div class="main-pad col" style="padding-top: 20px;">
						<div class="ad" style=" height: 300px; background: grey;"></div>
						
						<!-- latest news -->
						<div>
							<h2>Latest News</h2>
							<div class="col">
								<?php
									// $allblogs = $Blog->getAllFeaturedBlogByCategoryWithLimit($blogcat_id,0,4);
									$allblogs=$Blog->getAllRecentBlogWithLimit(0,4);
									if (isset($allblogs) && !empty($allblogs)) {
										foreach ($allblogs as $key => $blog) {
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
												<a class="post-img col-img" href="blog?id=<?php echo $blog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%; height: 10vh"></a>
												<div class="meta-col">
													<div class="post-date"><?php echo date('M d, Y',strtotime($blog->created_date)); ?></div>
													<div class="post-topic"><a href="blog?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></div>
												</div>
											</div>
											<div style="height: 10px"></div>
								<?php
										}
									}
								?>
							</div>
						</div>

						<div style="height: 20px"></div>
						<div class="ad" style=" height: 300px; background: grey;"></div>
						
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
												<a class="post-img col-img" href="blog?id=<?php echo $blog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail; ?>" alt="Snow" style="width:100%; height: 15vh"></a>
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
			</div>
			
		</main>
		<br>
<?php
	include 'includes/footer.php';
?>