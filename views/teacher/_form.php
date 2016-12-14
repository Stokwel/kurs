<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Works */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="works-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rating')->dropDownList([0, 1, 2, 3, 4, 5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Оценить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
