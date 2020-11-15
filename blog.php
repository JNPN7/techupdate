<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	if ($_GET['id'] <= 0){
		include 'includes/header.php';
		include 'easter/developer_page.php';
	}else{

	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$blog_id = (int)$_GET['id'];
		if($blog_id){
			$Blog = new blog();
			$blog_info = $Blog->getBlogbyId($blog_id);
			if ($blog_info) {
				$blog_info = $blog_info[0];
				// debugger($blog_info);
				$bread = $blog_info->title ;
				$catname = $blog_info->category;
				$contentarr = explode("#end#", html_entity_decode($blog_info->content));
				// debugger($contentarr);
				if (isset($blog_info->image) && !empty($blog_info->image)) {
					$imageArray = explode(" ", $blog_info->image);
					// debugger($imageArray, true);
					if(file_exists(UPLOAD_PATH.'blog/'.$imageArray[0])){	
						$thumbnail = UPLOAD_URL.'blog/'.$imageArray[0];
					}else{
						$thumbnail = 'assets\images\logo\logo.png';
					}	
				}else{
					$thumbnail = 'assets\images\logo\logo.png';
				}
				// debugger($contentarr,true);
				$data = array(
					'view' => $blog_info->view + 1
				);
				$Blog->updateBlogbyId($data,$blog_id);
			}else{
				redirect('index');
			}
		}else{
			redirect('index');
		}
	}else{
		redirect('index');
	}
	include 'includes/header.php';
	$Blog = new blog();
	$User = new user();
	if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
		$user_info = $User->getUserbySessionToken($_SESSION['token']);
	}
?>
<section class="parallax category-topic">
	<div style="height: 7vw;"></div>
		<div class="row" style="color: #fff;">
			<a href="index" class="banner-home"><p>Home</p></a>
			<div style="width: 15px"></div>
			<p>/</p>
			<div style="width: 15px"></div>
			<p><?php echo $catname; ?></p>
		</div>
		<h1 style="color: #fff; margin-top: 0;"><?php echo $catname; ?></h1>
</section>

<main role="main" class="main">
	<div class="row">
		<div class="main-section">
			<div class="share-btn-container">
				<a target="_blank" href="https://www.facebook.com/sharer.php?u=http://techxx.ml/blog?id=<?php echo $blog_id ?>">
					<i class="fa fa-facebook"></i>
				</a>
				<a target="_blank" href="http://twitter.com/share?url=http://techxx.ml/blog?id=<?php echo $blog_id ?>&hashtags=#techX">
					<i class="fa fa-twitter"></i>
				</a>
				<a target="_blank" href="#">
					<i class="fa fa-pinterest"></i>
				</a>
				<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://techxx.ml/blog?id=<?php echo $blog_id ?>">
					<i class="fa fa-linkedin"></i>
				</a>
				<a target="_blank" href="mailto:?Subject=techX Mail&Body=I%20saw%20this%20and%20thought%20of%20you!%20 http://techxx.ml/blog?id=<?php echo $blog_id ?>">
					<i class="fa fa-inbox"></i>
				</a>
			</div>
			<div class="blog-pad" style="padding-top: 40px">
				<article>
					<div class="post-header ht-60 post-rel">
						<?php
							if (isset($blog_info->image) && !empty($blog_info->image)) {
								$imageArray = explode(" ", $blog_info->image);
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
						<img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" >
						<div class="post-meta">
							<div class="post-date"><?php echo date('M d, Y',strtotime($blog_info->created_date)) ?></div>
							<div><?php echo $blog_info->title; ?></div>
						</div>
					</div>
					<div style="display: flex; justify-content: flex-end;">
						<p>By  <span style="color: red;"><?=$blog_info->bloggername?></span> | <?=date('M d, Y',
						strtotime($blog_info->created_date))?></p>
					</div>
					
					<?php
						$i = 1;
						foreach ($contentarr as $key => $value) {
							// debugger($value);
							$val = explode("#start#", $value);
							if (filter_var($val[0],FILTER_SANITIZE_STRING) == "paragraph"){
					?>
								<p style="margin: 20px 0 10px"><?=$val[1]?></p>
					<?php
							}
							else if (filter_var($val[0],FILTER_SANITIZE_STRING) == "image"){
							// debugger($val);
					?>			
								<figure class="blog-figure">
								<?php
									if (isset($blog_info->image) && !empty($blog_info->image)) {
										$imageArray = explode(" ", $blog_info->image);
											// debugger($imageArray, true);
											if(isset($imageArray[$i]) && !empty($imageArray[$i])){
												if(file_exists(UPLOAD_PATH.'blog/'.$imageArray[$i])){	
													$thumbnail = UPLOAD_URL.'blog/'.$imageArray[$i];
												}else{
													$thumbnail = UPLOAD_URL.'noimg.png';
												}
											}else{
												$thumbnail = '';
											}
										$i++;
									}else{
										$thumbnail = UPLOAD_URL.'noimg.png';
									}
									if(isset($thumbnail) && !empty($thumbnail)){
								?>			
									<img class="blog-image" src="<?php echo $thumbnail?>" style="">
									<figcaption><?=$val[1]?></figcaption>
									<?php
										}
									?>
								</figure>
					<?php
							}
							else if (filter_var($val[0],FILTER_SANITIZE_STRING) == 'ad') {
					?>
								<div class="ad" style="background-color: grey; height: <?=$val[1]?>">
								</div>
					<?php
							}
						}
					?>
						<!-- comment -->
						<?php
							$Comment = new comment();
							$Count = $Comment->getNumberCommentByBlog($blog_id);
							$comments = $Comment->getAllAcceptCommentByBlog($blog_id);
							
						?>
						<div id="commentContainer">
						    <div class="commentNumber"><?php echo $Count[0]->total ?> Comments</div>
						    <?php
						    	if(isset($comments) && !empty($comments)){
						    		foreach ($comments as $key => $comment) {
						    ?>
							    <div class="comment">
							        <div class="commentContent">
							            <div class="commentatorImage">
							                <img src="assets\images\bg.jpeg" alt="">
							            </div>
							            <div class="commentDetails">
							                <p class="commentator"><?php echo $comment->name; ?></p>
							                <p class="commentTime"><?php echo date('M d, Y h:i a',strtotime($comment->created_date)) ?><button  class="replyButton" onclick="reply(this);" data-commentid="<?php echo $comment->id ?>">Reply</button></p>
							                <p class="commentDescription"><?php echo html_entity_decode($comment->message) ?></p>
							            </div>
							        </div>
							        <?php 
							        	$replies = $Comment->getAllAcceptReplyByBlogByComment($blog_id,$comment->id);
							        	// debugger($replies);
							        	if (isset($replies) && !empty($replies)){
							        		foreach ($replies as $key => $reply) {
							        ?>
										        <div class="reply commentContent">
										            <div class="commentatorImage">
										                <img src="assets\images\bg.jpeg" alt="">
										            </div>
										            <div class="commentDetails">
										                <p class="commentator"><?php echo $reply->name; ?></p>
										                <p class="commentTime"><?php echo date('M d, Y h:i a',strtotime($reply->created_date)) ?><button class="replyButton" onclick="reply(this);" data-commentid="<?php echo $comment->id ?>">Reply</button></p>
										                <p class="commentDescription"><?php echo html_entity_decode($reply->message) ?></p>
										            </div>
										        </div>
							        <?php
							        		}
							        	}
							        ?>
							    </div>
						    <?php
						    		}
						    	}
						    ?>
						    
						    <div class="leaveAReply">
						        <div class="heading">LEAVE A REPLY</div>
						        	<input placeholder="Type a message." type="text">        
						    </div>
						</div>
						<div id="replyBox">
						    <div class="replyForm">
						            <form action="process/comment" method="post">
						                <div class="message">
						                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Type a message."></textarea>
						                </div>
						                <div>
						                	<input type="hidden" name="commentid" id="commentid" value="">
											<input type="hidden" name="blogid" value="<?php echo $blog_id ?>">
											<div>
												<div href="#" class="cancelButton">
													Cancel
												</div>
												<div>
													<button type="submit" class="submitButton">
														Submit
													</button>
												</div>
											</div>
						                </div>
						            </form>
						    </div>
						</div>
						<!-- comment -->
				</article>
			</div>

		</div>
		<aside class="right-section">
			<div class="main-pad col" style="padding-top: 50px;">
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
										<a class="post-img col-img" href="blog?id=<?php echo $blog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%; min-height: 15vh"></a>
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
							<a href="#" target="_blank" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
				            <a href="#" target="_blank" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
				            <a href="#" target="_blank" style="color: #000000"><i class="fa fa-instagram"></i></a>
				            <a href="#" target="_blank" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
				            <a href="#" target="_blank" style="color: #000000"><i class="fa fa-github-square"></i></a>
			        	</p>
					</div>
				</div>
			</div>
			<div style="height: 10px;"></div>
		</aside>
	</div>
</main>

<?php
	if(isset($_SESSION['commentMessage'])) {
		showCommentBox();
	}
}
	include 'includes/footer.php';
?>

<script type="text/javascript">
	function reply(element) {
		// console.log(element);
		var commentid = $(element).data('commentid');
		// console.log(commentid);
		document.getElementById("commentid").value = commentid;
	}


	// function openForm() {
	//   document.getElementById("myForm").style.display = "block";
	// }

	// function closeForm() {
	//   document.getElementById("myForm").style.display = "none";
	// }

	// document.getElementById("loginbtn").onclick = function(){
	// 	location.href = "login";
	// }
	// document.getElementById("registerbtn").onclick = function(){
	// 	location.href = "register";
	// }
</script>