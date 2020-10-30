<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';
	$content = "paragraph<start>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.HAHAHAHHAAH<end>image<start>assets/images/mountain2.jpeg,caption<end>paragraph<start>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<end>image<start>assets/images/mountain1.jpeg,caption<end>image<start>assets/images/mountain3.jpeg,caption<end>paragraph<start>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<end>ad<start>90px<end>";
	$arr = explode("<end>", $content);
?>

<section class="parallax category-topic">
	<div style="height: 7vw;"></div>
		<div class="row" style="color: #fff;">
			<a href="index" class="banner-home"><p>Home</p></a>
			<div style="width: 15px"></div>
			<p>/</p>
			<div style="width: 15px"></div>
			<p>Category Name</p>
		</div>
		<h1 style="color: #fff; margin-top: 0;">Category name</h1>
</section>

<main role="main" class="main">
	<div class="row">
		<div class="main-section">
			<div class="main-pad" style="padding-top: 40px">
				<article>
					<div class="post-header ht-60 post-rel">
						<img class="post-thumb" src="assets/images/mountain2.jpeg" alt="Snow" >
						<div class="post-meta">
							<div class="post-date">Jan 2, 2020</div>
							<div>Thats what she said, Micheal scott scott tots nowhere going on and on and on we are good and thanks for asking</div>
						</div>
					</div>
					<?php
						foreach ($arr as $key => $value) {
							$val = explode("<start>", $value);
							if($val[0] == 'paragraph'){

					?>
								<p style="margin: 20px 0 10px 0"><?=$val[1]?></p>
								<div style="height: 20px;"></div>
					<?php
							}elseif ($val[0] == 'image') {
								$fig = explode(",", $val[1])
					?>
								<figure>
									<img src="<?=$fig[0]?>">
									<figcaption><?=$fig[1]?></figcaption>
								</figure>
					<?php
							}elseif ($val[0] == 'ad') {
					?>
								<div style="background-color: grey; height: <?=$val[1]?>">
								</div>
					<?php
							}
						}
					?>
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