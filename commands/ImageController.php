<?php

namespace app\commands;

use app\models\Teils;
use app\models\Links;

use yii\console\Controller;
use yii\console\ExitCode;

class ImageController extends Controller
{
	public function actionIndex()
	{
		$path = \Yii::getAlias('@images');

		$this->convert();
		//$files = scandir($path);

		//$im = $this->convert($path.'/'.$files[5]);
		//print_r($im);
		//echo "\n" . $path . "\n";

		return ExitCode::OK;
	}

	private function convert($image_jpg = null)
	{
		$output = [];
		$command = 'ls -al';
		$return = null;

		exec($command, $output, $return);

		print_r($output);
		//return getimagesize($image_jpg);
		return null;
	}
}