<?php
namespace common\models;

use yii\data\SqlDataProvider;
class SqlModelsProvider extends SqlDataProvider
{
    public  $class;
    public $query;
  /*  public function __construct($param)
    {
        $this->_class = $param['class'];
        parent::__construct([
            'sql' => $param['query']->createCommand()->getRawSql(),
        ]);
    }*/
    public function init(){
    	$this->sql =  $this->query->createCommand()->getRawSql();
        parent::init();
    }

    public function getModels()
    {
        $records = parent::getModels();
        $models  = [];
        foreach ($records as $key => $record) {
            $model            = new $this->class();
            $model->attributes = $record;
            $models[$key]     = $model;
        }
        return $models;
    }

}
