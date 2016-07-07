<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cash Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cash Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
