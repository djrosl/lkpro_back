<?php

namespace backend\controllers;

use Yii;
use common\models\Buttons;
use backend\models\ButtonsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ButtonsController implements the CRUD actions for Buttons model.
 */
class ButtonsController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Buttons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ButtonsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRelated($database)
    {
        $models = \common\models\Database::findOne(['id'=>$database])->buttons;

        return $this->render('related', [
            'models'=>$models
        ]);
    }

    /**
     * Displays a single Buttons model.
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
     * Creates a new Buttons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Buttons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = Yii::$app->request->post();

            foreach($model->fields as $field){
                $field->required = 0;
                $field->save();
            }
            foreach($post['field_required'] as $field_id=>$value){
                $button_field = \common\models\Button_field::findOne(['button_id'=>$model->id, 'field_id'=>$field_id]);
                $button_field->required = 1;
                $button_field->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Buttons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = Yii::$app->request->post();

            foreach($model->bfields as $field){
                $field->required = 0;
                $field->save();
            }
            if(!empty($post['field_required'])){
                foreach($post['field_required'] as $field_id=>$value){
                    $button_field = \common\models\Button_field::findOne(['button_id'=>$model->id, 'field_id'=>$field_id]);
                    $button_field->required = 1;
                    $button_field->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Buttons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buttons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buttons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buttons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
