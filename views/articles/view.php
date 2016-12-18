<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/authors/index']];
$this->params['breadcrumbs'][] = ['label' => 'Мои публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-view">
    <?php if ($model->user_id == Yii::$app->user->getId()): ?>
    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверен что хотите удалить эту публикацию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title:ntext',
            'magazine_title:ntext',
            'keywords:ntext',
            'description:ntext'
        ],
    ]) ?>

</div>
