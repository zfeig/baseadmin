<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <?=Html::cssFile('@web/css/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
    <title>用户管理</title>
    <script>
        $(function(){
            ckinfo();
            //检查信息框
             function ckinfo(){
                var len=$(".text").length;
                if(len){
                    fadeInfo();
                }
            }

            //消息消失动画
            function fadeInfo(){
                setTimeout(function(){
                    //alert('消息框即将消失！');
                    $(".text").fadeOut(800);
                },1000)
            }

        })
    </script>
</head>
<body>
<div class="main">

    <?php if(Yii::$app->session->hasFlash('success')):?>
    <div class=" text-info text-success text">
        <b><?=Yii::$app->session->getFlash('success')?></b>
    </div>
    <?endif?>


    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class=" text-info text-danger text">
            <b><?=Yii::$app->session->getFlash('error')?></b>
        </div>
    <?endif?>

   <h1>推荐朋友</h1>
    <div class="container">
        <div class="row">
            <?php if(count($users)>0):?>
                <?php foreach ($users as $v): ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->user?>" class="img-circle tx" src="<?php if($v->thumb):?><?=$v->thumb?><?else:?>/avatar/photo.jpg<?endif?>" alt=""/>
                        <p class="text-info nickname"><?=$v->nickname?></p>
                        <p><a href="<?=Yii::$app->urlManager->createUrl(['admin/index/follow','id'=>$v->id])?>" class="btn btn-primary btn-sm btn-success">添加关注</a></p>
                    </div>
                <? endforeach?>
            <?endif?>
        </div>
    </div>

    <p><h2>我的粉丝</h2></p>
    <div class="container">
        <div class="row">
            <?php if(count($fensi)>0):?>
                <?php foreach ($fensi as $v): ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->user?>" class="img-circle tx" src="<?php if($v->thumb):?><?=$v->thumb?><?else:?>/avatar/photo.jpg<?endif?>" alt=""/>


                            <?php if(in_array($v->id,$cids )):?>
                                <p class="text-success nickname" href="javascript:void(0)"><span title="我们互相关注了！" class="glyphicon glyphicon-ok-circle"></span> <?=$v->nickname?></p>
                            <?else:?>
                                <p class="text-danger nickname"  href="javascript:void(0)" ><span title="还未关注他哦！" class="glyphicon glyphicon-remove-circle"></span> <?=$v->nickname?></p>
                            <?endif?>

                    </div>
                <? endforeach?>
             <?else:?>
                <p>好可怜，一个粉丝都没有！</p>
            <?endif?>
        </div>
    </div>

    <p><h2>我关注的</h2></p>

    <div class="container">
        <div class="row">
            <?php if(count($cares)>0):?>
                <?php foreach ($cares as $v): ?>
                    <div class="col-md-2 col-sm-1 col-xs-3">
                        <img title="<?=$v->user?>" class="img-circle tx" src="<?php if($v->thumb):?><?=$v->thumb?><?else:?>/avatar/photo.jpg<?endif?>" alt=""/>
                        <p class="text-info nickname"><?=$v->nickname?></p>
                        <p><a href="<?=Yii::$app->urlManager->createUrl(['admin/index/nofollow','id'=>$v->id])?>" class="btn btn-primary btn-sm btn-danger">取消关注</a></p>
                    </div>
                <? endforeach?>
            <?else:?>
               <p>没有关注任何人！</p>
            <?endif?>
        </div>
    </div>
    
</div>
</body>
</html>
