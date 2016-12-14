<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'second_name')->textInput() ?>

    <?= $form->field($model, 'third_name')->textInput() ?>

    <?php if ($model->isNewRecord): ?>
    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password')->textInput() ?>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
