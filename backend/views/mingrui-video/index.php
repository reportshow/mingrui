<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频分享';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="player/video-js.css">
<style>
  .center {
  margin-left: auto;
  margin-right: auto;
  display: block
  }
</style>

<?php $count = 0; foreach($videos as $video) { ?>
<?php if(($count%3)==0) { ?>
<div class="row">
<?php } ?>
  <div class="col-md-4">
    <div class="box box-widget">
      <div class="box-header with-border bg-light-blue">
	<?php echo $video->title ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body bg-black">
	<video  class="video-js vjs-default-skin vjs-big-play-centered center" controls>
	  <source src="<?php echo $video->video_url . '/index.m3u8' ?>" type="application/vnd.apple.mpegurl">
	</video>
      </div>
      <!-- /.box-body -->
      <div class="box-header bg-black text-center">
	<p><?php echo $video->description ?></p>
      </div>
    </div>
  </div>
  <!-- /.col -->

<?php if(($count%3)==2) { ?>              
</div>
<!-- /.row -->
<?php } ?>
<?php $count++; }?>


<!-- Video Player -->
<script src="player/video.js"></script>
<script src="player/videojs-ie8.min.js"></script>
<script src="player/hls.js"></script>
<script src="player/videojs-hlsjs.js"></script>
<script>
function resizeVideoJS(player){
    id = player.id();
    // Make up an aspect ratio
    var aspectRatio = 264/640;
    var width = document.getElementById(id).parentElement.offsetWidth*0.9;
    player.width(width).height( width * aspectRatio );
}    

function resizePlayers(){
    var players = document.getElementsByClassName('video-js');
    for(var i=0; i<players.length; i++){
            resizeVideoJS(this);
    }
}

var players = document.getElementsByClassName('video-js');
for(var i=0; i<players.length; i++){
    videojs(players[i]);
    videojs(players[i]).ready(function(){
        console.log(this.options()); //log all of the default videojs options
        resizeVideoJS(this);
    });
}

window.onresize = function(){
    resizePlayers;
};

</script>
