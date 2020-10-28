
<?php
$header = "Category"; 
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
                <h3>Category</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Categories</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addCategory()">Add Category</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Category Name</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Category = new category();
                          $categories = $Category->getAllCategory();
                          // debugger($categories);
                          if ($categories) {
                            foreach ($categories as $key => $category) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $category->categoryname;?></td>
                            <td><?php echo html_entity_decode($category->description);?></td>
                            <?php
                                if(isset($category->image) && !empty($category->image) && file_exists(UPLOAD_PATH."category/".$category->image)){
                                  $thumbnail = UPLOAD_URL.'category/'.$category->image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            ?>
                            <td><img src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editCategory(this);" data-category_info='<?php echo(json_encode($category))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/category?id=<?php echo($category->id)?>&amp;act=<?php echo substr(md5("Delete-Category-".$category->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
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
                              <h4 class="modal-title" id="title">Add Category</h4>
                            </div>
                            <form action="process/category.php" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Category Name</label>
                                    <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="categoryname" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Category Description</label>
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
                                <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($category_image->id) && !empty($category_image->id))?"$category_image->id":""?>">
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

  function addCategory(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Category');
    $('#categoryname').val("");
    $('#id').removeAttr('value');
    var path = "<?php echo UPLOAD_URL?>insert.jpg";
    $('#imgid img').attr("src",path);
    showModal();
  }

  function editCategory(element){
    var category_info = $(element).data("category_info");

    if (typeof(category_info) != "object"){
      category_info = JSON.parse(category_info);
    }
     console.log(category_info);

    $('#title').html('Edit Category');
    $('#categoryname').val(category_info.categoryname);
    $('#id').val(category_info.id);
      //to show previously added image
      var string='';
      var image_id = category_info.image;
      if (image_id!=''){
        var path = string.concat("<?php echo UPLOAD_URL.'category/'?>",image_id);
      }else{
        var path = string.concat("<?php echo UPLOAD_URL?>",noimg.png);
      }
       $('#imgid img').attr("src",path);
    showModal(category_info.description); 
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