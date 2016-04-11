<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Database_types */

$this->title = Yii::t('app', 'Create Database Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Database Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="database-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
