<?php

namespace console\modules\spider\controllers;

use backend\modules\finance\models\FinanceMain;
use yii;

include "console/modules/spider/components/functions.php";

class FinanceController extends SpiderController
{
    public static $URL = 'http://f10.eastmoney.com/f10_v2/BackOffice.aspx?command=RptF10MainTarget&code=@CODE&num=90&code1=@CODE1&spstr=&n=0';

    private static $html = '';
    public function actionTest()
    {
          self::getOnepage('600006');
    }
    public function actionMake()
    {
        $all = AllCodes();
        foreach ($all as $code) {

            self::getOnepage($code);
        }
    }

    private function getOnepage($code)
    {
        echo "\n ==== $code";
        $code = $this->eastmoneyCode($code);

        $url = str_replace('@CODE', $code, self::$URL);

exit($url);

        self::$html = $this->HtmlfromUrl($url);
        $times      = self::datefromHtml();
        $rows       = self::tablefromHtml();
        self::$html = null;

        //多少个日期
        foreach ($times as $col => $date) {
            $dateTxt = date('Y-m-d', $date);
            if (parent::dataExist(FinanceMain::class, ['code' => $code, 'date' => $dateTxt])) {
                Yii::info('数据存在', '忽略');
                continue;
            }

            $finance       = new FinanceMain();
            $finance->date = $dateTxt;
            $finance->code = $code;

            foreach ($rows as $field => $tds) {

                $value           = $tds[$col];
                $finance->$field = VAL($value);
            }

            if (!$finance->save()) {
                var_dump($finance->errors);exit;
            }
            echo "  OK!";

        }

    }

    public function datefromHtml($html)
    {
        $tr = $html->find('tr', 0);
        //echo ($tr);
        $THs   = $tr->find('th');
        $times = [];
        foreach ($THs as $th) {
            $times[] = strtotime($th->plaintext);
        }
        array_shift($times);
        return $times;
    }

/**
 * [tablefromHtml description]
 * @return [type] [description]
 */
    public function tablefromHtml()
    {
        $finance = new FinanceMain();
        $labels  = $finance->attributeLabels();

        $TR_list = self::$html->find('tr');

        $rows = [];
        foreach ($TR_list as $tr) {
            $tds = $tr->find('td');
            if (count($tds) < 1) {
                continue;
            }

            $fieldLabel = $tds[0];
            if (!$fieldLabel) {
                echo __FILE__ . ' /line:' . __LINE__;
                exit;
            }
            $field = array_search($fieldLabel, $labels);
            if (!$field) {
                echo "\n fail to match label:" . $fieldLabel;
                continue;
            }
            //echo "\n$fieldLabel:  $field  "; //查看是否对应上了
            //
            $row = [];
            foreach ($tds as $i => $td) {
                $row[$i] = cleanTag($tds[$i]->plaintext);
            }
            array_shift($row);
            $rows[$field] = $row;
        }
        return $rows;
    }

}
