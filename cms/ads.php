<?php
$header = "Advertisement"; 
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
          <h3>Advertisement</h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>List of Advertisements</h2>

              <ul class="nav navbar-right panel_toolbox">
                <a href="#" class="btn btn-primary" onclick="addAdvertisement()">Add Advertisement</a>
              </ul>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                  <thead >
                    <th style="text-align: center">S.N</th>
                    <th style="text-align: center">URL</th>
                    <th style="text-align: center">Caption</th>
                    <th style="text-align: center">Type</th>
                    <th style="text-align: center">Image</th>
                    <th style="text-align: center">Action</th>
                  </thead>
                  <tbody>
                    <?php $Advertisement = new advertisement();
                    $advertisements = $Advertisement->getAllAdvertisement();
                     //debugger($advertisements);
                    if ($advertisements) {
                      foreach ($advertisements as $key => $advertisement) {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><a href="<?php echo $advertisement->url;?>"><?php echo $advertisement->url;?></a></td>
                      <td><?php echo html_entity_decode($advertisement->caption);?></td>
                      <td><?php echo $advertisement->type;?></td>
                      <?php
                          if(isset($advertisement->image) && !empty($advertisement->image) && file_exists(UPLOAD_PATH."advertisement/".$advertisement->image)){
                            $thumbnail = UPLOAD_URL.'advertisement/'.$advertisement->image;
                          }else{
                            $thumbnail = UPLOAD_URL.'noimg.png';
                          }
                      ?>
                      <td><img src="<?php echo($thumbnail) ?>"alt="" style="width: 300px; height: auto"></td>
                      
                      <td>
                        <a href="javascript:;" class="btn btn-info" onclick="editAdvertisement(this); " data-advertisement_info='<?php echo(json_encode($advertisement))?>'>
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="process/advertisement?id=<?php echo($advertisement->id)?>&amp;act=<?php echo substr(md5("Delete-Advertisement-".$advertisement->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this advertisement?');">
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
                        <h4 class="modal-title" id="title">Add Advertisement</h4>
                      </div>
                      <form action="process/advertisement.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="">URL</label>
                              <input type="text" class="form-control" name="url" id="url" placeholder="url" required="" >
                          </div>
                          <div class="form-group">
                              <label for="">Caption</label>
                              <textarea class="form-control" name="caption" id="caption"  required="" cols="30" rows="10"></textarea>
                          </div>
                          <div class="form-group" id=abc>
                            <label for="">Type</label><br>
                            <input type="radio"  name="type" id="type1" value="Simple" >  Simple (300 X 250)<br>
                            <input type="radio"  name="type" id="type2" value="Wide" >  Wide (728 X 90)<br>
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
                          <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($advertisement_image->id) && !empty($advertisement_image->id))?"$advertisement_image->id":""?>">
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
<script type="text/javascript">
  var ab = " Advertisement-20200530112306am554.png ";
</script>
<?php $abc = "<script>document.writeln(ab);</script>" ?>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  function addAdvertisement(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Advertisement');
    $('#url').val("");
    $('#caption').val("");
    $('#id').removeAttr('value');
    $('#type1').removeAttr('checked');
    $('#type2').removeAttr('checked');
    //for insert image duing add ads
    var path = "<?php echo UPLOAD_URL?>insert.jpg";
    $('#imgid img').attr("src",path);
    showModal();
  }

  function editAdvertisement(element){
     console.log(element);
    var advertisement_info = $(element).data('advertisement_info');

    if (typeof(advertisement_info) != 'object'){
      advertisement_info = JSON.parse(advertisement_info);
    }
    // console.log(advertisement_info);
    $('#title').html('Edit Advertisement');
    $('#url').val(advertisement_info.url);
    $('#caption').val(advertisement_info.caption);
    $('#id').val(advertisement_info.id);
    if (advertisement_info.type=="Simple") {
      $('#type1').prop("checked",true);
    }if(advertisement_info.type=="Wide"){     
      $('#type2').prop("checked",true);
    }
    //to show previously added image
    var string='';
    var image_id = advertisement_info.image;
    if (image_id!=''){
      var path = string.concat("<?php echo UPLOAD_URL.'advertisement/'?>",image_id);
    }else{
      var path = string.concat("<?php echo UPLOAD_URL?>",noimg.png);
    }
     $('#imgid img').attr("src",path); 
    showModal();  
  }
  
  function showModal(data=""){
   
    $('.modal').modal();
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