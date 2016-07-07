<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

use common\widgets\Excel;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'file', 'remove-payment', 'accept-payment', 'statistics', 'excel', 'user', 'all-orders', 'balance-operations'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionAllOrders(){

        $models = \common\models\Order::find()->all();
        $buttons = \common\models\Order_button::find()
                ->joinWith('order')
                ->joinWith('order.user')
                ->where(['not', ['user.id'=>null]])
                ->orderBy('order.date')
                ->all();

        return $this->render('all-orders', [
            'orders'=>$models,
            'buttons' => $buttons
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionUser($id = 0){
        if(!$id){
            return $this->goHome();
        }

        $model = \common\models\User::findOne(['id'=>$id]);

        return $this->render('user', [
            'model'=>$model
        ]);
    }

    public function actionIndex()
    {
        $codes = \common\models\Codes::find()->where(['used' => 0])->all();
        $users = \common\models\User::find()->all();

        $orders = \common\models\Order::find()->orderBy('id DESC')->all();

        $payments = \common\models\Payment::find()->where(['status'=>0])->all();

        $buttons = \common\models\Order_button::find()
                ->joinWith('order')
                ->joinWith('order.user')
                ->where(['order_button.payed'=>1])
                ->andWhere(['in', 'order_button.status', [1,0]])
                ->andWhere(['not', ['user.id'=>null]])
                ->orderBy('order.date')
                ->all();

        return $this->render('index', [
            'codes'=>$codes, 
            'users'=>$users, 
            'orders'=>$orders,
            'payments'=>$payments,
            'buttons'=>$buttons
            ]);
    }

    public function actionFile($path){
        $file = \Yii::getAlias('@uploads/').$path;
        if(file_exists($file)){
            \Yii::$app->response->sendFile($file);
        } else {
            throw new \yii\web\HttpException(404, 'File doesn\'t exist');
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRemovePayment($id = 0) {
        if($id) {
            \common\models\Payment::findOne(['id'=>$id])->delete();
        }
        return $this->goHome();
    }

    public function actionAcceptPayment($id = 0, $redirect = true) {
        if($id) {
            $payment = \common\models\Payment::findOne(['id'=>$id]);
            $balance = \common\models\Balance::findOne(['user_id'=>$payment->user_id]);
            
            if(is_null($balance)) {
                $balance = new \common\models\Balance();
            }

            $balance->user_id = $payment->user_id;
            $balance->summ = $balance->summ ? (int)$balance->summ + (int)$payment->summ : $payment->summ;

            $order_buttons = \common\models\Order_button::find()
                ->joinWith('order')
                ->where(['order.user_id'=>$payment->user_id, 'order_button.status'=>0])
                ->all();

            foreach($order_buttons as $button){
                if($balance->summ - (int)$button->button->price >= 0) {
                    $balance->summ = $balance->summ - (int)$button->button->price;
                    $button->payed = 1;
                    $button->save();
                }
            }

            if($balance->save()){
                //$payment->status = 1;
                $payment->save();

                if(!$redirect) {
                    return $payment->id;
                }
            }
        }
        return $this->goHome();
    }

    public function actionStatistics(){
        $boxes = [
            'users'=> \common\models\User::find()->count(),
            'orders'=>\common\models\Order::find()->count(),
            'payment'=>\common\models\Payment::find()->sum('summ'),
            'order_payment'=>\common\models\OrderPayment::find()->sum('summ'),
        ];

        $order_months = [];
        $payments = [];
        for($i = 1; $i <= 12; $i++){        
            $lower = new \DateTime('2016-'.$i.'-1');
            $upper = new \DateTime('2016-'.$i.'-31');
            $order_months[] = \common\models\Order::find()->where(['BETWEEN', 'date', $lower->format('Y-m-d'), $upper->format('Y-m-d')])->count();
            $payments[] = \common\models\Payment::find()->where(['BETWEEN', 'date', $lower->format('Y-m-d'), $upper->format('Y-m-d')])->sum('summ');
        }

        $all_order = [
            'usual'=>\common\models\Buttons::find()->all(),
            'user_pay'=>\common\models\User::find()->all(),
        ];

        return $this->render('statistics', [
            'boxes'=>$boxes,
            'months' => $order_months,
            'all_order' => $all_order,
            'payments'=>$payments,
            ]);
    }

    public function actionExcel($table = ''){
        if($table == 'payment') {
            Excel::export([
                'models' => \common\models\Payment::find()->all(),
                'mode'=>'export',
                'columns'=> [
                    'summ',
                    'user.username',
                    'status',
                    'date',
                    'type',
                    'check',
                    'cash_type',
                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-payment.xls'
            ]);
            $file = 'export-payment.xls';
        } else if($table == 'order'){
            Excel::export([
                'models' => \common\models\Order::find()->all(),
                'mode'=>'export',
                'columns'=> [
                    'id',
                    'user.username',
                    'cost:text:Стоимость',
                    'title',
                    'date:datetime',
                    [
                        'attribute' => 'buttons',
                        'header' => 'Заказанные проверки',
                        'format' => 'text',
                        'value' => function($model){
                            $out = '';
                            foreach($model->buttons as $button){
                                $out .= $button->title.'('.$button->price.'р.); ';
                            }

                            return $out;
                        }
                    ],
                    [
                        'attribute' => 'fields',
                        'header' => 'Введенные поля',
                        'format' => 'text',
                        'value' => function($model){
                            $out = '';
                            foreach($model->fields as $field){
                                $content = $field->content;
                                if($field->field->type == 3) {
                                    $dates = explode(',', $field->content);

                                    $dates[0] = new \DateTime($dates[0]);
                                    $dates[1] = new \DateTime($dates[1]);
                                    $content = $dates[0]->format('d.m.Y').' - '.$dates[1]->format('d.m.Y');
                                }
                                $out .= $field->field->title.' - '.$content."; ";
                            }

                            return $out;
                        }
                    ],

                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-order.xls'
            ]);
            $file = 'export-order.xls';
        } else if($table == 'code'){
            Excel::export([
                'models' => \common\models\Codes::find()->where(['used'=>0])->all(),
                'mode'=>'export',
                'columns'=> [
                    'code',
                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-codes.xls'
            ]);
            $file = 'export-codes.xls';
        } else if($table == 'users'){
            Excel::export([
                'models' => \common\models\User::find()->all(),
                'mode'=>'export',
                'columns'=> [
                    'username',
                    'email',
                    'code.code',
                    'balance.summ',
                    'icq',
                    'jabber'
                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-user.xls'
            ]);
            $file = 'export-user.xls';
        } else if($table == 'buttons'){
            Excel::export([
                'models' => \common\models\Order_button::find()->joinWith('order')->joinWith('button')->joinWith('order.user')->where(['order_button.status'=>1])->andWhere(['not', ['user.id'=>null]])->all(),
                'mode'=>'export',
                'columns'=> [
                    [
                        'attribute' => 'button',
                        'header' => 'База данных',
                        'format' => 'text',
                        'value' => function($model){
                            $db = \common\models\Database::findOne(['id'=>$model->button->db_id]); 
                            return $db->title;
                        }
                    ],
                    [
                        'attribute' => 'order.fields',
                        'header' => 'Поля',
                        'format' => 'text',
                        'value' => function($model){
                            $out = '';
                            foreach($model->order->fields as $field){
                                $out .= $field->field->title.': '.$field->content.' ';
                            }

                            return $out;
                        }
                    ],
                    'button.title',
                    'order.date',
                    'order.user.username',
                    'button.price'
                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-buttons.xls'
            ]);
            $file = 'export-buttons.xls';
        } else if($table == 'allbuttons'){
            Excel::export([
                'models' => \common\models\Order_button::find()->joinWith('order')->joinWith('button')->joinWith('order.user')->where(['not', ['user.id'=>null]])->all(),
                'mode'=>'export',
                'columns'=> [
                    [
                        'attribute' => 'button',
                        'header' => 'База данных',
                        'format' => 'text',
                        'value' => function($model){
                            $db = \common\models\Database::findOne(['id'=>$model->button->db_id]); 
                            return $db->title;
                        }
                    ],
                    [
                        'attribute' => 'order.fields',
                        'header' => 'Поля',
                        'format' => 'text',
                        'value' => function($model){
                            $out = '';
                            foreach($model->order->fields as $field){
                                $out .= $field->field->title.': '.$field->content.' ';
                            }

                            return $out;
                        }
                    ],
                    'button.title',
                    'order.date',
                    'order.user.username',
                    'button.price'
                ],
                'asAttachment'=>false,
                'savePath'=>\Yii::getAlias('@uploads/'),
                'fileName'=>'export-buttons.xls'
            ]);
            $file = 'export-buttons.xls';
        } else {
            return $this->goHome();
        }

        $this->actionFile($file);

        //return $this->goHome();
        
    }

    public function actionBalanceOperations() {
        $done = false;
        $model = new \common\models\Payment();
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $model->load($post);
            $model->type = 1;
            $model->cash_type = 0;
            $model->check = '';
            if($model->status == 1){

            }
            /*var_dump($model);die;*/
            if($model->save()){
                $done = 'Выполнено!';
                $this->actionAcceptPayment($model->id, false);
            } else {
                return $model->validate();
            }
        }

        return $this->render('balance-operation', [
            'model'=>$model,
            'done'=>$done
        ]);
    }

}
