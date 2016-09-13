<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '报告检索';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rest-report-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
 
</div>
