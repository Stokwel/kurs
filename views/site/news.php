<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $newsData,
        'itemView' => '_newList'
    ]); ?>

</div>
