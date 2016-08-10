<?php
namespace api\controllers;

use backend\modules\normaldata\models\Company;
use common\models\Mycodes;
use common\models\Myreports;
use common\models\RealtimeReport;
use yii;

class MyController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        //$access_token = Yii::$app->request->get('access_token');

        //unset($behaviors['authenticator']);
        return $behaviors;
    }
    /**
     * 获取我的自选股列表
     * @return [type] [description]
     */
    public function actionCodeList()
    {
        try {
            $uid   = self::myid();
            $model = Mycodes::find()->where(['uid' => $uid])->one();
            if ($model && $model->codes) {
                //需要加未读条数
                return self::getCodesInfo($model->codes);//此处改为在model中弄，防止其他地方需要用
            }
            return [];
        } catch (\Exception $e) {
            return 100199;
        }


    }

    /**
     * 标志新收藏的code为已读
     */
    public function actionReadCode() {
        $id = Yii::$app->request->post('code');
        if(!$id) return 100001;
        $uid = self::myid();
        $model = Mycodes::find()->where(['uid' => $uid])->one();
        $flag = false;
        if($model && $model->codes) {
            $code = json_decode($model->codes);
            foreach($code as $key => $val) {
                if($code[$key]->id == $id) {
                    $code[$key]->isread = 1;
                }
            }
            $code = json_encode($code);
            $model->codes = $code;
            $flag = $model->save();
        }
        if($flag) return [];
        else return $id;
    }
    /**
     * 删除一个自选股
     * @return [type] [description]
     */
    public function actionCodeDel()
    {
        try {
            $uid     = self::myid();
            $model   = Mycodes::find()->where(['uid' => $uid])->one();
            $delList = Yii::$app->request->post('codes');

            if ($model && $model->codes) {
                $oldlist      = explode(',', $model->codes);
                $newlist      = array_diff($oldlist, $delList);
                $model->codes = implode(',', $newlist);
                $model->save();
            }
            return [];
        } catch (\Exception $e) {
            return 100199;
        }

    }
    /**
     * 添加一个自选股
     * @return [type] [description]
     */
    public function actionCodeAdd()
    {
        //try {
            $uid     = self::myid();
            $model   = Mycodes::find()->where(['uid' => $uid])->one();
            $newList = Yii::$app->request->post('codes');
            $newList = explode('_',$newList);

            if (count($newList) < 1) {
                return [];
            }

            if (!$model) {
                $model = new Mycodes();
                $tempArray = [];
                foreach($newList as $val) {
                    array_push($tempArray,array(
                        'id' => $val . '',
                        'isread' => '0'
                    ));
                }
                $list = json_encode($tempArray);
            } else {
                $code = json_decode($model->codes);

                foreach($newList as $tempNewList) {
                    $flag = false;
                    foreach($code as $key => $val) {
                        if($val->id == $code) {
                            $flag = true;
                            $code[$key]->isread='1';
                        }
                    }
                    if(!$flag) array_push($code,[
                        'id' => $tempNewList . '',
                        'isread' => '0'
                    ]);
                }

                $list = json_encode($code);
            }

            $model->uid   = $uid;
            $model->codes = $list;
            $model->save();
            return [];
//        } catch (\Exception $e) {
//            return 100199;
//        }

        //return self::getCodesInfo($list);

    }

    public function getCodesInfo($codes)
    {
        $data = [];
        $codes = json_decode($codes);
        $ids = [];
        foreach($codes as $val) {
            $model = Company::find()->where('code=:code',[':code' => $val->id])->one();
            if(empty($model)) continue;
            array_push($data,array(
                'id' => '' . $model->id,
                'code' => '' . $model->code,
                'name' => '' . $model->name,
                'company_name' => '' . $model->company_name,
                'tel' => '' . $model->tel,
                'city' => '' . $model->city,
                'is_read' => $val->isread
            ));
            array_push($ids,$val->id);
        }


//        $tempArray = [];
//        foreach($data as $model) {
//            array_push($tempArray,array(
//                'id' => '' . $model->id,
//                'code' => '' . $model->code,
//                'name' => '' . $model->name,
//                'company_name' => '' . $model->company_name,
//                'tel' => '' . $model->tel,
//                'city' => '' . $model->city,
//            ));
//        }
        return $data;
    }

    /**
     * 获取 我收藏的公告
     * @return [type] [description]
     */
    public function actionReportList()
    {
        $uid   = self::myid();
        $model = Myreports::find()->where(['uid' => $uid])->one();
        if ($model && $model->report_ids) {
            //不需要一个个的查询，太慢
            $data = RealtimeReport::getReportListByIds(explode('_',trim($model->report_ids,'_')));
        }
        return $data;

    }

    /**
     * 删除n个我收藏的公告
     * @return [type] [description]
     */
    public function actionReportDel()
    {
        $uid     = self::myid();
        $model   = Myreports::find()->where(['uid' => $uid])->one();
        $delList = Yii::$app->request->post('id');

        if ($model && $model->report_ids) {
            $oldlist      = explode('_', $model->report_ids);
            $newlist      = array_diff($oldlist, explode('_',trim($delList,'_')));
            $model->report_ids = implode('_', $newlist);
            $model->save();
        }
        $data = RealtimeReport::getReportListByIds($newlist);
        return $data;

    }

    /**
     * 添加n个我收藏的公告
     * @return [type] [description]
     */
    public function actionReportAdd()
    {

        $uid     = self::myid();
        $model   = Myreports::find()->where(['uid' => $uid])->one();
        $newList = Yii::$app->request->post('id');

        if (count($newList) < 1) {           
            return [];
        }

        if (!$model) {
            $model = new Myreports();
            $list  = trim($newList,'_');

        } else {
            $list = $model->report_ids;

            $newList = array_merge(explode('_', trim($list,'_')), explode('_',trim($newList,'_')));
            $newList = array_unique($newList);
            $list    = implode('_', $newList);
        }

        $model->uid   = $uid;
        $model->report_ids = $list;
        $model->save();
        $data = RealtimeReport::getReportListByIds(explode('_',$list));
        return $data;
    }

    public function myid()
    {
        return yii::$app->user->id;
    }
}
