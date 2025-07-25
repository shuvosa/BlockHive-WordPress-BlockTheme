<?php
/**
 * Title: Night-Day mode
 * Slug: my-theme/night-mode
 * Categories: text, button
 * Viewport width: 1600
 */
?>

<!-- wp:group {"align": "full", "className": "flex justify-end mb-6"} -->
<div class="wp-block-group alignfull flex justify-end mb-6">
    <!-- wp:group {"id":"toggleBtn","className":"px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"} -->
    <div id="toggleBtn" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
        <!-- wp:image {"id":"toggleIcon","className":"image_night","width":"24","height":"24"} -->
        <figure class="wp-block-image is-resized">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/sun.png'); ?>" alt="Toggle theme" width="24" height="24" />"
        </figure>
        <!-- /wp:image -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

