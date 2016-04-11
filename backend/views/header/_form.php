<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Header */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'column_1')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic',
        //'maxlength' => 255
    ]) ?>

    <?= $form->field($model, 'column_2')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic',
        //'maxlength' => 255
    ]) ?>

    <?= $form->field($model, 'column_3')->widget(CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic',
        //'maxlength' => 255
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
