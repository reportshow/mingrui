<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\MingruiPingjia;
use backend\widgets\Attachments;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '外源报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$jingjiaText = MingruiPingjia::getTextArray();
$objText = $jingjiaText[$model->pingjia];

///var_export($objText); exit();
// $pingjiaTextString = '';
// if($objText){
//    $pingjiaTextString = $objText['key'] . $objText['label']; 
// }

?>
<div class="mingrui-reportstore-view">


    <p>
        <?= Html::a('Update', ['更新', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['删除', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'sick',
            'product',
            'tel',
            'diagnose:ntext',
            'gene',
            [
              'attribute'=>'jingjia',
              'label' => '评价',
              'value'=> $objText,
            ],

            //'attachements:ntext',
            [
               'attribute'=> 'attachements',
               //'label' => '文件',
               'value' => Attachments::widget(['model' => $model, 'field' => 'attachements']),                
            ],

            [
              'attribute'=>'createtime',              
              'value'=> date('Y-m-d H:i', $model->createtime),
            ], 
        ],
    ]) ?>

</div>
