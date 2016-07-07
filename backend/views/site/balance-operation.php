<?php

use yii\helpers\Url;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Ручные операции с балансом';
?>
<div class="site-index">
    <div class="formform">
        <h3><?=$done?></h3>
        <?php $form = ActiveForm::begin(['layout' => 'inline']); ?>

            <?= $form->field($model, 'summ')->textInput(['placeholder' => $model->getAttributeLabel('summ')]) ?>
            <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>
            <?= $form->field($model, 'status')->dropDownList([
                1=>'Проведен',
                0=>'Ожидает',
            ]) ?>

            <?= $form->field($model, 'date')->textInput([
                'placeholder' => $model->getAttributeLabel('date'),
                'data-mask'=>'data-mask',
                'data-inputmask'=>"'alias': 'yyyy-mm-dd'"
            ]) ?>
            <?= $form->field($model, 'comment')->textInput(['placeholder' => $model->getAttributeLabel('comment')]) ?>
        
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div><!-- formform -->
</div>