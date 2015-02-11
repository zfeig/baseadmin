<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $user
 * @property string $pwd
 */
class YiiUser extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public  static  function  ckauth(){
        if(Yii::$app->user->isGuest){
            return Yii::$app->response->redirect(['admin/index/login']);
        }else{
            $role=YiiUser::findOne(Yii::$app->user->getId())->role->role;
            $desc=YiiUser::findOne(Yii::$app->user->getId())->role->desc;
            if($role!='admin' && $desc!='管理员'){
               echo "You're Not Authorised!!";die();
            }
        }
        return true;
    }

    /**
     * @获取关联的角色信息
     */
    public function  getRole(){
        return $this->hasOne(Role::className(),['id'=>'role_id']);
    }


    /**
     * @
     */
    public static function findIdentity($id)
    {
        //自动登陆时会调用
        $temp = parent::find()->where(['id'=>$id])->one();
        return isset($temp)?new static($temp):null;
    }

    /**
     * @
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * @
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *@
     */

    public  function  getUser(){
        return $this->user;
    }

    /**
     * @
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * @
     */
    public function validatePassword($password)
    {
        return $this->pwd === $password;
    }




}
