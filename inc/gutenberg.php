<?php
/**
 * Functions which modify gutenberg
 *
 * @package _os
 */

 function os_gutenberg_default_colors(){
    add_theme_support(
      'editor-color-palette',
      array(
        array(
          'name' => 'Primary color',
          'slug' => 'primary_theme_color',
          'color' => get_field('primary_color','option')
        ),
        array(
          'name' => 'Secondary color',
          'slug' => 'secondary_theme_color',
          'color' => get_field('secondary_color','option')
        ),
        array(
          'name' => 'Dark color',
          'slug' => 'dark_color',
          'color' => get_field('dark_color','option')
        ),
        array(
          'name' => 'Light color',
          'slug' => 'light_color',
          'color' => get_field('light_color','option')
        )
      )
    );
  }
  add_action('after_setup_theme','os_gutenberg_default_colors');
