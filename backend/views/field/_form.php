<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Field */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        0=>'Текстовое поле',
        1=>'Дата',
        2=>'Выпадающий список',
        3=>'Период',
        4=>'Файл',
        5=>'Регион',
    ]) ?>

    <?= $form->field($model, 'subfields')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
