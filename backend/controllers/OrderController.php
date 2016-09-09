<?php

namespace backend\controllers;

use Yii;
use common\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->goHome();
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionChangeStatus() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $order_button = \common\models\Order_button::findOne(['button_id'=>$post['id'], 'order_id'=>$post['order_id']]);
        $order_button->status = $post['value'];
        $order_button->save();

        if($post['value'] == 3 || $post['value'] == 4) {
            $balance = \common\models\Balance::findOne(['user_id'=>$order_button->order->user_id]);
            $balance->summ = $balance->summ+$order_button->button->price;

            $balance->save();

            $payment = new \common\models\Payment();
            $payment->status = 1;
            $payment->summ = (int)$order_button->button->price;
            $payment->user_id = $order_button->order->user_id;
            $payment->date = new \yii\db\Expression('NOW()');
            $payment->type = 0;
            $payment->comment = 'Возврат #'.$order_button->order->id.' / '.$order_button->button->title;
            $payment->save();
        }

        return 'Статус проверки успешно изменен.';
    }

    public function actionChangeOrderStatus() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $order_button = \common\models\Order::findOne(['id'=>$post['id']]);
        $order_button->status = (int)$post['value'];
        $order_button->save();

        return 'Статус заказа успешно изменен.';
    }

    public function actionAddFile() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $file = \yii\web\UploadedFile::getInstanceByName('0');

        $path = \Yii::getAlias('@uploads/').$file->baseName.'.'.$file->extension;
        if($file->saveAs($path)) {
            $order_button = \common\models\Order_button::findOne(['button_id'=>$post['id'], 'order_id'=>$post['order_id']]);
            $order_button->file = $file->name;
            $order_button->save();
        }

        return 'Файл успешно добавлен.';
    }

    public function actionRemoveFile() {
        $post = \Yii::$app->getRequest()->getBodyParams();

        $order_button = \common\models\Order_button::findOne(['id'=>$post['id']]);
        if($order_button->file){
            $order_button->file = '';
            $order_button->save();
        }

        return 'OK';
    }

    public function actionAddTooltip() {
        $post = \Yii::$app->getRequest()->getBodyParams();
        $order_button = \common\models\Order_button::findOne(['id'=>$post['id']]);
        $order_button->tooltip = $post['tooltip'];
        $order_button->save();
        return 'OK';
    }
}
