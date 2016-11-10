<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\MingruiDoc;
use backend\widgets\Comments;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
$type = $_GET['type'];
$name = MingruiDoc::$TYPES[$type ];

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['index','type'=>$model->type]];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-doc-view">
 
    <p class='hide'>
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
/*   echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:raw', 
            'doc',
            ['attribute'=>'createtime','format'=>'date']
        ],
    ]) */

    echo  $this->render('view-item', [
        'model' => $model,
    ]);
    ?>

    <?php
    
    if($_GET['type']=='article'){

    
       ?>
       <div class='row' style="margin-left:0px">
         <div class="col-md-8" style="padding-left: 0px;">

              <?=Comments::widget([
                    'action'=>'mingrui-doc/send-comment',
                    'id' => 'doc'.$model->id,
                ])?>
         </div>
       </div>
        <?php
    }//=====
    ?>
</div>
