
<?php
$header = "Sale"; 
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
                <h3>Sale</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Categories</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addSale()">Add Sale</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Sale Name</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Product ID</th>
                          <th style="text-align: center">Discount</th>
                          <th style="text-align: center">Category Name</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Sale = new sale();
                          $sales = $Sale->getAllSale();
                          $Category = new category();
                          // debugger($sales);
                          if ($sales) {
                            foreach ($sales as $key => $sale) {
                              $categories = $Category->getCategorybyId($sale->categoryid);
                              // debugger($categories);
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $sale->productname;?></td>
                            <td><?php echo html_entity_decode($sale->description);?></td>
                            <td><?php echo $sale->productid; ?></td>
                            <td><?php echo $sale->discount;?></td>
                            <td><?php echo $categories[0]->categoryname;?></td>
                            <?php
                                if(isset($sale->image) && !empty($sale->image) && file_exists(UPLOAD_PATH."sale/".$sale->image)){
                                  $thumbnail = UPLOAD_URL.'sale/'.$sale->image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            ?>
                            <td><img src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editSale(this);" data-sale_info='<?php echo(json_encode($sale, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/sale?id=<?php echo($sale->id)?>&amp;act=<?php echo substr(md5("Delete-Sale-".$sale->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this sale?');">
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
                              <h4 class="modal-title" id="title">Add Sale</h4>
                            </div>
                            <form action="process/sale.php" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name="salename" id="salename" placeholder="salename" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Sale Description</label>
                                    <textarea class="form-control" id="description" name="description" required="" cols="30" rows="10"> </textarea>
                                </div>
                                <div class="form-group" id="#ed">
                                    <label for="">Product ID</label>
                                    <input type="text" class="form-control" name="productid" id="productid" placeholder="productid" required="">
                                </div>
                                <div class="form-group" id="#ed">
                                    <label for="">Discount</label>
                                    <input type="number" class="form-control" name="discount" id="discount" placeholder="discount" required="">
                                </div>
                                <div class="form-group">
                                  <label for="">Category</label>
                                  <select name="categoryid" id="categoryid" class="form-control">
                                    <option value="" selected="selected" disabled="disabled">--Select Category--</option>
                                    <?php
                                    $Category = new category();
                                    $categories = $Category->getAllCategory();
                                    if ($categories) {
                                      foreach ($categories as $key => $category) {
                                        ?>
                                        <option value="<?php echo($category->id)?>" <?php  if(isset($product_info) && !empty($product_info)){ echo ($product_info->categoryid==$category->id)?"selected":""; } ?>><?php echo $category->categoryname;?></option>
                                        <?php  
                                      }
                                    }
                                    ?>
                                  </select>
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
                                <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($sale_image->id) && !empty($sale_image->id))?"$sale_image->id":""?>">
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

  function addSale(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Sale');
    $('#salename').val("");
    $('#productid').val("");
    $('#id').removeAttr('value');
    var path = "<?php echo UPLOAD_URL?>insert.jpg";
    $('#imgid img').attr("src",path);
    showModal();
  }

  function editSale(element){
    var sale_info = $(element).data("sale_info");

    if (typeof(sale_info) != "object"){
      sale_info = JSON.parse(sale_info);
    }
     console.log(sale_info);

    $('#title').html('Edit Sale');
    $('#salename').val(sale_info.productname);
    $('#productid').val(sale_info.productid);
    $('#discount').val(sale_info.discount);
    $('#categoryid').val(sale_info.categoryid);
    $('#id').val(sale_info.id);
      //to show previously added image
      var string='';
      var image_id = sale_info.image;
      if (image_id!=''){
        var path = string.concat("<?php echo UPLOAD_URL.'sale/'?>",image_id);
      }else{
        var path = string.concat("<?php echo UPLOAD_URL?>",noimg.png);
      }
       $('#imgid img').attr("src",path);
    showModal(sale_info.description); 
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