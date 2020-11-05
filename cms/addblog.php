
<?php
$header = "Blog"; 
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>

<?php
  $action="Add";
  if ($_GET) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $blog_id = (int)$_GET['id'];
      if ($blog_id) {
        $act = substr(md5("Edit-Blog-".$blog_id.$_SESSION['token']), 3,15);
        if ($act==$_GET['act']) {
          $Blog = new blog();
          $blog_info = $Blog->getBlogbyId($blog_id);
          // debugger($blog_info,true);
          if ($blog_info) {
            $blog_info = $blog_info[0];
            $action="Edit";
          }
        }
      }
    }
  }
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
                    <h2><?php echo $action?> Blogs</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/blog" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-8">
                          <label for="">Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Blog Title" value="<?php echo (isset($blog_info->title) && !empty($blog_info->title))?$blog_info->title:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Content</label>
                          <textarea class="form-control" name="content" id="content" placeholder="Content" cols="30" rows="10">
                            <?php echo (isset($blog_info->content) && !empty($blog_info->content))?$blog_info->content:"" ?>
                          </textarea>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Quote</label>
                          <textarea class="form-control" name="quote" id="quote" placeholder="Content" cols="1" rows="1">
                            <?php echo (isset($blog_info->quote) && !empty($blog_info->quote))?$blog_info->quote:"" ?>
                          </textarea>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Blogger Name</label>
                          <input type="text" class="form-control" name="bloggername" id="bloggername" placeholder="Blogger Name" value="<?php echo (isset($blog_info->bloggername) && !empty($blog_info->bloggername))?$blog_info->bloggername:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Type</label><br>
                          <input type="radio"  name="featured" id="featured" value="Featured" <?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured=='Featured')?"Checked":"" ?>> Featured<br>
                          <input type="radio"  name="featured" id="featured" value="notFeatured" <?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured=='notFeatured')?"Checked":"" ?>> Not Featured<br>
                        </div>
                            <?php
                              $BlogCategory = new blogcategory();
                            $blogcategories = $BlogCategory->getAllBlogCategory();
                            // debugger($blogcategories);
                            ?>
                        <div class="form-group col-md-8">
                          <label for="">Blog Category</label>
                          <select name="blogcategoryid" id="blogcategoryid" class="form-control">
                            <option value="" selected="selected" disabled="disabled">--Select BlogCategory--</option>
                            <?php
                            if ($blogcategories) {
                              foreach ($blogcategories as $key => $blogcategory) {
                                ?>
                                <option value="<?php echo($blogcategory->id)?>" <?php  if(isset($blog_info) && !empty($blog_info)){ echo ($blog_info->blogcategoryid==$blogcategory->id)?"selected":""; } ?>><?php echo $blogcategory->categoryname;?></option>
                                <?php  
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Blog Image</label>
                          <input type="file"  name="image[]" id="image" accept="image/*" multiple="multiple">
                        </div>

                       <?php
                          if(isset($blog_info) && !empty($blog_info)){
                            $imageArray = explode(" ", $blog_info->image);
                            // debugger($imageArray,true);
                            foreach ($imageArray as $key => $image) {
                                  if(isset($image) && !empty($image) && file_exists(UPLOAD_PATH."blog/".$image)){
                                  $thumbnail = UPLOAD_URL.'blog/'.$image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            }
                            }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            // debugger($thumbnail,true);
                        ?>

                        <div class="form-group col-md-8">
                               
                          <img src="<?php echo($thumbnail)?>" id="thumbnail" style="width: 300px; height: auto;">
                        </div>
                        <!-- <div class="gallery">
                          
                        </div> -->
                        <div class="form-group col-md-8">
                          <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($blog_image->id) && !empty($blog_image->id))?"$blog_image->id":""?>">
                          <input type="hidden" name="id" id="id" value="<?php echo(isset($blog_info->id) && !empty($blog_info->id))?"$blog_info->id":""?>">    
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </form>  
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
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  
    
  var content = $('#content').val();    //for content for while editing
  ckeditor(content);

  function ckeditor(data=""){
    $('.ck').remove();
    ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        editor.setData(data);
    } )
    .catch( error => {
        console.error( error );
    } );
  }

  //   var quote = $('#quote').val();    //for quote for while editing
  // ckeditor(quote);

  // function ckeditor(data=""){
  //   $('.ck').remove();
  //   ClassicEditor
  //   .create( document.querySelector( '#quote' ) )
  //   .then( editor => {
  //       editor.setData(data);
  //   } )
  //   .catch( error => {
  //       console.error( error );
  //   } );
  // }

    document.getElementById("image").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("thumbnail").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>