<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

//$table = 'debit_wallet_tbl';
$param1 = 'user_id';
$get_rows = $object->get_rows_from_one_table('leads');

$get_my_leads = $object->get_rows_from_one_table_by_two_params('leads','classification','lead','added_by',$uid);
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
              <h3 class="mb-0">This is a list of Leads</h3>
              <div class="float-right">
              <h4 class="mb-0">Sort By</h4>
              <form id="lead_filter_form">
                <select name="lead_filter" id="lead_filter" class="">
                  <option value="All" selected="">All</option>
                  <option value="My Leads">My Leads</option>
                  <option value="New Leads">New Leads</option>
                </select>
              </form>
              </div>
            </div>
            <div id="table_filter">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Full Name</th>
                        
                        <th scope="col">Email Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Location</th>
                        <th scope="col">Classification</th>
                        <th scope="col">Interest Level</th>
                       <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                    
                   <?php

                   foreach($get_rows as $value){
                      
                     ?>
                     <tr>
                      
                       
                        <td><?php echo $value['fullname'];?></td>
                        <td><?php echo $value['email'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td>
                          <?php
                             if($value['other_location'] == 'NULL'){
                              echo $value['location'];
                            }else{
                              echo $value['other_location'];
                            }
                          ?>
                        </td>
                      <td><?php echo $value['classification'];?></td>
                      <td><?php echo $value['interest_level'];?></td>

                        <td>
                          <?php

                         if($value['added_by'] == $uid || $value['assigned_to'] == $uid){
                         ?>
                        <small class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit<?php echo $value['id']; ?>">Edit</small> 
                          <!-- <small class="btn btn-sm btn-danger" data-toggle="modal" data-target="#archive<?php //echo $value['id']; ?>">Archive</small> -->
                        </td>

                      <?php  } else{?>
                        <small class="badge badge-sm badge-danger">No edit access</small> 
                      <?php }?>
                      </tr>

                       <div class="modal fade" id="edit<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Lead's details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form enctype="multipart/form-data" action="" method="post" id="edit_leads_form<?php echo $value['unique_id']; ?>"> 
                                    <div class="row">
                                          <div class="col-lg-12">
                                               <label class="form-control-label" for="input-first-name">Full Name</label>
                                           <input type="text" name="fullname" id="fullname"  class="form-control" value="<?php echo $value['fullname']?>" readonly>
                                          </div>
                                    </div><br>
                                    <div class="row">
                          <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Email</label>
                                <input type="email" name="email" id="email"  class="form-control" value="<?php echo $value['email']?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                 <label class="form-control-label" for="input-first-name">Phone</label>
                                <input type="number" name="phone" id="phone"  class="form-control" value="<?php echo $value['phone']?>">
                            </div>

                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                 <label class="form-control-label" for="input-first-name">Location and Source of Lead</label>
                                  <select name="location_source" class="form-control" id="location_source">
                                    <option value="<?php echo $value['location']?>"> <?php echo $value['location']?></option>
                                    <option value="Twitter"  disabled>Twitter</option>
                                    <option value="LinkedIn"  disabled>LinkedIn</option>
                                    <option value="FB"  disabled>Facebook</option>
                                    <option value="Referrals"  disabled>Referrals</option>
                                    <option value="Uber"  disabled>Uber</option>
                                    <option value="Taxify"  disabled>Taxify</option>
                                    <option value="Direct Marketing"  disabled>Direct Marketing</option>
                                    <option value="Others"  disabled>Others (specify)</option>  
                                  </select>
                                  <br><br>
                                  <div class="row">
                                    <div id="others" class="col-lg-6" style="display: none;">
                                      <input type="text" name="other_location" class="form-control" placeholder="Please Specify">
                                    </div>
                                  </div>
                            </div></div><br>
                            <div class="row">
                            <div class="col-lg-12">
                                  <label class="form-control-label" for="input-first-name">Classification of leads </label><br>
                                  <select name="classification" class="form-control">
                                    <option value="<?php echo $value['classification']?>"> <?php echo $value['classification']?></option>
                                    <option value="raw lead">Raw Lead</option>
                                    <option value="lead">Lead</option>
                                    <option value="prospect">Prospect</option>
                                    <option value="client">Client</option>
                                  </select>
                            </div>
                      </div><br>
                      <div class="row">
                            <div class="col-lg-12">
                                  <label class="form-control-label" for="input-first-name">Interest Level </label><br>
                                  <select name="interest_level" class="form-control">
                                    <option value="<?php echo $value['interest_level']?>"> <?php echo $value['interest_level']?></option>
                                    <option value="1">One Star</option>
                                    <option value="2">Two Stars</option>
                                    <option value="3">Three Stars</option>
                                    <option value="4">Four Stars</option>
                                    <option value="5">Five Stars</option>

                                  </select>
                            </div>
                      </div><br>
                              <input type="hidden" name="unique_id" value="<?php echo $value['unique_id'];?>">
                    </form>
                                  </div>
                                <div class="modal-footer">
                                  <button class="btn btn-success get_leads_id_be" name="update_leads" id="<?php echo $value['unique_id']; ?>">Update</button>
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                             <!-- <div class="modal fade" id="archive<?php //echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Archive Lead</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to archive this lead?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                  <form method="post" id="archive_lead_form<?php //echo $value['id']; ?>">
                                    <button class="btn btn-danger archive_lead" name="archive_lead" id="<?php //echo $value['id']; ?>">Archive</button>
                                    <input type="hidden" name="unique_id" value="<?php //echo $value['unique_id']?>">
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div> -->
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
    $("select#lead_filter").change(function(){
       var filter = $(this).children("option:selected").val();
        //if(filter == 'My Leads'){
      //   $("#table_filter").html('thanks');
      // } 
      $.ajax({
  url:"leads_filter.php",
  method:"POST",
  data:{filter:filter},
  success:function(data){
    $("#table_filter").empty();
    $("#table_filter").html(data);
  }
  });
//}
    });
});
</script>