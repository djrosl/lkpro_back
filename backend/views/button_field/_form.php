<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Button_field */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="button-field-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'button_id')->textInput() ?>

    <?= $form->field($model, 'field_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
