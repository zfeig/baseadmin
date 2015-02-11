<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Role;
/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $role
 * @property string $desc
 */
class RoleForm extends Role
{
    public  $role;
    public  $desc;
    public  $prilist;
    public  $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'desc','prilist'], 'required'],
            [['desc'], 'string'],
            [['id'],'required','on'=>'update'],
            [['role'],'ckunique','on'=>'update'],
            [['role'],'unique','on'=>'add'],
            [['prilist'],'checkNum'],
            [['role'], 'string', 'max' => 225]
        ];
    }

    //检查参数个数是否超过指定数目
    public function checkNum($attribute){
        if(count($this->$attribute)<2){
            $this->addError($attribute,'请至少选择两种权限!');
        }
    }

    //查找role名称是否唯一
    public function ckunique($attribute,$params){

        if(Role::ckrole($this->$attribute,$this->id)){
            $this->addError($attribute,'角色名已经被占用');
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'=>'',
            'role' => '角色名 [如：admin]',
            'desc' => '角色描述',
            'prilist'=>'权限选择'
        ];
    }
}
