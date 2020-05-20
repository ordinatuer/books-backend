<?php
namespace app\controllers;
use Yii;
use yii\rest\ActiveController;
use app\controllers\func\ExcludeActions;

class TeilController extends ActiveController {
    use ExcludeActions;

    public $modelClass = 'app\models\Teils';
    
    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }
}