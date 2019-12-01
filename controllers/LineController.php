<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;

class LineController extends ActiveController {
    public $modelClass = 'app\models\Lines';

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
}