 <?php
 use backend\widgets\WeixinMenubar;

 
 ?>

<!-- jQuery 2.2.3 -->
<!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
<!-- ChartJS -->
<script src="plugins/chartjs/Chart.js"></script>
<!-- Morris.js charts -->
<script src="plugins/morris/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<!--script src="<?=$directoryAsset?>/js/app.min.js"></script-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=$directoryAsset?>/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=$directoryAsset?>/js/demo.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<?=WeixinMenubar::widget();?>