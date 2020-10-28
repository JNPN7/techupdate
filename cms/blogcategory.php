
<?php
$header = "BlogCategory"; 
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
                <h3>BlogCategory</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Blog Categories</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addBlogCategory()">Add Blog Category</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Blog Category Name</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $BlogCategory = new blogcategory();
                          $blogcategories = $BlogCategory->getAllBlogCategory();
                          // debugger($blogcategories);
                          if ($blogcategories) {
                            foreach ($blogcategories as $key => $blogcategory) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $blogcategory->categoryname;?></td>
                            <td><?php echo html_entity_decode($blogcategory->description);?></td>
                            <?php
                                if(isset($blogcategory->image) && !empty($blogcategory->image) && file_exists(UPLOAD_PATH."blogcategory/".$blogcategory->image)){
                                  $thumbnail = UPLOAD_URL.'blogcategory/'.$blogcategory->image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            ?>
                            <td><img src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editBlogCategory(this);" data-blogcategory_info='<?php echo(json_encode($blogcategory))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/blogcategory?id=<?php echo($blogcategory->id)?>&amp;act=<?php echo substr(md5("Delete-BlogCategory-".$blogcategory->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blogcategory?');">
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
                      
                      <div class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h4 class="modal-title" id="title">Add Blog Category</h4>
                            </div>
                            <form action="process/blogcategory.php" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Blog Category Name</label>
                                    <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="categoryname" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Blog Category Description</label>
                                    <textarea class="form-control" id="description" name="description" required="" cols="30" rows="10"> </textarea>
                                </div>
                                <div class="form-group">
                                  <label for="">Image</label>
                                  <input type="file"  name="image" id="image" accept="image/*">
                                </div>
                                <div class="form-group" id="imgid">       
                                  <img src="" style="width: 300px; height: auto;" id="thumbnail" style="width: 300px; height: auto;">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($blogcategory_image->id) && !empty($blogcategory_image->id))?"$blogcategory_image->id":""?>">
                                <input type="hidden" id="id" name="id">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="sumbit" class="btn btn-primary">Save changes</button>
                              </div>                
                            </form>
                            
        
                        </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->
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

  function addBlogCategory(){
    $('#ed').addClass('form-group');
    $('#title').html('Add BlogCategory');
    $('#categoryname').val("");
    $('#id').removeAttr('value');
    var path = "<?php echo UPLOAD_URL?>insert.jpg";
    $('#imgid img').attr("src",path);
    showModal();
  }

  function editBlogCategory(element){
    var blogcategory_info = $(element).data("blogcategory_info");

    if (typeof(blogcategory_info) != "object"){
      blogcategory_info = JSON.parse(blogcategory_info);
    }
     console.log(blogcategory_info);

    $('#title').html('Edit Blog Category');
    $('#categoryname').val(blogcategory_info.categoryname);
    $('#id').val(blogcategory_info.id);
      //to show previously added image
      var string='';
      var image_id = blogcategory_info.image;
      if (image_id!=''){
        var path = string.concat("<?php echo UPLOAD_URL.'blogcategory/'?>",image_id);
      }else{
        var path = string.concat("<?php echo UPLOAD_URL?>",noimg.png);
      }
       $('#imgid img').attr("src",path);
    showModal(blogcategory_info.description); 
  }

  function showModal(data=""){
    ckeditor(data);
    $('.modal').modal();
  }

  function ckeditor(data=""){
    $('.ck').remove();
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .then( editor => {
        editor.setData(data);
    } )
    .catch( error => {
        console.error( error );
    } );
  }
  

  //for the thumbnail
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