<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Статистика';
?>
<div class="site-index">

    <div class="body-content">

        
        <div class="row">
            <div class="col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Пользователей</span>
                  <span class="info-box-number"><?=$boxes['users']?></span>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Заказов</span>
                  <span class="info-box-number"><?=$boxes['orders']?></span>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Денег введено</span>
                  <span class="info-box-number"><?=$boxes['payment']?></span>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-check"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Оплачено</span>
                  <span class="info-box-number"><?=$boxes['order_payment']?></span>
                </div>
              </div>
            </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Заказы</h3>
              </div>
              <div class="box-body">
                <canvas id="orders"></canvas>

                <script type="text/javascript">
                  var ctx = $("#orders");
                  var myLineChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                        datasets: [
                            {
                                label: "Заказы по месяцам",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "rgba(75,192,192,0.4)",
                                borderColor: "rgba(75,192,192,1)",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "rgba(75,192,192,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: [<?=implode(',',$months)?>],
                            }
                        ]
                      }
                  });
                </script>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Частые проверки</h3>
              </div>
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                  <?php foreach($all_order['usual'] as $usual):
                  if($usual->getOrderCount()): ?>
                    <tr>
                      <td><?=$usual->title?></td>
                      <td><?=$usual->getOrderCount()?></td>
                    </tr>
                  <?php endif; endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Платежи</h3>
              </div>
              <div class="box-body">
                <canvas id="payments"></canvas>

                <script type="text/javascript">
                  var ctx = $("#payments");
                  var myLineChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                        datasets: [
                            {
                                label: "Платежи по месяцам",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "rgba(75,132,192,0.4)",
                                borderColor: "rgba(75,132,192,1)",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                pointBorderColor: "rgba(75,132,192,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(75,132,192,1)",
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: [<?=implode(',',$payments)?>],
                            }
                        ]
                      }
                  });
                </script>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Введено денег пользователями</h3>
              </div>
              <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                  <?php foreach($all_order['user_pay'] as $user):
                  if($user->getPayment()->sum('summ')): ?>
                    <tr>
                      <td><?=$user->username?></td>
                      <td><?=$user->getPayment()->sum('summ')?></td>
                    </tr>
                  <?php endif; endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">
                
              </div>
            </div>
          </div>
        </div>


    </div>
</div>
