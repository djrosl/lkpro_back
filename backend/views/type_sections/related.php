<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Type_sectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Type Sections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-sections-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a href="<?=Url::to(['type_sections/create'])?>" class="btn btn-success">Создать</a>
    </p>

    <div class="box">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($models as $model): ?>
                <tr>
                    <td><?=$model->id?></td>
                    <td><?=$model->title?>
                        <br>
                        <small><?=$model->info?></small>
                    </td>
                    <td><?=Html::a('Базы данных', Url::to(['database/related', 'section'=>$model->id]))?></td>
                    <td><?=Html::a('Изменить', Url::to(['type_sections/update', 'id'=>$model->id]))?></td>
                    <td><?=Html::a('Удалить', Url::to(['type_sections/delete', 'id'=>$model->id]))?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>
