<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Type_sections */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Type Sections',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="type-sections-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
