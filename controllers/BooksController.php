<?php

namespace app\controllers;

use app\models\Teils;

class BooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teils = Teils::find()->all();

        return $this->render('index', [
            'teils' => $teils,
        ]);
    }

    public function actionView(int $id)
    {
    	$book = Teils::findOne($id);

    	return $this->render('book', [
    		'book' => $book,
    	]);
    }

}
