<?php 

namespace app\controllers;

use yii\web\Controller;

class TagsController extends Controller
{
	public function actionIndex()
	{
		$tags = \app\models\Tags::find();

		return $this->render('index', [
			'tags' => $tags,
		]);
	}
}