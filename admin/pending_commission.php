<?php include('includes/instantiated_files2.php');
include('includes/header.php');
 

// $table = 'debit_wallet_tbl';
// $param1 = 'user_id';
$get_request = $object->get_rows_from_one_table_by_one_param('bonus_commission_request','commission_status',0);


?>

<div class="table-responsive">
  <table class="table align-items-center table-flush">
  <thead class="thead-light">
   <?php if($get_request == null){
          echo "<tr><td>No record found...</td></tr>";
        } else{ ?>
    <tr>
      
          <th scope="col">Set For</th>
          <th scope="col">Commission Amount</th>
          <th scope="col">Date</th>
          <th scope="col">Action</th>

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
      <td> <small class="btn btn-sm btn-success" data-toggle="modal" data-target="#approve<?php echo $value['id']; ?>">Approve</small>
                          <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject<?php echo $value['id']; ?>">Reject</small> </td>
                        <?php //} ?>

                        <div class="modal fade bd-example-modal-md" id="approve<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <div class="modal fade bd-example-modal-md" id="reject<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
  <!--   Core   -->