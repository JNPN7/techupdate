<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
        $blogcat_id = (int)$_GET['id'];
        if($blogcat_id){
            $BlogCategory = new blogcategory();
            $blogcategory_info = $BlogCategory->getBlogCategorybyId($blogcat_id);
            $Blog = new blog();
            $total_no_of_blog = $Blog->getNumberOfBlogsByCategory($blogcat_id);
            // debugger($blogcategory_info);
            if ($blogcategory_info) {
                $blogcategory_info = $blogcategory_info[0];
                $breads = $blogcategory_info->categoryname;
            }else{
                redirect('index');
            }
        }else{
            redirect('index');
        }
        }else{redirect('index');
    }
?>

<section class="parallax category-topic">
	<div style="height: 7vw;"></div>
		<div class="row" style="color: #fff;">
			<a href="index" class="banner-home"><p>Home</p></a>
			<div style="width: 15px"></div>
			<p>/</p>
			<div style="width: 15px"></div>
			<p><?php echo $breads; ?></p>
		</div>
		<h1 style="color: #fff; margin-top: 0;"><?php echo $breads; ?></h1>
</section>

<main role="main" class="main">
	<div class="row">
		<div class="main-section">
			<div class="main-pad" style="padding-top: 40px">
				<!----------- oldie design ----------->
				<!-- <div class="col">
					<div class="post post-col">
						<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain2.jpeg" alt="Snow" style="width:100%;"></a>
						<div class="meta-col">
							<div class="post-date color-grey">May 13, 2020</div>
							<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke no way haha</div>
							<div class="post-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </div>
						</div>
					</div>
					<div style="height: 10px"></div>
					<div class="post post-col">
						<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain3.jpeg" alt="Snow" style="width:100%;"></a>
						<div class="meta-col">
							<div class="post-date color-grey">May 13, 2020</div>
							<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke</div>
							<div class="post-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </div>
						</div>
					</div>
					<div style="height: 10px"></div>
					<div class="post post-col">
						<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain4.jpeg" alt="Snow" style="width:100%;"></a>
						<div class="meta-col">
							<div class="post-date color-grey">May 13, 2020</div>
							<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke go away you piece of shit</div>
							<div class="post-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.  </div>
						</div>
					</div>
					<div style="height: 10px"></div>
					<div class="post post-col">
						<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain1.jpeg" alt="Snow" style="width:100%;"></a>
						<div class="meta-col">
							<div class="post-date color-grey">May 13, 2020</div>
							<div class="post-topic">I wish I was the monster you think of</div>
							<div class="post-des">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, </div>
						</div>
					</div>
				</div> -->

				<!---------------- new design ------------------->
				<div class="col">
					<?php 
						
						$featuredBlogs = $Blog->getAllFeaturedBlogByCategoryWithLimit($blogcat_id,0,4);
						if(isset($featuredBlogs[0]) && !empty($featuredBlogs[0])){
							// debugger($featuredBlogs[1], true);
					?>
					<!-- Top Post -->
							<div class="post ht-60 post-rel">
								<?php
									if (isset($featuredBlogs[0]->image) && !empty($featuredBlogs[0]->image)) {
										$imageArray = explode(" ", $featuredBlogs[0]->image);
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
								<a class="post-img" href="blog?id=<?php echo $featuredBlogs[0]->id ?>"><img class="post-thumb" src="<?php echo $thumbnail; ?>" alt="Snow" ></a>
								<div class="post-meta">
									<div class="post-date"><?php echo date('M d, Y',strtotime($featuredBlogs[0]->created_date)) ?></div>
									<div class="post-topic"><a href="blog?id=<?php echo $featuredBlogs[0]->id ?>" style="color: white"><?php echo $featuredBlogs[0]->title; ?></a></div>
								</div>
							</div>
					<?php
							}
					?>
					<!-- Top Post -->
					<div style="height: 30px;"></div>
					<!-- 2nd and 3rd Post -->
					<?php
						if(isset($featuredBlogs[1]) && !empty($featuredBlogs[1]) && isset($featuredBlogs[2]) && !empty($featuredBlogs[2])){
					?>
					<div class="row dontmissup" style="justify-content: space-between;">
						<div class="post dontmissup-content"  >
							<?php
								if (isset($featuredBlogs[1]->image) && !empty($featuredBlogs[1]->image)) {
									$imageArray = explode(" ", $featuredBlogs[1]->image);
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
							<a class="post-img" href="blog?id=<?php echo $featuredBlogs[1]->id ?>"><img class="post-thumb" src="<?php echo $thumbnail?>" alt="Snow" style="width:100%; height: 40vh"></a>
							<div class="post-meta meta-outside">
								<div class="post-date color-grey"><?php echo date('M d, Y',strtotime($featuredBlogs[1]->created_date)); ?></div>
								<div class="post-topic"><a href="blog?id=<?php echo $featuredBlogs[1]->id ?>"><?php echo $featuredBlogs[1]->title; ?></a></div>
							</div>
						</div>
					
					
						<div class="post dontmissup-content">
							<?php
								if (isset($featuredBlogs[2]->image) && !empty($featuredBlogs[2]->image)) {
									$imageArray = explode(" ", $featuredBlogs[2]->image);
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
							<a class="post-img" href="blog?id=<?php echo $featuredBlogs[2]->id ?>"><img class="post-thumb" src="<?php echo $thumbnail?>" alt="Snow" style="width:100%; height: 40vh"></a>
							<div class="post-meta meta-outside">
								<div class="post-date color-grey"><?php echo date('M d, Y',strtotime($featuredBlogs[2]->created_date)); ?></div>
								<div class="post-topic"><a href="blog?id=<?php echo $featuredBlogs[2]->id ?>"><?php echo $featuredBlogs[2]->title; ?></a></div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					<!-- 2nd and 3rd Post -->
					<div style="height: 30px;"></div>
					<div id="scrollhere" class="ad" style=" height: 100px; background: grey;"></div>
					<div style="height: 30px;"></div>
					
					<!-- Other Posts -->
					<div id="filter_data" data-categoryid='<?=$blogcategory_info->id?>' style=""></div>
					
					<div style="height: 30px"></div>
					<!-- Other Posts -->
					<!-- <div style="background: green; margin: 20px; text-align: center; width: 300px; padding: 0;" >
						<h3 style="padding: 0;">Load more</h3>
					</div> -->
					<div style="width: 100%; text-align: center;">
						<div class="pagination" data-val="1">
							<div id="<">&laquo;</div>
			
							<div id="1">1</div>
							<div id="2">2</div>
							<div id="3">3</div>
							<div id="4">4</div>

							
						  	<div id=">">&raquo;</div>
						</div>
					</div>
					
				</div>
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
							<a href="#" style="color: #000000"><i class="fa fa-facebook-official"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-snapchat-ghost"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-instagram"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-twitter-square"></i></a>
				            <a href="#" style="color: #000000"><i class="fa fa-github-square"></i></a>
			        	</p>
					</div>
				</div>
			</div>
			<div style="height: 10px;"></div>
		</aside>
	</div>
</main>

<?php
	include 'includes/footer.php';
?>

<script type="text/javascript">
	var limit = 4;
	var offset;	 
	var categoryid;
	var elmnt = document.getElementById("scrollhere");
	var four = $('#4');
  	
	$(document).ready(function(){
		var pagination = $('.pagination').data('val');
		offset = (pagination - 1) * 7;
		categoryid = $('#filter_data').data('categoryid');
		$('#' + pagination).addClass('active').siblings().removeClass('active');
		$.post('ajax_fetch/fetch_data.php',{
			limit: limit,
			offset: offset,
			categoryid: categoryid
		},function(data, status){
			console.log(status);
			$('#filter_data').html(data);
		});
		
	});
	$(document).delegate( ".pagination div", "click", function(e){
		elmnt.scrollIntoView();
		var inputId = this.id;
		var active_id = parseInt($('.active').attr('id')); 
		var categoryid = $('#filter_data').data('categoryid');
		if (inputId == "<"){
			active_id -= 1;
			if(active_id > 0){
				$('#' + active_id).addClass('active').siblings().removeClass('active');
			}
		}else if (inputId == ">"){
			active_id += 1;
			$('#' + active_id).addClass('active').siblings().removeClass('active');
		}else{
			$(this).addClass('active').siblings().removeClass('active');
		}
		if ($('#4').hasClass("active")){
			let html1 = parseInt($('#1').html());
			let html2 = parseInt($('#2').html());
			let html3 = parseInt($('#3').html());
			let html4 = parseInt($('#4').html());
			$('#1').html(html1 + 2);
			$('#2').html(html2 + 2);
			$('#3').html(html3 + 2);
			$('#4').html(html4 + 2);
			$('#2').addClass('active').siblings().removeClass('active');
		}
		if ($('#1').hasClass("active")){
			let html1 = parseInt($('#1').html());
			if (html1 != 1){
				let html2 = parseInt($('#2').html());
				let html3 = parseInt($('#3').html());
				let html4 = parseInt($('#4').html());
				$('#1').html(html1 - 2);
				$('#2').html(html2 - 2);
				$('#3').html(html3 - 2);
				$('#4').html(html4 - 2);
				$('#3').addClass('active').siblings().removeClass('active');
			}
		}
		var active_html = parseInt($('.active').html());
		offset = (active_html - 1) * limit;
		$('.pagination').data('val', active_html);
			
		$.post('ajax_fetch/fetch_data.php',{
			limit: limit,
			offset: offset,
			categoryid: categoryid
		},function(data, status){
			console.log(status);
			$('#filter_data').html(data);
		});

    });

    
</script>