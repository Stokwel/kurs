<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
?>

<div class="new">
    <span><?=$model->created_at?></span>
    <?=Html::a($model->title, Url::to(['new', 'id' => $model->id]))?>
    <div><?=mb_strimwidth($model->content, 0, 200, '...')?></div>
</div>

