<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '共享视频';
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
<table>
<?php foreach($videos as $video) { ?>
<tr>
  <td valign="top" style="padding-bottom:30px !important;padding-left:50px !important;">
    <div class="box-body bg-black">
      <video  class="video-js vjs-default-skin vjs-big-play-centered center" poster="<?php echo $video->thumb_picture_url?>" preload controls>
	<source src="<?php echo $video->video_url . '/index.m3u8' ?>" type="application/vnd.apple.mpegurl">
      </video>
    </div>
  </td>
  <td valign="top" style="padding-left:30px !important;padding-bottom:30px !important;">
    <table style="table-layout:fixed;background-color:rgb(230, 230, 230);">
      <thead>
	<tr>
	  <td style="border-bottom:1pt solid black;"><span style="font-weight:bold"><?php echo $video->title ?></span><span style="padding-left: 15px;font-size:70% !important;"><?php echo $video->created_at ?></span></td>
	<tr>
      </thead>
      <tbody>
	<tr>
	  <td style="word-break:break-all !important;white-space: pre-wrap !important;width:800px;height:133px" ><?php echo $video->description ?></td>
	<tr>
      </tbody>
    </table>
  </td>
</tr>
<?php }?>
</table>
<!-- Video Player -->
<script src="player/video.js"></script>
<script src="player/videojs-ie8.min.js"></script>
<script src="player/hls.js"></script>
<script src="player/videojs-hlsjs.js"></script>
<script>
function resizeVideoJS(player){
    id = player.id();
    // Make up an aspect ratio
    var aspectRatio = 400/600;
    // var width = document.getElementById(id).parentElement.offsetWidth*0.9;
    var width = 200;
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
