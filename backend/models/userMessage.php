<?php
namespace backend\models;

use backend\models\MingruiComments;
use backend\models\MingruiOrder;
use Yii;

class userMessage
{

    public static function myMessages($getcount = false)
    {
        $myid  = Yii::$app->user->id;
        $query = MingruiComments::find()
            ->where(['isread' => 0])
            ->andWhere(['<>', 'uid', $myid])
            ->andWhere(['to_uid' => null]);

        if (Yii::$app->user->can('admin')) {
            $query = $query->andWhere(['like', 'report_id', 'gb']);
        } else if (Yii::$app->user->can('doctor')) {

            $bookid = 'gb' . Yii::$app->user->Identity->role_tab_id;
            $query  = $query->andWhere(['report_id' => $bookid]);

            // echo "测试: ".$query->createCommand()->getRawSql(); exit;
        } else {
            return $getcount ? 0 : [];
        }

        return $getcount ? $query->count() : $query->all();
    }

    public static function reportMessage($getcount = false)
    {
        $myid = Yii::$app->user->id;

        /* $query = RestReport::find();
        $query = $query->where(['<>', 'ptype', 'yidai']);
        $query = $query->joinWith(['sample']);
        $query = $query->where(['rest_sample.doctor_id' =>  $myid]);
        $query = $query->select(['id']);
        $allreportid = [];
        foreach ($query->all() as $key => $o) {
        $allreportid[] = $
        }exit;
         */

        $query = MingruiComments::find()
            ->where(['isread' => 0]);

        if (Yii::$app->user->can('admin')) {
            $query = $query->andWhere(['to_uid' => 99999999]);

        } else if (Yii::$app->user->can('doctor')) {
            $doctor_id = Yii::$app->user->Identity->role_tab_id;
            $query     = $query->andWhere(['to_uid' => $doctor_id]);
        } else {
            return $getcount ? 0 : [];
        }

        return $getcount ? $query->count() : $query->all();

    }
    public static function format4web($list)
    {
        $data = [];
        if (count($list)) {
            foreach ($list as $key => $msg) {
                $item = ['name' => '', 'avatar' => ''];

                if ($msg->creator) {
                    $item['name']   = $msg->creator->nickname;
                    $item['avatar'] = $msg->creator->avatar;
                }
                $report_id = $msg->report_id;

                if (is_numeric($report_id)) {
                    $item['url'] = Yii::$app->urlManager->createUrl(['/rest-report/view', 'id' => $report_id]);
                } else {
                    //留言板
                    $item['url'] = Yii::$app->urlManager->createUrl(['/guestbook/view', 'id' => $report_id]);
                }
                $item['createtime'] = date('Y-m-d H:i', $msg->createtime);
                $item['content']    = $msg->content ;
                $data[]             = $item;
            }
        }
        return $data;
    }
    public function Orders()
    {
        $all = MingruiOrder::find()->where(['status' => 'init'])->all();
    }

}
