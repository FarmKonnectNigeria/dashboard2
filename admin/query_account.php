<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

?>


<body class="">
  <?php include('includes/sidebar.php'); 
      if($role_name != 'Investment Manager'){
    echo '<meta http-equiv="refresh" content="0; URL=no_access" />';
  }
  ?>
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
              <h3 class="mb-0">Query Account</h3>
            </div>
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <form action="" method="post" id="query_account_form"> 
                         <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Investor</label><br>
                                  <select class="form-control select-2 col-lg-10" name="user_id" id="user_id">
                                      <option value="">Select Investor</option>
                                      <?php 
                                      $get_users = $object->get_rows_from_one_table('users_tbl');
                                        foreach($get_users as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'].' ('.$value['email'].')' ; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                       <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">Start Date</label>
                             <input type="date" name="start_date" id="start_date"  class="form-control">
                            </div>
                      </div><br>

                      <div class="row">
                            <div class="col-lg-10" id="fullname_input">
                                 <label class="form-control-label" for="input-first-name">End Date</label>
                             <input type="date" name="end_date" id="end_date"  class="form-control">
                            </div>
                      </div><br>
                     
                      <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="query_account" name="query_account"  class="btn btn-sm btn-primary query_account">Query Account</button>  
                            </div>
                    </div>
                    <br>
                    <br>
                    <br>
                
                       </form>
                    </div>
                    <div class="col-lg-2"></div>
                    
              </div>
                  <div id="spinner_class" class="text-center">
                        
                      </div><br><br>
              <div class="row">
                <div class="col">
                  <div id="query_account_table"></div>
                </div>
              </div>


             

               <div class="card-footer py-4">
              <nav aria-label="...">
               <!--  <ul class="pagination justify-content-end mb-0">
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
                </ul> -->
              </nav>


          </div>
        </div>
      </div>
      <br>
         <br>
         <br>
      <!-- Dark table -->
    <!--  <hr/><br> -->

         

      
      <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    </div>
  </div>
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#query_account').click(function(e){
    e.preventDefault();
    if($('#user_id').val() == '' || $('#start_date').val() == '' || $('#end_date').val() == ''){
      alert("Please fill all fields");
    }else{ 
      $.ajax({
        url:"ajax_admin/query_account_details.php",
        method:"POST",
        data:$('#query_account_form').serialize(),
        beforeSend:function(){
          $("#spinner_class").html('Loading... <div class="spinner-border" role="status"></div>');
        },
        success:function(data){
          $("#spinner_class").empty();
         $("#query_account_table").empty();
         $("#query_account_table").html(data);    
        }
        });
      }
    });
  });
 function printDiv() {
    var divToPrint = document.getElementById('print_table');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write("<h3 align='center'>Print Page</h3>");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
    }

$("body").on("click", "#download_table", function () {
  html2canvas($('#print_table')[0], {
    onrendered: function (canvas) {
      var data = canvas.toDataURL();
      var docDefinition = {
        content: [{
          image: data,
          width: 500
        }]
      };
      pdfMake.createPdf(docDefinition).download("Account Activity Log.pdf");
    }
  });
});
</script>