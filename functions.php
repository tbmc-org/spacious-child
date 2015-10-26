<?php 

/**
 * function to enque child and parent theme styles
 */
function theme_enqueue_styles() {
	$parent_style = 'parent-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
	get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style )
	);
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * function to show the footer info, copyright information
 */
if ( ! function_exists( 'spacious_footer_copyright' ) ) :
function spacious_footer_copyright() {
	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( esc_html( 'Texas Buddhist Meditation Center(TBMC)' ) ) . '" ><span>' . esc_html( 'Texas Buddhist Meditation Center(TBMC)' ) . '</span></a>';
	$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s.', 'spacious' ), date( 'Y' ), $site_link );
	$spacious_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';
	
	echo $spacious_footer_copyright;
}
endif;

add_action( 'spacious_footer_copyright', 'spacious_footer_copyright', 10 );