<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$getbalance = $object->get_one_row_from_one_table('wallet_tbl','user_id',$uid);

$total_investment = $object->get_total_investment($uid);
$expense_decode = json_decode($total_investment,true);

?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
   <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(./assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-success opacity-8"></span>
      <!-- Header container -->
      <div class="container align-items-center">
        <div class="row"  style="margin-top: -20px;">
          <div class="col-lg-7 col-md-10">
            <h1 align="center" class="display-2 text-white" >Wallet Balance<span>&#8358;<?php echo number_format($getbalance['balance']); ?>&nbsp;&nbsp;<span align="center"  style="font-size: 15px;" ><a style="color:white;" href="#">Total Income(Profits, Bonuses etc): &#8358;<?php echo number_format(250088); ?></a></span> <span align="center"  style="font-size: 15px;" ><a href="#" style="color:white;">Total Expenses(Package Subscriptions etc): &#8358;<?php echo number_format(700088); ?></a></span>
              <hr>
              <button align="center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                credit wallet
                </button>

            </h1>

            <br>
           <!--  <span style="font-size: 20px;" class="display-2 text-white pl-3 ">Total income: &#8358;<?php //echo number_format($getbalance['balance']); ?></span><hr> -->
            <!-- Button trigger modal <hr>
 -->

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Credit Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <input type="text" name="amount" placeholder="enter amount" class="form-control"><br>
        <button type="button" class="btn btn-success">credit wallet</button><hr>


       You can also make payment by using the following methods:<br>
        Bank:UBA Plc.<br>
        Account No:1021313768,<br> 
        Account name: FarmKonnect Agribusiness Limited, <br>
        Account Type: Savings.<br>
        You can also pay using USSD.<hr>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
          </div>
        </div>
      </div>
   
    </div>
    <!-- Page content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>