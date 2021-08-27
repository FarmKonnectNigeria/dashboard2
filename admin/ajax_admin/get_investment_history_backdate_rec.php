<?php  //include('../includes/instantiated_files.php');
       include('../../classes/algorithm_functions.php');
      $invst_id = $_GET['invst_id'];
      $date44 = $_GET['date44'];
      $no_of_days_of_investment = $_GET['no_of_days_of_investment'];
      $tenureop = $_GET['tenureop'];
      
      
      if(   ($no_of_days_of_investment > $tenureop) &&  ($tenureop != 'INFINITY') ){
               $details = "<div class='row'><div class='col-md-12'>No of Contributory Days must not be greater than Tenure of Product</div></div>";
               echo '<script type="text/javascript">$(document).ready(function(){ $("#cmd_backdate_investment_request").show(); });</script>';
      }
      else if( $no_of_days_of_investment == "" ){
          
                $details = "<div class='row'><div class='col-md-12'>Please select the number of days of contribution</div></div>";
                echo '<script type="text/javascript">$(document).ready(function(){ $("#cmd_backdate_investment_request").show(); });</script>';
          
      }else{
          
          
      

       $getdet = get_details_for_backdate_rec($date44,$invst_id,$no_of_days_of_investment);
       $getdetdec = json_decode($getdet,true);
       if($getdetdec['status'] == 0){
           $details = "<div class='row'><div class='col-md-12'>".$getdetdec['msg']."</div></div><br>";
       }else{
           $proftowall = 0;
           $details .= "<div class='row'><div class='col-md-12'>";
           $details .= "No of Contribution Days: ".$no_of_days_of_investment.'<br>';
           //$details .= "Total Profit So far: ".$getdetdec['total_profit_so_far'].'<br>';
           //$details .= "Floating Days: ".$getdetdec['floating_days'].'<br>';
           //$details .= "Floating Profit: ".$getdetdec['floating_profit'].'<br>';
           //$details .= "Accrued Days: ".$getdetdec['accrued_days'].'<br>';
          
           $details .= "Contribution Per Day: ".$getdetdec['contribution_per_day'].'<br>';
           $details .= "Total Contribution: ".$getdetdec['total_contributions'].'<br>';
           $details .= "Investment Start Date: ".date('F-d-Y',strtotime($getdetdec['date_investment_starts'])).'<br>';
           $details .= "Total Profit So far: ".$getdetdec['total_profit'].'<br>';
           $details .= "Profit to apply to Wallet: ".$proftowall.'<br>';
           $details .= "Withdrawal Amount: ".$getdetdec['withdrawal'].'<br><br>';
          //   echo $getdetdec['profit_per_day'].'-'.$getdetdec['days_so_far'].'-'.$getdetdec['total_profit_so_far'].'-'.$getdetdec['floating_days'].'-'.$getdetdec['floating_profit'].'-'.
          //   $getdetdec['accrued_days'].'-'.$getdetdec['accrued_profit'].'-'.$getdetdec['date_investment_starts'].'-'.$getdetdec['withdrawal'];
          $details .="<input type='hidden' id='no_of_days_of_investment' name='no_of_days_of_investment' value='".$no_of_days_of_investment."'>";
          $details .="<input type='hidden' id='total_profit' name='total_profit' value='".$getdetdec['total_profit']."'>";
          $details .="<input type='hidden' id='date_investment_starts' name='date_investment_starts' value='".$getdetdec['date_investment_starts']."'>";
          $details .="<input type='hidden' id='proftowall' name='proftowall' value='".$proftowall."'>";
          $details .="<input type='hidden' id='contribution_per_day' name='contribution_per_day' value='".$getdetdec['contribution_per_day']."'>";
          $details .="<input type='hidden' id='total_contributions' name='total_contributions' value='".$getdetdec['total_contributions']."'>";
        
          //$details .="<input type='hidden' id='profit_per_day' name='profit_per_day' value='".$getdetdec['profit_per_day']."'>";
          //$details .="<input type='hidden' id='days_so_far' name='days_so_far' value='".$getdetdec['days_so_far']."'>";
          //$details .="<input type='hidden' id='total_profit_so_far' name='total_profit_so_far' value='".$getdetdec['total_profit_so_far']."'>";
          //$details .="<input type='hidden' id='floating_days' name='floating_days' value='".$getdetdec['floating_days']."'>";
          //$details .="<input type='hidden' id='accrued_days' name='accrued_days' value='".$getdetdec['accrued_days']."'>";  
           
          $details .="</div></div><br>"; ?>
          
          <script type="text/javascript">$(document).ready(function(){ $("#cmd_backdate_investment_request").show(); });</script>
          
           
       <?php } } echo $details;
    
?>

