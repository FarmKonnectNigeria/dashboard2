    <?php //include('includes/instantiated_files.php');
//include('includes/header.php'); 
$getbalance = $object->get_one_row_from_one_table('wallet_tbl','user_id', $uid);
//var_dump($getbalance);


$get_term = $object->get_one_row_from_one_table('terms_n_conditions','conditions_for_what','bank_transfer');

$get_account_details = $object->get_rows_from_one_table('bank_accounts');

$total_investment = $object->get_total_investment($uid);
$expense_decode = json_decode($total_investment,true);

?>

    <div class="container-fluid mt--7">
     <div class="modal fade" id="exampleModalScrollableCre" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Credit Wallet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Please choose method of Payment</span>
        <form method="post">
          <select name="method_of_payment" id="method_of_payment" class="form-control">
            <option value="select_method">Select Method of Payment</option>
            <option value="online_payment" id="online_payment">Online Payment</option>
            <option value="bank_transfer" id="online_payment">Bank Transfer</option>
          </select>
          <div id="credit_wallet" style="display: none;" class="credit_wallet">
            <hr>
            <input type="text" name="amount" placeholder="enter amount" class="form-control"><br>
          <button type="button" class="btn btn-success">credit wallet</button>
          </div>
          <div style="display: none;" class="bank_transfer">
            <hr>
            <b><?php echo $get_term['description']; ?></b><br><br>
            You can also make payment by using the following methods:
            <?php
              if($get_account_details == null){
                echo "No Bank Account available, please contact FarmKonnect for more details";
              }else{
                foreach ($get_account_details as $value) {
            ?>
            <hr>
            <b>Bank Name:</b> <?php echo $value['bank_name']; ?><br>
            <b>Account No:</b> <?php echo $value['account_number']; ?><br> 
            <b>Account name:</b>  <?php echo $value['account_name']; ?> <br>
            <b>Account Type:</b>  <?php echo $value['account_type']; ?><br>
          <?php } }?><br>
            You can also pay using USSD.
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 <a  style="color: black;" href="#" class="font-weight-bold ml-1" target="_blank">FarmKonnect</a>
            </div>
          </div>
        <!--   <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div> -->
        </div>
      </footer>
    </div>
 <?php //include('includes/scripts.php'); ?> 
 
  <script src="./assets/js/plugins/jquery/dist/jquery.min.js"></script>
   
<script type="text/javascript">
  $(document).ready(function(){
    $("select#method_of_payment").change(function(){
        var method_of_payment = $(this).children("option:selected").val();
        if(method_of_payment == 'select_method'){
          $('.bank_transfer').css("display", "none");
        $('.credit_wallet').css("display", "none");
      }
        else if(method_of_payment == 'online_payment'){
          $('.bank_transfer').css("display", "none");
        $('.credit_wallet').css("display", "block");
      }
      else if(method_of_payment == 'bank_transfer'){
        $('.credit_wallet').css("display", "none");
        $('.bank_transfer').css("display", "block");
      }
    });
});
</script>
    

  