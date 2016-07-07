<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Заказ номер '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    


    
    <div class="box">
        <div class="box-header"><h4>Запрошеные проверки</h4></div>
        <div class="box-content">
            <table class="table">
                <thead>
                    <tr>
                        <th>База</th>
                        <th>Название проверки</th>
                        <th>Статус выполнения</th>
                        <th>Прикрепить результат</th>
                        <th>Стоимость</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach($model->buttons as $button): 
                $db = \common\models\Database::findOne(['id'=>$button->db_id]); 
                $order_button = \common\models\Order_button::findOne(['button_id'=>$button->id, 'order_id'=>$model->id]);

                ?>
                    <tr>  
                        <td><?=$db->title ?></td>
                        <td><?=$button->title ?></td>
                        <td>
                            <select name="" data-order-id="<?=$model->id?>" data-id="<?=$button->id?>" id="select<?=$button->id?>" class="form-control select-button-status">
                                <option value="3" <?= $order_button->status == 3 ? 'default selected="selected"' : ''?>>
                                Отклонено</option>
                                <option value="0" <?= !$order_button->status ? 'default selected="selected"' : ''?>>
                                Не в работе</option>
                                <option value="1" <?= $order_button->status == 1 ? 'default selected="selected"' : ''?>>В процессе</option>
                                <option value="2" <?= $order_button->status == 2 ? 'default selected="selected"' : ''?>>Проверено</option>
                            </select>

                            <form data-id="<?=$order_button->id?>" class="form-inline tooltip-text <?=$order_button->status == 3 ? '':'hidden'?>">
                                <input type="text" name="" id="" class="form-control" placeholder="Подсказка" value="<?=$order_button->tooltip?>"><!-- 
                                 --><button class="btn btn-success"> > </button>
                            </form>
                        </td>
                        <td>
                            <?php $file = $order_button->file ? array_pop(explode('/',$order_button->file)) : 'Выберите файл...' ?>
                            <label class="for-file-input" for="file<?=$button->id?>"><?=$file?></label>
                            
                            <input type="file" name="file<?=$button->id?>" data-order-id="<?=$model->id?>" data-id="<?=$button->id?>" id="file<?=$button->id?>" class="hidden">

                            <a class="removeFile" data-button="<?=$order_button->id?>" data-order="<?=$model->id?>" href=""><i class="fa fa-close"></i></a>
                        </td>
                        <td><?=$button->price ?> руб</td>
                    </tr>
            <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><b>Всего</b></td>
                        <td></td>
                        <td><b><?=$model->cost ?> руб</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    
    <div class="box">
        <div class="box-header"><h4>Введенные данные</h4></div>
            <div class="box-content">
            <table class="table">
                <tbody>
            <?php foreach($model->fields as $field): ?>
                <?php 
                    if($field->field->type == 3){
                        $arr = explode(',', $field->content);
                        $date1 = new DateTime($arr[0]);
                        $date2 = new DateTime($arr[1]);
                        $content = 'от '.$date1->format('d.m.Y').' до '.$date2->format('d.m.Y');
                    } else {
                        $content = $field->content;
                    }
                 ?>
                    <tr>
                        <td><?=$field->field->title ?></td>
                        <td><?= $content ?></td>
                    </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-header">Статус заказа</div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-control change-order-status" data-id="<?=$model->id?>">
                        <option value="1" <?=$model->status == 1 ? 'default selected="selected"':''?>>
                            Не оплачено</option>
                        <option value="2" <?=$model->status == 2 ? 'default selected="selected"':''?>>
                            В работе</option>
                        <option value="3" <?=$model->status == 3 ? 'default selected="selected"':''?>>
                            Завершено</option>
                        <option value="4" <?=$model->status == 4 ? 'default selected="selected"':''?>>
                            В архиве</option>
                        <option value="0" <?=$model->status == 0 ? 'default selected="selected"':''?>>
                            Отменено</option>
                    </select>  
                </div>
            </div>
        </div>
    </div>

</div>



<div class="fixed-alert">
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Готово!</h4>
        <p></p>
    </div>
</div>