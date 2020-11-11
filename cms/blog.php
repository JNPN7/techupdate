
<?php
$header = "Blog"; 
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php
                flashMessage();
            ?>
            <div class="page-title">
              <div class="title_left">               
                <h3>Blog</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Blogs</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="addblog" class="btn btn-primary">Add Blog</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: justify;">
                        <thead >
                          <th style="text-align: justify;">S.N</th>
                          <th style="text-align: center">Title</th>
                          <th style="text-align: center">Content</th>
                          <th style="text-align: center">Quote</th>
                          <th style="text-align: center">Blogger Name</th>
                          <th style="text-align: center">Type</th>
                          <th style="text-align: center">Category</th>
                          <th style="text-align: center">View</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Blog = new blog();
                          $blogs = $Blog->getAllBlog();
                          // debugger($blogs,true);
                          if ($blogs) {
                            foreach ($blogs as $key => $blog) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $blog->title;?></td>
                            <td><?php echo html_entity_decode($blog->content);?></td>
                            <td><?php echo html_entity_decode($blog->quote);?></td>
                            <td><?php echo $blog->bloggername ?></td>
                            <td><?php echo $blog->featured;?></td>
                            <td><?php echo $blog->category;?></td>
                            <td><?php echo (isset($blog->view) && !empty($blog->view))?$blog->view:"0";?></td>
                            <td>
                            <?php
                                $imageArray = explode(" ", $blog->image); 
                                // debugger($imageArray);
                                foreach ($imageArray as $key => $img) {
                                    if(isset($img) && !empty($img) && file_exists(UPLOAD_PATH."blog/".$img)){
                                        $thumbnail = UPLOAD_URL.'blog/'.$img;
                                        // debugger($thumbnail,true);
                                    }else{
                                        $thumbnail = UPLOAD_URL.'noimg.png';
                                    }
                                    // debugger($thumbnail,true);
                                  ?>

                                <img src="<?php echo($thumbnail) ?>"alt="" style="width: 150px; height: auto">
                                <?php
                                }

                            ?>
                            </td>
                            <td>
                              <a href="addblog?id=<?php echo($blog->id)?>&amp;act=<?php echo substr(md5("Edit-Blog-".$blog->id.$_SESSION['token']), 3,15) ?>" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/sendmail?id=<?php echo($blog->id)?>&amp;act=<?php echo substr(md5("Send-Blog-".$blog->id.$_SESSION['token']), 3,15) ?>" class="btn btn-success" onclick="return confirm('Are you ready to send mail to subscribers? Check once before sending.');">
                                <i class="fa fa-inbox"></i>
                              </a>
                              <a href="process/blog?id=<?php echo($blog->id)?>&amp;act=<?php echo substr(md5("Delete-Blog-".$blog->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?');">
                                <i class="fa fa-trash"></i>
                              </a>
                            </td>
                          </tr>           
                          <?php
                            }
                          }
                          ?>
                        </tbody>
                      </table>                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php 
    include 'inc/footer.php';
?>

<script src="assets/js/datatable.js"></script>

  