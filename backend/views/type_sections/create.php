<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Type_sections */

$this->title = Yii::t('app', 'Create Type Sections');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-sections-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
