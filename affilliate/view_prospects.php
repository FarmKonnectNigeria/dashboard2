<?php include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_rows = $object->get_rows_from_one_table_by_id('users_tbl','referral_id',$uid);
//$get_rows2 = $object->get_rows_from_one_table_by_id('leads_tbl','referral_id',$uid);

?>


<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <!--  <div class="header bg-gradient-default pb-8 pt-5 pt-md-8"  >
     
    </div> -->
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This is a list of all your prospects<span><!-- <button style="margin-left: 13px;" type="button" class="btn btn-success btn-sm float-right mb-10" data-toggle="modal" data-target="#send_msg_modal"><i class="fas fa-plus-circle" ></i> Send Messages to Prospects</button> -->

               <!--  <button type="button" class="btn btn-primary btn-sm float-right mb-10" data-toggle="modal" data-target="#add_lead_modal"><i class="fas fa-plus-circle"></i> Add New Lead</button></span> --></h3> 
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 <?php if($get_rows == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">First name</th>
                        
                        <th scope="col">Last name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                       <!-- <th>Action</th> -->
                   

                  </tr>
                </thead>
                <tbody>
                   <?php

                   foreach($get_rows as $value){
                         
                     ?>
                     <tr>
                        <td><?php echo $value['other_names'];?></td>
                        <td><?php echo $value['surname'];?></td>
                        <td><?php echo $value['phone'];?></td>
                        <td><?php echo $value['email'];?></td>
                       <!--  <td> <small class="btn btn-sm btn-success">View details</small> </td>
 -->
                      </tr>
                <?php } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
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
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Dark table -->


         
          <!-- Modal -->
            <div class="modal fade" id="send_msg_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->
                  <div class="modal-body">
                    <form  id="send_msg_form" method="post"> 
                        <!-- Default input -->
                        <h1 class="modal-title" id="exampleModalLabel">Send Message to All Prospects</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                     
                           <label class="form-control-label" for="input-first-name">Subject</label>
                              <input type="text" class="form-control" id="subject" name="subject">
                        </div>

                        <div class="form-group">
                     
                           <label class="form-control-label" for="input-first-name">Message to Send</label>
                              <textarea class="ckeditor" id="generic" name="generic" rows="10"></textarea>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-12">
                            <label for="formGroupExampleInput">All Your Prospects</label>
                            <p><?php
                              //$emails_array = array();
                             foreach($get_rows2 as $value2){
                               // $array = array(
                               //     'email'=>$value2['email']
                              //  ); 
                              echo '<small>'.$value2['first_name'].' '.$value2['surname']; ?>: <?php echo $value2['email'].'</small>'; ?><br>    
                            <?php 
                              //array_push($emails_array,$array);
                          } 

                          //  $leads_info = json_encode($emails_array);


                            ?>

                          </p> 
       
                          </div>
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="cmd_msg_to_leads" id="cmd_msg_to_leads">Send To Leads</button>
                  </div>
                </div>
              </div>
            </div>

                  <div class="modal fade" id="add_lead_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div> -->
                  <div class="modal-body">
                    <form  id="create_lead_form" method="post"> 
                        <!-- Default input -->
                        <h1 class="modal-title" id="exampleModalLabel">Create a New Lead</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group row">
                          <div class="col-md-6">
                                 <label class="form-control-label" for="input-first-name">Firstname</label>
                              <input type="text" required class="form-control" id="first_name" name="first_name" rows="10">

                          </div>

                           <div class="col-md-6">
                                 <label class="form-control-label" for="input-surname">Surname</label>
                              <input type="text" required class="form-control" id="surname" name="surname" rows="10">
                          </div>
                          
                        </div>

                          <div class="form-group row">
                          <div class="col-md-6">
                                 <label class="form-control-label" for="input-phone">Phone</label>
                              <input type="number" required class="form-control" id="phone" name="phone" rows="10">
                          </div>

                           <div class="col-md-6">
                                 <label class="form-control-label" for="input-email">Email</label>
                              <input type="email" required class="form-control" id="email" name="email" rows="10">
                          </div>
                          
                        </div>
                       
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="cmd_create_lead" id="cmd_create_lead">Create New Lead</button>
                  </div>
                </div>
              </div>
            </div>


      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>