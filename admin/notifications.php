<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_notifications = $object->get_rows_from_one_table_by_id('admin_notifications_tbl','admin_id',$uid);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
  ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <!-- <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Notifications</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_notifications == null){
                        echo "<tr><td>No Notifications...</td></tr>";
                      } else{ ?>
                  <tr>
                    <th scope="col">Notification Heading</th>
                    <th scope="col">Notification</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                   <?php
                   foreach($get_notifications as $value){
                     ?>
                      <tr>
                        <td><h4><?php echo $value['notification_heading'];?></h4></td>
                        <td><?php echo $value['notification'];?></td>
                        <td><?php echo $value['date_created'];?></td>
                       <td>
                        <div id="checked<?php echo $value['unique_id'];?>">
                          <?php
                            if($value['status'] == 0){
                              echo "<small class='badge badge-sm badge-danger'>Unread</small>";
                            }else{
                              echo "<small class='badge badge-sm badge-success'>Read</small>";
                            }
                          ?>
                        </td> 
                      </div>
                        <td>
                          <?php
                          if($value['status'] == 1){
                            ?>
                            <div id="unread<?php echo $value['unique_id'];?>">
                              <button title="mark as unread" style="font-size:8px" class="btn btn-sm btn-danger admin_mark_as_unread" id="<?php echo $value['unique_id'];?>">
                                <i class="fa fa-check" ></i>
                              </button>
                              <form method="post" id="admin_mark_as_unread_form<?php echo $value['unique_id'];?>">
                              <input type="hidden" name="unique_id" value="<?php echo $value['unique_id'];?>">
                            </form>
                            </div>
                        <?php }
                        ?>
                        </td>  
                      </tr>
                <?php } } ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
             <!--  <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav> -->
            </div>
          </div>
        </div>
      </div>
      <!-- Dark table -->


         

      <br>
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>