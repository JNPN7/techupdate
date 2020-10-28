
<?php
$header = "Contact"; 
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
                <h3>Contact</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Contacts</h2>

                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <a href="#" class="btn btn-primary" onclick="addContact()">Add Contact</a>
                    </ul> -->

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Name</th>
                          <th style="text-align: center">Email</th>
                          <th style="text-align: center">Message</th>
                          <th style="text-align: center">Time</th>
                          <th style="text-align: center">Type</th>
                          <!-- <th style="text-align: center">Action</th> -->
                        </thead>
                        <tbody>
                          <?php $Contact = new contact();
                          $contacts = $Contact->getAllContact();
                          // debugger($contacts);
                          if ($contacts) {
                            foreach ($contacts as $key => $contact) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $contact->username;?></td>
                            <td><?php echo $contact->email;?></td>
                            <td><?php echo html_entity_decode($contact->message);?></td>
                            <td><?php echo date("M d, Y h:i:s a",strtotime($contact->created_date));?></td>
                            <td><?php echo $contact->type;?></td>
<!--                             <td>
                              <a href="process/contact?id=<?php echo($contact->id)?>&amp;act=<?php echo substr(md5("Accept-Contact-".$contact->id.$_SESSION['token']), 3,15) ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to accept this contact?');">
                                <i class="fa fa-check"></i>
                              </a>
                              <a href="process/contact?id=<?php echo($contact->id)?>&amp;act=<?php echo substr(md5("Reject-Contact-".$contact->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this contact?');">
                                <i class="fa fa-close"></i>
                              </a>
                            </td> -->
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
