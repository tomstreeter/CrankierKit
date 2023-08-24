<?php use Kirby\Toolkit\Date; ?>
<footer <?php e($footerClasses !='' , "class=" . $footerClasses . "" ); ?>>
	<p>&copy;
		<?= Date::now()->year(); ?>

	</footer>