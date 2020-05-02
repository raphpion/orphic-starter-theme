<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$imageUrl = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
$imageAlt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', TRUE);
?>

<nav class="os-nav os-hidden-main os-hidden-medium">
  <a href="<?php echo get_home_url() ?>" >
    <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>" class="os-nav-logo" />
  </a>
  <?php
      $topMenuItems = get_nav_menu_items_by_location('menu-1');
      if (is_array($topMenuItems) || is_object($topMenuItems)):
      foreach($topMenuItems as $item):
          $link = $item->url;
          $title = $item->title;
      ?>
      <a href="<?php echo $link ?>" class="<?php echo get_active_class($item); ?>"><?php echo $title ?></a>
      <?php
      endforeach;
    endif;
      ?>
</nav>
