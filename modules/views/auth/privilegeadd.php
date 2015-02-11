<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发送消息</title>
    <?=Html::cssFile('@web/css/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
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
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="main">
                <h1>添加权限</h1>
                <?php if(Yii::$app->session->hasFlash('success')):?>
                    <div class="alert alert-success text">
                        <b><?=Yii::$app->session->getFlash('success')?></b>
                    </div>
                <?endif?>


                <?php if(Yii::$app->session->hasFlash('error')):?>
                    <div class="alert alert-error text">
                        <b><?=Yii::$app->session->getFlash('error')?></b>
                    </div>
                <?endif?>

                <?php $form=ActiveForm::begin(['id'=>'privilegeadd','enableAjaxValidation'=>true]); ?>
                <?= $form->field($model,'route')->textInput();?>
                <?= $form->field($model,'desc')->textarea(['rows'=>4]);?>
                <?=Html::submitButton('添加',['class'=>'btn btn-primary'])?>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>



</body>
</html>