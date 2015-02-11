<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%role_privilege}}".
 *
 * @property integer $role_id
 * @property integer $privilege_id
 */
class RolePrivilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role_privilege}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'privilege_id'], 'required'],
            [['role_id', 'privilege_id'], 'integer']
        ];
    }

    /**
     * @获取关联权限表
     */
    public function getPrivilege(){
        return $this->hasOne(Privilege::className(),['id'=>'privilege_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'privilege_id' => 'Privilege ID',
        ];
    }
}
