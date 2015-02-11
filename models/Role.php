<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $role
 * @property string $desc
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'desc'], 'required'],
            [['desc'], 'string'],
            [['role'],'unique'],
            [['role'], 'string', 'max' => 225]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrilist(){
        return $this->hasMany(RolePrivilege::className(),['role_id'=>'id']);
    }


    /**
     * @编辑时检查role是否重复
     */
    public function ckrole($role,$id){

        $model =new Role();
        $count=Static::find()->where(["role"=>$role])->andWhere(['!=','id',$id])->count();
       if($count){
           return true;
       }
    }

    /**
     * @获取当前角色对应的权限
     */
    public static function prilist(){
        if(Yii::$app->user->isGuest){
            return Yii::$app->response->redirect(['admin/index/login']);
        }

        $ownpri=array();
        if(Yii::$app->session->has('prilist')){
            $ownpri=Yii::$app->session->has('prilist');
        }else{
            $role_id=Yii::$app->user->identity->role_id;
            $role=Role::findOne($role_id);
            foreach($role->prilist as $v){
                array_push($ownpri,$v->privilege_id);
            }
        }
        return $ownpri;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => '角色名',
            'desc' => '角色描述',
        ];
    }
}
