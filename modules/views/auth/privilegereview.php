<?php
use yii\helpers\Html;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?=Html::cssFile('@web/css/bootstrap.min.css')?>
    <?=Html::cssFile('@web/css/site.css')?>
    <?=Html::jsFile('@web/Js/jquery.js')?>
    <?=Html::jsFile('@web/Js/bootstrap.js')?>
</head>
<body>

</body>
</html>
<table class="table table-striped">
    <tr>
        <td>路由</td>
        <td>描述</td>
    </tr>
    <tr>
        <td><?=$data->route?></td>
        <td><?=$data->desc?></td>
    </tr>
</table>