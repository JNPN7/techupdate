<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	// debugger($blog_id,true);
    $blog_id = 8;
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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
<style type="text/css">

		body {
			/* For .post-meta */
		    --postMetaFontSize: 25px;
		    --postMetaFontWeight: 600;

		    /* For .meta-outside */
		    --metaOutsideFontSize: 20px;

		    /* For .meta-col */
		    --metaColFontSize: 18px;
		    --metaColFontWeight: 600;

		    /* For .post-des */
		    --postDesFontSize: 14px;
		    --postDesFontWeight: 300;

		    /* For .post-date */
		    --postDateFontSize: 14px;
			--bodyFontFamily: 'Segoe UI';
		    --bodyFontSize: 20px;
		    --bodyFontWeight: 300;
			--h1FontSize: 35px;
			font-family: var(--bodyFontFamily);
			font-size: var(--bodyFontSize);
			font-weight: var(--bodyFontWeight);
			color: var(--bodyColor);
			margin-left: 160px;
    		margin-right: 160px;
			padding: 0;
			overflow-x: hidden;
		}
		h1{
			font-size: var(--h1FontSize);
			padding-bottom: 0; 
			padding-top: 0;
		}

		 .emailpost-title,  .emailpost-username, .emailpost-writer{
			text-align: center;
			padding-top: 0px ;
			padding-bottom: 0px;
		}
		.blogemail-main h1{
			text-align: center;
			padding-top: 10px;
			padding-bottom: 0px;
		}

		.emailpost-content{
			text-align: justify;
			font-size: 40px;
			margin-right: 60px;
			margin-left: 60px;
		}
		.emailpost-image{
			width: 80%;
			height: auto;
			display: block;
			margin-left: auto;
    		margin-right: auto
		}

		.blogemail-main p{
			text-align: justify; text-justify: inter-word;
		}

		.post-col{
			display: flex;
			flex-direction: row;
			overflow: hidden;
		}
		.meta-col{
			display: flex;
			flex-direction: column;
			color: var(--metaColColor);
			padding-left: 5px;
			font-size: var(--metaColFontSize);
			font-weight: var(--metaColFontWeight);
			flex: 70%;
		}
		.col-img{
			flex: 30%;
		}
		.post-topic>a{
		    color: var(--primary);
		    text-decoration: none;
		}
		.post-topic>a:hover{
		    text-decoration: underline;
		}
		.post-des{
			font-size: var(--postDesFontSize);
			font-weight: var(--postDesFontWeight);
		}
		.post-date{
			font-size: var(postDateFontSize);
			color: var(--postDateColor);
		}
		.post .post-img:hover, .post .post-img:focus {
		     opacity: 0.8;
		}
</style>
</head>
<body>
	<a href="http://techxx.ml/blog?id=<?php echo $blog_id ?>" target="_blank" style="text-decoration: none; color: black">
	<div class="blogemail-main">
		<h1>TechXX</h1>
		<hr>
		<div class="emailpost-username" >Post for Subscribers <?php echo date('d M, Y', strtotime($blog_info->created_date)) ?></div>
		<hr>
		<div class="emailpost-title"><h1 style="padding-top: 0px;"><?php echo $blog_info->title ?></h1></div>
		<div class="emailpost-writer">Written By: <?php echo $blog_info->bloggername; ?></div>
		<div class="emailpost-image"><img class="emailpost-image" src="<?php echo $thumbnail ?>"></div>
		<article>
					<p><?php echo substr($contentarr[0], 0, 300).'....' ?><a href="http://techxx.ml/blog?id=<?php echo $blog_id ?>" target="_blank" >show more</a></p>
					<figure >
					<?php
						if (isset($blog_info->image) && !empty($blog_info->image)) {
							$imageArray = explode(" ", $blog_info->image);
								// debugger($imageArray, true);
								if(isset($imageArray[1]) && !empty($imageArray[1])){
									if(file_exists(UPLOAD_PATH.'blog/'.$imageArray[1])){	
										$thumbnail = UPLOAD_URL.'blog/'.$imageArray[1];
									}else{
										$thumbnail = UPLOAD_URL.'noimg.png';
									}
								}else{
									$thumbnail = '';
								}	
						}else{
							$thumbnail = UPLOAD_URL.'noimg.png';
						}
						if(isset($thumbnail) && !empty($thumbnail)){
					?>			
						<img class="emailpost-image" src="<?php echo $thumbnail?>" style="">
						<figcaption style="text-align: center;"><?php echo 'caption';?></figcaption>
						<?php
							}
						?>
					</figure>
				</article>

					</div>
	</a>
						<h1>Other Recent Blogs</h1>
							<div class="col">
								<?php
									// $allblogs = $Blog->getAllFeaturedBlogByCategoryWithLimit($blogcat_id,0,4);
									$allblogs=$Blog->getAllRecentBlogWithLimit(1,5);
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
												<a class="post-img col-img" href="http://techxx.ml/blog?id=<?php echo $blog->id ?>" target="_blank"><img class="post-thumb" src="<?php echo $thumbnail ?>" alt="Snow" style="width:100%; min-height: 13vw"></a>
												<div class="meta-col">
													<div class="post-date color-grey"><?php echo date('M d, Y',strtotime($blog->created_date)); ?></div>
													<div class="post-topic"><a href="http://techxx.ml/blog?id=<?php echo $blog->id ?>" target="_blank"><?php echo $blog->title; ?></a></div>
													<div class="post-des"><?php echo html_entity_decode(substr(explode('..break..', $blog->content)[0], 0, 300).'.......') ?><a href="http://techxx.ml/blog?id=<?php echo $blog->id ?>" target="_blank">Show More</a></div>
												</div>
											</div>
											<div style="height: 10px"></div>
								<?php
										}
									}
								?>
							</div>
</body>
</html>