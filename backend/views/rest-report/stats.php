<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Report', 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);

/* $sqliteUrl = str_replace('/primerbean/media/', 'user/', $model->snpsqlite); */
/* $sqliteUrl = Yii::$app->params['erp_url'] . $sqliteUrl ; */
/* $data = file_get_contents($sqliteUrl); */
/* $data = json_decode($data, true); */

/* for($i =0;$i<6;$i++){ */
/*      $text = trim($data[0][$i]); */
/*      if($text == '') */
/*      { */
/*           echo "没有值"; */
/*      } */
/*      else { */
/*           echo ($text); */
/*      } */
/*      echo '<br/>'; */
/* } */

/* echo(trim($data[0][6][0])); */
/* echo('--' . trim($data[0][6][1])); */
/* echo('--' . trim($data[0][6][2]). '<br/>'); */
/* for($i =7;$i<14;$i++){ */
/*      $text = trim($data[0][$i]); */
/*      if($text == '') */
/*      { */
/*           echo "没有值"; */
/*      } */
/*      else { */
/*           echo ($text); */
/*      } */
/*      echo '<br/>'; */
/* } */

/* echo(trim($data[0][14][0])); */
/* echo('--' . trim($data[0][14][1]). '<br/>'); */

/* echo('NG16070056--' . trim($data[0][15]['NG16070056'][0])); */
/* echo('--' . trim($data[0][15]['NG16070056'][1]). '<br/>'); */

/* echo(trim($data[0][16][0])); */
/* echo('--' . trim($data[0][16][1])); */
/* echo('--' . trim($data[0][16][2]). '<br/>'); */

/* for($i =17;$i<20;$i++){ */
/*      echo trim($data[0][$i]) .'<br/>'; */
/* } */

/* echo(trim($data[0][20][0])); */
/* echo('--' . trim($data[0][20][1]). '<br/>'); */

/* echo(trim($data[0][21][0][0])); */
/* echo('--' . trim($data[0][21][0][1])); */
/* echo('--' . trim($data[0][21][0][2]). '--'); */
/* echo(trim($data[0][21][1][0])); */
/* echo('--' . trim($data[0][21][1][1])); */
/* echo('--' . trim($data[0][21][1][2]). '--'); */
/* echo(trim($data[0][21][2][0])); */
/* echo('--' . trim($data[0][21][2][1])); */
/* echo('--' . trim($data[0][21][2][2]). '<br/>'); */
?>
<script>
  var data = <?php echo $data ?>;
</script>


<div class="box box-success">
    <div class="box-body">
<?php if(strcmp($data, '[]')) {?>
    <p>基因:<?php echo $gene; ?></p>
    <br/>
    <p style="text-align:center;">外显子分布及病人突变外显子</p>
    <div class="chart">
    <canvas id="genearea" width="800" height="600"></canvas>
    </div>
<?php } else { ?>
          <p style="text-align:center;">没有检测到异常基因!</p>         
<?php } ?>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



<script>
var startX = 100;
var startY = 10;
var height = 40;
var width  = 600
var context = null;
var graphCanvas = document.getElementById('genearea');
// Ensure that the element is available within the DOM
if (graphCanvas && graphCanvas.getContext) {
    // Open a 2D context within the canvas
    context = graphCanvas.getContext('2d');
}

//Draw vertival line
drawLine(context, startX, startY, startX, startY+height, '#000000');

//Draw horizontal line
drawLine(context, startX, startY+height/2, startX+width, startY+height/2, '#000000');

data_length = data.length;
min = data[0].start;
max  = data[data_length-1].end;

areas = new Array();
for(var i=0; i< data_length; i++) {
    var area = new Array();
    area[0] = (width / (max-min)* (data[i].start-min))+startX;// X start
    area[1] = width / (max-min)*(data[i].end-data[i].start);//width
    area[2] = data[i].count;// text for count
    area[4] = data[i].start.toString().concat('--', data[i].end.toString());//text for coordination
    area[5] = i*10;//height offset
    areas[i] = area;
}

countmax = areas[0][2];
countmin = areas[0][2];
for(var i=0; i<areas.length; i++) {
    if(areas[i][2] >countmax) {
	countmax = areas[i][2]; 
    }
    if(areas[i][2] <countmin) {
	countmin = areas[i][2]; 
    }
}

//Draw areas
for(var i=0; i<areas.length; i++) {
    //map 0-max to 0-255
    if(countmax >0) {
	coloroff = 255/countmax*areas[i][2];
	green =  255 - coloroff;
	red = coloroff;
    }
    else{
	green =  255;
	red = 0;
    }
    fillstyle = 'rgb('.concat(red.toString(),',',  green.toString(), ',0)');
    drawArea(context, areas[i][0], areas[i][1], areas[i][2], areas[i][4], areas[i][5], fillstyle);
}

//Draw line for bad area
for(var i=0; i< data_length; i++) {
    if(data[i].bad){
	drawLine(context, areas[i][0]+areas[i][1]/2, startY-20, areas[i][0]+areas[i][1]/2, startY+height+20, '#ff0000');
    }
}

// drawLine - draws a line on a canvas context from the start point to the end point
function drawLine(contextO, startx, starty, endx, endy, strokeStyle) {
    contextO.beginPath();
    contextO.moveTo(startx, starty);
    contextO.lineTo(endx, endy);
    contextO.closePath();
    context.strokeStyle = strokeStyle;
    contextO.stroke();
}

// drawRectangle - draws a rectangle on a canvas context using the dimensions specified
function drawArea(contextO, start, width, count, text, heightoff, fillstyle) {
    context.lineWidth = "0.0";
    contextO.beginPath();
    contextO.rect(start, startY, width, height);
    contextO.closePath();
    context.strokeStyle = fillstyle;
    contextO.stroke();
    context.fillStyle = fillstyle;
    contextO.fill();
    context.font = '10pt Calibri';
    context.textAlign = "center";
    context.fillStyle = "#000";
    var metrics = context.measureText(count);
    var textWidth = metrics.width;
    context.fillText(count, start+width/2, startY+(height+10)/2);
    context.font = '10pt Calibri';
    context.textAlign = "center";
    context.fillStyle = "#000";
    var metrics = context.measureText(text);
    var textWidth = metrics.width;
    context.fillText(text, start+width/2, startY+height+20+ heightoff);
}
</script>
