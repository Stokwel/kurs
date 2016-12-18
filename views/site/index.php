<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Главная';

?>
<div class="courses-index">
    <div class="menu">
        <span><?= Html::a('Авторы', Url::to('site/authors')) ?></span> |
        <span><?= Html::a('Публикации', Url::to('site/articles')) ?></span>
        <?php if (!Yii::$app->user->isGuest): ?>
            | <span><?= Html::a('Личный кабинет', Url::to('/authors/index')) ?></span>
        <?php endif; ?>
        <?php if (!Yii::$app->user->isGuest && $countCollaboration): ?>
            | <span><?= Html::a('Неподтвержденные соавторства ('.$countCollaboration.')', Url::to('/articles/non-confirmed')) ?></span>
        <?php endif; ?>
    </div>

</div>
