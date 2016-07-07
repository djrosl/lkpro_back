<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HelpCategory */

$this->title = 'Create Help Category';
$this->params['breadcrumbs'][] = ['label' => 'Help Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="help-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
