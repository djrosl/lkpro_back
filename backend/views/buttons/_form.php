<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Database;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Buttons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buttons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'help')->widget(CKEditor::className()) ?>

    <?= $form->field($model, 'example')->widget(CKEditor::className()) ?>

    <?= $form->field($model, 'time')->widget(CKEditor::className()) ?>

    <?php 
    $db_arr = [];
    foreach(ArrayHelper::map(Database::find()->all(), 'id', 'content') as $key => $db_id){
        $db_arr[$key] = strip_tags($db_id);
    }
    ?>

    <?= $form->field($model, 'db_id')->dropDownList($db_arr) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
