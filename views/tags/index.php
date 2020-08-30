<?php
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
?>
<h1>Tags View index</h1>
<?php

$dataProvider = new ActiveDataProvider([
	'query' => $tags,
	'pagination' => [
		'pageSize' => 10,
	],
]);

echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_tag',
]);

?>