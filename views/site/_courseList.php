<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
?>

<div class="new">
    <?=Html::a($model->title, Url::to(['course', 'id' => $model->id]))?>
    <div><?=mb_strimwidth($model->description, 0, 200, '...')?></div>
</div>

