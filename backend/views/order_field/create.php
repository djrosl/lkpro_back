<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order_field */

$this->title = Yii::t('app', 'Create Order Field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
