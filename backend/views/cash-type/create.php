<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CashType */

$this->title = 'Create Cash Type';
$this->params['breadcrumbs'][] = ['label' => 'Cash Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
