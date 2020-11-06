<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$count = 0;
	function fetch_data($offset, $limit=4, $categoryid = -1){
		if ($categoryid == -1){
			$Blog = new blog;
			$popularBlog = $Blog->getAllPopularBlogWithLimit($offset, $limit);
		}else{
			$Blog = new blog;
			$popularBlog = $Blog->getAllRecentBlogByCategoryWithLimit($categoryid, $offset, $limit);
		}
		return $popularBlog;
	}
	$offset = $_POST['offset'];
	$limit = $_POST['limit'];
	if (isset($_POST['categoryid']) && !empty($_POST['categoryid'])){
		$categoryid = $_POST['categoryid'];
		$popularBlog = fetch_data($offset , $limit, $categoryid);
	}else{
		$popularBlog = fetch_data($offset ,$limit);
	}
	if ($popularBlog) {
		foreach ($popularBlog as $key => $blog) {
			$count += 1;
			# code...
?>
			<!-- post -->
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
			<a class="post-img col-img" href="blog?id=<?php echo $blog->id ?>"><img class="post-thumb" src="<?php echo $thumbnail; ?>" alt="Snow" style="width:100%; height: 25vh"></a>
			<div class="meta-col">
				<div class="post-date color-grey"><?php echo date('M d, Y',strtotime($blog->created_date)); ?></div>
				<div class="post-topic"><a href="blog?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></div>
				<div class="post-des"><?php echo html_entity_decode(substr(explode('..break..', $blog->content)[0], 0, 300).'.......') ?><a href="blog?id=<?php echo $blog->id ?>">Show More</a></div>
			</div>
		</div>
		<div style="height: 10px"></div>
			<!-- /post -->
<?php
		}
	}
	if ($count == 0){
?>
	<p style="text-align: center;">Sorry!!!  No More Results</p>
<?php
	}
?>
