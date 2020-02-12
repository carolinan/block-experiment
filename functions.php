<?php
/**
 * Block Experiment functions and definitions
 *
 * @package Block_Experiment
 */

/** Check if Gutenberg is active. If not, do not activate. */
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) || ! function_exists( 'gutenberg_pre_init' ) || class_exists( 'Classic_Editor' ) ) {
	require get_template_directory() . '/back-compat.php';
	return;
}

if ( ! function_exists( 'block_experiment_theme_support' ) ) {
	/**
	 * Include basic theme support
	 */
	function block_experiment_theme_support() {

		add_theme_support( 'title-tag' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Blue Accent', 'block_experiment' ),
					'slug'  => 'accent',
					'color' => '#0073AA',
				),
				array(
					'name'  => __( 'Primary Black', 'block_experiment' ),
					'slug'  => 'primary',
					'color' => '#000',
				),
				array(
					'name'  => __( 'Secondary Dark grey', 'block_experiment' ),
					'slug'  => 'secondary',
					'color' => '#32373c',
				),
			)
		);

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
					'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => _x( 'Normal', 'Name of the regular font size in the block editor', 'twentytwenty' ),
					'shortName' => _x( 'N', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
					'size'      => 21,
					'slug'      => 'normal',
				),
				array(
					'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
					'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
					'size'      => 26.25,
					'slug'      => 'large',
				),
				array(
					'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
					'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
					'size'      => 32,
					'slug'      => 'larger',
				),
			)
		);

	}

	add_action( 'after_setup_theme', 'block_experiment_theme_support' );
}

if ( ! function_exists( 'block_experiment_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function block_experiment_scripts() {
		wp_enqueue_style( 'block-experiment-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

		wp_enqueue_style( 'open-sans' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_style( 'block_experiment-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );
	}
	add_action( 'wp_enqueue_scripts', 'block_experiment_scripts' );
}

/**
 * Include a skip to content link at the top of the page.
 */
function block_experiment_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', ' block_experiment' ) . '</a>';
}

add_action( 'wp_body_open', 'block_experiment_skip_link', 5 );

require get_template_directory() . '/custom-block-styles.php';

/**
 * Add body classes.
 * We do this to help us reduce the css.
 */
function block_experiment_add_body_class( $classes ) {

	if ( is_search() || is_404() ) {
		$classes[] = 'blog';
	}

	return $classes;
}
add_filter( 'body_class', 'block_experiment_add_body_class' );
