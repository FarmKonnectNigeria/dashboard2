<?php  include('../includes/instantiated_files.php');
      //echo "He is not OK";
      $userid = $_POST['userid'];
      //$check_subscribed_packages = $object->check_row_exists_by_one_param('subscribed_packages','user_id',$userid);
      $check_subscribed_packages = $object->check_row_exists_by_one_param('subscribed_packages','user_id',$userid);
      if($check_subscribed_packages){
          //echo "exists";
          $get_subscribed_packages =  $object->get_rows_from_one_table_by_three_params('subscribed_packages', 'user_id', $userid,'liquidation_status', 0,'package_type',2);
          
          $form = "<br><select name='invst_id' id='invst_id' class='form-control'>";
          $form .= "<option value=''>select a package </option>";
          
          foreach($get_subscribed_packages as $sub){
              $packid = $sub['package_id'];
              $pk_det = $object->get_one_row_from_one_table('package_definition','unique_id',$packid);
              $pk_det_name = $pk_det['package_name'];
              $totalamount = number_format($sub['total_amount']);
              $uniquid = $sub['unique_id'];
              $form .= "<option value='".$uniquid."'>".$pk_det_name."(".$totalamount.")</option>";
          }
          //$form .="";
          $form .= '</select><br><div id="spinner_class2" class="text-center"></div><div id="package_details"></div>';
         
          
          echo $form;
          
      }
      else{
          echo "<br>Sorry, This Customer does not have a recurrent package yet...<br>Use this Link to buy a package for a user: <a href='./buy_package'>Buy Package</a>";
      }
?>


<script type="text/javascript">
    $(document).ready(function(){
  
   //get details for users subscribed packages
    $('#invst_id').change(function(e){
        e.preventDefault();
        var invst_id = $(this).val();
        
        if(invst_id == ""){
            alert("Please select a package");
        
        }else{
             
            $.ajax({
            url:"ajax_admin/get_a_package_details_rec.php",
            method:"POST",
            data:{invst_id:invst_id},
            beforeSend: function(){
            $("#spinner_class2").html('<br>Loading... <div class="spinner-border" role="status"></div>');
            },
            success:function(data){
                     $("#spinner_class2").empty();
                     $('#package_details').html(data);
                         
                        
            
            }
    
     });
            
        }
        
       
        
    });
    
    
    
    
    
    
});
  </script>