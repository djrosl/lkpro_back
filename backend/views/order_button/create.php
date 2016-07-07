<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order_button */

$this->title = Yii::t('app', 'Create Order Button');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Buttons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-button-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
