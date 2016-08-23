<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use backend\widgets\Comments;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-report-view">



    <p>

<div style='float:right'>
<?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>

<?=Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data'  => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method'  => 'post',
    ],
])?>
  </div>
 

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
  'comments'=>$comments,
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
 'id'=> $model->id,
])?>
