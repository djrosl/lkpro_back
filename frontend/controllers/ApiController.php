<?php
namespace frontend\controllers;

use common\models\LoginForm;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\base\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use frontend\models\SignupForm;
use common\models\Database_types;

use Yii;

class ApiController extends Controller
{

    public function cors() {

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
    }


    public function behaviors(){
        $this->cors();
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => [
                'dashboard', 
                'add-passport', 
                'add-passport-photo', 
                'order', 
                'user-orders',
                'user-settings', 
                'payment-add',
                'reorder',
                'payment-history',
                'cash-type',
                'add-file-field',
            ],
            'except' => ['options'],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['dashboard'],
            'rules' => [
                [
                    'actions' => [
                        'dashboard',
                        'add-passport', 
                        'add-passport-photo', 
                        'order', 
                        'user-orders',
                        'user-settings',
                        'payment-add',
                        'reorder',
                        'payment-history',
                        'cash-type',
                        'add-file-field',
                    ],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }

    public function actionRegister(){
        $model = new SignupForm();
        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        $user = $model->signup();
        if ($user) {
            return ['access_token' => $user->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }

    public function actionDashboard(){
        //$images = Yii::$app->user->identity->passport->getImages();
        /*$imgs = [];
        foreach($images as $image){
            $imgs[] = $image ? $image->getUrl() : '';
        }*/

        $response = [
            'id'=>Yii::$app->user->identity->id,
            'username' => Yii::$app->user->identity->username,
            'access_token' => Yii::$app->user->identity->getAuthKey(),
            'balance' => Yii::$app->user->identity->balance ? Yii::$app->user->identity->balance->summ : 0
        ];
        //$response['passport']['images'] = $imgs;
        return $response;
    }

    public function actionAddPassport() {
        $post = \Yii::$app->request->post();
        
        if(Yii::$app->user->identity->passport){
            $model = \common\models\Passport::findOne(['id'=>Yii::$app->user->identity->passport->id]);
        } else {
            $model = new \common\models\Passport();
        }

        if($post){
            if($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->save()){
                //$model->user_id = Yii::$app->user->identity->username;
                return Yii::$app->user->identity->getPassport()->one();
            } else {
                $model->validate();
                return $model;
            }
        } else {
            throw new \yii\web\HttpException(405, 'Method not allowed');
        }
    }

    public function actionAddPassportPhoto(){
        $model = \common\models\Passport::findOne(['id'=>Yii::$app->user->identity->passport->id]);

        $model->images = \yii\web\UploadedFile::getInstanceByName('images');

        $back_webroot = Yii::$app->urlManagerBackend->baseUrl;
        //return $model->images;
        if($model->images) {
            $path = \Yii::getAlias('@uploads/').$model->images->baseName.'.'.$model->images->extension;

            //return $path;
            $model->images->saveAs($path);
            $model->attachImage($path);
        }
    }

    public function actionOrder(){
        $post = \Yii::$app->getRequest()->getBodyParams();
        
        /*if(\Yii::$app->user->identity->balance->summ < $post['cost']) {
            throw new \yii\web\HttpException(500, 'FAIL!');
        }*/

        if(!empty($post['reorder'])){
            $order = \common\models\Order::findOne(['id'=>$post['reorder']]);
            $buttons = $order->orderbuttons;
            $fields = $order->fields;
            $balance = \common\models\Balance::find(['id'=>Yii::$app->user->identity->id])->one();

            foreach($buttons as $button) {
                $balance->summ = (int)$balance->summ + (int)$button->button->price;
                $button->delete();
            }
            foreach($fields as $field) {
                $field->delete();
            }

            $balance->save();
        } else {
            $order = new \common\models\Order();
        }
        
        $order->user_id = \Yii::$app->user->identity->id;
        $order->base_type = (int)$post['base_type'];
        $order->cost = (string)$post['cost'];
        $order->status = 2;
        //$order->title = $post['name'];

        if($order->save()) {
            $balance = \common\models\Balance::find(['id'=>Yii::$app->user->identity->id])->one();

            foreach($post['order'] as $button){
                $order_button = new \common\models\Order_button();
                $order_button->status = 0;
                $order_button->payed = 0;
                if($balance->summ - (int)$button['price'] >= 0) {
                    $balance->summ = $balance->summ - (int)$button['price'];
                    $order_button->payed = 1;
                }
                $order_button->order_id = $order->id;
                $order_button->button_id = $button['id'];
                $order_button->save();
            }
            foreach($post['sub'] as $key => $field){
                if($field){
                    $order_field = new \common\models\Order_field();
                    $order_field->order_id = $order->id;
                    $order_field->field_id = $key;
                    $order_field->content = is_array($field) ? implode(',', $field) : $field;
                    $order_field->save();
                }
            }

            
            
            if($balance->save()){
                /*$order_payment = new \common\models\OrderPayment();
                $order_payment->order_id = $order->id;
                $order_payment->summ = $order->cost;
                $order_payment->date = new \yii\db\Expression('NOW()');
                $order_payment->user_id = $order->user_id;
                $order_payment->save();*/

                return $balance->summ;
            }

        } else {
            $order->validate();
            return $order;
        }

        return [];
    }

    public function actionFile($path){
        $file = \Yii::getAlias('@uploads/').$path;
        if(file_exists($file)){
            \Yii::$app->response->sendFile($file);
        } else {
            throw new \yii\web\HttpException(404, 'File doesn\'t exist');
        }
    }

    public function actionUserOrders($status = 1, $id = 0) {
        $user_id = \Yii::$app->user->identity->id;

        if($id) {
            $order = \common\models\Order::find()->where(['user_id'=>$user_id, 'id'=>$id]);
            return $order->with('orderbuttons')->with('orderbuttons.button')->with('fields')->with('fields.field')->asArray()->one();
        }

        $orders = \common\models\Order::find()->where(['user_id'=>$user_id]);
        if($status == 4) {
            $orders->andWhere(['in','status', [4]]);
        } else {
            $orders->andWhere(['not in','status', [4, 0]]);
        }

        return $orders->with('orderbuttons')->with('orderbuttons.button')->with('fields')->asArray()->all();

    }

    public function actionUserSettings() {        
        $user_id = \Yii::$app->user->identity->id;
        if(\Yii::$app->request->post()) {
            $post = \Yii::$app->getRequest()->getBodyParams();
            $model = \frontend\models\User::findOne(['id'=>$user_id]);

            if(!empty($post['username'])){
                $model->username = $post['username'];
            }
            if(!empty($post['email'])){
                $model->email = $post['email'];
            }
            if(!empty($post['jabber'])){
                $model->jabber = $post['jabber'];
            }
            if(!empty($post['icq'])){
                $model->icq = $post['icq'];
            }
            if(!empty($post['password'])){
                $model->setPassword($post['password']);
                $model->generateAuthKey();
            }

            if($model->save()) {
                return $model;
            } else {
                $model->validate();
                return $model;
            }


        } else {
            return \frontend\models\User::findOne(['id'=>$user_id]);
        }

    }

    public function actionChangeOrderStatus(){
        $post = \Yii::$app->getRequest()->getBodyParams();

        $model = \common\models\Order::findOne(['id'=>$post['id']]);
        $model->status = $post['status'];
        return $model->save();
    }

    public function actionHelp($id = 0) {
        if($id) {
            $model = \common\models\Help::findOne(['id'=>$id]);
            return $model;
        } else {
            $models = \common\models\HelpCategory::find()->joinWith('help')->asArray()->all();
            return $models;
        }
    }

    public function actionMainHelp() {
        return \common\models\Help::find()->where(['help.is_main' => 1])->one();
    }

    public function actionFileCheck() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $file = \yii\web\UploadedFile::getInstanceByName('file');

        $path = \Yii::getAlias('@uploads/').$file->baseName.'.'.$file->extension;
        if($file->saveAs($path)) {
            return $file->name;
        }

        return 'error!';
    }

    public function actionPaymentAdd(){
        $post = \Yii::$app->getRequest()->getBodyParams();

        $model = new \common\models\Payment();
    
        $model->user_id = \Yii::$app->user->identity->id;
        $model->status = 0;
        $model->type = 1;
        $model->summ = $post['summ'];
        $model->date = date('Y-m-d H:i:s', strtotime($post['date']));
        $model->check = $post['check'];
        $model->cash_type = $post['cash_type'];


        if($model->save()){
            return $model;
        } else {
            throw new \yii\web\HttpException(500, 'FAIL!');
        }
    }

    public function actionPaymentHistory() {
        $user_id = \Yii::$app->user->identity->id;
        $models = \common\models\Payment::find()->with('cashType')->where(['user_id'=>$user_id])->asArray()->all();
            

        return $models;
    }

    public function actionReorder($id = 0){
        $model = \common\models\Order::findOne(['id'=>$id]);
        if($model->user_id == \Yii::$app->user->identity->id){
            return [
                'model'=>$model,
                'order_buttons'=>$model->getOrderbuttons()->with('button')->with('button.fields')->with('button.bfields')->asArray()->all(),
                'fields'=>$model->getFields()->with('field')->asArray()->all(),
                'base_slug'=>$model->basetype->slug
            ];
        } else {
            throw new \yii\web\HttpException(500, 'FAIL!');
        }
    }

    public function actionIsRequired($field_id, $button_id) {
        return \common\models\Button_field::find()->where(['button_id'=>$button_id, 'field_id'=>$field_id])->select('required')->one();
    }

    public function actionCashType(){
        return \common\models\CashType::find()->asArray()->all();
    }

    public function actionAddFileField() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $file = \yii\web\UploadedFile::getInstanceByName('fieldFile');

        $path = \Yii::getAlias('@uploads/').$file->baseName.'-'.time().'.'.$file->extension;
        if($file->saveAs($path)) {
            return [
                'id'=>(int)Yii::$app->request->headers['FieldId'],
                'path'=>$file->baseName.'-'.time().'.'.$file->extension
            ];
        }

        return 'FAILED!';
    }

}