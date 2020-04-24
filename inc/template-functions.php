<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

 add_action( 'publish_post', 'os_automatic_sitemap' );
 add_action( 'publish_page', 'os_automatic_sitemap' );
 add_action( 'save_post',    'os_automatic_sitemap' );

 function os_automatic_sitemap() {
     $postsForSitemap = get_posts(array(
         'numberposts' => -1,
         'orderby'     => 'modified',
         'post_type'   => array( 'post', 'page' ),
         'order'       => 'DESC'
     ));

     $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
     $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

     foreach( $postsForSitemap as $post ) {
         setup_postdata( $post );

         $postdate = explode( " ", $post->post_modified );

         $sitemap .= '<url>'.
                     '<loc>' . get_permalink( $post->ID ) . '</loc>' .
                     '<lastmod>' . $postdate[0] . '</lastmod>' .
                     '<changefreq>monthly</changefreq>' .
                     '</url>';
       }

     $sitemap .= '</urlset>';

     $fp = fopen( ABSPATH . 'sitemap.xml', 'w' );

     fwrite( $fp, $sitemap );
     fclose( $fp );
 }
