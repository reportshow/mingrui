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
?>
<style>
  table {
  border-collapse: collapse;
  width: 100%;
  }

  th, td {
  text-align: left;
  padding: 8px;
  }

  tr:nth-child(even){background-color: #f2f2f2}
</style>


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
      <div id="coords" style="text-align:center;display:none"></div>
      <canvas id="genearea" width="800"></canvas>
    </div>
    <div class="box-body">
      <table id="table" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>序号</th>
            <th>起始位置</th>
            <th>终止位置</th>
            <th>是否异常</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->			       
<?php } else { ?>
          <p style="text-align:center;">没有检测到异常基因!</p>         
<?php } ?>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<script>
var startX = 50;
var startY = 10;
var height = 40;
var width  = 600
var context = null;
var coords_div = document.getElementById('coords');
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
    area[5] = i;//index
    areas[i] = area;
    var row = "<tr><td>" + (i+1) + "</td><td>" +
	data[i] .start + "</td><td>"+ data[i].end +"</td>";
    if(data[i].bad){
	row = row + "<td>是</td>";
    }
    else {
	row = row + "<td>否</td>";
    }
    row = row + "</tr>";
    $('#table').find('tbody').append(row);		
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
function drawArea(contextO, start, width, count, text,index,fillstyle) {
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
    context.fillText(index+1, start+width/2, startY+height+31+i%4*12);
}
</script>
