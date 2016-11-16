<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "mingrui_qa".
 *
 * @property string $id
 * @property string $question
 * @property string $answer
 * @property string $createtime
 */
class Status  extends Model
{
     public function getCount(){
        
        //echo $reportQ->count(); 

        $count['unfinish'] = RestReport::find()->where(['<>', 'ptype', 'yidai'])->andWhere(['<>', 'status', 'finished'])->count();
        $count['finish'] = RestReport::find()->where(['<>', 'ptype', 'yidai'])->andWhere([ 'status'=>'finished'])->count();

        $count['doctor'] = RestClient::find()->count();
        $count['sick'] = RestSample::find()->where(['xianzhengzhe'=>1])->count();
        return $count;
     }

}
