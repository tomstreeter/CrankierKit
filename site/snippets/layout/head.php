<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ($custom_head_meta = $slots->custom_head_meta()) : ?>
	<?= $custom_head_meta; ?>
	<?php endif ?>
	<?= js('assets/js/main.js', ['defer' => true]); ?>
	<?= css('assets/css/main.css'); ?>
	<?php if ($custom_head_links = $slots->custom_head_links()) : ?>
	<?= $custom_head_links; ?>
	<?php endif ?>
	<title>
		<?php if ($custom_head_title = $slots->custom_head_title()) : ?>
		<?= $custom_head_title; ?>
		<?php else : ?>
		<?php if ($page->isHomePage()) : ?>
		<?= $site->title() ?>
		<?php else : ?>
		<?= $page->title() ?> | <?= $site->title() ?>
		<?php endif; ?>
		<?php endif ?>
	</title>
</head>