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

/**
 * Shortcode to output social media icons
 */
function social_media_icons( $atts ) {
		if ( !empty( $atts['facebook'] ) || !empty( $atts['google-plus'] ) ) {
		
			$sites = array(
				'facebook' => array(
					'nice_name' => 'Facebook',
					'style' => 'fa-facebook'
				),
				'google-plus' => array(
					'nice_name' => 'Google+',
					'style' => 'fa-google-plus'
				)
			);

			$html = "<ul class='share-buttons'>";

			foreach( $atts as $key => $val ) {
				$html .= "<li><a href='" . $val . "' target='_blank' title='Follow us on " . $sites[ strtolower( $key ) ]['nice_name'] . "'><span class='fa-stack'><i class='fa fa-circle fa-stack-2x'></i><i class='fa " . $sites[ strtolower( $key ) ]['style'] . " fa-stack-1x fa-inverse'></i></span></a></li>";
			}

			$html .= "</ul>";

			return $html;
		}

		return '';
}

add_shortcode( 'social-icons', 'social_media_icons' );