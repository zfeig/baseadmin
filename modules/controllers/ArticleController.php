<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/2/7
 * Time: 14:26
 */

namespace app\modules\controllers;
use app\models\Role;
use yii\web\Controller;
use app\models\Privilege;
use yii\filters\AccessControl;



class ArticleController extends Controller{
    public $layout='layout';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list','add','update','delete','review','search'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            $prilist=Role::prilist();
                            $route= $this->module->id.'/'.$this->id.'/'.$this->action->id;
                            $privilege=Privilege::findOne(['route'=>$route]);

                            if(in_array($privilege->id,$prilist)){
                                return true;
                            }else{
                                echo "对不起！访问未授权！";die();
                            }

                        }
                    ],
                ],
            ],
        ];
    }

    public function actionList(){
        echo '文章列表'.@path1;
    }

    public function  actionAdd(){
        echo '文章添加';
    }

    public  function actionUpdate(){
        echo '文章更新';
    }


    public function  actionDelete(){
        echo '文章删除';
    }


    public function  actionSearch(){
        echo '文章查找';
    }

    public function  actionReview(){
        echo '文章预览';
    }

} 