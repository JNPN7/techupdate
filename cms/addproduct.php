
<?php
$header = "Product"; 
    include 'inc/header.php';
    include 'inc/checklogin.php';
?>

<?php
  $action="Add";
  if ($_GET) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
      $product_id = (int)$_GET['id'];
      if ($product_id) {
        $act = substr(md5("Edit-Product-".$product_id.$_SESSION['token']), 3,15);
        if ($act==$_GET['act']) {
          $Product = new product();
          $product_info = $Product->getProductbyId($product_id);
          // debugger($product_info,true);
          if ($product_info) {
            $product_info = $product_info[0];
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
                <h3>Product</h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $action?> Products</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form action="process/product" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-8">
                          <label for="">Product Name</label>
                          <input type="text" class="form-control" name="productname" id="productname" placeholder="Product Title" value="<?php echo (isset($product_info->productname) && !empty($product_info->productname))?$product_info->productname:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Description</label>
                          <textarea class="form-control" name="description" id="description" placeholder="Content" cols="30" rows="10">
                            <?php echo (isset($product_info->description) && !empty($product_info->description))?$product_info->description:"" ?>
                          </textarea>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Made of</label>
                          <input type="text" class="form-control" name="madeof" id="madeof" placeholder="made of" value="<?php echo (isset($product_info->madeof) && !empty($product_info->madeof))?$product_info->madeof:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Selling Price</label>
                          <input type="text" class="form-control" name="acprice" id="acprice" placeholder="selling Price" value="<?php echo (isset($product_info->acprice) && !empty($product_info->acprice))?$product_info->acprice:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Previous Price</label>
                          <input type="text" class="form-control" name="cprice" id="cprice" placeholder="prev. Price" value="<?php echo (isset($product_info->cprice) && !empty($product_info->cprice))?$product_info->cprice:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Type</label><br>
                          <input type="radio"  name="featured" id="featured" value="Featured" <?php echo (isset($product_info->featured) && !empty($product_info->featured) && $product_info->featured=='Featured')?"Checked":"" ?>> Featured<br>
                          <input type="radio"  name="featured" id="featured" value="notFeatured" <?php echo (isset($product_info->featured) && !empty($product_info->featured) && $product_info->featured=='notFeatured')?"Checked":"" ?>> Not Featured<br>
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Size</label>
                          <input type="text" class="form-control" name="size" id="size" placeholder="size" value="<?php echo (isset($product_info->size) && !empty($product_info->size))?$product_info->size:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
                          <label for="">Weight</label>
                          <input type="text" class="form-control" name="weight" id="weight" placeholder="weight" value="<?php echo (isset($product_info->weight) && !empty($product_info->weight))?$product_info->weight:"" ?>">
                        </div>
                        <div class="form-group col-md-8">
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
                        <div class="form-group col-md-8">
                          <label for="">Product Image</label>
                          <input type="file"  name="image[]" id="image" accept="image/*" multiple="multiple">
                        </div>
                        <?php
                          if(isset($product_info) && !empty($product_info)){
                            $imageArray = explode(" ", $product_info->image);
                            // debugger($imageArray,true);
                            foreach ($imageArray as $key => $image) {
                                  if(isset($image) && !empty($image) && file_exists(UPLOAD_PATH."product/".$image)){
                                  $thumbnail = UPLOAD_URL.'product/'.$image;
                                }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            }
                            }else{
                                  $thumbnail = UPLOAD_URL.'noimg.png';
                                }
                            // debugger($thumbnail,true);
                        ?>
                       <?php
                       // debugger($product_info);
                            // if(isset($product_info->image) && !empty($product_info->image) && file_exists(UPLOAD_PATH."product/".$product_info->image)){
                            //   $thumbnail = UPLOAD_URL.'product/'.$product_info->image;
                            // }else{
                            //   $thumbnail = UPLOAD_URL.'noimg.png';
                            // }
                            ?>

                        <div class="form-group col-md-8">
                               
                          <img src="<?php echo($thumbnail)?>" id="thumbnail" style="width: 150px; height: auto;">
                        </div>
                        <!-- <div class="gallery">
                          
                        </div> -->
                        <div class="form-group col-md-8">
                          <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($product_image->id) && !empty($product_image->id))?"$product_image->id":""?>">
                           <input type="hidden" name="id" id="id" value="<?php echo(isset($product_info->id) && !empty($product_info->id))?"$product_info->id":""?>">    
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

  
    
  var description = $('#description').val();    //for description for while editing
  ckeditor(description);

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


// $(function() {
//     // Multiple images preview in browser
//     var imagesPreview = function(image, thumbnail) {

//         if (image.files) {
//             var filesAmount = image.files.length;
//             console.log(filesAmount);
//             for (i = 0; i < filesAmount; i++) {
//                 var reader = new FileReader();
//                 console.log(i);
//                 reader.onload = function(e) {
//                     // var idname = 'thumbnail' + i;
//                     // console.log(idname);
//                     // document.getElementById(idname).src = e.target.result;
//                     $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(thumbnail);
//                 }
//                 reader.readAsDataURL(image.files[i]);
//                 console.log(image.files[i]);
//             }
//         }

//     };

//     $('#image').on('change', function() {
//         imagesPreview(this, 'div.gallery');
//     });
// });


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