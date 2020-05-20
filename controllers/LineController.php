<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use app\controllers\func\ExcludeActions;

class LineController extends ActiveController {
	use ExcludeActions;
	
    public $modelClass = 'app\models\Lines';

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
}