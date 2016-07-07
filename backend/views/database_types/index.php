<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Database_typesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Database Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="database-types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Database Types'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="box">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Show Title</th>
                    <th>Slug</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($models as $model): ?>
                <tr>
                    <td><?=$model->id?></td>
                    <td><?=$model->title?>
                        <br>
                        <?=Html::a('Секции', Url::to(['type_sections/related', 'type'=>$model->id]))?>
                    </td>
                    <td><?=$model->show_title?></td>
                    <td><?=$model->slug?></td>
                    <td><?php //Html::a('Изменить', Url::to(['database_types/update', 'id'=>$model->id]))?></td>
                    <td><?php //Html::a('Удалить', Url::to(['database_types/delete', 'id'=>$model->id]))?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
