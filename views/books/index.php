<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\assets\ListAsset;

ListAsset::register($this);
$name = 'leaflebooks';

$this->title = $name;
$this->registerMetaTag([
	'name' => 'description',
	'content' => 'All boks on this page',
]);

?>
<div class="flex-container">
<?php

foreach ($teils as $teil) {
	if (!$teil->image) {continue;}
?>

	<div class="flex-teil">
		<a href="<?=Url::base(true) . '/books/' . $teil->teil_id?>">
			<picture>
				<source srcset="<?=$teil->picture()['webp-prev']?>" type="image/webp">
				<img src="<?=$teil->picture()['jpg']?>" title="<?=$teil->text?>" />
			</picture>
		</a>
	</div>

<?php } ?>
</div>