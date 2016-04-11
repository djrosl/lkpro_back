<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'LK PRO Admin Panel';
?>
<div class="site-index">

    <div class="body-content">

        <row class="col-md-12">
            <p>
                    <form class="form-inline" method="post" action="<?php echo Url::to('/codes/generate'); ?>">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <input type="number" class="form-control" min="1" name="num" id="" placeholder="<?php echo Yii::t('app', 'Codes number'); ?>">
                        <input type="submit" class="btn btn-primary" value="<?php echo Yii::t('app', 'Generate codes'); ?>">
                    </form>
                    </p>
        </row>
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Коды</h3>
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
                      </table>
                    </div>
                  </div>
                </div>
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Пользователи</h3>
                    </div>

                    <div class="box-body">
                      <table class="table table-bordered">
                        <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?=$user->id?></td>
                                <td><?=$user->username?></td>
                                <td><?=$user->code ? $user->code->code : ''?></td>
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
