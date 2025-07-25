<?php
/**
 * Title: Search icon
 * Slug: my-theme/search-icon
 * Categories: text, button
 * Viewport width: 1600
 */
?>

<!-- wp:group {"className":"main-content"} -->
<div class="main-content">
  <!-- wp:group {"id":"trigger"} -->
  <div id="trigger">
    <!-- wp:image {"width":24,"height":24,"src":"<?php echo esc_url(get_template_directory_uri() . '/assets/search.png'); ?>","alt":"Search icon"} -->
    <figure class="wp-block-image is-resized">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/search.png'); ?>" alt="Search icon" width="24" height="24"/>
    </figure>
    <!-- /wp:image -->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"popup-overlay","id":"popupOverlay"} -->
<div class="popup-overlay" id="popupOverlay">
  <!-- wp:group {"className":"popup"} -->
  <div class="popup">
    <!-- wp:paragraph {"className":"close-btn","id":"closeBtn"} -->
    <p class="close-btn" id="closeBtn">X</p>
    <!-- /wp:paragraph -->
    <!-- wp:search {"label":"Search","buttonText":"Search"} /-->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->