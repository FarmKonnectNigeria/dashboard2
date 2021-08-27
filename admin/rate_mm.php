<?php 
ini_set('memory_limit', '-1');
include('includes/instantiated_files2.php');
include('includes/header.php'); 

$get_MM = $object->get_one_row_from_one_table('admin_roles', 'role_name', 'Marketing Manager');
$get_MM_id = $object->get_rows_from_one_table_by_id('admin_tbl', 'role_right', $get_MM['unique_id']);
?>


<body class="">
<style type="text/css">
  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}

.rating>input {
    display: none
}

.rating>label {
    position: relative;
    width: 1em;
    font-size: 40px;
    color: #5cb85c;
    cursor: pointer
}

.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}

.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}

.rating>input:checked~label:before {
    opacity: 1
}

.rating:hover>input:checked~label:before {
    opacity: 0.4
}


h2,
p {
    text-align: center
}


p {
    font-size: 12px;
}

@media only screen and (max-width: 600px) {
    h2 {
        font-size: 14px
    }

    p {
        font-size: 12px
    }
}
</style>

  <?php include('includes/sidebar.php'); 
    if($role_name != 'Super Administrator'){
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
              <h3 class="mb-0">Rate Marketing Manager </h3>
              <?php //if(!empty($msg)){
                //echo $msg;
             // }?>
            </div>
              
              <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                      <form action="" method="post" id="submit_rating_form"> 
                      <div class="row">
                            <div class="col-lg-12"> 
                              <label class="form-control-label" for="input-first-name">Marketing Manager</label><br>
                                  <select class="form-control select-2 col-lg-12 " name="admin_id" id="admin_id">
                                      <option value="">Select MM</option>
                                      <?php 
                                        foreach($get_MM_id as $value){
                                      ?>
                                      <option value="<?php echo $value['unique_id']; ?>"><?php echo $value['surname'].' '.$value['other_names'] ; ?></option>
                                    <?php } ?>

                                  </select>
                            </div>
                      </div><br>
                      <div id="show_rating" style="display: none">
                          <h2>Rating </h2>
                          <div class="rating"> 
                              <input type="radio" name="rating" value="5" id="5"><label for="5" title="5 star">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4" title="4 star">☆</label> 
                              <input type="radio" name="rating" value="3" id="3"><label for="3" title="3 star">☆</label> 
                              <input type="radio" name="rating" value="2" id="2"><label for="2" title="2 star">☆</label> 
                              <input type="radio" name="rating" value="1" id="1"><label for="1" title="1 star">☆</label>
                          </div>
                          <button class="btn btn-sm btn-success" id="submit_rating" name="submit_rating" type="button">Submit Rating</button>
                      </div>
                    <br>
                    <br>
                    <br>
                
                       </form>
                    </div>
                    <div class="col-lg-2"></div>
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
    $("#admin_id").change(function(){
      if($("#admin_id").children("option:selected").val() ==''){
        $("#show_rating").css("display", "none");
        alert("Please Select a Marketing Manager");
      }else{
        $("#show_rating").css("display", "block");
      }
    });
});
</script>