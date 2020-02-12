<?php
/**
 * Custom Block styles for Block Experiment
 *
 * @package Block_Experiment
 */

/**
 * Hide gallery captions
 */
register_block_style(
	'core/gallery',
	array(
		'name'         => 'block-experiment-hide-caption',
		'label'        => __( 'Hide caption', 'block-experiment' ),
		'inline_style' => '.is-style-block-experiment-hide-caption figcaption, .is-style-block-experiment-hide-label .wp-block-search__label { display: none; }',
	)
);

/**
 * Hide search label
 */
register_block_style(
	'core/search',
	array(
		'name'         => 'block-experiment-hide-label',
		'label'        => __( 'Hide label', 'block-experiment' ),
		'inline_style' => '.is-style-block-experiment-hide-label label { display: none; }',
	)
);

