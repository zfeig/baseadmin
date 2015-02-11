<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/2/4
 * Time: 18:28
 */

namespace app\modules\controllers;
use app\models\RolePrivilege;
use Yii;
use app\models\Role;
use app\models\RoleForm;
use yii\web\Controller;
use app\models\YiiUser;
use app\models\Privilege;
use yii\web\session;
use yii\data\Pagination;
use yii\filters\AccessControl;


class AuthController extends Controller{
    public $layout='layout';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['rolelist','roleadd','roleupdate','roledel','rolereview','privilegelist','privilegeadd','privilegeupdate','privilegedel','privilegereview'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return YiiUser::ckauth();
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * @rolelist 用户组列表
     */
    public function actionRolelist(){

        $model=new Role();
        $count=$model->find()->count();
        $page=new Pagination(['defaultPageSize'=>10,'totalCount'=>$count]);
        $roles=$model->find()->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();

        return $this->render('rolelist',['page'=>$page,'roles'=> $roles]);
    }

    /**
     * @Roleadd  添加角色组
     */

    public  function actionRoleadd(){
        $model=new RoleForm();
        $model->scenario = 'add';//验证规则场景识别
        //获取权限列表
        $pri=Privilege::find()->all();
        $prilist=array();
        foreach($pri as $v){
            $prilist[$v->id]=$v->desc;
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $post=Yii::$app->request->post('RoleForm');
           // echo "<pre/>";print_r(Yii::$app->request->post());
            //角色入库
            $role=new Role();
            $role->role=$post['role'];
            $role->desc=$post['desc'];
            $role->save();

            //角色权限入库
            $list=$post['prilist'];
            $role_id=$role->id;
            foreach($list as $v){
                $obj=  new RolePrivilege();
                $obj->role_id=$role_id;
                $obj->privilege_id=$v;
                $obj->save();
            }
            Yii::$app->session->setFlash('success','角色添加成功！');
        }


       return $this->render('roleadd',array('model'=>$model,'prilist'=>$prilist));
    }


    public function actionRoleupdate($id){
        $role=Role::findOne($id);
        $roleform=new RoleForm();
        $roleform->scenario = 'update';//验证规则场景识别
        $roleform->attributes=$role->attributes;

        //权限添加
        if($roleform->load(Yii::$app->request->post()) && $roleform->validate()){

            //echo "<pre/>";print_r(Yii::$app->request->post());
            //更新role模型
            $post=Yii::$app->request->post('RoleForm');
            $role->role=$post['role'];
            $role->desc=$post['desc'];
            $role->save();

            //echo "<pre/>";print_r(Yii::$app->request->post());
            //检查权限是否改动
            $opri=Yii::$app->request->post('oprilist');
            $pri=$post['prilist'];
            sort($opri);
            sort($pri);
            if(implode('',$pri)!=implode('',$opri)){
                //执行操作，删除原有权限oprilist，更新现有权限prilist
                foreach(Yii::$app->request->post('oprilist') as $v){
                    RolePrivilege::deleteAll('role_id=:id and privilege_id=:pid',[':id'=>$post['id'],':pid'=>$v]);
                }

                foreach($post['prilist'] as $v){
                    $obj=  new RolePrivilege();
                    $obj->role_id=$post['id'];
                    $obj->privilege_id=$v;
                    $obj->save();
                }
            }

            Yii::$app->session->setFlash('success','更新成功！');
        }

        //获取全部权限列表
        $pri=Privilege::find()->all();
        $prilist=array();
        foreach($pri as $v){
            $prilist[$v->id]=$v->desc;
        }
        $roleform->prilist=$prilist;

        //当前角色拥有的权限
        $jsarr=array();
        //通过关联模型获取
        foreach($role->prilist as $v){
            array_push($jsarr,$v->privilege_id);
        }
        return $this->render('roleupdate',array('model'=>$roleform,'arr'=>$jsarr));
    }


    /**
     * @param $id
     * @return string  角色预览
     */
    public function actionRolereview($id){

        //获取角色拥有的权限
        $role=Role::findOne($id);//获取当前角色对象
        $prilist=$role->prilist;//获取当前角色权限列表
        return $this->render('rolereview',array('role'=>$role,'prilist'=>$prilist));

    }










    /**
     * @权限列表
     */
    public  function actionPrivilegelist(){

        $model=new Privilege();
        $count=$model->find()->count();
        $page=new Pagination(['defaultPageSize'=>10,'totalCount'=>$count]);
        $privileges=$model->find()->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();

        return $this->render('privilegelist',['page'=>$page,'privileges'=> $privileges]);
    }

    /**
     * @return string 权限添加
     */
    public function  actionPrivilegeadd(){
        $model=new Privilege();
        $role_pri=new RolePrivilege();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            //echo "<pre/>";print_r($model);
            if($model->save()){
                //将权限赋给管理员
                $role_pri->role_id=1;//管理员组账号
                $role_pri->privilege_id=$model->id;
                $role_pri->save();

                Yii::$app->session->setFlash('success','权限添加成功！');
            }else{
                Yii::$app->session->setFlash('error','权限添加失败！');
            }
        }
        return $this->render('privilegeadd',['model'=>$model]);
    }

    /**
     * @修改权限信息
     */

    public function actionPrivilegeupdate($id){
        $model=Privilege::findOne($id);

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            //echo "<pre/>";print_r($model);
            if($model->save()){
                Yii::$app->session->setFlash('success','权限修改成功！');
            }else{
                Yii::$app->session->setFlash('error','权限修改失败！');
            }
        }
        return $this->render('privilegeupdate',array('model'=>$model));
    }


    /**
     * @删除权限信息；删除操作会影响到权限角色表，所以对于权限角色表也要更新数据；
     */

    public function  actionPrivilegedel($id){
        echo $id;
    }


    /**
     * @param $id
     * @return string 内容预览
     */

    public function actionPrivilegereview($id){
        $data=Privilege::findOne($id);
        return $this->render('privilegereview',array('data'=>$data));
    }




} 