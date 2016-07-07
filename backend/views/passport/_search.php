<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PassportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="passport-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'own_lastname') ?>

    <?= $form->field($model, 'own_firstname') ?>

    <?= $form->field($model, 'own_fathername') ?>

    <?php // echo $form->field($model, 'own_maidenname') ?>

    <?php // echo $form->field($model, 'own_birthplace') ?>

    <?php // echo $form->field($model, 'own_birthdate') ?>

    <?php // echo $form->field($model, 'pass_seria') ?>

    <?php // echo $form->field($model, 'pass_num') ?>

    <?php // echo $form->field($model, 'pass_get') ?>

    <?php // echo $form->field($model, 'pass_by') ?>

    <?php // echo $form->field($model, 'reg_region') ?>

    <?php // echo $form->field($model, 'reg_city') ?>

    <?php // echo $form->field($model, 'reg_street') ?>

    <?php // echo $form->field($model, 'reg_house') ?>

    <?php // echo $form->field($model, 'reg_housing') ?>

    <?php // echo $form->field($model, 'reg_flat') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
