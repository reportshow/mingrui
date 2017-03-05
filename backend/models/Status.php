<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

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

        $count['unfinish'] = RestReport::find()
                    ->where(['<>', 'ptype', 'yidai'])
                    ->andWhere(['<>', 'status', 'finished'])->count();
        $count['finish'] = RestReport::find()->where(['<>', 'ptype', 'yidai'])->andWhere([ 'status'=>'finished'])->count();

        $count['doctor'] = RestClient::find()->count();
        $count['sick'] = RestSample::find()->where(['xianzhengzhe'=>1])->count();
        return $count;
     }

     public function getUserCount(){
     	$count = [];     	
     	$count['daily'] = $this->userDaily;
     	$count['total'] = $this->userTotal; 
     	return $count;   	

     }
     public function getUserDaily(){
    	$todayStart = self::todayStart();
     	//$debugtime = '';
     	for($i=30;$i>=0;$i--){
     		$start = $todayStart-($i)*3600*24;
     		$end = $todayStart-($i-1)*3600*24;
     		$day = date('d',$start+1);

     		$query = User::find()
     				->where(['>','created_at',$start])
     				->andWhere(['<','created_at',$end]);
     	   $daily['label'][] = ($day);
     	   $daily['daily'][] = $query->count();
     	   //echo $query->createCommand()->getRawSql(); exit;
     	}
     	return  $daily;
     }
     public function getUserTotal(){
     	$todayStart = self::todayStart();
     	//$debugtime = '';
     	for($i=30;$i>=0;$i--){
     		$start = $todayStart-($i)*3600*24;
     		$end = $todayStart-($i-1)*3600*24;
     		$day = date('d',$start+1);

     		$total['label'][]= $day;
     		$total['total'][] = User::find()
     				->where(['<','created_at',$end])
     				->count();

     		$total['doctor'][]  = User::find()
     				->where(['<','created_at',$end])
     				->andWhere(['role_text'=>'doctor'])
     				->count();

     		$total['guest'][]  = User::find()
     				->where(['<','created_at',$end])
     				->andWhere(['role_text'=>'guest'])
     				->count();

     	   // $debugtime .=  $end .'<';
     	}
     	//echo $debugtime.'=========';

     	return  $total;
     }  
     /***
    
     public function getModelDaily($modelname){
     	$todayStart = self::todayStart();
     	for($i=0;$i<30;$i++){
     		$start = $todayStart-($i-1)*3600*24;
     		$end = $todayStart-($i)*3600*24;
     		$day = date('m',$start+1);
     		$daily[$day] = ModelUseage::find()
     				->where(['name' =>$modelname])
     				->andWhere(['>','created_at',$start])
     				->andWhere(['<','created_at',$end])
     				->count();
     	   
     	}
     	return  $daily;
     }

     public function getModelTotal($modelname){
     	$todayStart = self::todayStart();
     	for($i=0;$i<30;$i++){
     		$start = $todayStart-($i-1)*3600*24;
     		$end = $todayStart-($i)*3600*24;
     		$day = date('m',$start+1);
     		$total[$day] = ModelUseage::find()
     				->where(['name' =>$modelname]) 
     				->andWhere(['<','created_at',$end])
     				->count();
     	   
     	}
     	return  $total;
     }
 **/     
     public static function todayStart(){
		return strtotime (date('Y-m-d',time()));
     }


}
