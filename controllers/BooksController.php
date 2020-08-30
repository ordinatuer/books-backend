<?php

namespace app\controllers;

use app\models\Teils;

class BooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teils = Teils::find()->where(['type' => 3]);

        return $this->render('index', [
            'tilesWithImg' => $teils,
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
