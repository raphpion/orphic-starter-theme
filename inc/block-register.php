<?php
/**
 * Functions which register custom blocks
 *
 * @package _os
 */

function orphic_block_categories( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug' => 'custom-orphic-blocks',
                'title' => __( 'Custom orphic content sections', '_os' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories', 'orphic_block_categories', 10, 2 );

function register_acf_block_types() {

    // acf_register_block_type(array(
    //     'name'              => 'hero',
    //     'title'             => __('Main home hero'),
    //     'description'       => __(''),
    //     'render_template'   => 'template-parts/blocks/hero/hero.php',
    //     'category'          => 'custom-orphic-blocks',
    //     'icon'              => 'welcome-view-site',
    //     'keywords'          => array( 'hero', 'block' ),
	// 			'mode' => 'edit',
	// 			'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/hero/hero.css',
    // ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}