<?php

use app\models\Teachers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Olympics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="olympics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desctiption')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'from_ts')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'to_ts')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'teacher_id')->dropDownList(Teachers::find()->select(['CONCAT([[first_name]]," ",[[second_name]])', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
