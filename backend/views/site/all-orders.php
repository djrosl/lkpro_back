<?php 
use yii\helpers\Url;
use yii\helpers\Html;


$this->title = "Все проверки";

 ?>
<div class="fixed-alert">
    <div class="alert alert-success alert-dismissible">
        <h4><i class="icon fa fa-check"></i> Готово!</h4>
        <p></p>
    </div>
</div>


                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">ОПЛАЧЕНЫЕ ПРОВЕРКИ В РАБОТЕ</h3>
                      <div class="box-tools pull-right">
                        <a href="<?=Url::to('/site/excel?table=allbuttons')?>" class="label label-primary">Скачать Excel</a>
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
                              <th>Оплата</th>
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
                                    echo $field->field->title.': '.$content.'<br>';
                                  } ?>
                                </div>
                              </td>
                              <td><span class="filter-val"><?=$button->title ?></span></td>
                              <td><span class="filter-val"><?=$order_button->order->user->username ?></span></td>
                              <td><?php 
                                $date = Datetime::createFromFormat('Y-m-d H:i:s', $order_button->order->date);
                                echo $date->format('d.m.Y');
                              ?></td>
                              <td>
                                  <select name="" data-order-id="<?=$order_button->order_id?>" data-id="<?=$button->id?>" id="select<?=$button->id?>" class="select-button-status">
                                      <option value="3" <?= $order_button->status == 3 ? 'default selected="selected"' : ''?>>
                                      Отклонено</option>
                                      <option value="0" <?= !$order_button->status ? 'default selected="selected"' : ''?>>
                                      Не в работе</option>
                                      <option value="1" <?= $order_button->status == 1 ? 'default selected="selected"' : ''?>>В процессе</option>
                                      <option value="2" <?= $order_button->status == 2 ? 'default selected="selected"' : ''?>>Проверено</option>
                                  </select>

                                  <form data-id="<?=$order_button->id?>" class="form-inline tooltip-text <?=$order_button->status == 3 ? '':'hidden'?>">
                                      <input type="text" name="" id="" class="" placeholder="Подсказка" value="<?=$order_button->tooltip?>"><!-- 
                                       --><button class=""> ok </button>
                                  </form>
                              </td>
                              <td>
                                  <?php $file = $order_button->file ? array_pop(explode('/',$order_button->file)) : 'Выберите файл...' ?>
                                  <label class="for-file-input" for="file<?=$button->id?>"><?=$file?></label>
                                  
                                  <input type="file" name="file<?=$button->id?>" data-order-id="<?=$order_button->order_id?>" data-id="<?=$button->id?>" id="file<?=$button->id?>" class="hidden">

                                  <a class="removeFile" data-button="<?=$order_button->id?>" data-order="<?=$order_button->order_id?>" href=""><i class="fa fa-close"></i></a>
                              </td>
                              <td><span class="filter-val"><?=$button->price ?></span></td>
                              <td><?=$order_button->payed ? 'Да':'Нет'?></td>
                          </tr>
                  <?php 
                  endif;
                  endforeach; ?>
                      </tbody>
                  </table>
                  </div>
                </div>
            </div>