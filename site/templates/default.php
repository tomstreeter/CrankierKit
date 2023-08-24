<?php snippet('layout/layout', ['bodyClasses' => 'stack', ' mainClasses' => 'stack'], slots: true); ?>
<?php slot('customMain'); ?>
<h3>
	<?= $page->title();  ?>
</h3>
<p>
	This page (<?= $page->title(); ?>) is being rendered by the <strong><em><?= $page->template(); ?> </em></strong> template. This page is <em>supposed</em> to be rendered by the <strong><em><?= $page->intendedTemplate(); ?> </em></strong> template. This is the intended behavior when CrankierKit is first installed because there <em>is</em> no <strong><em><?= $page->intendedTemplate(); ?></em></strong> template when it's first installed. Pretty cool, eh? Maybe this is what you want, maybe it's not. It's your call. I'm not the boss of you. Just know that making this page of text different requires editing the <strong><em> <?= $page->template(); ?> </em></strong> template file.
</p>
<?php endslot(); ?>

<?php endsnippet(); ?>