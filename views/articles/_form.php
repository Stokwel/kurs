<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="works-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'magazine_title')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'authors')->textInput() ?>

    <?= $form->field($model, 'userCollaboration')->dropDownList(User::getCollaborationsList($userId), ['prompt' => 'Выберите соавтора'])?>

    <input type="hidden" name="Articles[user_id]" value="<?=$userId?>"/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
