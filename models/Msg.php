<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%msg}}".
 *
 * @property integer $id
 * @property integer $fid
 * @property integer $tid
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $send_time
 * @property integer $replay
 */
class Msg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%msg}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'tid', 'title', 'content'], 'required'],
            [['fid', 'tid', 'status', 'send_time'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 225]
        ];
    }

    /*cate与news关联，获取关联的news信息[这里onCondition条件，相当于and]*/
    public function getName(){
       // return $this->hasOne(YiiUser::className(),["id"=>"tid"]);
        return $this->hasOne(YiiUser::className(),['id'=>'fid']);
    }

    public function getToname(){
        return $this->hasOne(YiiUser::className(),['id'=>'tid']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fid' => 'Fid',
            'tid' => '发送给：',
            'title' => '信息标题：',
            'content' => '信息内容：',
            'status' => 'Status',
            'send_time' => 'Send Time',
        ];
    }
}
