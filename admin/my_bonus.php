<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_bonus = $object->get_rows_from_one_table_by_two_params('target_bonus_commission','set_for', $uid, 'bonus_status', 0);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name !=  'Business Executive'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
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
              <h3 class="mb-0">Available bonus</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_bonus == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
 
                        <th scope="col">Bonus Amount</th>
                        <th scope="col">Date Set</th>
                        <th scope="col">Status</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_bonus as $value){
                    if($value['bonus'] == null){
                      echo "<div class='m-3' style='color: red; font-size: 13px'>NO BONUS AVAILABLE, PLEASE CHECK LATER</div>";
                    }else{
                         
                     ?>
                     <tr>
                        <td>&#8358;<?php echo number_format($value['bonus']);?></td>
                        <td><?php echo $object->formatted_date($value['date_created']);?></td>
                        <?php //if($found > 0){?>
                          <td>
                          <?php if($value['bonus_status'] == 1){?>
                          <small class="badge badge-sm badge-primary">Pending</small> 
                          <?php }else if($value['bonus_status'] == 2){?>
                            <small class="badge badge-sm badge-success">Approved</small>
                              <?php }else if($value['bonus_status'] == 3){?>
                            <small class="badge badge-sm badge-danger">Declined</small>
                              <?php }else if($value['bonus_status'] == 0){?>
                            <small class="badge badge-sm badge-warning">Not Claimed</small>
                            <?php }else if($value['bonus_status'] == 4){?>
                            <small class="badge badge-sm badge-info">Queried</small>
                             <?php }?>
                          </td>
                          <td>
                          <?php if($value['bonus_status'] == 0){?>
                        <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#claim<?php echo $value['id']; ?>">Claim Bonus</small> 
                        <?php }?>
                        </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md" id="claim<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Claim Bonus</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to claim this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success claim_bonus" name="claim_bonus" id="<?php echo $value['unique_id']; ?>">Claim</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="claim_bonus_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>

                      </tr>
                <?php } } }?>
                 
                 
                 
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