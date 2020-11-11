<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	include 'includes/header.php';

            $BlogCategory = new blogcategory();
            $Blog = new blog();
?>
<main role="main" class="main">
    <div class="row">
        <div class="main-section">
            <div class="main-pad" style="padding-top: 40px">

                <!---------------- new design ------------------->
                <?php
                    $keyword = $_GET['keyword'];
                    if($keyword == "") {
                        goBack();
                    }
                    else {
                        $Database = new database();
                        $sqlForBlogs = "SELECT id, title, created_date, content, quote, bloggername, image FROM blogs";
                        $count = 0;
                        
                        $data = $Database->getDataFromQuery($sqlForBlogs);
                        if(count($data) > 0) {
                            $count += search($data, $keyword, 1);
                        }
                        if(!$count) {
                            echo '<div class="searchResults"><p>No results found!!</p></div>';
                        }
                    }
                ?>
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
    
    $(document).ready(function(){
        var pagination = $('.pagination').data('val');
        offset = (pagination - 1) * 7;
        categoryid = $('#filter_data').data('categoryid');
        console.log(offset);
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
        var pagination = parseInt($('.pagination').data('val'));
        categoryid = $('#filter_data').data('categoryid');
        if (inputId == "<"){
            pagination -= 1;
            if(pagination > 0){
                offset = (pagination - 1) * limit;
                $('.pagination').data('val', pagination);
                $('#' + pagination).addClass('active').siblings().removeClass('active');
            }
        }else if (inputId == ">"){
            pagination += 1;
            offset = (pagination - 1) * limit;
            $('.pagination').data('val', pagination);
            $('#' + pagination).addClass('active').siblings().removeClass('active');
        }else{
            pagination = inputId;
            offset = (pagination - 1) * limit;
            $(this).addClass('active').siblings().removeClass('active');
            $('.pagination').data('val', inputId);
        }
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