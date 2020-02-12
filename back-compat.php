<?php
/**
 * Block Experiment back compat functionality
 *
 * Prevents Block Experiment from running without Gutenberg
 *
 * @package Block_Experiment
 */

/**
 * Switches to the default theme.
 *
 * @since Block Experiment 1.0.0
 */
function block_experiment_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'block_experiment_upgrade_notice' );
}
add_action( 'after_switch_theme', 'block_experiment_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to Block Experiment.
 *
 * @since Block Experiment 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function block_experiment_upgrade_notice() {
	/* translators: %s: WordPress version. */
	$message = __( 'Block Experiment requires Gutenberg to be active.', 'block_experiment' );
	printf( '<div class="notice notice-error is-dismissible"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded.
 *
 * @since Block Experiment 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function block_experiment_customize() {
	wp_die(
		__( 'Block Experiment requires Gutenberg to be active.', 'block_experiment' ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'block_experiment_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress.
 *
 * @since Block Experiment 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function block_experiment_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( __( 'Block Experiment requires Gutenberg to be active.', 'block_experiment' ) );
	}
}
add_action( 'template_redirect', 'block_experiment_preview' );
