<?php

namespace backend\controllers;

use backend\models\MingruiFilters;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * VcfController implements the CRUD actions for MingruiVcf model.
 */
class FilterController extends Controller
{
    public $enableCsrfValidation = false;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionList($user_id, $report_id, $report_type)
    {
         $filters = MingruiFilters::find()
              ->where(['user_id' => $user_id,
                       'report_id' => $report_id,
                       'report_type' => $report_type])
              ->orderBy([
                             'id'=> SORT_DESC
                             ])
              ->asArray()
              ->all();
         $array = [];
         foreach($filters as $filter) {
              $array[] = array_values($filter);
         }

         return json_encode($array);
    }

    public function actionFilteradd($str_filter)
    {
         $filter_array = json_decode($str_filter);

         $filter = new MingruiFilters();
         $filter->description = $filter_array[1];
         $filter->title       = $filter_array[2];
         $filter->report_type = $filter_array[3];
         $filter->user_id     = $filter_array[4];
         $filter->report_id   = $filter_array[5];
         $filter->filter_json = $filter_array[6];
         $ret = $filter->save();
         if($ret) {
              return $filter->id;
         }
         else {
              return -1;
         }
    }

    public function actionFilterdelete($id)
    {
         $filter = MingruiFilters::find()->where(['id' => $id])->one();
         $filter->delete();
         
         return true;
    }
    
}
