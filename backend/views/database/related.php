<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Type_sectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Базы данных');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-sections-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a href="<?=Url::to(['database/create'])?>" class="btn btn-success">Создать базу</a>
        <a href="<?=Url::to(['buttons/create'])?>" class="btn btn-success">Создать проверку</a>
    </p>

    <div class="box">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Проверки</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($models as $model): ?>
                <tr>
                    <td><?=$model->id?></td>
                    <td><?=$model->title?>
                    </td>
                    <td>
                        <?php foreach($model->buttons as $button){
                            echo '<p>'.Html::a($button->title, Url::to(['buttons/update', 'id'=>$button->id])).'</p>';
                        } ?>
                        <?php //Html::a('Все', Url::to(['buttons/related', 'database'=>$model->id]))?>
                    </td>
                    <td><?=Html::a('Изменить', Url::to(['database/update', 'id'=>$model->id]))?></td>
                    <td><?=Html::a('Удалить', Url::to(['database/delete', 'id'=>$model->id]))?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>
