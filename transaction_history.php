<?php include('includes/instantiated_files.php');
include('includes/header.php'); 

$my_transaction_history = $object->my_transaction_history($uid);


$wallet_balance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);

$my_total_withdrawal = $object->my_total_withdrawal($uid);
$my_total_withdrawal_decode = json_decode($my_total_withdrawal,true);


$withdrawals = $object->my_transaction_history($uid);




?>


<body class="">
 <!--  <style type="text/css">
        #show_profit{
           display: none;
        }
  </style> -->
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row" style="margin-top: -160px;">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">This gives a history of your cash flow:

               <!--  <button type="button" class="btn btn-success btn-sm float-right  mb-3" data-toggle="modal"  data-target="#add_slot_modssal"><i class="fas fa-plus-circle"></i>Income History</button>
                                &nbsp;&nbsp; &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger btn-sm float-right  mb-3" data-toggle="modal" data-target="#ss"><i class="fas fa-plus-circle"></i>Expenses History</button> -->
               
               <div class="row">
                      <div class="col-md-12">
                              
                      </div>
               </div>

               
            

              </h3>
            <!--  <div id="chart">-->
            <!--</div>-->
              
              
            </div>
            <div class="table-responsive">
              <!-- <table class="table align-items-center table-flush"> -->
                <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                 <?php if($my_transaction_history == null){
                        echo "<tr><td>No record found...</td></tr>";
                      } else{ ?>
                  <tr>
                    
                        <th scope="col">Amount Requested</th>
                        <th scope="col">Transaction Category</th>
                        <th scope="col">Transaction Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Requested</th>
                        <!-- <th scope="col">Date</th> -->
                        <!-- <th scope="col">Action</th> -->

                  </tr>
                </thead>
                <tbody>
                   <?php
                       
                    

                      foreach($my_transaction_history as $value){
                          
                          
                          
                        if($value['purpose'] == 7){
                          $tansaction_category = '<span style="color:red;">debit</span>';
                          $transaction_type = '<span style="color:red;">withdrawal</span>';
                          $status = "<small class='badge badge-sm badge-success'>processed</small>"; }
                         elseif($value['purpose'] == 5) {
                          $tansaction_category = '<span style="color:red;">debit</span>';
                          $transaction_type = '<span style="color:red;">withdrawal</span>';
                           $status = "<small class='badge badge-sm badge-primary'>pending</small>"; 
                          }elseif($value['purpose'] == 6) {
                          $tansaction_category = '<span style="color:red;">debit</span>';

                          $transaction_type = '<span style="color:red;">withdrawal</span>';
                           $status = "<small class='badge badge-sm badge-danger'>declined</small>"; 
                          }elseif($value['purpose'] == 8) {
                          $tansaction_category = '<span style="color:red;">debit</span>';
                          
                          $transaction_type = '<span style="color:red;">withdrawal</span>';
                           $status = "<small class='badge badge-sm badge-default'>cancelled</small>"; 
                          }elseif($value['purpose'] == 9) {
                          $tansaction_category = '<span style="color:red;">debit</span>';
                          
                          $transaction_type = '<span style="color:red;">withdrawal</span>';
                           $status = "<small class='badge badge-sm badge-success'>approved</small>"; 
                          }
                          elseif($value['purpose'] == 10) {
                          $tansaction_category = '<span style="color:green;">credit</span>';
                          
                          $transaction_type = '<span style="color:green;">wallet crediting</span>';
                          $status = "<small class='badge badge-sm badge-success'>pending</small>"; 
                          }
                          elseif($value['purpose'] == 11) {
                          $tansaction_category = '<span style="color:green;">credit</span>';
                          
                          $transaction_type = '<span style="color:green;">wallet crediting</span>';
                          $status = "<small class='badge badge-sm badge-success'>confirmed</small>"; 
                          }


                          else{
                          $tansaction_category = '<span style="color:red;">transaction cate</span>';
                          
                           $transaction_type = 'tansaction_type';
                           $status = "<small class='badge badge-sm badge-primary'>pendinggg</small>"; 
                             
                          }

                          $getpackage = $object->get_one_row_from_one_table('package_tbl','unique_id',$value['package_id']);
                          $get_others = $object->get_one_row_from_one_table_by_two_params('subscribed_user_tbl','user_id',$value['user_id'], 'package_id',$value['package_id']);
                          
                        
                      ?>
                     <tr>
                      
                        <td><?php echo '&#8358;'.number_format($value['amount_withdrawn']);?></td>
                        <td><?php echo $tansaction_category;?></td>
                        <td><?php echo $transaction_type;?></td>
                        <td><?php echo $status;?></td>
                        <td><?php echo $object->formatted_date($value['date_created']); ?></td>
                      
                       <!--  <td><?php //echo $value['date_created'];?></td> -->
                   <!--  <td><a href="#" data-target="#view_earnings<?php //echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm btn-primary">view earnings</a></td> -->


                    <!-- view history here -->


                      </tr>
                      
                      
                <?php 
                
                
                
                } } ?>
                 
                 
                 
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <!-- <nav aria-label="...">
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

         
 <!-- Modal -->
         <!-- Modal -->
            <div class="modal fade" id="add_slot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form  id="wallet_withdrawal_form" method="post"> 
                        <!-- Default input -->
                        <h2 class="modal-title" id="exampleModalLabel">Request a Withdrawal from Wallet</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button><br>

                        <div class="form-group">
                          <label for="formGroupExampleInput">Wallet Balance: &#8358;<?php echo number_format($wallet_balance['balance']); ?></label>
                          <input type="hidden" value="<?php echo $wallet_balance['balance']; ?>" name="wallet_balance" id="wallet_balance">
                        </div>

                        <div id="show_profit">
                            
                        </div>
                     
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="formGroupExampleInput">Withdrawal Amount</label>
                            <input type="number" class="form-control form-control-sm" id="amount_to_withdraw" name="amount_to_withdraw" value="1">
                          </div>
                        </div>
                     </form> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-small" name="wallet_withdraw" id="wallet_withdraw">Request a  Withdrawal Now</button>
                  </div>
                </div>
              </div>
            </div>



      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    
     <script>
         //STEP 2 - Chart Data
         <?php 
         
         
         $chart_amounts = [];
        $chart_dates = [];
        
        
        foreach($withdrawals as $withdrawal){
            array_push($chart_dates, date('Y-m-d', strtotime($withdrawal['date_created'])));
                          array_push($chart_amounts, number_format($withdrawal['amount_withdrawn']));
                          
                          $amounts = json_encode($chart_amounts);
                          $dates = json_encode($chart_dates);
        }
         
         ?>
         
    var date = '<?= @$dates; ?>'
    var amount = '<?= @$amounts; ?>';
    
    
    const dates = JSON.parse(date);
    const amounts = JSON.parse(amount);
    
    var obj = {};
    
    console.log(dates);
            console.log(amounts);
            
            
        $.each(amounts,function(i,val){
          obj[dates[i]] = val;
        });
        
        console.log(obj);
        
        
    var data = [];
        
    $.each( obj, function( key, value ) {
      var row = {
          'label': key,
          'value': value
          };
          
        data.push(row);
    });
    
    data = data.reverse(); 

    //STEP 3 - Chart Configurations
    const chartConfig = {
    type: 'column2d',
    renderAt: 'chart',
    width: '100%',
    height: '400',
    dataFormat: 'json',
    dataSource: {
        // Chart Configuration
        "chart": {
            "caption": "Latest Transactions",
            "subCaption": "",
            "xAxisName": "Date",
            "yAxisName": "Amount (Naira)",
            "numberSuffix": "",
            "theme": "fusion",
            },
        // Chart Data
        "data": data
        }
    };
    FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts(chartConfig);
    fusioncharts.render();
    });

</script>


    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
  $(document).ready(function () {
$('#datatable-basic').DataTable();
//$('.dataTables_length').addClass('bs-select');
});
</script>