<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */

$this->title = 'Изменить публикацию: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/authors/index']];
$this->params['breadcrumbs'][] = ['label' => 'Мои публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userId' => $userId
    ]) ?>

</div>
