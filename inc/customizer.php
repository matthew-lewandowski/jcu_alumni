<?php
/**
 * JCU_Alumni Theme Customizer
 *
 * @package JCU_Alumni
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jcu_alumni_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/*
	 * Custom Customizer Customizations
	 */

	// Setting for header and footer background color
    $wp_customize->add_setting('theme_bg_color', array(
        'default' => '#fff',
        'transport' => 'postMessage',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    //Control for header and footer background color.
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
          $wp_customize,
          'theme_bg_color', array(
              'label' => __('Header and footer background color', 'jcu_alumni'),
              'section' => 'colors',
              'settings' => 'theme_bg_color'
          )
      )
    );



	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'jcu_alumni_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'jcu_alumni_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'jcu_alumni_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function jcu_alumni_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function jcu_alumni_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jcu_alumni_customize_preview_js() {
	wp_enqueue_script( 'jcu_alumni-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'jcu_alumni_customize_preview_js' );
