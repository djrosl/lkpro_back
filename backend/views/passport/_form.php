<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Passport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passport-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'own_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_fathername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_maidenname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_birthplace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_birthdate')->textInput() ?>

    <?= $form->field($model, 'pass_seria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_get')->textInput() ?>

    <?= $form->field($model, 'pass_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_house')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_housing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_flat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
