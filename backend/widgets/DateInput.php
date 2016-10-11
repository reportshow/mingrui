<?php
namespace backend\widgets;

use backend\components\Functions;
use kartik\date\DatePicker;
use yii\base\Widget;

class DateInput extends Widget
{
    public $model;
    public $attribute;

    public $field       = '';
    public $searchModel = null;
    public $size        = 'mini';

    public function run()
    {

        if (Functions::ismobile()) {
            $attribute = $this->attribute;
            $model     = $this->model;
            $modelName = $model::classname();
            $modelName = substr($modelName, strrpos($modelName, '\\') + 1);
            $idstr     = "{$modelName}-{$attribute}";

            $value = $model[$attribute]; //Yii::$app->request->queryParams[$searchModel[$field]];
            // var_export(Yii::$app->request->queryParams);exit;

            return "<input class='form-control'  id='$idstr' name='{$modelName}[{$attribute}]' type='date' value='$value'/>";
        }

        $pickerType   = $this->size == 'mini' ? DatePicker::TYPE_INPUT : DatePicker::TYPE_COMPONENT_APPEND;
        $removeButton = $this->size == 'mini' ? false : ['icon' => 'remove'];
        return DatePicker::widget([
            'model'         => $this->model,
            'attribute'     => $this->attribute,
            //'name'          => $this->name,
            'language'      => 'zh_cn',
            //'size'=>'xs',
            'removeButton'  => $removeButton,
            'type'          => $pickerType,
            'pluginOptions' => [
                'autoclose'      => true,
                'format'         => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'language'       => 'zh-CN',
            ],
        ]);

    }

}
