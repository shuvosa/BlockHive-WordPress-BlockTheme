<?php
/**
 * Functions.php for My Block Theme
 */

 function blockhive_enqueue_tailwind_for_single_posts() {
    // Check if it's a single post page
    // Enqueue Tailwind CSS script from CDN
    wp_enqueue_script(
        'tailwind-cdn', // Handle name
        'https://cdn.tailwindcss.com', // CDN URL
        array(), // Dependencies (none required)
        null,    // Version (null to avoid appending version)
        false    // Load in <head> (false ensures it's in the head, not footer)
    );

    // Add Tailwind config using inline script
    wp_add_inline_script(
        'tailwind-cdn',
        "tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purple: {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9'
                        }
                    }
                }
            },
            corePlugins: {
                preflight: false
            }
        };"
    );
}
add_action('wp_enqueue_scripts', 'blockhive_enqueue_tailwind_for_single_posts');
 /**
 * simple data insertion
 */



 function blockhive_append_class_to_h2_in_post_content( $block_content, $block ) {
    if ( $block['blockName'] === 'core/post-content' ) {
        $block_content = preg_replace(
            '/<h2([^>]*)class="([^"]*)"/',
            '<h2$1class="$2 sk"',
            $block_content
        );

          // Append class to <p> tags with an existing class attribute
          $block_content = preg_replace(
            '/<p([^>]*)class="([^"]*)"/',
            '<p$1class="$2 my-p-class"',
            $block_content
        );

           // Add class to <p> tags without a class attribute
           $block_content = preg_replace(
            '/<p(?![^>]*class=)/',
            '<p class="my-p-class"',
            $block_content
        );

    }
    return $block_content;
}
add_filter( 'render_block', 'blockhive_append_class_to_h2_in_post_content', 10, 2 );


//naviation color

function blockhive_add_hover_class_to_navigation_links( $block_content, $block ) {
    if ( $block['blockName'] === 'core/navigation' ) {
        $block_content = str_replace(
            '<a ',
            '<a class="hover:text-purple-400" ',
            $block_content
        );
    }
    return $block_content;
}
add_filter( 'render_block', 'blockhive_add_hover_class_to_navigation_links', 10, 2 );

function blockhive_add_post_template_ul_li( $block_content, $block ) {
    if ( $block['blockName'] === 'core/post-template' ) {
        $block_content = str_replace(
            '<ul ',
            '<ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" ',
            $block_content
        );

        $block_content = str_replace(
            '<li ',
            '<li class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden" ',
            $block_content
        );
    }
    return $block_content;
}
add_filter( 'render_block', 'blockhive_add_post_template_ul_li', 10, 2 );

function blockhive_add_class_to_post_featured_image( $block_content, $block ) {
    if ( $block['blockName'] === 'core/post-featured-image' && !is_single() ) {
        $block_content = str_replace(
            '<img ',
            '<img class="w-full h-48 object-cover" ',
            $block_content
        );
    }
    return $block_content;
}
add_filter( 'render_block', 'blockhive_add_class_to_post_featured_image', 10, 2 );




 
 /**
 * end 
 */

 function blockhive_my_theme_enqueue_search_assets() {
    // Load CSS in both editor and frontend
    wp_enqueue_style(
      'my-theme-search-icon',
      get_template_directory_uri() . '/assets/css/search-icon.css',
      array(),
      filemtime(get_template_directory() . '/assets/css/search-icon.css')
    );
  
    // Load JS in both editor and frontend (in the footer)
    wp_enqueue_script(
      'my-theme-search-icon',
      get_template_directory_uri() . '/assets/js/search-icon.js',
      array(),
      filemtime(get_template_directory() . '/assets/js/search-icon.js'),
      true
    );
  }
  
add_action('enqueue_block_assets', 'blockhive_my_theme_enqueue_search_assets');

  
 
// Add theme support for block styles and wide alignment
function blockhive_my_block_theme_setup() {
    // Add theme support for block styles and wide alignment
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('block-templates'); // Ensure block templates are supported

    // Add editor style (Tailwind CSS)
    add_editor_style('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

    // Add custom body class
    add_filter('body_class', function($classes) {
        $classes[] = 'min-h-screen bg-black text-white';
        return $classes;
    });
}
add_action('after_setup_theme', 'blockhive_my_block_theme_setup');
// Enqueue an additional custom CSS file.
function blockhive_my_block_theme_enqueue_styles() {
    wp_enqueue_style('custom-styles', get_template_directory_uri() . '/css/custom-styles.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'blockhive_my_block_theme_enqueue_styles');

// Enqueue scripts and styles
function blockhive_enqueue_custom_scripts() {
    // Enqueue Tailwind CSS
    wp_enqueue_style('tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');

    // Enqueue custom JavaScript
    wp_enqueue_script('custom-ajax-handler', get_template_directory_uri() . '/js/custom-ajax.js', array(), null, true);

    // Localize the AJAX URL
    wp_localize_script('custom-ajax-handler', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'blockhive_enqueue_custom_scripts');

// Create pages on theme activation
function blockhive_create_pages_on_theme_activation() {
    $pages_to_create = [

        [
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'index',
        ],
        [
            'title' => 'About',
            'slug' => 'about',
            'template' => 'About',
        ],
        [
            'title' => 'Contact',
            'slug' => 'contact',
            'template' => 'contact',
        ],
        [
            'title' => 'Blog',
            'slug' => 'Blog',
            'template' => 'Blog',
        ],

    ];

    foreach ($pages_to_create as $page) {
        if (!get_page_by_path($page['slug'])) {
            $page_id = wp_insert_post([
                'post_title' => $page['title'],
                'post_name' => $page['slug'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_content' => 'This is the ' . $page['title'] . ' page.',
            ]);

            if (!is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page['template']);
            }
        }
    }
}
add_action('after_switch_theme', 'blockhive_create_pages_on_theme_activation');



// form field admin page
 // Admin functionality to display and insert the data.
 add_action('admin_menu', 'blockhive_sdp_add_menu');
 function blockhive_sdp_add_menu() {
    add_menu_page(
        'blockhive',            // Page title
        'blockhive',            // Menu title
        'manage_options',        // Capability
        'simple-data',           // Menu slug
        'blockhive_sdp_admin_page',        // Callback function
        'dashicons-admin-users', // Icon
        20                       // Position
    );
 }

 function blockhive_sdp_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'simple_data';

    // Handle form submission.
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sdp_submit'])) {
        $name    = sanitize_text_field($_POST['name']);
        $email   = sanitize_text_field($_POST['email']);
        $message = sanitize_text_field($_POST['message']);

        if ($name && $email && $message) {
           $wpdb->insert($table_name, ['name' => $name, 'email' => $email, 'message' => $message]);
           echo "<div class='updated'><p>Data inserted successfully!</p></div>";
        } else {
           echo "<div class='error'><p>Please provide valid inputs.</p></div>";
        }
    }

    // Pagination, filtering, and data display.
    $per_page = 15;
    $current_page = isset($_GET['paged']) ? abs((int)$_GET['paged']) : 1;
    $offset = ($current_page * $per_page) - $per_page;

    $selected_month = isset($_GET['month']) ? sanitize_text_field($_GET['month']) : '';
    $month_where = '';
    if (!empty($selected_month)) {
        $month_where = $wpdb->prepare("AND MONTH(CURDATE()) = %s", $selected_month);
    }

    $total_query = "SELECT COUNT(*) FROM $table_name WHERE 1=1 $month_where";
    $total = $wpdb->get_var($total_query);
    $pages = ceil($total / $per_page);

    $query = "SELECT * FROM $table_name WHERE 1=1 $month_where ORDER BY id DESC LIMIT %d OFFSET %d";
    $results = $wpdb->get_results($wpdb->prepare($query, $per_page, $offset));
    ?>
    <div class="wrap">
        <h2>Data List</h2>
        <form method="get">
           <label for="month">Filter by Month:</label>
           <select name="month" id="month">
              <option value="">All Months</option>
              <?php
                 for ($i = 1; $i <= 12; $i++) {
                    $month_name = date('F', mktime(0, 0, 0, $i, 10));
                    $selected = ($selected_month == $i) ? 'selected' : '';
                    echo '<option value="' . $i . '" ' . $selected . '>' . $month_name . '</option>';
                 }
              ?>
           </select>
           <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
           <input type="submit" class="button" value="Filter">
        </form>

        <table class="wp-list-table widefat fixed striped">
           <thead>
              <tr>
                 <th>ID</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Message</th>
              </tr>
           </thead>
           <tbody>
           <?php if ($results): ?>
              <?php foreach ($results as $row): ?>
                 <tr>
                    <td><?php echo esc_html($row->id); ?></td>
                    <td><?php echo esc_html($row->name); ?></td>
                    <td><?php echo esc_html($row->email); ?></td>
                    <td><?php echo esc_html($row->message); ?></td>
                 </tr>
              <?php endforeach; ?>
           <?php else: ?>
              <tr>
                 <td colspan="4">No data found.</td>
              </tr>
           <?php endif; ?>
           </tbody>
        </table>

        <div class="tablenav">
           <div class="tablenav-pages">
              <?php
              if ($pages > 1) {
                 echo '<span class="displaying-num">' . sprintf(__('Displaying %d-%d of %d', 'blockhive'), $offset + 1, min($offset + $per_page, $total), $total) . '</span>';
                 echo '<span class="pagination-links">';

                 $current_url = admin_url('admin.php?page=simple-data');
                 $base_url = add_query_arg('paged', '%#%', $current_url);

                 if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                    echo '<a class="prev-page button" href="' . add_query_arg('paged', $prev_page, $current_url) . '">&laquo;</a>';
                 }

                 $page_links = paginate_links(array(
                    'base'      => $base_url,
                    'format'    => '',
                    'prev_text' => __('&laquo;','blockhive'),
                    'next_text' => __('&raquo;','blockhive'),
                    'total'     => $pages,
                    'current'   => $current_page,
                    'mid_size'  => 2,
                 ));
                 echo $page_links;

                 if ($current_page < $pages) {
                    $next_page = $current_page + 1;
                    echo '<a class="next-page button" href="' . add_query_arg('paged', $next_page, $current_url) . '">&raquo;</a>';
                 }
                 echo '</span>';
              }
              ?>
           </div>
           <br class="clear">
        </div>
    </div>
    <?php
 }

 // Delete the table on theme deactivation.
 register_deactivation_hook(__FILE__, 'blockhive_sdp_delete_table');
 function blockhive_sdp_delete_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'simple_data';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
 }

 // Create the table on theme activation.
 function blockhive_sdp_create_table_on_theme_activation() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'simple_data';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           name varchar(255) NOT NULL,
           email varchar(255) NOT NULL,
           message text NOT NULL,
           PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
 }
 add_action('after_switch_theme', 'blockhive_sdp_create_table_on_theme_activation');



//for night mode 

function blockhive_my_theme_enqueue_scripts() {
    // Enqueue the script
    wp_enqueue_script(
        'night-day-toggle',
        get_template_directory_uri() . '/assets/js/night-day-toggle.js',
        array(),
        filemtime(get_template_directory() . '/assets/js/night-day-toggle.js'),
        true
    );

    // Localize script variables
    wp_localize_script('night-day-toggle', 'myThemeVars', array(
        'sunIcon' => esc_url(get_template_directory_uri() . '/assets/sun.png'),
        'nightIcon' => esc_url(get_template_directory_uri() . '/assets/night.png')
    ));
}
add_action('wp_enqueue_scripts', 'blockhive_my_theme_enqueue_scripts');


//create a post when theme is install

function blockhive_create_sample_post_with_image() {
    // Only allow administrators to run this function.
    if ( ! current_user_can( 'administrator' ) ) { // Typo here: 'administrator' is misspelled
        return;
    }

    // Define the post details.
    $new_post = array(
        'post_title'   => 'My new post',
        'post_content' => 'Content to insert.',
        'post_status'  => 'publish',
        'post_author'  => get_current_user_id(),
    );

    // Insert the post into the database.
    $post_id = wp_insert_post( $new_post );

    if ( $post_id ) {
        // Get the full URL of the local image in the theme's assets folder.
        $image_url = get_theme_file_uri( 'assets/my-image.jpg' );

        // Include required WordPress files for media handling.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // Download image and attach to post.
        $attachment_id = media_sideload_image( $image_url, $post_id, null, 'id' );

        if (! is_wp_error( $attachment_id )) {
            set_post_thumbnail( $post_id, $attachment_id );
            // Use transients to display a notice on the next page load.
            set_transient( 'sample_post_notice', 'success', 45 );
        } else {
            set_transient( 'sample_post_notice', 'image_error', 45 );
        }
    } else {
        set_transient( 'sample_post_notice', 'post_error', 45 );
    }
}
add_action( 'after_switch_theme', 'blockhive_create_sample_post_with_image' );

// Display admin notices if needed.
add_action( 'admin_notices', 'blockhive_sample_post_admin_notice' );

function blockhive_sample_post_admin_notice() {
    $notice = get_transient( 'sample_post_notice' );
    if ( $notice === 'success' ) {
        echo '<div class="notice notice-success"><p>Post created with featured image!</p></div>';
        delete_transient( 'sample_post_notice' );
    } elseif ( $notice === 'image_error' ) {
        echo '<div class="notice notice-warning"><p>Post created, but image failed.</p></div>';
        delete_transient( 'sample_post_notice' );
    } elseif ( $notice === 'post_error' ) {
        echo '<div class="notice notice-error"><p>Post creation failed.</p></div>';
        delete_transient( 'sample_post_notice' );
    }
}


// Register a custom block style for the core Quote block.

if ( function_exists( 'register_block_style' ) ) {
    // Register a new style for the core Quote block.
    register_block_style(
        'core/quote', // Target block.
        array(
            'name'         => 'highlighted-quote', // Unique style name.
            'label'        => __( 'Highlighted Quote', 'blockhive' ), // Label shown in the editor.
            'inline_style' => '.wp-block-quote.is-style-highlighted-quote { background-color: #fffae6; border-left: 5px solid #f2c94c; padding: 1em 1.5em; }',
        )
    );
}



// Register a custom block pattern  for the custom header.

if ( function_exists( 'register_block_pattern' ) ) {
    // Register a new block pattern for a custom header.
    register_block_pattern(
        'custom/my-custom-header', // A unique identifier for the pattern.
        array(
            'title'       => __( 'Custom Header', 'blockhive' ), // Name for the pattern.
            'description' => __( 'A full-width header with a cover image and centered text overlay.', 'blockhive' ),
            'content'     => "<!-- wp:cover {\"url\":\"https://example.com/path-to-image.jpg\",\"dimRatio\":50,\"overlayColor\":\"black\",\"minHeight\":350,\"align\":\"full\"} -->
<div class=\"wp-block-cover alignfull\" style=\"min-height:350px\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-black-background-color has-background-dim\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:heading {\"align\":\"center\",\"textColor\":\"white\",\"level\":1} -->
<h1 class=\"has-text-align-center has-white-color has-text-color\">Welcome to Our Site</h1>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->",
        )
    );
}
