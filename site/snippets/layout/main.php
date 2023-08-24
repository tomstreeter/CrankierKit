

<main <?php e($mainClasses !='' , "class=" . $mainClasses . "" ); ?> >
	<?php if ($customMain = $slots->customMain()): ?>
	<?= $customMain; ?>
	<?php else: 	?>
	<h3>
		<?= $page->title(); ?>
	</h3>
	<p>
		Lorem ipsum dolor, sit amet, consectetur adipisicing elit. Quisquam alias eligendi sit in accusamus, mollitia, rem voluptates laboriosam labore tempore culpa cumque nostrum molestiae! Accusamus quas excepturi eligendi adipisci sed, est ullam deleniti harum ipsam quidem consequuntur maiores unde, perspiciatis natus, ab, aspernatur umque quod nobis debitis consectetur iusto exercitationem.
	</p>
	<?php endif ?>
</main>