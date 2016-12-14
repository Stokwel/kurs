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
        <span><?= Html::a('Добавить публикацию', Url::to('/articles/create')) ?></span> |
        <span><?= Html::a('Мои публикации', Url::to('/articles/index')) ?></span>
    </div>

</div>
