<?php
namespace backend\models;

use backend\models\MingruiComments;
use Yii;

class userMessage
{

    public static function myMessages()
    {
        $myid = Yii::$app->user->id;

        $comments = MingruiComments::find()
            ->where(['report_id' => 'gb' . $myid])
            ->andWhere(['<>', 'uid', $myid])
            ->andWhere(['isread' => 0])
            ->all();
        return $comments;
    }

}
