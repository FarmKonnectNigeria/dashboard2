<?php include('includes/instantiated_files.php');
include('includes/header.php'); 
$get_rows = $object->get_rows_from_one_table('unit_to_user_assignment');



?>
<body class="">
  <?php include('includes/sidebar.php'); ?>
  <div class="main-content">
    <!-- Navbar -->
    <?php include('includes/topnav2.php'); ?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">    
          <?php 
          $msg_state = 0;
              //var_dump($get_rows);
                    // echo '<h1 class="display-2 text-white" >Farm Unit
                    //     <span style="font-size: 20px;" class="display-2 text-white pl-3 ">Below is the list of your farm(s)</span><hr>';
              foreach($get_rows as $value){ 
                $get_user_id = json_decode($value['user_id']);
                //print_r($get_user_id);
                $get_unit = $object->get_one_row_from_one_table('cctv_unit', 'unique_id', $value['unit_id']);
                $get_area = $object->get_one_row_from_one_table('cctv_area', 'unique_id', $get_unit['area_id']);
                //foreach ($get_user_id as $user_id) {
                  if(in_array($uid, $get_user_id)){
                    $msg_state++;
                    ?>
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-10">
                     <div id="accordion">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $value['id'];?>" aria-expanded="true" aria-controls="collapseOne">
                              <h4 class="text-uppercase"><?php echo 'Unit Name: '.$get_unit['unit_name'].' | Area Name: '.$get_area['area_name'].' (click to view farm)'?></h4>
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne<?php echo $value['id']?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                              <!--//echo $get_unit['cctv_link']; ?>-->
                            <!-- <video width="560" height="315" controls>-->
                            <!--  <source src="https://213.34.225.97:8080/mjpg/video.mjpg" type="video/mp4">-->
                              <!--<source src="movie.ogg" type="video/ogg">-->
                            <!--  Your browser does not support the video tag.-->
                            <!--</video> -->
                            <iframe width="545" height="409" src="https://www.youtube.com/embed/qm_OXblcvx4?autoplay=1&amp;modestbranding=1&amp;loop=1&amp;controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <!--<iframe width="545" height="409" src="https://213.34.225.97:8080/mjpg/video.mjpg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><br>
                  <?php
                  }else{
                    if($msg_state < 1){
                    $msg = '<h1 class="display-2 text-white" >Farm Unit
                        <span style="font-size: 20px;" class="display-2 text-white pl-3 ">You have not yet been assigned to a unit, please be patient as you will be assigned soon</span><hr>';
                      }
                  }

                }
                if(isset($msg)){
                    echo $msg;
                  }

                ?>
                     
        </div>
      </div>
    </div>
    <?php include('includes/footer.php'); ?>
  </div>
    <!-- Footer -->
      
  <!--   Core   -->
<?php include('includes/scripts.php'); ?>