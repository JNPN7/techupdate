<?php
$header = "Follow Us"; 
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
          <h3>Follow Us</h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>List of Follow Us</h2>

              <ul class="nav navbar-right panel_toolbox">
                <a href="#" class="btn btn-primary" onclick="addFollowUs()">Add Follow Us Icon</a>
              </ul>

              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                  <thead >
                    <th style="text-align: center">S.N.</th>
                    <th style="text-align: center">Icon Name</th>
                    <th style="text-align: center">URL</th>
                    <th style="text-align: center">Action</th>
                  </thead>
                  <tbody>
                    <?php $FollowUs = new followus();
                    $followuss = $FollowUs->getAllFollowUs();
                       //debugger($followuss);
                    if ($followuss) {
                      foreach ($followuss as $key => $followus) {
                    ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><a href="<?php echo $followus->iconname;?>"><?php echo $followus->iconname;?></a></td>
                      <td><a href="<?php echo $followus->url;?>"><?php echo $followus->url;?></a></td>  
                      <td>
                        <a href="javascript:;" class="btn btn-info" onclick="editFollowUs(this); " data-followus_info='<?php echo(json_encode($followus))?>'>
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="process/followus?id=<?php echo($followus->id)?>&amp;act=<?php echo substr(md5("Delete-FollowUs-".$followus->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this followus?');">
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
                        <h4 class="modal-title" id="title">Add FollowUs</h4>
                      </div>
                      <form action="process/followus.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="">Icon Name</label>
                              <input type="text" class="form-control" name="iconname" id="iconname" placeholder="iconname" required="" >
                          </div>
                          <div class="form-group">
                              <label for="">URL</label>
                              <input type="text" class="form-control" name="url" id="url" placeholder="url" required="" >
                          </div>                                       
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" name="old_img" id="old_img" value="<?php echo(isset($followus_image->id) && !empty($followus_image->id))?"$followus_image->id":""?>">
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
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">

  function addFollowUs(){
    $('#title').html('Add Follow Us Icon');
    $('#iconname').val("");
    $('#url').val("");
    $('#id').removeAttr('value');
    showModal();
  }

  function editFollowUs(element){
    var followus_info = $(element).data('followus_info');
    if (typeof(followus_info) != 'object'){
      followus_info = JSON.parse(followus_info);
    }

    $('#title').html('Edit Follow Us Icon');
    $('#iconname').val(followus_info.iconname);
    $('#url').val(followus_info.url);
    $('#id').val(followus_info.id); 
    showModal();  
  }
  
  function showModal(data=""){
    $('.modal').modal();
  }

</script>