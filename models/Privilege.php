<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%privilege}}".
 *
 * @property integer $id
 * @property string $route
 * @property string $desc
 */
class Privilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%privilege}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route', 'desc'], 'required'],
            [['desc'], 'string'],
            [['route'],'unique'],
            [['route'], 'string', 'max' => 35]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route' => '路由名称',
            'desc' => '路由描述',
        ];
    }
}
