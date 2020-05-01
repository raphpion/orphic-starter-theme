<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$imageUrl = wp_get_attachment_image_src( $custom_logo_id , 'full' )[0];
$imageAlt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', TRUE);
?>

<nav class="os-nav os-hidden-small os-hidden-tiny">
  <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>" class="os-nav-logo" />
nav desktop
</nav>
