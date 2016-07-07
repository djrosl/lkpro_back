<?php 

namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use common\models\Database_types;

class DatabaseTypeController extends ActiveController
{    
    public function behaviors(){
        $this->cors();
        $behaviors = parent::behaviors();

        return $behaviors;
    }

	public function cors() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            exit(0);
        }
    }

    public function actionOptions(){
        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', ['OPTIONS', 'POST']));
    }

    public function actionSearch() {
        $get = \Yii::$app->request->get();
        if (!empty($get)) {
            $model = new $this->modelClass;
            foreach ($get as $key => $value) {
                if (!$model->hasAttribute($key) && $key !== 'expand' && $key !== 'fields' && $key !== 'embed') {
                    throw new \yii\web\HttpException(404, 'Invalid attribute:' . $key);
                }
            }
            try {
                $provider = Database_types::find()->where(['slug'=>$get['slug']])->with('sections')->with('sections.databases')->with('sections.databases.buttons')->with('sections.databases.buttons.fields')->with('sections.databases.buttons.bfields')->asArray()->one();

            } catch (Exception $ex) {
                throw new \yii\web\HttpException(500, 'Internal server error');
            }
            if (count($provider) <= 0) {
                throw new \yii\web\HttpException(404, 'No entries found with this query string');
            } else {
                return $provider;
            }
        } else {
            throw new \yii\web\HttpException(400, 'There are no query string');
        }
    }

    public $modelClass = 'common\models\Database_types';
}