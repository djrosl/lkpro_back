<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Database_types */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Database Types',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Database Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="database-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
