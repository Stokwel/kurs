<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кабинет преподавателя';

?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Оценить работы', Url::to('works')) ?></p>

</div>
