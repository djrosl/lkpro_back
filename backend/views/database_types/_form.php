<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Database_types */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="database-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon_class')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field( $model, 'slug' )->textInput( [ 'maxlength' => 255 ] ) ?>

    <?php $model->status = 1; ?>
    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
