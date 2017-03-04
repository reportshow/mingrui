<?php

use backend\models\MingruiPingjia;
use backend\widgets\Attachments;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => '外源报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//var_dump($model);exit;

$pingjiaText = MingruiPingjia::getTextArray();
if ($model->pingjia == null) {
  $objText ='';
} else {
    $objText = $pingjiaText[$model->pingjia];
}

///var_export($objText); exit();
// $pingjiaTextString = '';
// if($objText){
//    $pingjiaTextString = $objText['key'] . $objText['label'];
// }

?>
<div class="mingrui-reportstore-view">


    <p>
        <?=Html::a('更新', ['update', 'id' => $model->id], ['class' => ' btn btn-primary'])?>
        <?=Html::a('删除', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data'  => [
        'confirm' => '确定要删除吗?',
        'method'  => 'post',
    ],
])?>
    </p>

    <?=DetailView::widget([
    'model'      => $model,
    'attributes' => [
        //'id',
       // 'uid',
        'sick',
        'product',
        'tel',
        'extra1',
        'diagnose:ntext',
        'gene',
        [
            'attribute' => 'jingjia',
            'label'     => '评价',
            'format'=>'raw',
            'value'     => $objText,
        ],

        //'attachements:ntext',
        [
            'attribute' => 'attachements',
            'format'=>'raw',
            //'label' => '文件',
            'value'     => Attachments::widget(['model' => $model, 'field' => 'attachements']),
        ],

        [
            'attribute' => 'createtime',
            'value'     => date('Y-m-d H:i', $model->createtime),
        ],
    ],
])?>

</div>
