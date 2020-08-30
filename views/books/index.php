<?php
/* @var $this yii\web\View */

use app\assets\ListAsset;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

ListAsset::register($this);
$name = 'leaflebooks';

$this->title = $name;
$this->registerMetaTag([
	'name' => 'description',
	'content' => 'All boks on this page',
]);

$dataProvider = new ActiveDataProvider([
	'query' => $tilesWithImg,
	'pagination' => [
		'pageSize' => 15,
	],
]);

$listView = ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_book',
	'options' => [
		'class' => 'flex-container',
	],
	'summary' => false,
	'pager' => [
		'options' => [
			'class' => 'pagination col-sm-12',
		],
	],
]);

?>
<?=$listView;?>