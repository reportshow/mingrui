<?php
namespace common\models;

use yii\data\SqlDataProvider;

/**
 * example:
 *
$dataProvider = new SqlModelsProvider([
'query' => $query,
'class' => get_class($this),
]);

$dataProvider = new SqlModelsProvider([
'sql' => 'select * from user',
'class' => get_class($this),
]);
 */
class SqlModelsProvider extends SqlDataProvider
{
    public $class;
    public $query;
    public function init()
    {
        if ($this->query) {
            $this->sql = $this->query->createCommand()->getRawSql();
        }
        parent::init();
    }

    public function getModels()
    {
        $records = parent::getModels();
        $models  = [];
        foreach ($records as $key => $record) {
            $model             = new $this->class();
            $model->attributes = $record;
            $models[$key]      = $model;
        }
        return $models;
    }

}
