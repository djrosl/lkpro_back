<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Passport */

$this->title = Yii::t('app', 'Create Passport');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Passports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
