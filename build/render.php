<p
	<?php echo get_block_wrapper_attributes(); ?>
	data-wp-interactive="myplugin/animatedword"
	<?php echo wp_interactivity_data_wp_context(array(
		'words'         => array('Programador', 'Project Manager', 'Marketero', 'Diseñador'),
		'currentIndex'  => 0,
		'isFading'      => false,
	)); ?>
	data-wp-init="actions.init">
	Y yo soy un <span class="word-animated" data-wp-class--fade="context.isFading" data-wp-text="state.currentWord"></span>.
</p>