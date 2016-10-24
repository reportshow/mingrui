<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * This is the model class for table "mingrui_vcf".
 *
 * @property string $id
 * @property string $uid
 * @property string $sick
 * @property integer $age
 * @property string $sex
 * @property string $vcf
 * @property string $status
 * @property string $tel
 * @property string $product
 * @property string $diagnose
 * @property string $gene
 * @property string $createtime
 * @property string $task_id
 */
class Sitepage extends Model
{

    public static function doctorTongji()
    {
        $query     = RestReport::find();
        $query     = $query->where(['<>', 'ptype', 'yidai']);
        $query     = $query->joinWith(['sample']);
        $doctor_id = Yii::$app->user->Identity->role_tab_id;
        $query     = $query->where(['rest_sample.doctor_id' => $doctor_id]);

        $total = $query->count();
        $done  = $query->andWhere(['rest_report.status' => 'finished'])->count();
        return ['done' => $done, 'ongoing' => $total - $done];

    }

    public static function docContent($type)
    {
        $query = MingruiDoc::find();
        $query = $query->where(['type' => $type]) 
                      ->orderBy('id DESC')
                      ->limit(10); 
        return $query->all();              

    }

}
