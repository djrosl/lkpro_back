<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Header */

$this->title = Yii::t('app', 'Create Header');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Headers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
