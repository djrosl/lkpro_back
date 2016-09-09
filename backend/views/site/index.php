<?php

use yii\helpers\Url;
use kartik\export\ExportMenu;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'LK PRO Admin Panel';

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
      'id',
      'summ',
      'user_id',
      'status',
      'date',
      'type',
      'check',
      'cash_type',
    ['class' => 'yii\grid\ActionColumn'],
];

?>
<div class="fixed-alert">
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Готово!</h4>
        <p></p>
    </div>
</div>
<div class="site-index">

    <div class="body-content">
<p>Время: Самара <?=date('d.m.Y H:i', time())?></p>

      
      <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">ОПЛАЧЕНЫЕ ПРОВЕРКИ В РАБОТЕ <a href="/site/all-orders">Список всех проверок</a></h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=buttons')?>" class="label label-primary">Скачать Excel</a>
                      </div>
                    </div>

                  <div class="box-body">
                    <table class="table tablesorter" id="payed">
                      <thead>
                          <tr>
                              <th>База</th>
                              <th>Название проверки</th>
                              <th>Пользователь</th>
                              <th>Дата</th>
                              <th>Статус выполнения</th>
                              <th>Прикрепить результат</th>
                              <th>Стоимость</th>
                          </tr>
                          <tr class="filter-inputs">
                              <td>
                                <select name="" id="" >
                                    <option value="" default selected>Все</option>
                                  <?php 
                                    $arr = [];
                                    foreach($buttons as $order_button){
                                      $button = $order_button->button;
                                      if($button):
                                        $db = \common\models\Database::findOne(['id'=>$button->db_id]);
                                        $arr[] = $db->title;
                                      endif;

                                    }
                                    $arr = array_unique($arr);
                                    foreach($arr as $option){ ?>
                                      <option value="<?=$option?>"><?=$option?></option>
                                    <?php } ?>
                                </select>
                              </td>
                              <td>
                                <select name="" id="" >
                                    <option value="" default selected>Все</option>
                                  <?php 
                                    $arr = [];
                                    foreach($buttons as $order_button){
                                      if($order_button->button):
                                        $arr[] = $order_button->button->title;
                                      endif;
                                    }
                                    $arr = array_unique($arr);
                                    foreach($arr as $option){ ?>
                                      <option value="<?=$option?>"><?=$option?></option>
                                    <?php } ?>
                                </select>
                              </td>
                              <td>
                                <select name="" id="" >
                                    <option value="" default selected>Все</option>
                                    <?php 
                                      $arr = [];
                                      foreach($buttons as $order_button){
                                        $arr[] = $order_button->order->user->username;
                                      }
                                      $arr = array_unique($arr);
                                      foreach($arr as $option){ ?>
                                        <option value="<?=$option?>"><?=$option?></option>
                                      <?php } ?>
                                </select>
                              </td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                <input type="text" name="" id="" size="10">
                              </td>
                          </tr>
                      </thead>
                      <tbody class="to-filter-inputs">
                  <?php foreach($buttons as $order_button): 
                      $button = $order_button->button;
                      if($button):
                      $db = \common\models\Database::findOne(['id'=>$button->db_id]); 

                      ?>
                          <tr>  
                              <td><span class="filter-val"><?=$db->title ?></span>
                              <br>
                              <h6><a href="#" class="showFields">Поля:</a></h6>
                                <div class="fieldsToShow">
                                <?php foreach($order_button->order->fields as $field){
                                    $content = $field->content;
                                    if($field->field->type == 4) {
                                      echo $field->field->title.'<div class="images">';
                                      foreach(explode(',data:', $content) as $k=>$src){
                                        if($k) {
                                          $src = 'data:'.$src; 
                                        }
                                        echo '<a target="_blank" href="'.$src.'">'.Html::img($src, ['width'=>'50']).'</a>';
                                      }
                                      echo '</div>';
                                    } else {
                                      echo $field->field->title.': '.$content.'<br>';
                                    }
                                  } ?>
                                </div>
                              </td>
                              <td><span class="filter-val"><?=$button->title ?></span></td>
                              <td><span class="filter-val"><?=$order_button->order->user->username ?></span></td>
                              <td><?=$order_button->order->date?></td>
                              <td>
                                  <select name="" data-order-id="<?=$order_button->order_id?>" data-id="<?=$button->id?>" id="select<?=$button->id?>" class="form-control select-button-status">
                                      <option value="3" <?= $order_button->status == 3 ? 'default selected="selected"' : ''?>>
                                      Отклонено</option>
                                      <option value="0" <?= !$order_button->status ? 'default selected="selected"' : ''?>>
                                      Не в работе</option>
                                      <option value="1" <?= $order_button->status == 1 ? 'default selected="selected"' : ''?>>В процессе</option>
                                      <option value="2" <?= $order_button->status == 2 ? 'default selected="selected"' : ''?>>Проверено</option>
                                      <option value="4" <?= $order_button->status == 4 ? 'default selected="selected"' : ''?>>
                                      Недостаточно данных</option>
                                  </select>

                                  <form data-id="<?=$order_button->id?>" class="form-inline tooltip-text">
                                      <input type="text" name="" id="" class="form-control" placeholder="Подсказка" value="<?=$order_button->tooltip?>"><!-- 
                                       --><button class="btn btn-success"> > </button>
                                  </form>
                              </td>
                              <td>
                                  <?php $file = $order_button->file ? array_pop(explode('/',$order_button->file)) : 'Выберите файл...' ?>
                                  <label class="for-file-input" for="file<?=$button->id?>"><?=$file?></label>
                                  
                                  <input type="file" name="file<?=$button->id?>" data-order-id="<?=$order_button->order_id?>" data-id="<?=$button->id?>" id="file<?=$button->id?>" class="hidden">

                                  <a class="removeFile" data-button="<?=$order_button->id?>" data-order="<?=$order_button->order_id?>" href=""><i class="fa fa-close"></i></a>
                              </td>
                              <td><span class="filter-val"><?=$button->price ?></span></td>
                          </tr>
                  <?php 
                  endif;
                  endforeach; ?>
                      </tbody>
                  </table>
                  </div>
                </div>
            </div>
        </div>




        
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Неподтвержденные поступления средств</h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=payment')?>" class="label label-primary">Скачать Excel</a>
                      </div>
                    </div>

                  <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Пользователь</th>
                            <th>Сумма</th>
                            <th>Тип</th>
                            <th>Дата</th>
                            <th>Чек</th>
                            <th>Тип денег</th>
                            <th class="text-right"><small>Зачислить на счет/Удалить</small></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          <?php foreach ($payments as $payment): ?>
                            <tr>
                              <td><?=$payment->user->username?></td>
                              <td><?=$payment->summ?></td>
                              <td><?=$payment->typeString()?></td>
                              <td><?php $date = new DateTime($payment->date); echo $date->format('d.m.Y H:m'); ?></td>
                              <td><a href="<?=Url::to('/site/file/?path='.$payment->check)?>" target="_blank">Скачать</a></td>
                              <td><?=$payment->cashType->title?></td>
                              <td class="text-right">
                                <a href="<?=Url::to('/site/accept-payment?id='.$payment->id)?>" class="btn btn-success">
                                  <i class="fa fa-check"></i>
                                </a>
                                <a href="<?=Url::to('/site/remove-payment?id='.$payment->id)?>" class="btn btn-danger">
                                  <i class="fa fa-close"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>

                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Новые заказы</h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=order')?>" class="label label-primary">Скачать Excel</a>
                      </div>
                    </div>

                  <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Имя пользователя</th>
                                <th>Проверено</th>
                                <th>Стоимость</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th></th>
                                <th>Удалить</th>
                            </tr>
                        </thead>
                      <tbody>
                        <?php foreach($orders as $order): ?>
                          <tr>
                              <td>
                                <?php foreach($order->fields as $field):

                                    if($field->field->id == 1){
                                      echo $field->content."<br>";
                                    }
                                      
                                    if($field->field->id == 5){
                                      echo $field->content."<br>";
                                    }
                                      
                                    if($field->field->id == 6){
                                      echo 'ИНН '.$field->content."<br>";
                                    }
                                      
                                    if($field->field->id == 7){
                                      echo 'ОГРН '.$field->content."<br>";
                                    }
                                      
                                    if($field->field->id == 8){
                                      echo 'ОГРН '.$field->content."<br>";
                                    }

                                  endforeach; ?>
                              </td>
                              <td><?=$order->user->username?></td>
                              <td class="text-center">
                                <?php
                                    $statuses = [0=>0,1=>0,2=>0,3=>0, 4=>0];
                                    foreach($order->orderbuttons as $but) {
                                        if(is_null($but->status)){
                                            $but->status = 0;
                                        }
                                        $statuses[$but->status]++;
                                    }
                                    
                                    foreach($statuses as $key => $status) {
                                        if($status) {
                                     ?>
                                        <span class="color-<?=$key?>"><?=$status?></span>
                                    <?php }
                                    } ?>
                              </td>
                              <td><?=$order->cost?></td>
                              <td><?=$order->stringStatus()?></td>
                              <td><?=$order->date?></td>
                              <td><a href="<?=Url::to('/order/view?id='.$order->id)?>">Подробнее</a></td>
                              <td>
                                <a href="<?=Url::to('/order/delete?id='.$order->id)?>" class="btn btn-danger">
                                  <i class="fa fa-close"></i>
                                </a>
                              </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="5">
                                  <a href="<?=Url::to('/order')?>">Все заказы</a>
                              </td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Коды </h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=code')?>" class="label label-primary">Скачать Excel</a>
                      </div>
                    </div>

                    <div class="box-body">
                      <table class="table table-bordered">
                        <tbody>
                        <?php foreach($codes as $code): ?>
                            <tr>
                                <td><?=$code->id?></td>
                                <td><?=$code->code?></td>
                                <td><button data-clipboard-text="<?=$code->code?>" class="btn btn-default btn-clipboard"><i class="fa fa-copy"></i></button></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3">
                              <form class="form-inline" method="post" action="<?php echo Url::to('/codes/generate'); ?>">
                                  <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                                  <input type="number" class="form-control" min="1" name="num" id="" placeholder="<?php echo Yii::t('app', 'Количество'); ?>">
                                  <input type="submit" class="btn btn-primary" value="<?php echo Yii::t('app', 'Сгенерировать'); ?>">
                              </form>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Пользователи</h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=users')?>" class="label label-primary">Скачать Excel</a>
                      </div>
                    </div>

                    <div class="box-body">
                      <table class="table table-bordered">
                        <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?=$user->id?></td>
                                <td><?=$user->username?></td>
                                <td><?=$user->balance ? $user->balance->summ : 0?> руб.</td>
                                <td><?=$user->code ? $user->code->code : ''?></td>
                                <td><?=Html::a('<i class="fa fa-info"></i>', '/site/user?id='.$user->id, ['class'=>'btn btn-default'])?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
        </div>

    </div>
</div>
