  <script src=".././assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src=".././assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src=".././assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src=".././assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src=".././assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
   <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
   <script src=".././js/scripts.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
   <script type="text/javascript" src=".././js/addons/datatables.min.js"></script>
   <script src="../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  <script type="text/javascript">
    // Initialize CKEditor

        // CKEDITOR.replace('package_description',{
        //   height: "200px"

        // });
        // CKEDITOR.replace('description',{
        //   height: "200px"

        // }); 
        // CKEDITOR.replace('role_description',{
        //   height: "200px"

        // }); 
        $(document).ready(function() {


    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-single').select2();
    $('.select-2').select2();
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

  var admin_logs = $('#admin_logs').DataTable({
              "scrollX": true,
              "processing": true,
              "serverSide": true,
              "ajax": "../server_tables/all_admin_logs.php",
              // 'pagingType': 'numbers'
                // "order": [[ 2, "asc" ]],
                // "columnDefs": [
                // { "render": all_sns,
                // "data": null,         
                // "targets": [0], "width": "9%", "targets": 0 },
                // ]
          } );
            
  </script>

</body>

</html>