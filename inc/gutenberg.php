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
          'color' => get_theme_mod('primary_theme_color')
        ),
        array(
          'name' => 'Secondary color',
          'slug' => 'secondary_theme_color',
          'color' => get_theme_mod('secondary_theme_color')
        ),
        array(
          'name' => 'Dark color',
          'slug' => 'dark_color',
          'color' => get_theme_mod('dark_color')
        ),
        array(
          'name' => 'Light color',
          'slug' => 'light_color',
          'color' => get_theme_mod('light_color')
        )
      )
    );
  }
  add_action('after_setup_theme','os_gutenberg_default_colors');
