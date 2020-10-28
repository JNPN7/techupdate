
<?php
$header = "Query"; 
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
                <h3>Query</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Querys</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="datatable" class="table table-striped table-bordered " style="text-align: center">
                        <thead >
                          <th style="text-align: center">S.N</th>
                          <th style="text-align: center">Name</th>
                          <th style="text-align: center">Message</th>
                          <th style="text-align: center">Time</th>
                          <th style="text-align: center">Query Type</th>
                          <th style="text-align: center">Query ID</th>
                          <th style="text-align: center">Product ID</th>
                          <th style="text-align: center">Status</th>
                          <th style="text-align: center">Action</th>
                        </thead>
                        <tbody>
                          <?php $Query = new query();
                          $querys = $Query->getAllQuery();
                          // debugger($querys, true);
                          if ($querys) {
                            foreach ($querys as $key => $query) {
                          ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $query->name;?></td>
                            <td><?php echo html_entity_decode($query->message);?></td>
                            <td><?php echo date("M d, Y h:i:s a",strtotime($query->created_date));?></td>
                            <td><?php echo $query->queryType;?></td>
                            <td><?php echo (isset($query->questionid) && !empty($query->questionid))?$query->questionid:"Null";?></td>
                            <td><?php echo $query->productid;?></td>
                            <td><?php echo $query->state;?></td>
                            <td>
                              <a href="process/query?id=<?php echo($query->id)?>&amp;act=<?php echo substr(md5("Accept-Query-".$query->id.$_SESSION['token']), 3,15) ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to accept this query?');">
                                <i class="fa fa-check"></i>
                              </a>
                              <a href="process/query?id=<?php echo($query->id)?>&amp;act=<?php echo substr(md5("Reject-Query-".$query->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this query?');">
                                <i class="fa fa-close"></i>
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
