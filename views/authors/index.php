<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user \app\models\User */

$this->title = 'Личный кабинет';

?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="menu">
        <span><?= Html::a('Добавить публикацию', Url::to('/articles/create')) ?></span> |
        <span><?= Html::a('Мои публикации', Url::to('/articles/index')) ?></span>
        <?php if (!Yii::$app->user->isGuest && $countCollaboration): ?>
            | <span><?= Html::a('Неподтвержденные соавторства ('.$countCollaboration.')', Url::to('/articles/non-confirmed')) ?></span>
        <?php endif; ?>
    </div>

    <h3>Мои данные</h3>
    <div>Дата рождения: <?=Yii::$app->formatter->asDate($user->birth_date, 'dd-MM-yyyy')?></div>
    <div>Логин: <?=$user->username?></div>
    <div>Имя: <?=$user->first_name?></div>
    <div>Фамилия: <?=$user->second_name?></div>
    <div>Фамилия: <?=$user->second_name?></div>
    <div>Отчество: <?=$user->third_name?></div>
    <div>Место проживания: <?=$user->address_residence?></div>
    <div>Место работы: <?=$user->place_work?></div>
</div>
