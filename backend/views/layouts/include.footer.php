 <?php
 
 ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
  var players = document.getElementsByClassName('video-js');
  for(var i=0; i<players.length; i++){
       videojs(players[i]);
  }
</script>