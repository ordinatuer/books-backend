<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;

class TeilController extends ActiveController {
    public $modelClass = 'app\models\Teils';
    
    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
}