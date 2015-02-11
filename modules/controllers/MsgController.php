<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/31
 * Time: 17:33
 */

namespace app\modules\controllers;
use app\models\Msg;
use Yii;
use yii\web\Controller;
use app\models\Follow;
use app\models\YiiUser;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class MsgController extends Controller{
    public $layout  = 'layout';
    /**
     * @用户授权规则
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['sendmsg','msg','read','mysend','reply','pull'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @msg消息列表
     */

    public function  actionMsg(){

        $model=new Msg();
        $uid=Yii::$app->user->getId();
        $count=$model->find()->where(['tid'=>$uid])->count();
        $page=new Pagination(['defaultPageSize'=>5,'totalCount'=>$count]);
        $msgs=$model->find()->where(['tid'=>$uid])->orderBy('send_time asc')->orderBy('status asc')->offset($page->offset)->limit($page->limit)->all();

        return $this->render('msg',['page'=>$page,'msgs'=>$msgs]);


    }

    /**
     * @mysend 我发送的消息
     */

    public function  actionMysend(){

        $model=new Msg();
        $uid=Yii::$app->user->getId();
        $count=$model->find()->where(['fid'=>$uid])->count();
        $page=new Pagination(['defaultPageSize'=>5,'totalCount'=>$count]);
        $msgs=$model->find()->where(['fid'=>$uid])->orderBy('send_time desc')->offset($page->offset)->limit($page->limit)->all();
        return $this->render('mysend',['page'=>$page,'msgs'=>$msgs]);


    }


    /**
     * @sendmsg
     */
    public function actionSendmsg(){

        //查找我关注的【满足条件才能发邮件】
        $uid=Yii::$app->user->getId();
        $follows=Follow::find()->where(['uid'=>$uid])->all();
        if(count($follows)<=0){
            Yii::$app->session->setFlash('error','请您先关注朋友后，再来发消息！');
            return $this->redirect(['index/users']);
        }
        $ids=array();
        foreach($follows as $v){
            array_push($ids,$v->fid);
        }
        //发送对象
        $uses=YiiUser::findAll($ids);
        $to=array();
        foreach($uses as $v){
            $to[$v->id]=$v->nickname;
        }

        $model=new Msg();

        if($model->load(Yii::$app->request->post())&& $model->validate()){
            $model->fid=$uid;
            $model->send_time=time();
            if($model->save()){
                Yii::$app->session->setFlash('success','发送成功！');
            }else{
                Yii::$app->session->setFlash('error','发送失败！');
            }
            //echo "<pre/>";print_r(Yii::$app->request->post());die();
        }
        return $this->render('sendmsg',['model'=>$model,'to'=>$to]);
    }

    /**
     * @reply 在当前消息下回复对方
     */

    public function  actionReply(){
        $arr=array();
        if(Yii::$app->request->isAjax){
            $msg=Yii::$app->request->post("Msg");
            $obj=new Msg();
            $obj->fid=$msg['fid'];
            $obj->tid=$msg['tid'];
            $obj->title=$msg['title'];
            $obj->content=$msg['content'];
            $obj->reply=$msg['reply'];
            $obj->send_time=time();
            $obj->save();
            $arr['status']=1;

        }else{
            $arr['status']=0;
        }
        echo json_encode($arr);
    }

    /**
     * @pull  前台轮询消息推送
     */

    public function actionPull(){
        $arr=array();
        if(Yii::$app->request->isAjax){
            $num=Yii::$app->request->get('msgnum');
            //对比数据库当前用户未读消息结果
            $msgnum=Msg::find()->where(['tid'=>Yii::$app->user->getId()])->andWhere(['status'=>0])->count();
            if($msgnum!=$num){
                $session=Yii::$app->session;
                $session->set('msg',$msgnum);
                $arr['msgnum']=$msgnum;
                $arr['status']=1;
            }else{
                $arr['status']=0;
            }
            echo json_encode($arr);
        }
    }


    /**
     * @read read mesage
     */
    public function actionRead($id){
        $msg=Msg::findOne(['id'=>$id]);

        //设置为已读
        if($msg->status==0){
            $msg->status=1;
            $msg->save();
        }

        //消息总数减1
        $session=Yii::$app->session;
        $num=$session->get('msg');
        if($num>0){
            $num--;
            $session->set('msg',$num);
        }

        //回复表单模型
        $model=new Msg();

        return $this->render('read',['msg'=>$msg,'model'=>$model]);
    }

} 