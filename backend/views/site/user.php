<?php

use yii\helpers\Url;
use kartik\export\ExportMenu;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Инфо о пользователе';

?>
<div class="site-index">

  <table class="table">
    <tr>
      <td>Никнейм</td>
      <td><?=$model->username?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?=$model->email?></td>
    </tr>
    <tr>
      <td>Jabber</td>
      <td><?=$model->jabber?></td>
    </tr>
    <tr>
      <td>ICQ</td>
      <td><?=$model->icq?></td>
    </tr>
    <tr>
      <td>Баланс</td>
      <td><?=@$model->balance->summ?></td>
    </tr>
  </table>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">История пополнений</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered tablesorter">
            <thead>
              <tr>
                <th>Дата</th>
                <th>Способ оплаты</th>
                <th>Сумма</th>
                <th>Статус</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($model->payment as $payment): ?>
              <tr>
                <td><?php 
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $payment->date);
                echo $date ? $date->format('d.m.Y') : '';
                ?></td>
                <td><?=$payment->cashType ? $payment->cashType->title : $payment->comment?></td>
                <td><?=$payment->summ?></td>
                <td><?=$payment->statusString()?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

</div>