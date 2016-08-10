<?php
namespace api\controllers;

use backend\modules\datas\models\RealtimeReport;
use backend\modules\normaldata\models\Company;
use yii;
use yii\data\Pagination;

class HomeController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $access_token = Yii::$app->request->get('access_token');
        unset($behaviors['authenticator']);
        return $behaviors;
    }

    public function actionRealtimeReport()
    {
        $query   = RealtimeReport::find();
        $page_no = Yii::$app->request->post('page');
        if (!$page_no) {
            $page_no = 0;
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount'      => $query->count(),
        ]);
        $pagination->setPage($page_no);

        $reports = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $reports;
    }

    public function actionCodeInfo()
    { //获取公司信息

    }

    public function actionSearchDiy()
    {
        $query      = Company::find();
        $connection = Yii::$app->db;
        $sql        = 'select * from company where 1 '; //需要分页
        $post = Yii::$app->request->post();
        $size = isset($post['size'])?$post['size']:20;
        $page = isset($post['page'])?$post['page']:0;
        $post['special'] = json_decode($post['special'],true);
        $post['normal'] = json_decode($post['normal'],true);
        unset($post['page']);
        unset($post['size']);
        $sql1 = '';
        foreach ($post as $k => $pt) {
            if(is_array($pt)) {
                foreach($pt as $kk => $vv) {
                    $sql1 .= self::makeSearchQuery($query,$kk,$vv);
                }
            } else {
                $sql1 .= self::makeSearchQuery($query, $k, $pt);
            }

        }
        //echo $sql;exit;
        $min = $page * $size;
        $max = $min + $size;
        $sql = $sql . $sql1 . ' and id limit ' . $min . ' , ' . $max;//使用between  and  进行分页
        $sqlCount = 'select count(*) as total from company where 1' . $sql1;
        $commandCount = $connection->createCommand($sqlCount);
        $resultCount = $commandCount->queryAll();
        $itemTotal = $resultCount[0]['total'];//查询总数
        $pageCount = ceil($itemTotal / $size);
        //查询结果
        $command = $connection->createCommand($sql);
        $result  = $command->queryAll();
        foreach($result as $key => $val) {
            $result[$key]['tel'] = '';
            $result[$key]['city'] = '';
            $result[$key]['company_name'] = '';
        }
        //需要分页信息

        return [
            'total' => $itemTotal,
            'cur_page' => $page,
            'list' => $result
        ];

    }
    public function makeSearchQuery($query, $key, $range)
    {
        /*if($key=='bossAge'){
        $query->andWhere(['in', 'code', Video::find()->select(['code'])]);
        }*/

        list($value1, $value2)   = explode('-', $range . '-');
        $value2 ? null : $value2 = $value1;

        $table = '';
        $field = '';
        if ($key == 'bossAge') {
            $table = 'contacts';
            $field = 'birthday';
        } else if ($key == 'bossStyle') {
            $table = 'contacts';
            $field = 'style';
        } else if ($key == 'jinglirun') {

        } else if ($key == 'yingyeshouru') {

        } else if ($key == 'PE') {
            $table = 'estimate';
            $field = 'PE';
        } else if ($key == 'PB') {
            $table = 'estimate';
            $field = 'PB';
        } else if ($key == 'PS') {
            $table = 'estimate';
            $field = 'PS';
        } else if ($key == 'jinglirunXJ') {

        }
        if ($table) {
            return "  AND code in (select code from $table where $field BETWEEN $value1 AND $value2)";
        }

    }
    public function myid()
    {
        return yii::$app->user->id;
    }
}
