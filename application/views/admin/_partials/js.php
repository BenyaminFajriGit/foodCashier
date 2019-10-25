<script src=<?php echo base_url("assets/jquery/jquery.min.js") ?>></script>
  <script src=<?php echo base_url("assets/bootstrap/js/bootstrap.bundle.min.js") ?>></script>

  <!-- Core plugin JavaScript-->
  <script src=<?php echo base_url("assets/jquery-easing/jquery.easing.min.js") ?>></script>

  <!-- Page level plugin JavaScript-->
  <script src=<?php echo base_url("assets/chart.js/Chart.min.js") ?>></script>
  <script src=<?php echo base_url("assets/datatables/jquery.dataTables.js") ?>></script>
  <script src=<?php echo base_url("assets/datatables/dataTables.bootstrap4.js") ?>></script>

  <!-- Custom scripts for all pages-->
  <script src=<?php echo base_url("js/sb-admin.min.js") ?>></script>

  <!-- Demo scripts for this page-->
  <script src=<?php echo base_url("js/demo/datatables-demo.js") ?>></script>
  <script src=<?php echo base_url("js/demo/chart-area-demo.js") ?>></script>

  <script>
        function logout(url) {
            $('#btn-logout').attr('href', url);
            $('#logoutModal').modal();

        }
        var height=$('.navbar').height();
        $('#wrapper').css('margin-top', height+10);
    </script>
