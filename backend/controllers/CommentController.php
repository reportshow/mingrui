<?php

namespace backend\controllers;

use backend\models\MingruiComments;
use backend\models\MingruiVcf;
use Yii;
use yii\web\Controller;

/**
 * VcfController implements the CRUD actions for MingruiVcf model.
 */
class CommentController extends Controller
{
    public $layout = false;
    public function actionClearComments($report_id)
    {

        if (is_numeric($report_id)) {
            //报告id
            return $this->clearReportComment($report_id);
        } else {
            return $this->clearGuestbookComment($report_id);
        }

    }

    public function clearReportComment($report_id)
    {
        $where['report_id'] = $report_id;
        if (Yii::$app->user->can('admin')) {
            $where['to_uid'] = '99999999';
        } else {
            $doctorid        = Yii::$app->user->Identity->role_tab_id;
            $where['to_uid'] = $doctorid;
        }
        MingruiComments::updateAll(['isread' => 1], $where);
        return json_encode(['code' => '1']);
    }

    public function clearGuestbookComment($report_id)
    {
        //留言
        $where = "report_id = '$report_id' ";
        if (Yii::$app->user->can('admin')) {
            $guestid = substr($report_id, 2);
            $where .= " AND uid <>  '$guestid' ";
        } else {
            $myid = Yii::$app->user->id;
            if ($report_id != 'gb' . $myid) {
                return json_encode(['code' => '101']);
            }
            $where .= " AND uid =  '$myid' ";
        }
        MingruiComments::updateAll(['isread' => 1], $where);

        return json_encode(['code' => '1']);
    }

}
