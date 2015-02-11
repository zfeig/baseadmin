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
    <?=Html::cssFile('@web/css/jquery.Jcrop.css')?>

    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/ajaxupload.js')?>
    <?=Html::jsFile('@web/Js/jquery.Jcrop.min.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
    <title>用户管理</title>
    <script>
        $(function(){



        })
    </script>
</head>
<style type="text/css">
    .form{padding: 15px;}
    .jcorp-holder{position: relative;}
    #frm{margin-bottom:0px; }
    #frm input{margin:15px 0; }
    .pic-display{display: block;margin: 20px;width: auto;}
    #thum{width: auto;}
    /*#thum img{width: auto;height: auto;display: block;}*/
    #preview-pane{
        padding: 0;
        width:150px;
        height: 150px;
        overflow: hidden;
        display: block;
        position: absolute;
        z-index: 2000;
        top: 10px;
        right:-170px;

        border: 1px rgba(0,0,0,.4) solid;
        background-color: white;

        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;

        -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
        box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    }

    #preview-pane .preview-container {
        width: 150px;
        height: 150px;
        overflow: hidden;
        padding: 0;
        text-indent: 0;
    }
    .jcrop-preview{padding: 0;margin: 0;text-indent: 0}

</style>
<body>
    <div class="main">

            <div class="form">
                <h3>头像上传：</h3>

                <div class="text">
                    <?php if($user->thumb):?>
                    <img class="img-circle tx" src="<?=$user->thumb ?>" alt=""/>
                        <?php else:?>
                        <img class="img-circle tx" src="/avatar/photo.jpg" alt=""/>
                    <?php endif ?>
                </div>

                    <form id="frm" action="#" method="post">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="hidden" id="f" name="f" />
                        <input id='upload' name="file_upload" type="button" value='上传' class='btn btn-large btn-primary'>
                        <input type="button" name="btn" value="确认裁剪" class="btn" />
                    </form>
                    <div class="info"></div>
                    <div class="pic-display"></div><div class="text-info"></div>

            </div>
    </div>

    <script>
        var url="http://"+window.location.host;
        var g_oJCrop = null;
        //异步上传文件
        new AjaxUpload("#upload", {
            action: url+'/admin/index/upload',
            type:"POST",
            name:'myfile',
            data: {},
            onSubmit: function(file, ext) {
                if($(".text-info img").length>0){
                    $(".info").html("<div style='color:#E3583B;margin:5px;'>文件已经裁剪过！</div>");return false;
                }
                $(".info").html("<div style='color:#008000;margin:5px;'>上传中...</div>");
            },
            onComplete: function(file, response) {

                if(g_oJCrop!=null){g_oJCrop.destroy();}
                //生成元素
                $(".pic-display").html("<div class='thum'><img id='target' src='"+response+"'/></div>");

                //初始化裁剪区
                $('#target').Jcrop({
                    onChange: updatePreview,
                    onSelect: updatePreview,
                    aspectRatio: 1
                },function(){
                    g_oJCrop = this;

                    var bounds = g_oJCrop.getBounds();
                    var x1,y1,x2,y2;
                    if(bounds[0]/bounds[1] > 150/150)
                    {
                        y1 = 0;
                        y2 = bounds[1];

                        x1 = (bounds[0] - 150 * bounds[1]/150)/2;
                        x2 = bounds[0]-x1;
                    }
                    else
                    {
                        x1 = 0;
                        x2 = bounds[0];

                        y1 = (bounds[1] - 150 * bounds[0]/150)/2;
                        y2 = bounds[1]-y1;
                    }
                    g_oJCrop.setSelect([x1,y1,x2,y2]);

                    //顺便插入略缩图
                    $(".jcrop-holder").append("<div id='preview-pane'><div class='preview-container'><img  class='jcrop-preview' src='"+response+"' /></div></div>");

                });
                //传递参数上传
                $("#f").val(response);

                //更新提示信息
                $(".info").html("<div style='color:#008000;margin:5px;'>准备裁剪。。。</div>");

            }
        });

        //更新裁剪图片信息
        function updatePreview(c) {
            if (parseInt(c.w) > 0){
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
                var bounds = g_oJCrop.getBounds();
                var rx = 150 / c.w;
                var ry = 150 / c.h;
                $('.preview-container img').css({
                    width: Math.round(rx * bounds[0]) + 'px',
                    height: Math.round(ry * bounds[1]) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        }


        //表单异步提交后台裁剪

        $("input[name=btn]").click( function(){
            var w=parseInt($("#w").val());
            if(!w){
                w=0;
            }
            if(w>0){
                $.post(url+'/admin/index/cutpic',{'x':$("input[name=x]").val(),'y':$("input[name=y]").val(),'w':$("input[name=w]").val(),'h':$("input[name=h]").val(),'f':$("input[name=f]").val()},function(data){
                    if(data.status==1){
                        $(".pic-display").remove();
                        $(".info").html("<div style='color:#008000;margin:10px 5px;'>裁剪成功!</div>")
                        $(".text-info").html("<img src='"+data.data+"'>");
                        $(".tx").attr('src',data.data);
                        $("input[name=btn]").hide();
                    }

                },'json');
            }else{
                $(".info").html("<div style='color:#E3583B;margin:5px;'>亲！还没有选择裁剪区域哦！</div>");
            }
        });

    </script>
</body>
</html>
