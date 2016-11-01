<?php
use backend\assets\AppAsset;
use backend\widgets\RestrepotTop2;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '报告归类';

AppAsset::register($this);

$report_id  = $model->id;
$pingjiaUrl = Yii::$app->urlManager->createUrl(['pingjia/save-xingji']);

$linchuang = '';
$pingjia   = $model->pingjia;
if ($pingjia) {
    $linchuang = $pingjia->linchuang;
}

?>
<?=RestrepotTop2::widget(['model_id' => $model->id]);?>


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

  input::-webkit-input-placeholder { /* WebKit browsers */
　　color:#f99;
　　}

</style>


<script>
  var data = <?php echo $data ?>;
</script>

<div class="box box-info">
    <div class="box-body">
      <!-- Horizontal Form -->
        <div class="box-header " style="padding-left: 0px">
          <h3>临床表型(phepotype)</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <div> </div>

            <div class="input-group col-md-5" style="margin-bottom: 15px;">
                  <input type="text" id="linchuang" class="form-control" name="linchuang"
                  placeholder="请输入临床诊断/特异表型" value="<?=$linchuang ?>">
                  <span class='input-group-btn'>
                    <button id='linchuangpingjia' ctype='button' class='btn btn-info btn-flat'
                    style='border-top-left-radius: 0;border-bottom-left-radius: 0;'>
                    <i class='fa  fa-check hide'></i> <span>确定</span>
                    </button>
                    <button id='rest' class='btn btn-default'>清空</button>
                  </span>

                  <p class="help-block help-block-error"></p>
            </div>
          <!-- /.box-body -->
      <script type="text/javascript">
          $('#linchuangpingjia').click(function(){
             var val = $('#linchuang').val();
             setLinchuang(val);
          });

           $('#rest').click(function(){
            $('#linchuang').val('');
             setLinchuang('null');
          });
          function setLinchuang(val){
             var url = "<?=$pingjiaUrl?>";

              $.ajax({
                   type: "POST",
                   url:  url,
                   data: {report_id: '<?=$report_id?>', linchuang: val},
                   dataType: "json",
                   success: function(d){
                        if(d.code==1){
                           alert('设置成功');

                        }
                   }
               });
          }

      </script>

</div>
<div class="box box-info" style="min-height: 400px">
    <h3 style="padding-left:10px">基因型(genotype)</h3>




<?php if (strcmp($data, '[]')) {?>
<?php foreach (json_decode($data, true) as $gene => $gene_data) {?>
          <div class="box-header ">
           <!--  <h3>基因型(genetype):</h3> -->
<?php foreach ($gene_data['genetype_str'] as $str) {?>
       <?=$str?><br/>
<?php }?>
       </div>
    <p style="text-align:center;">外显子分布及病人突变外显子</p>
    <div class="chart">
      <div id="coords_<?=$gene?>" style="text-align:center;display:none"></div>
      <canvas id="genearea_<?=$gene?>" width="800"></canvas>
    </div>
    <div class="box-body">
      <table id="table_<?=$gene?>" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>序号</th>
            <th>起始位置</th>
            <th>终止位置</th>
            <th>是否异常</th>
            <th>报道次数</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
<?php }?>
<?php } else {?>
<?php if (empty($explain)) {?>
          <h1 style="text-align:center;">没有检测到异常基因!</h1>
<?php } else {?>
          <h5 style="text-align:center;">外显子（Exon）CNV检测结果：</h5>
          <div style="text-align: center;"><?=$explain?></div>
<?php }?>
<?php }?>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<script>
var startX = 50;
var height = 40;
var width  = 600

for(var gene in data) {
     areas = new Array();
     data_length = data[gene].areas.length;
     min = data[gene].areas[0].start;
     max  = data[gene].areas[data_length-1].end;

     for(var i=0; i< data_length; i++) {
          var area = new Array();
          area[0] = (width / (max-min)* (data[gene].areas[i].start-min))+startX;// X start
          area[1] = width / (max-min)*(data[gene].areas[i].end-data[gene].areas[i].start);//width
          area[2] = data[gene].areas[i].count;// text for count
          area[4] = data[gene].areas[i].start.toString().concat('--', data[gene].areas[i].end.toString());//text for coordination
          area[5] = i;//index
          areas[i] = area;

          //fill the tables
          var row = "<tr><td>" + 'E' + (i+1) + "</td><td>" +
               data[gene].areas[i] .start + "</td><td>"+ data[gene].areas[i].end +"</td>";
          if(data[gene].areas[i].bad){
               row = row + "<td>是</td>";
          }
          else {
               row = row + "<td>否</td>";
          }
          row = row + "<td>" + data[gene].areas[i].count + "</td>";
          row = row + "</tr>";
          $('#table_'+gene).find('tbody').append(row);
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

     var startY = 10;
     var context = null;

     var coords_div = document.getElementById('coords_'+gene);
     var graphCanvas = document.getElementById('genearea_'+gene);
// Ensure that the element is available within the DOM
     if (graphCanvas && graphCanvas.getContext) {
          // Open a 2D context within the canvas
          context = graphCanvas.getContext('2d');
     }

//Draw vertival line
     drawLine(context, startX, startY, startX, startY+height, '#000000');

//Draw horizontal line
     drawLine(context, startX, startY+height/2, startX+width, startY+height/2, '#000000');

//Draw areas
     for(var i=0; i<areas.length; i++) {
          //map 0-max to 0-255
          if(countmax >0) {
               coloroff = 255/(countmax-countmin)*areas[i][2];
               coloroff = Math.round(coloroff);
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
          if(data[gene].areas[i].bad){
               drawLine(context, areas[i][0]+areas[i][1]/2, startY-20, areas[i][0]+areas[i][1]/2, startY+height+20, '#ff0000');
          }
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
    context.fillText('E' + (index+1), start+width/2, startY+height+31+i%4*12);
}
</script>





