
<?php
$header = "Contactinfo"; 
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
                <h3>Contactinfo</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Categories</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addContactinfo()">Add Contact Info.</a>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Map Link</th>
                          <th style="text-align: center">Description</th>
                          <th style="text-align: center">Address</th>
                          <th style="text-align: center">Phone Number</th>
                          <th style="text-align: center">Email</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Contactinfo = new contactinfo();
                          $contactinfos = $Contactinfo->getAllContactinfo();
                          // debugger($contactinfos);
                          if ($contactinfos) {
                            foreach ($contactinfos as $key => $contactinfo) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo substr($contactinfo->maplink, 0,20)."...";?></td>
                            <td><?php echo html_entity_decode($contactinfo->description);?></td>
                            <td><?php echo $contactinfo->address;?></td>
                            <td><?php echo $contactinfo->phone_number;?></td>
                            <td><?php echo $contactinfo->email;?></td>
                            <td>
                              <a href="javascript:;" class="btn btn-info" onclick="editContactinfo(this);" data-contactinfo_info='<?php echo(json_encode($contactinfo, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE))?>'>
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="process/contactinfo?id=<?php echo($contactinfo->id)?>&amp;act=<?php echo substr(md5("Delete-Contactinfo-".$contactinfo->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contactinfo?');">
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
                              <h4 class="modal-title" id="title">Add Contact Info</h4>
                            </div>
                            <form action="process/contactinfo.php" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="form-group" id="#ed">
                                    <label for="">Map Link</label>
                                    <input type="text" class="form-control" name="maplink" id="maplink" placeholder="maplink" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">About Us</label>
                                    <textarea class="form-control" id="description" name="description" required="" cols="30" rows="10"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="address" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="number" class="form-control" name="contactnumber" id="contactnumber" placeholder="contactnumber" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="email" required="">
                                </div>
                              </div>
                              <div class="modal-footer">
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

  function addContactinfo(){
    $('#ed').addClass('form-group');
    $('#title').html('Add Contact Info.');
    $('#contactinfoname').val("");
    $('#id').removeAttr('value');
    showModal();
  }

  function editContactinfo(element){
    console.log(element);
    var contactinfo_info = $(element).data("contactinfo_info");

    if (typeof(contactinfo_info) != "object"){
      var contactinfo_info = JSON.parse(contactinfo_info);
    }
     console.log(contactinfo_info);

    $('#id').val(contactinfo_info.id);
    $('#title').html('Edit Contact Info.');
    $('#maplink').val(contactinfo_info.maplink);
    $('#address').val(contactinfo_info.address);
    $('#contactnumber').val(contactinfo_info.phone_number);
    $('#email').val(contactinfo_info.email);
    showModal(contactinfo_info.description); 
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
  
</script>