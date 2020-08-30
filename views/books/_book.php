<?php
use yii\helpers\Url;

?>
<div class="flex-teil">
	<a href="<?=Url::base(true) . '/books/' . $model->teil_id?>">
		<picture>
			<source srcset="<?=$model->picture()['webp-prev']?>" type="image/webp">
			<img src="<?=$model->picture()['jpg']?>" title="<?=$model->text?>" />
		</picture>
	</a>
</div>