<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Панель администратора';
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Публикации', [Url::to('site/articles')]) ?></p>
</div>
