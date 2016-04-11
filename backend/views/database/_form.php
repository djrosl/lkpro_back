<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Database_types;
use common\models\Type_sections;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Database */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="database-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?=$form->field($model, 'title')->textInput()?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?php if($model->getImages()){
        foreach($model->getImages() as $image){
            echo is_null($image) ? '' : '<img src="'.$image->getUrl().'">';
        }
    } ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Database_types::find()->where(['status'=>1])->all(), 'id', 'title')) ?>
    <?= $form->field($model, 'section_id')->dropDownList(ArrayHelper::map(Type_sections::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'column_width')->dropDownList([0=>'50%',1=>'100%']) ?>

    <?= $form->field($model, 'type')->dropDownList([0=>'grey',1=>"green"]) ?>

    <?= $form->field($model, 'important')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
