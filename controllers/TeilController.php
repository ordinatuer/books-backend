<?php
namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\controllers\func\ExcludeActions;
use yii\filters\auth\HttpBasicAuth;

class TeilController extends ActiveController {
    use ExcludeActions;

    public $modelClass = 'app\models\Teils';
    
    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

//        Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authentificator'] = [
            'class' => HttpBasicAuth::className(),
            'only' => ['index'],
        ];

        return $behaviors;
    }
}