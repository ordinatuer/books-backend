<div class="row">
	<div class="col-md-6">
		<figure class="book-img">
			<picture>
				<source srcset="<?=$book->picture()['webp-prev']?>" type="image/webp" media="(max-width: 800px)">
				<source srcset="<?=$book->picture()['webp']?>" type="image/webp">
				<img src="<?=$book->picture()['jpg']?>"/>
			</picture>
			<figcaption><?=$book->text?></figcaption>
		</figure>
	</div>
	<div class="col-md-6 book-info">
		<h1><?=$book->text?></h1>
		<hr />
		
		<?php if ($book->links) : ?>

		<b>Жанр:</b><p><?=$book->links->genre?></p>
		<b>Тэги:</b><p><?=$book->links->tags?></p>
		<hr />

		<?php endif; ?>
	</div>
</div>