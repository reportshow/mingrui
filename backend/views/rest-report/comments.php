<?php
use backend\assets\AppAsset;
use backend\components\Functions;
use backend\widgets\Comments;
use backend\widgets\RestrepotTop2;
use backend\widgets\Summary;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title =  $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
 
$this->params['breadcrumbs'][] = '意见反馈';

AppAsset::register($this);
?>
<div class="rest-report-view">

<?=RestrepotTop2::widget(['model_id' => $model->id]);?>

<style type="text/css">
  .hidesummary{
    transform: translateX(-700px);
    -webkit-transform: translateX(-700px);
    transition-duration: 3s;}
</style>

<div class="row">

<?php

if (!Functions::ismobile()) {

    echo " <div class='col-md-4 summarybox'>";
    echo Summary::widget(['model' => $model, 'omims' => $omims]);
    echo " </div>";
}

if (1) {
    echo " <div class='col-md-8 commentbox'>";
    echo Comments::widget([
        'action' => 'rest-report/send-comment',
        'id'     => $model->id,
    ]);
    echo " </div>";
}

?>




</div>
  <!-- /.row -->


<script type="text/javascript">
  $(function(){
    $height = $('.summarybox').height();
    if($height > 200){
      $('.commentbox .direct-chat-messages').height($height-140);
    }

  });
</script>




    <?php

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

