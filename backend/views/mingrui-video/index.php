<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频分享';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .center {
  margin-left: auto;
  margin-right: auto;
  display: block
  }
</style>


<?php $count = 0; foreach($videos as $video) { ?>
<?php if(($count%2)==0) { ?>
<div class="row">
<?php } ?>
  <div class="col-md-4">
    <div class="box box-widget">
      <div class="box-header with-border bg-light-blue">
	<?php echo $video->title ?>
      </div>
      <!-- /.box-header -->
      <div class="box-body bg-black">
	<video  class="video-js vjs-default-skin center" height="180" width="300" center controls>
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

<?php if(($count%2)==1) { ?>              
</div>
<!-- /.row -->
<?php } ?>
<?php $count++; }?>
