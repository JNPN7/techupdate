
<?php
$header = "Product"; 
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
                <h3>Product</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Products</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="addproduct" class="btn btn-primary">Add Product</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: justify;">
                        <thead >
                          <th style="text-align: justify;">S.N</th>
                          <th style="text-align: center">Prod. Name</th>
                          <th style="text-align: center">PID</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Made of</th>
                          <th style="text-align: center">Sell Price</th>
                          <th style="text-align: center">Prev Price</th>
                          <th style="text-align: center">Size</th>
                          <th style="text-align: center">Weight</th>
                          <th style="text-align: center">Type</th>
                          <th style="text-align: center">Category</th>
                          <th style="text-align: center">View</th>
                          <th style="text-align: center">Image</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Product = new product();
                          $products = $Product->getAllProduct();
                          // debugger($products);
                          if ($products) {
                            foreach ($products as $key => $product) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $product->productname;?></td>
                            <td><?php echo $product->id;?></td>
                            <td><?php echo html_entity_decode($product->description);?></td>
                            <td><?php echo $product->madeof;?></td>
                            <td><?php echo $product->acprice;?></td>
                            <td><?php echo $product->cprice;?></td>
                            <td><?php echo $product->size;?></td>
                            <td><?php echo $product->weight;?></td>
                            <td><?php echo $product->featured;?></td>
                            <td><?php echo $product->category;?></td>
                            <td><?php echo (isset($product->view) && !empty($product->view))?$product->view:"0";?></td>
                            <td>
                            <?php
                                $imageArray = explode(" ", $product->image); 
                                // debugger($imageArray);
                                foreach ($imageArray as $key => $img) {
                                    if(isset($img) && !empty($img) && file_exists(UPLOAD_PATH."product/".$img)){
                                        $thumbnail = UPLOAD_URL.'product/'.$img;
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
                            <?php
                                // if(isset($product->image) && !empty($product->image) && file_exists(UPLOAD_PATH."product/".$product->image)){
                                //   // debugger($product);
                                //   $thumbnail = UPLOAD_URL.'product/'.$product->image;
                                // }else{
                                //   $thumbnail = UPLOAD_URL.'noimg.png';
                                // }
                            ?>
                            
                            <td>
                              <a href="addproduct?id=<?php echo($product->id)?>&amp;act=<?php echo substr(md5("Edit-Product-".$product->id.$_SESSION['token']), 3,15) ?>" class="btn btn-info">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/product?id=<?php echo($product->id)?>&amp;act=<?php echo substr(md5("Delete-Product-".$product->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
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

  