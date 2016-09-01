<?php

use backend\widgets\Comments;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-report-view">



    <p>




<?=Html::a('查看报告详情', ['show-report', 'id' => $model->id], [
    'class' => 'btn btn-success',
])?>

<?=Html::a('报告归类', ['rest-report/attachment', 'id' => $model->id], [
    'class' => 'btn btn-primary',
])?>

<?=Html::a('数据分析', ['rest-report/attachment', 'id' => $model->id], [
    'class' => 'btn btn-info',
])?>

<?=Html::a('完善资料', ['mingrui-attachment/', 'id' => $model->id], [
    'class' => 'btn btn-warning',
])?>

    </p>

 <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="images/user2.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?=$model->sample->name?></h3>
              <h5 class="widget-user-desc">检测者
              （<?= $model->sample->sex =='male' ? '男': '女' ?>，<?=$model->sample->age?>）</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">日期：<?=$model->created?></a></li>
                <li><a href="#">主诉：<?=$model->sample->symptom?></a></li>
                <li><a href="#">项目：<?=$model->product->name?></a></li>
                <li><a href="#">结论：<?=$model->conclusiontag?>  </a></li>
                <li><a href="#">注释：<?=$model->explainsummary?>
                 </a></li>
                <li style="padding:10px 0px 10px 16px;">
                编号：<?=$model->report_id?>
                <?=Html::a('查看报告详情', ['show-report', 'id' => $model->id], [
                    'class' => 'pull-right badge bg-green', 'style' => "padding:8px",
                  ])?>
                 </li>

                <li style="padding:10px 0px 10px 16px;"> 
                   附加报告: <span class="badge bg-red"  >1</span>
                   <span class="badge bg-green"  >2</span>
                   <span class="badge bg-aqua"  >3</span>

                   <?=Html::a('管理', ['mingrui-attachment/', 'id' => $model->id], [
                      'class' => 'pull-right badge bg-aqua',  
                  ])?>

                 
                  </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->



        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?=$model->sample->name?>之父</h3>
              <h5 class="widget-user-desc">父亲(41岁)</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="images/user1-128x128.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">CNS-11</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">CNS-04_ALS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">CNS-04_ALS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>



        <!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('../dist/img/photo1.png') center center;">
              <h3 class="widget-user-username"><?=$model->sample->name?>之母</h3>
              <h5 class="widget-user-desc">母亲(36岁)</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="images/user3-128x128.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">CNS-11</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">CNS-04_ALS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">CNS-04_ALS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->




  </div>
  <!-- /.row -->





        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="images/user2.png" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">谭雨茹</h3>
              <h5 class="widget-user-desc">检查者（女，9岁）</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">2016-05-13</a></li>
                <li><a href="#">项目: DX-15_代谢全面筛查</a></li>
                <li><a href="#">结论：<span class=" badge bg-green">阴性</span></a></li>
                <li><a href="#">注释: 该样本在佩梅病/痉挛性截瘫2型相关基因PLP1发现1-7号外显子疑似重复突变，建议结合其他方法进一步验证此重复的真实性，请结合临床进一步分析。
                 </a></li>
                <li><a href="#">NG16070056 <span class="pull-right badge bg-green" style="padding:6px">查看报告详情</span></a></li>

                <li><a href="#">
                   附加报告: <span class="badge bg-red"  >1</span>
                   <span class="badge bg-green"  >2</span>
                   <span class="badge bg-aqua"  >3</span>
                  <span class="pull-right badge bg-aqua" style="padding:6px">管理</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->





    <?=DetailView::widget([
    'model'      => $model,
    'attributes' => [
        //'id',
        'report_id',
        'created',
        //'updated',
        'status',
        'note:ntext',
        // 'assigner_id',
        //'product_id',
        [
            'attribute' => 'product.name',
            'label'     => '检查项目',
            'value'     => $model->product->name,
        ],

        //'complete',
        //'cnvsqlite',
        // 'snpsqlite',
        //'cnvsave:ntext',
        /*        [
        'attribute' => 'cnvsave',
        'label'     => 'cnvsave',
        'format'    => 'raw',
        'value'     => $model->cnsaveimg,
        ],*/
        /*      array(
        'label' => 'xx',
        'format' => 'raw',
        'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
        'value'     => function ($model) {
        return '/';
        },
        ),*/
        // 'snpsave:ntext',
        // 'finish',
        //  'xiafa',
        //  'analysis_id',
        // 'yidai_complete',
        //'url:url',
        //'yidai_note:ntext',
        // 'express',
        // 'express_no',
        //'sample_id',
        //   'pdf',

        ['label'    => '结论',
            'attribute' => 'conclusion',
            'format'    => 'raw',
            'value'     => $model->conclusiontag,

        ],
        //'explain:ntext',
        [
            'label' => '注释',
            'value' => $model->explainsummary,
        ],
        // 'jxyanzhen',
        //  'mut_type',
        //'star',
        // 'template',
        // 'type',
        // 'gene_template',
        // 'ptype',
        // 'csupload',
        // 'family_id',
        // 'date',
        //'abiresult:ntext',
        /*        ['label'    => '诊断',
        'attribute' => 'abiresult',
        'format'    => 'raw',
        'value'     => function($model){
        $json = json_decode($model->abiresult);
        if($json){
        return "TODO";// $json->dignosis;
        }
        } ,

        ],*/

        //'snpexplain:ntext',
        //'abiexported',
        //  'final_note:ntext',
        //  'assigner_note:ntext',
        //  'shenhe_date',
        //   'locked',
        //  'express_sent',
        //  'sale_marked',
        // 'time_stamp:ntext',
        // 'yidaifinished_date',
        //  'kyupload',
        //   'yidai_marked',
    ],
])?>

</div>
<?php

?>
<?=Comments::widget([
    'comments' => $comments,
    /*[
    [
    'position'=>'',
    'name'=>'xxx',
    'time'=>'23 Jan 2:00 pm',
    'avatar'=>'',
    'message'=>'Is this template really for free? That s unbelievable!',
    ],
    [
    'position'=>'right',
    'name'=>'hello',
    'time'=>'23 Jan 2:05 pm',
    'avatar'=>'',
    'message'=>'You better believe it!',
    ],
    ],*/
    'id'       => $model->id,
])?>
