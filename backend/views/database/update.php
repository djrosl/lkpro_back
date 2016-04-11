<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Database */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Database',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Databases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="database-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
