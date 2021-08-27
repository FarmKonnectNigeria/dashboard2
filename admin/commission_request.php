<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('bonus_commission_request','commission_status',0);

?>


<body class="">
  <?php include('includes/sidebar.php'); 
     if($role_name != 'Super Administrator'){
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
              <h3 class="mb-0">This is a list of pending Commission set by Marketing Managers</h3>
              <div class="float-right">
                <button class="btn btn-primary btn-sm" id="pending_commission">Pending Commission</button>
                <button class="btn btn-success btn-sm" id="approved_commission">Approved Commission</button>
                <button class="btn btn-danger btn-sm" id="rejected_commission">Rejected Commission</button>
              </div>
            </div>
            <div class="table_filter">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_request == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Set For</th>
                        <th scope="col">Commission (in percentage)</th>
                        <th scope="col">Date</th>
                        <?php //if($found > 0){?>
                           <th>Action</th>
                        <?php //} ?>

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_request as $value){

                    $get_user = $object->get_one_row_from_one_table('admin_tbl','unique_id',$value['set_for']);
                         
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $get_user['surname'].' '.$get_user['other_names'];?></td>
                        <td><?php echo $value['commission'].'%';?></td>
                        <td><?php echo $value['date_created'];?></td>


                        <?php //if($found > 0){?>
                        <td><span id="approve_commission_modal<?php echo $value['unique_id']; ?>"> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small></span>
                          <span id="reject_commission_modal<?php echo $value['unique_id']; ?>"><small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small></span> </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md approve_modal" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to approve this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-success approve_commission_request" name="approve_commission_request" id="<?php echo $value['unique_id']; ?>">Approve</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="approve_commission_request_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                    <input type="hidden" class="form-control" id="commission" name="commission" value="<?php echo $value['commission']?>">
                                    <input type="hidden" class="form-control" id="set_by" name="set_by" value="<?php echo $value['set_by']?>">
                                    <input type="hidden" class="form-control" id="BE_id" name="BE_id" value="<?php echo $value['set_for']?>">
                                </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade bd-example-modal-md reject_modal" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Reject Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to reject this request?
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-danger reject_commission_request" name="reject_commission_request" id="<?php echo $value['unique_id']; ?>">Reject</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                                <form method="post" id="reject_commission_request_form<?php echo $value['unique_id']; ?>">
                                    <input type="hidden" class="form-control" id="unique_id" name="unique_id" value="<?php echo $value['unique_id']?>">
                                </form>
                            </div>
                          </div>
                        </div>
  

                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#approved_commission").click(function(e){
      e.preventDefault();
      $.ajax({
  url:"approved_commission.php",
  method:"POST",
  success:function(data){
    $(".table_filter").empty();
    $(".table_filter").html(data);
  }
  });
//}
    });

     $("#rejected_commission").click(function(e){
      e.preventDefault();
      $.ajax({
  url:"rejected_commission.php",
  method:"POST",
  success:function(data){
    $(".table_filter").empty();
    $(".table_filter").html(data);
  }
  });
//}
    });

      $("#pending_commission").click(function(e){
      e.preventDefault();
      $.ajax({
  url:"pending_commission.php",
  method:"POST",
  success:function(data){
    $(".table_filter").empty();
    $(".table_filter").html(data);
  }
  });
//}
    });
});
</script>