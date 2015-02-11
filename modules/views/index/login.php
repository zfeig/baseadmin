<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?=Html::cssFile('@web/css/bootstrap.css')?>

</head>
<body>
<style>
    body{background: #009A61}
    .login{background: #fff;padding: 3em;margin-top: 10em;border-radius: 0.5em;}
    label{display: none;}
    .mr20{margin-right:20px;}
    h3{font-family: "microsoft yahei", "黑体"}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 sm col-sm-1"></div>
        <div class="col-md-4 sm col-sm-1 login">
            <h3><p><span class='glyphicon glyphicon-user'></span>&nbsp;欢迎使用用户中心</p></h3>
            <?php $form=ActiveForm::begin([
                'id'=>'login',
                'enableAjaxValidation' => false,
                'options'=>['enctype'=>'multipart/form-data']
            ]);?>

            <?=$form->field($model,'user')->textInput(["placeholder"=>"账号"]); ?>
            <?=$form->field($model,'pwd')->passwordInput(['placeholder'=>'密码']); ?>
<!--            --><?//=$form->field($model,'verifyCode')->widget(Captcha::className(),['captchaAction'=>Yii::$app->urlManager->createUrl('image/captcha'),
//                'template'=>'<div class="row"><div class="col-md-3 col-xs-4 mr20">{image}</div><div class="col-md-6 col-xs-6">{input}</div></div>'
//            ])?>
            <?=  Html::submitButton('登录', ['class'=>'btn btn-primary btn-lg btn-block','name' =>'submit-button']) ?>
            <?php ActiveForm::end();?>
        </div>
        <div class="col-md-4 sm col-sm-1"></div>
    </div>
</div>
</body>
</html>

