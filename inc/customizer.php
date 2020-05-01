<?php
/**
 * _os Theme Customizer
 *
 * @package _os
 */

 function os_customize_register( $wp_customize ) {
	//add primary theme color, to access : echo get_theme_mod('primary_theme_color');
	$wp_customize->add_setting( 'primary_theme_color' , array(
		'default'     => "#f9b248",
		'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_theme_color', array(
      'label'        => __( 'Primary theme color', 'os' ),
      'section'    => 'colors',
  ) ) );

	$wp_customize->add_setting( 'secondary_theme_color' , array(
				'default'     => "#21294c",
				'transport'   => 'refresh',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_theme_color', array(
			'label'        => __( 'Secondary theme color', 'os' ),
			'section'    => 'colors',
	) ) );

	$wp_customize->add_setting( 'dark_color' , array(
				'default'     => "#000000",
				'transport'   => 'refresh',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_color', array(
			'label'        => __( 'Dark color', 'os' ),
			'section'    => 'colors',
	) ) );

	$wp_customize->add_setting( 'light_color' , array(
				'default'     => "#ffffff",
				'transport'   => 'refresh',
		) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'light_color', array(
			'label'        => __( 'light color', 'os' ),
			'section'    => 'colors',
	) ) );
}
add_action( 'customize_register', 'os_customize_register' );
