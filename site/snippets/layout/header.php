<header <?php e($headerClasses != '', 'class="' . $headerClasses . '"'); ?>>
	<?php if ($customHeader = $slots->customHeader()) : ?>
		<?= $customHeader; ?>
	<?php else : ?>
		<?php snippet('components/banner') ?>
	<?php endif ?>
</header>