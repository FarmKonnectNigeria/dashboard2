<?php  //include('../includes/instantiated_files.php');
       include('../../classes/algorithm_functions.php');
      $invst_id = $_GET['invst_id'];
      $date44 = $_GET['date44'];

       $getdet = get_details_for_backdate($date44,$invst_id);
       $getdetdec = json_decode($getdet,true);
       if($getdetdec['status'] == 0){
           $details = "<div class='row'><div class='col-md-12'>".$getdetdec['msg']."</div></div><br>";
       }else{
           $proftowall = $getdetdec['accrued_profit'] - $getdetdec['withdrawal'];
           $details .= "<div class='row'><div class='col-md-12'>";
           $details .= "Profit Per Day: ".$getdetdec['profit_per_day'].'<br>';
           $details .= "Days So far: ".$getdetdec['days_so_far'].'<br>';
           $details .= "Total Profit So far: ".$getdetdec['total_profit_so_far'].'<br>';
           $details .= "Floating Days: ".$getdetdec['floating_days'].'<br>';
           $details .= "Floating Profit: ".$getdetdec['floating_profit'].'<br>';
           $details .= "Accrued Days: ".$getdetdec['accrued_days'].'<br>';
           $details .= "Accrued Profit: ".$getdetdec['accrued_profit'].'<br>';
           $details .= "Investment Start Date: ".date('F-d-Y',strtotime($getdetdec['date_investment_starts'])).'<br>';
           $details .= "Profit to apply to Wallet: ".$proftowall.'<br>';
           $details .= "Withdrawal Amount: ".$getdetdec['withdrawal'].'<br><br>';
          //   echo $getdetdec['profit_per_day'].'-'.$getdetdec['days_so_far'].'-'.$getdetdec['total_profit_so_far'].'-'.$getdetdec['floating_days'].'-'.$getdetdec['floating_profit'].'-'.
          //   $getdetdec['accrued_days'].'-'.$getdetdec['accrued_profit'].'-'.$getdetdec['date_investment_starts'].'-'.$getdetdec['withdrawal'];
          $details .="<input type='hidden' id='profit_per_day' name='profit_per_day' value='".$getdetdec['profit_per_day']."'>";
          $details .="<input type='hidden' id='days_so_far' name='days_so_far' value='".$getdetdec['days_so_far']."'>";
          $details .="<input type='hidden' id='total_profit_so_far' name='total_profit_so_far' value='".$getdetdec['total_profit_so_far']."'>";
          $details .="<input type='hidden' id='floating_days' name='floating_days' value='".$getdetdec['floating_days']."'>";
          $details .="<input type='hidden' id='accrued_days' name='accrued_days' value='".$getdetdec['accrued_days']."'>";
          $details .="<input type='hidden' id='accrued_profit' name='accrued_profit' value='".$getdetdec['accrued_profit']."'>";
          $details .="<input type='hidden' id='date_investment_starts' name='date_investment_starts' value='".$getdetdec['date_investment_starts']."'>";
          $details .="<input type='hidden' id='proftowall' name='proftowall' value='".$proftowall."'>";
          $details .="<input type='hidden' id='withdrawal' name='withdrawal' value='".$getdetdec['withdrawal']."'>  ";
          
           
          $details .="</div></div><br>"; ?>
          
          <script type="text/javascript">$(document).ready(function(){ $("#cmd_backdate_investment_request").show(); });</script>
          
           
       <?php } echo $details;
    
?>

