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



        <div class="col-md-8">          
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
        </div>


 


</div>
  <!-- /.row -->


 




    <?

//     DetailView::widget([
//     'model'      => $model,
//     'attributes' => [
//         //'id',
//         'report_id',
//         'created',
//         //'updated',
//         'status',
//         'note:ntext',
//         // 'assigner_id',
//         //'product_id',
//         [
//             'attribute' => 'product.name',
//             'label'     => '检查项目',
//             'value'     => $model->product->name,
//         ],

//         //'complete',
//         //'cnvsqlite',
//         // 'snpsqlite',
//         //'cnvsave:ntext',
//         /*        [
//         'attribute' => 'cnvsave',
//         'label'     => 'cnvsave',
//         'format'    => 'raw',
//         'value'     => $model->cnsaveimg,
//         ],*/
//         /*      array(
//         'label' => 'xx',
//         'format' => 'raw',
//         'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
//         'value'     => function ($model) {
//         return '/';
//         },
//         ),*/
//         // 'snpsave:ntext',
//         // 'finish',
//         //  'xiafa',
//         //  'analysis_id',
//         // 'yidai_complete',
//         //'url:url',
//         //'yidai_note:ntext',
//         // 'express',
//         // 'express_no',
//         //'sample_id',
//         //   'pdf',

//         ['label'    => '结论',
//             'attribute' => 'conclusion',
//             'format'    => 'raw',
//             'value'     => $model->conclusiontag,

//         ],
//         //'explain:ntext',
//         [
//             'label' => '注释',
//             'value' => $model->explainsummary,
//         ],
//         // 'jxyanzhen',
//         //  'mut_type',
//         //'star',
//         // 'template',
//         // 'type',
//         // 'gene_template',
//         // 'ptype',
//         // 'csupload',
//         // 'family_id',
//         // 'date',
//         //'abiresult:ntext',
//         /*        ['label'    => '诊断',
//         'attribute' => 'abiresult',
//         'format'    => 'raw',
//         'value'     => function($model){
//         $json = json_decode($model->abiresult);
//         if($json){
//         return "TODO";// $json->dignosis;
//         }
//         } ,

//         ],*/

//         //'snpexplain:ntext',
//         //'abiexported',
//         //  'final_note:ntext',
//         //  'assigner_note:ntext',
//         //  'shenhe_date',
//         //   'locked',
//         //  'express_sent',
//         //  'sale_marked',
//         // 'time_stamp:ntext',
//         // 'yidaifinished_date',
//         //  'kyupload',
//         //   'yidai_marked',
//     ],
// ]);



?>

</div>
 
