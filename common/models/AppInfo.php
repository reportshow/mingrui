<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_info".
 *
 * @property integer $id
 * @property string $appver
 * @property string $appname
 * @property string $apiver
 */
class AppInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['appver', 'appname', 'apiver'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'app的版本',
            'appver' => 'app的版本',
            'appname' => 'api的名称',
            'apiver' => 'api的版本',
        ];
    }

    public function afterFind() {
        $this->id .= '';
    }
}
