<?php
namespace api\controllers;
use common\models\RealtimeReport;
use common\models\Mycodes;
use yii;
use yii\data\Pagination;

class ReportController extends RestController
{
    /**
     * 获取公司的公告
     * @return array
     */
    public function actionRealtime()
    {
        $code = Yii::$app->request->post('code');
        $size = Yii::$app->request->post('size');
        $uid = self::myid();

        //需要分页
        $query   = RealtimeReport::find()->where('code=:code',[':code' => $code])->select(['id','title','code',
            'time' => 'createtime','createtime' ]);

        $myCodes = Mycodes::find()->where('uid=:uid',[':uid' => $uid])->one();
        $isMyCode = in_array($code,explode('_',trim($myCodes->codes,'_')));

        $page_no = Yii::$app->request->post('page');
        if (!$page_no) {
            $page_no = 0;
        }

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount'      => $query->count(),
        ]);
        $pagination->setPage($page_no);

        $reports = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return [
            'is_mycode' => $isMyCode,
            'list' => $reports
        ];;
//        return [
//            'is_mycode' => false,
//            'list'      => [
//                [
//                    "id"    => 1111111, //公告的id
//                    "title" => "关于变更在上海设立食品销售公司事项的公告",
//                    "code"  => "600123",
//                    "time"  => "14922335"],
//                [
//                    "id"    => 22222, //公告的id
//                    "title" => "关于公司重大资产重组停牌进展的公告",
//                    "code"  => "600123",
//                    "time"  => "14922335"],
//            ],
//        ];
    }

    public function actionSearch()
    {   
        //TODO
        $code = Yii::$app->request->post('code');
        $keyword = Yii::$app->request->post('keyword');
        $page_no = Yii::$app->request->post('page');
        $size = Yii::$app->request->post('size');
        if(empty($keyword)) return 100001;
        $page_no = Yii::$app->request->post('page');
        if (!$page_no) {
            $page_no = 0;
        }

        $query   = RealtimeReport::find()->where(['like','title',$keyword])->select(['id','title','code',
            'time' => 'createtime','createtime' ]);

        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount'      => $query->count(),
        ]);
        $pagination->setPage($page_no);

        $reports = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $reports;
//        return [
//            [
//                "id"    => 1111111, //公告的id
//                "title" => "第八届董事会 2016 年第九次临时会议决议公告",
//                "code"  => "600123",
//                "time"  => "14922335",
//            ], [
//                "id"    => 222, //公告的id
//                "title" => "关于投资收购乌拉圭Lorsinal S.A.股权的公告",
//                "code"  => "600123",
//                "time"  => "14922335",
//            ],
//        ];
    }

    public function actionDetail()
    {
       //TODO
        $id = Yii::$app->request->post('id');$id = 1;
        $data = RealtimeReport::find()->where('id=:id',[':id' => $id])->select(['id','title','code',
        'time' => 'createtime','createtime' ])->one();
        //是否被收藏

        //echo '<pre>';var_dump($data);exit;
        return $data;
//        return [
//            "id"        => 55600312, //公告的id
//            "title"     => "第八届董事会 2016 年第九次临时会议决议公告",
//            "detail"    => "新大洲控股股份有限公司（以下简称“本公司”或“公司”）第八届董事会
//2016 年第九次临时会议通知于 2016 年 7 月 4 日以电子邮件、传真、电话等方式
//发出，会议于 2016 年 7 月 15 日以通讯表决方式召开。本次董事会会议应参加表
//决董事 7 人，实际参加表决董事 7 人。会议由陈阳友董事长主持。本次会议的召
//开符合有关法律、行政法规、部门规章、规范性文件和《公司章程》的规定。",
//            "url"       => "",
//            "share_url" => "",
//            "pdf_url"   => "http://www.cninfo.com.cn/cninfo-new/disclosure/szse/download/1202478573?announceTime=2016-07-18",
//            "time"      => "14922335",
//        ];
    }

    public function myid()
    {
        return yii::$app->user->id;
    }
}
