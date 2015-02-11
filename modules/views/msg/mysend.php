<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\widgets\linkPager;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>消息中心</title>
    <?=Html::cssFile('@web/css/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
    <script>
        $(function(){

            //查看信息
            $(".msgshow").click(function(){
                var from=$(this).attr('from');
                var to=$(this).attr('to');
                var title=$(this).attr('title');
                var content=$(this).attr('content');
                var send_time=$(this).attr('send_time');
                $(".from").html("<p>From："+from+"</p>");
                $(".to").html("<p>To："+to+"</p><p>信息体：</p>");
                $(".title").html("<p>主题："+title+"</p>");
                $(".content").html("<p>"+content+"<span class='pull-right'>created at "+send_time+"</span></p>");

                $('#myModal').modal('show');
            });

            //确定按钮
            $(".sure").click(function(){
                $('#myModal').modal('hide');
            })

        })
    </script>
</head>
<body>
<div class="contianer">
    <div class="row">
        <div class="col-md-12">
            <div class="main">
                <h2>信息中心</h2>
<!--                <div class="tool">-->
<!--                    <a class="btn btn-primary btn-sm" href="--><?//=Yii::$app->urlManager->createUrl('admin/msg/sendmsg')?><!--">发送消息</a>-->
<!--                </div>-->
                <table class="table table-hover">
                    <tr>
                        <th>Id</th>
                        <th>信息标题</th>
                        <th>发送时间</th>
                        <th>发送给</th>
                        <th>消息类型</th>
                        <th>查看信息</th>
                    </tr>
                    <?php if(count($msgs)>0):?>
                        <?php foreach($msgs as $v):?>
                            <tr>
                                <td><?=$v->id?></td>
                                <td><?php if($v->reply):?> 我回复了：<b style="color: #D9534F"><?=$v->title?></b> <?else:?><?=$v->title?> <?endif?></td>
                                <td><?=date('Y-m-d H:i:s',$v->send_time)?></td>
                                <td><?=$v->toname->nickname?></td>
                                <td> <?php if($v->reply):?> <a class="text text-danger" href="javascript:void(0)">回复消息</a>  <?else:?><a class="text text-info" href="javascript:void()">普通消息</a>  <?endif?></td>
                                <td>
                                    <a class="btn btn-sm btn-success msgshow" href="javascript:void(0)" from="<?=$v->name->nickname?>" to="<?=$v->toname->nickname?>" title="<?=$v->title?>" content="<?=strip_tags($v->content)?>"  send_time="<?=date('Y-m-d H:i:s',$v->send_time)?>" >查看</a>
                                </td>
                            </tr>
                        <?endforeach?>
                    <?else:?>
                        <tr><td colspan="5">暂无消息！</td></tr>
                    <?endif?>
                </table>
                <div class="page">
                    <?= LinkPager::widget(['pagination' => $page]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" url='' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">消息提示</h4>
            </div>
            <div class="modal-body">
                <p class='text-info'>
                <div class="from"></div>
                <div class="to"></div>
                <div class="content"></div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary sure">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

</body>
</html>