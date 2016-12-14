<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личный кабинет';

?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="menu">
        <span><?= Html::a('Новости', Url::to('news')) ?></span> |
        <span><?= Html::a('Все Курсы', Url::to('courses')) ?></span> |
        <span><?= Html::a('Мои публикации', Url::to('/articles/index')) ?></span>
    </div>

</div>
