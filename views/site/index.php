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
        <span><?= Html::a('Авторы', Url::to('news')) ?></span> |
        <span><?= Html::a('Публикации', Url::to('site/articles')) ?></span>
        <?php if (!Yii::$app->user->isGuest): ?>
            | <span><?= Html::a('Личный кабинет', Url::to('/authors/index')) ?></span>
        <?php endif; ?>
    </div>

</div>
