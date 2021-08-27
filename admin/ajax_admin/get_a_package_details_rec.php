<?php  include('../includes/instantiated_files.php');
      $invst_id = $_POST['invst_id'];
     
      $get_subscribed_packages =  $object->get_one_row_from_one_table('subscribed_packages','unique_id',$invst_id);
   
      $packid = $get_subscribed_packages['package_id'];
      $get_package_details = $object->get_one_row_from_one_table('package_definition','unique_id',$packid);
      $pk_det_name = $get_package_details['package_name'];
      $ptype = $get_subscribed_packages['package_type'];
      $tenure_of_product = $get_subscribed_packages['tenure_of_product'];
      $slots = $get_subscribed_packages['no_of_slots_bought'];
      $moratorium = $get_subscribed_packages['moratorium'];
      $mf = $get_subscribed_packages['multiplying_factor'];
      $float_time = $get_subscribed_packages['float_time'];
      $package_unit_price = $get_subscribed_packages['package_unit_price'];
      $total_amount = $package_unit_price * $slots;
      
      if($ptype == '1'){
          $type = "Fixed";
      }
      
      if($ptype == '2'){
          $type = "Recurrent";
      }
      
      if($tenure_of_product == "inf"){  $tenp = "INFINITY"; }else{ $tenp = $tenure_of_product;  }
      
      $details = "Package Name: ".$pk_det_name.'<br>';
      $details .= "Package Type: <strong>".$type.'</strong><br>';
      $details .= "Tenure of Product(days): ".$tenp.'<br>';
      $details .= "Slot Bought: ".$slots.'<br>';
      $details .= "Package Unit: ".$package_unit_price.'<br>';
      $details .= "Multiplying Factor: ".$mf.'<br>';
       $details .= "Float Time: ".$float_time.'<br>';
      $details .= "Moratorium: ".$moratorium.'<br>';
      $details .= "Total Amount: ".$total_amount.'<br><br>';
      $details .= "Select a date to backdate to:<input type='hidden' id='tenureop' name='tenureop' value='".$tenp."'> <input class='form-control form-control-sm' type='date' name='back_date' id='back_date' style='width:40%;'><br>Input No of Contribution Days: <input required='' class='form-control form-control-sm' type='number' name='no_of_days_of_investment' id='no_of_days_of_investment' style='width:40%;'>  <br><a style='float:left;' id='".$invst_id."' class='btn btn-sm btn-success get_invstment_history_backdate' >Show Investment Details</a><br><hr>";
      $details .= "<br>";
      $details .= "</div><div id='spinner_classpp' class='text-center'></div><div id='backdate_investment_details'></div>";
      echo $details;
          
          
      
      
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cmd_backdate_investment_request').hide();
  
   //get details for users subscribed packages
    $('.get_invstment_history_backdate').click(function(e){
        e.preventDefault();
        var invst_id = $(this).attr("id");
        var date44 = $("#back_date").val();
        var no_of_days_of_investment = $("#no_of_days_of_investment").val();
        var tenureop = $("#tenureop").val();
         $('#backdate_investment_details').empty();
         
         if(date44 == ""){
             
             alert("Please select a date to backdate to");
         }
         
        //  else if(no_of_days_of_investment == ""){
             
        //      alert("Please select the number of days of contribution");
        //  }
         
        //  else if(  (no_of_days_of_investment > tenureop) && (tenureop != 'INFINITY') ){
             
        //      alert("No of Contributory Days must not be greater than Tenure of Product");
        //  }
         
         
         
         else{
             //////get backdate details here  
            $.ajax({
            url:"ajax_admin/get_investment_history_backdate_rec.php",
            method:"GET",
            data:{invst_id:invst_id,date44:date44,no_of_days_of_investment:no_of_days_of_investment,tenureop:tenureop},
                      beforeSend: function(){
                        $("#spinner_classpp").html('<br>Loading... <div class="spinner-border" role="status"></div>');
                        },
            success:function(data){
                     $("#spinner_classpp").empty();
                     $('#backdate_investment_details').html(data);
                     
              }    
            });
         }
       
       });
   
     });
  </script>

