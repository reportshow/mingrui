<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model apps\models\Mainlist */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mainlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainlist-view">
 

    <p>
        <?= Html::a('修改', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php   
      echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'name_en',
            'number',
            'description:ntext',
            'hassub',
            'classname',
        ],
    ]) ;

     if(!$model->hassub) {
     	echo Html::a('编辑详细图文描述',['detailedit','id'=>$model->id], 
     	  ['class'=>'btn btn-success btn-detail ']) ;
     }
    ?>

</div>
