<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
 
$get_feedback = $object->get_rows_from_one_table_by_one_param('feedback_tbl','user_id', $uid);
$get_complaint = $object->get_rows_from_one_table_by_one_param('contact_us_tbl','user_id', $uid);

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
              <h3 class="mb-0">This is a list of your Feedbacks/Complaints</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_feedback == null && $get_complaint == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Full name</th>
                        
                        <th scope="col">Heading/Issues</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Status</th>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_feedback as $value){
                          $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $value['heading'];?></td>
                        <td><?php echo $value['comment'];?></td>
                        <td>
                        <?php
                          if($value['status'] == 0){
                          ?> 
                          <small class="badge badge-primary">New</small>
                        <?php } else if($value['status'] == 1){
                          ?>
                          <small class="badge badge-info">Escalated</small>
                          <?php
                        }else if($value['status'] == 2){
                          ?>
                          <small class="badge badge-success">Noted</small>
                          <?php
                        }
                          ?>
                      </td>
                      </tr>
                <?php } 
                    foreach($get_complaint as $value){
                          $get_user = $object->get_one_row_from_one_table('users_tbl','unique_id',$value['user_id']);
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $value['issues'];?></td>
                        <td><?php echo $value['comment'];?></td>
                        <td>
                           <?php
                              if($value['status'] == 0){
                            ?> 
                            <small class="badge badge-primary">New</small>
                          <?php } else if($value['status'] == 1){
                            ?>
                            <small class="badge badge-info">Escalated</small>
                            <?php
                          }else if($value['status'] == 2){
                            ?>
                            <small class="badge badge-success">Resolved</small>
                            <?php
                          }
                          ?>
                        </td>
                      </tr>
                <?php }
                } ?>
                 
                 
                 
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


         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>