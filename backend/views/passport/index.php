<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PassportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Passports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passport-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Passport'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'own_lastname',
            'own_firstname',
            'own_fathername',
            // 'own_maidenname',
            // 'own_birthplace',
            // 'own_birthdate',
            // 'pass_seria',
            // 'pass_num',
            // 'pass_get',
            // 'pass_by',
            // 'reg_region',
            // 'reg_city',
            // 'reg_street',
            // 'reg_house',
            // 'reg_housing',
            // 'reg_flat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
