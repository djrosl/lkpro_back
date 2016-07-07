<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HelpCategory */

$this->title = 'Update Help Category: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Help Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="help-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
