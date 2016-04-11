<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Buttons */

$this->title = Yii::t('app', 'Create Buttons');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buttons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buttons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
