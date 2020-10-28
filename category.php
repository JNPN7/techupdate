<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
        $blogcat_id = (int)$_GET['id'];
        if($blogcat_id){
            $BlogCategory = new blogcategory();
            $blogcategory_info = $BlogCategory->getBlogCategorybyId($blogcat_id);
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
					<div class="post ht-60 post-rel">
						<a class="post-img" href="#"><img class="post-thumb" src="assets/images/mountain1.jpeg" alt="Snow" ></a>
						<div class="post-meta">
							<div class="post-date">Jan 2, 2020</div>
							<div class="post-topic">Thats what she said, Micheal scott scott tots nowhere going on and on and on we are good and thanks for asking</div>
						</div>
					</div>
					<div style="height: 30px;"></div>
					<div class="row dontmissup" style="justify-content: space-between;">
						<div class="post dontmissup-content"  >
							<a class="post-img" href="#"><img class="post-thumb" src="assets/images/mountain3.jpeg" alt="Snow" style="width:100%; height: 40vh"></a>
							<div class="post-meta meta-outside">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">Dont be afraid I not a moster Identity theft is not a joke!!!</div>
							</div>
						</div>
					
					
						<div class="post dontmissup-content">
							<a class="post-img" href="#"><img class="post-thumb" src="assets/images/mountain1.jpeg" alt="Snow" style="width:100%; height: 40vh"></a>
							<div class="post-meta meta-outside">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">Dont be afraid I not a moster Identity theft is not a joke</div>
							</div>
						</div>
					</div>
					<div style="height: 30px;"></div>
					<div class="ad" style=" height: 100px; background: grey;"></div>
					<div style="height: 30px;"></div>
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
					<div style="background: green; margin: 20px; text-align: center; width: 300px; padding: 0;" >
						<h3 style="padding: 0;">Load more</h3>
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
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain2.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke no way haha</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain3.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain4.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke go away you piece of shit</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain1.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the monster you think of</div>
							</div>
						</div>
					</div>
				</div>

				<div style="height: 20px"></div>
				<div class="ad" style=" height: 300px; background: grey;"></div>
				
				<!-- Featured news -->
				<div>
					<h2>Featured News</h2>
					<div class="col">
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain2.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke no way haha</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain3.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain4.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the moster you think of Identity theft is not a joke go away you piece of shit</div>
							</div>
						</div>
						<div style="height: 10px"></div>
						<div class="post post-col">
							<a class="post-img col-img" href="#"><img class="post-thumb" src="assets/images/mountain1.jpeg" alt="Snow" style="width:100%;"></a>
							<div class="meta-col">
								<div class="post-date color-grey">May 13, 2020</div>
								<div class="post-topic">I wish I was the monster you think of</div>
							</div>
						</div>
					</div>
				</div>

				<!-- keep up with us -->
				<div>
					<h2>Keep up with us</h2>
					<div class="row">
						<i class="fa fa-facebook-square" aria-hidden="true"></i>
						<div style="width: 10px"></div>
						<i class="fa fa-twitter-square" aria-hidden="true"></i>
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