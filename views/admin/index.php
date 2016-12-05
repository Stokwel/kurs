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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p><?= Html::a('Курсы', [Url::to('courses/index')]) ?></p>
    <p><?= Html::a('Новости', [Url::to('news/index')]) ?></p>
    <p><?= Html::a('Олимпиады', [Url::to('olympics/index')]) ?></p>
    <p><?= Html::a('Преподаватели', [Url::to('teachers/index')]) ?></p>


</div>
