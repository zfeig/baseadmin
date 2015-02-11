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
            updatemsg();
            //更新信息栏信息数
            function updatemsg(){
                var msgnum=$("#msgnum",parent.document).text();
                //alert(msgnum);
                if(parseInt(msgnum)>0){
                    msgnum=parseInt(msgnum)-1;
                    $("#msgnum",parent.document).text(msgnum);
                }
            }



        })
    </script>
</head>
<style>
    #reply{clear: both}
    .reply_form{display: none;clear: both;margin-top: 2em;}
    .control-label{display: none}
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="main">
                <h1>查看信息</h1>
                <div class="info"></div>
                <p>From:<?=$msg->name->nickname?></p>
                <p>To：<?=Yii::$app->user->identity->nickname?></p>
                <p>主题：<?=$msg->title?></p>
                <p>信息体：</p>
                <p class="content"><?=$msg->content?>
                    <span class="pull-right pull"> created at <?= date('Y-m-d H:i:s')?></span>
                </p>

                <p><a class="btn btn-info" id="reply" href="javascript:void(0);">回复对方</a></p>

                        <div class="reply_form">
                            <?php $form=ActiveForm::begin(
                                [
                                    'action'=>['admin/msg/reply'],
                                   'method'=>'post',
                                    'options'=>['name'=>'form']
                                ]
                            )?>
                                <?=$form->field($model,'fid')->hiddenInput(['value'=>Yii::$app->user->getId()])?>
                                <?=$form->field($model,'tid')->hiddenInput(['value'=>$msg->name->id])?>
                                <?=$form->field($model,'title')->hiddenInput(['value'=>$msg->title])?>
                                <div class="form-group">
                                    <?=$form->field($model,'content')->textarea()?>
                                </div>
                                <?=$form->field($model,'reply')->hiddenInput(['value'=>'1'])?>
                            <a class="btn btn-success" id="replytohim" cansend="1" href="javascript:void(0);">回复</a>
                            <?php ActiveForm::end()?>

<!--                            <form name="form">-->
<!--                                <input name="fid" type="hidden" value="--><?//=Yii::$app->user->getId()?><!--"/>-->
<!--                                <input name="tid" type="hidden" value="--><?//=$msg->name->id?><!--"/>-->
<!--                                <input type="hidden" name="title" value="--><?//=$msg->title?><!--"/>-->
<!--                                <div class="form-group">-->
<!--                                    <textarea name="content" class="form-control" id="content" cols="30" placeholder="至少输入10个字符" rows="4"></textarea>-->
<!--                                </div>-->
<!--                                <input name="reply" type="hidden" value="1"/>-->
<!--                                <a class="btn btn-success" id="replytohim" cansend="1" href="javascript:void(0);">回复</a>-->
<!--                            </form>-->

                        </div>
            </div>
        </div>
    </div>
</div>

<script>
    //点击回复，展开收起回复框
    $("#reply").click(function(){
        $(".reply_form").show();
    });

        //点击异步回复对方
        $("#replytohim").click(function(){
            if($(this).attr('cansend')==1){
                //发送消息

                if($("form textarea").val().length<=0){
                    $(".info").html("<div class='alert alert-danger'>回复内容不得为空！</div>");
                    return false;
                }
                $.post('/admin/msg/reply',$("form[name=form]").serialize(),function(data){
                    if(data.status==1){

                        $(".info").html("<div class='alert alert-success'>回复成功！</div>");
                        $("#replytohim").attr("cansend",'0').attr('disabled',true);

                    }else{
                        $(".info").html("<div class='alert alert-danger'>回复失败！</div>");
                    }
                },'json')
            }
        })
</script>

</body>
</html>
