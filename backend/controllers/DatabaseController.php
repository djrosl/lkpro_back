<?php

namespace backend\controllers;

use Yii;
use common\models\Database;
use backend\models\DatabaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Type_sections;

/**
 * DatabaseController implements the CRUD actions for Database model.
 */
class DatabaseController extends Controller
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
     * Lists all Database models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DatabaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRelated($section)
    {

        $models = Type_sections::findOne(['id'=>$section])->databases;

        return $this->render('related', [
            'models'=>$models
        ]);
    }

    /**
     * Displays a single Database model.
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
     * Creates a new Database model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Database();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
            if($model->image) {
                if(!is_null($model->getImage())) {
                    $model->removeImages($model->getImage());
                }
                $path = \Yii::getAlias('@webroot/images/').$model->image->baseName.'.'.$model->image->extension;
                $model->image->saveAs($path);
                $model->attachImage($path);
                $model->image = $model->getImage()->getUrl();
                $model->save();
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Database model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
            if($model->image) {
                if(!is_null($model->getImage())) {
                    $model->removeImage($model->getImage());
                }
                $path = \Yii::getAlias('@webroot/images/').$model->image->baseName.'.'.$model->image->extension;
                $model->image->saveAs($path);
                $model->attachImage($path);
                $model->image = $model->getImage()->getUrl();
                $model->save();
            } else if(!is_null($model->getImage())){
                $model->image = $model->getImage()->getUrl();
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Database model.
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
     * Finds the Database model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Database the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Database::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
