<?php
/**
 * Plugin Name: 48HoursReady Opportunities Hub
 * Description: Funding & Institutions Hub with custom post type, taxonomies, landing page, and RSS feed.
 * Version: 1.8.0
 * Author: 48HoursReady
 * Text Domain: opportunities-hub
 */

if (!defined('ABSPATH')) exit;

define('OPP_HUB_VERSION', '1.8.0');
define('OPP_HUB_PATH', plugin_dir_path(__FILE__));
define('OPP_HUB_URL', plugin_dir_url(__FILE__));

// ============================================================
// 1. REGISTER CUSTOM POST TYPE + TAXONOMIES
// ============================================================
add_action('init', 'opphub_register_post_type');
function opphub_register_post_type() {
    register_post_type('opportunity', [
        'labels' => [
            'name'               => 'Opportunities',
            'singular_name'      => 'Opportunity',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Opportunity',
            'edit_item'          => 'Edit Opportunity',
            'new_item'           => 'New Opportunity',
            'view_item'          => 'View Opportunity',
            'search_items'       => 'Search Opportunities',
            'not_found'          => 'No opportunities found',
            'not_found_in_trash' => 'No opportunities found in trash',
            'all_items'          => 'All Opportunities',
            'menu_name'          => 'Opportunities Hub',
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'opportunities'],
        'menu_icon'     => 'dashicons-money-alt',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
        'menu_position' => 5,
    ]);

    // Institution taxonomy
    register_taxonomy('institution', 'opportunity', [
        'labels' => [
            'name'          => 'Institutions',
            'singular_name' => 'Institution',
            'search_items'  => 'Search Institutions',
            'all_items'     => 'All Institutions',
            'edit_item'     => 'Edit Institution',
            'add_new_item'  => 'Add New Institution',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'institution'],
        'show_in_rest' => true,
    ]);

    // Funding Type taxonomy
    register_taxonomy('funding_type', 'opportunity', [
        'labels' => [
            'name'          => 'Funding Types',
            'singular_name' => 'Funding Type',
            'search_items'  => 'Search Funding Types',
            'all_items'     => 'All Funding Types',
            'edit_item'     => 'Edit Funding Type',
            'add_new_item'  => 'Add New Funding Type',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'funding-type'],
        'show_in_rest' => true,
    ]);

    // Region taxonomy
    register_taxonomy('region', 'opportunity', [
        'labels' => [
            'name'          => 'Regions',
            'singular_name' => 'Region',
            'search_items'  => 'Search Regions',
            'all_items'     => 'All Regions',
            'edit_item'     => 'Edit Region',
            'add_new_item'  => 'Add New Region',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'region'],
        'show_in_rest' => true,
    ]);

    // Sector taxonomy
    register_taxonomy('sector', 'opportunity', [
        'labels' => [
            'name'          => 'Sectors',
            'singular_name' => 'Sector',
            'search_items'  => 'Search Sectors',
            'all_items'     => 'All Sectors',
            'edit_item'     => 'Edit Sector',
            'add_new_item'  => 'Add New Sector',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'sector'],
        'show_in_rest' => true,
    ]);
}

// ============================================================
// 2. CUSTOM META FIELDS
// ============================================================
add_action('add_meta_boxes', 'opphub_add_meta_boxes');
function opphub_add_meta_boxes() {
    add_meta_box(
        'opphub_details',
        'Opportunity Details',
        'opphub_details_callback',
        'opportunity',
        'normal',
        'high'
    );
}

function opphub_details_callback($post) {
    wp_nonce_field('opphub_save_meta', 'opphub_meta_nonce');
    $funding_min  = get_post_meta($post->ID, '_opphub_funding_min', true);
    $funding_max  = get_post_meta($post->ID, '_opphub_funding_max', true);
    $deadline     = get_post_meta($post->ID, '_opphub_deadline', true);
    $status       = get_post_meta($post->ID, '_opphub_status', true) ?: 'open';
    $apply_url    = get_post_meta($post->ID, '_opphub_apply_url', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="opphub_funding_min">Funding Min ($)</label></th>
            <td><input type="number" id="opphub_funding_min" name="opphub_funding_min" value="<?php echo esc_attr($funding_min); ?>" class="regular-text" placeholder="e.g. 10000"></td>
        </tr>
        <tr>
            <th><label for="opphub_funding_max">Funding Max ($)</label></th>
            <td><input type="number" id="opphub_funding_max" name="opphub_funding_max" value="<?php echo esc_attr($funding_max); ?>" class="regular-text" placeholder="e.g. 500000"></td>
        </tr>
        <tr>
            <th><label for="opphub_deadline">Deadline</label></th>
            <td><input type="date" id="opphub_deadline" name="opphub_deadline" value="<?php echo esc_attr($deadline); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="opphub_status">Status</label></th>
            <td>
                <select id="opphub_status" name="opphub_status">
                    <option value="open" <?php selected($status, 'open'); ?>>Open</option>
                    <option value="closing_soon" <?php selected($status, 'closing_soon'); ?>>Closing Soon</option>
                    <option value="closed" <?php selected($status, 'closed'); ?>>Closed</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="opphub_apply_url">Application URL</label></th>
            <td><input type="url" id="opphub_apply_url" name="opphub_apply_url" value="<?php echo esc_url($apply_url); ?>" class="regular-text" placeholder="https://..."></td>
        </tr>
    </table>
    <?php
}

add_action('save_post_opportunity', 'opphub_save_meta');
function opphub_save_meta($post_id) {
    if (!isset($_POST['opphub_meta_nonce']) || !wp_verify_nonce($_POST['opphub_meta_nonce'], 'opphub_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['funding_min', 'funding_max', 'deadline', 'status', 'apply_url'];
    foreach ($fields as $field) {
        if (isset($_POST['opphub_' . $field])) {
            update_post_meta($post_id, '_opphub_' . $field, sanitize_text_field($_POST['opphub_' . $field]));
        }
    }
}

// ============================================================
// 3. SEED DEFAULT TAXONOMY TERMS ON ACTIVATION
// ============================================================
register_activation_hook(__FILE__, 'opphub_activate');
function opphub_activate() {
    opphub_register_post_type();

    // Institutions
    $institutions = ['IDB', 'World Bank', 'UN', 'USAID', 'BRH', 'Unibank', 'Chambers of Commerce', 'Microfinance Networks'];
    foreach ($institutions as $inst) {
        if (!term_exists($inst, 'institution')) {
            wp_insert_term($inst, 'institution');
        }
    }

    // Funding Types
    $types = ['Grant', 'Loan', 'Sponsorship', 'Equity'];
    foreach ($types as $type) {
        if (!term_exists($type, 'funding_type')) {
            wp_insert_term($type, 'funding_type');
        }
    }

    // Regions
    $regions = ['Caribbean', 'Africa', 'Latin America', 'Global', 'Asia Pacific', 'North America', 'Europe'];
    foreach ($regions as $region) {
        if (!term_exists($region, 'region')) {
            wp_insert_term($region, 'region');
        }
    }

    // Sectors
    $sectors = ['SME', 'Agriculture', 'Tech', 'NGO', 'Youth', 'Health', 'Education', 'Energy'];
    foreach ($sectors as $sector) {
        if (!term_exists($sector, 'sector')) {
            wp_insert_term($sector, 'sector');
        }
    }

    // Create the Funding Hub page if it doesn't exist
    $page = get_page_by_path('funding-hub');
    if (!$page) {
        wp_insert_post([
            'post_title'   => 'Funding Opportunities Hub',
            'post_name'    => 'funding-hub',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '<!-- This page uses the Opportunities Hub template. Content is generated by the plugin. -->',
            'page_template'=> '',
            'meta_input'   => ['_wp_page_template' => 'opphub-landing.php'],
        ]);
    }

    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'opphub_deactivate');
function opphub_deactivate() {
    flush_rewrite_rules();
}

// ============================================================
// 4. PAGE TEMPLATE
// ============================================================
add_filter('template_include', 'opphub_page_template');
function opphub_page_template($template) {
    if (is_page('funding-hub') || (is_page() && get_page_template_slug() === 'opphub-landing.php')) {
        $plugin_template = OPP_HUB_PATH . 'templates/landing-page.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
}

// Show our template in the page template dropdown
add_filter('theme_page_templates', 'opphub_add_page_template');
function opphub_add_page_template($templates) {
    $templates['opphub-landing.php'] = 'Opportunities Hub Landing';
    return $templates;
}

// ============================================================
// 5. RSS FEED
// ============================================================
add_action('init', 'opphub_add_feed');
function opphub_add_feed() {
    add_feed('opportunities-feed', 'opphub_render_feed');
}

function opphub_render_feed() {
    $opportunities = new WP_Query([
        'post_type'      => 'opportunity',
        'posts_per_page' => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
    echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . '>';
    echo '<?xml-stylesheet type="text/xsl" href="' . esc_url(OPP_HUB_URL . 'assets/rss-style.xsl') . '"?' . '>';
    ?>
<rss version="2.0"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
    <title><?php echo esc_xml(get_bloginfo('name')); ?> - Funding Opportunities</title>
    <link><?php echo esc_url(home_url('/funding-hub')); ?></link>
    <description>Latest funding opportunities from IDB, World Bank, UN, banks, and microfinance institutions - updated weekly.</description>
    <language><?php echo esc_xml(get_bloginfo('language')); ?></language>
    <lastBuildDate><?php echo esc_xml(date(DATE_RSS)); ?></lastBuildDate>
    <atom:link href="<?php echo esc_url(home_url('/feed/opportunities-feed')); ?>" rel="self" type="application/rss+xml" />
    <?php while ($opportunities->have_posts()) : $opportunities->the_post();
        $funding_min = get_post_meta(get_the_ID(), '_opphub_funding_min', true);
        $funding_max = get_post_meta(get_the_ID(), '_opphub_funding_max', true);
        $deadline    = get_post_meta(get_the_ID(), '_opphub_deadline', true);
        $institutions = get_the_terms(get_the_ID(), 'institution');
        $regions      = get_the_terms(get_the_ID(), 'region');
    ?>
    <item>
        <title><?php the_title_rss(); ?></title>
        <link><?php the_permalink_rss(); ?></link>
        <guid isPermaLink="true"><?php the_permalink_rss(); ?></guid>
        <pubDate><?php echo esc_xml(get_the_date(DATE_RSS)); ?></pubDate>
        <description><![CDATA[<?php the_excerpt_rss(); ?>
<?php if ($funding_min || $funding_max) : ?>
Funding: $<?php echo number_format((int)$funding_min); ?> - $<?php echo number_format((int)$funding_max); ?>
<?php endif; ?>
<?php if ($deadline) : ?>
Deadline: <?php echo esc_html(date('F j, Y', strtotime($deadline))); ?>
<?php endif; ?>
<?php if ($institutions && !is_wp_error($institutions)) : ?>
Institution: <?php echo esc_html(implode(', ', wp_list_pluck($institutions, 'name'))); ?>
<?php endif; ?>
<?php if ($regions && !is_wp_error($regions)) : ?>
Region: <?php echo esc_html(implode(', ', wp_list_pluck($regions, 'name'))); ?>
<?php endif; ?>]]></description>
        <?php if ($institutions && !is_wp_error($institutions)) : foreach ($institutions as $inst) : ?>
        <category><?php echo esc_xml($inst->name); ?></category>
        <?php endforeach; endif; ?>
    </item>
    <?php endwhile; wp_reset_postdata(); ?>
</channel>
</rss>
    <?php
}

// ============================================================
// 6. ENQUEUE FRONT-END ASSETS
// ============================================================
// Prevent Cloudflare/browser caching of the funding hub page
add_action('template_redirect', 'opphub_no_cache_headers');
function opphub_no_cache_headers() {
    if (is_page('funding-hub') || (is_page() && get_page_template_slug() === 'opphub-landing.php')) {
        nocache_headers();
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
    }
}

add_action('wp_enqueue_scripts', 'opphub_enqueue_assets');
function opphub_enqueue_assets() {
    if (is_page('funding-hub') || (is_page() && get_page_template_slug() === 'opphub-landing.php')) {
        wp_enqueue_style('opphub-style', OPP_HUB_URL . 'assets/css/opphub.css', [], OPP_HUB_VERSION);
        wp_enqueue_script('opphub-script', OPP_HUB_URL . 'assets/js/opphub.js', ['jquery'], OPP_HUB_VERSION, true);
        wp_localize_script('opphub-script', 'opphub_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('opphub_filter'),
        ]);
    }
}

// ============================================================
// 7. AJAX FILTER HANDLER
// ============================================================
add_action('wp_ajax_opphub_filter', 'opphub_ajax_filter');
add_action('wp_ajax_nopriv_opphub_filter', 'opphub_ajax_filter');
function opphub_ajax_filter() {
    check_ajax_referer('opphub_filter', 'nonce');

    $tax_query = [];

    $taxonomies = ['institution', 'funding_type', 'region', 'sector'];
    foreach ($taxonomies as $tax) {
        if (!empty($_POST[$tax])) {
            $tax_query[] = [
                'taxonomy' => $tax,
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_POST[$tax]),
            ];
        }
    }

    $meta_query = [];

    // Deadline filter — include posts without deadline set (auto-imported)
    if (!empty($_POST['deadline_status'])) {
        $today = date('Y-m-d');
        if ($_POST['deadline_status'] === 'open') {
            $meta_query[] = [
                'relation' => 'OR',
                [
                    'key'     => '_opphub_deadline',
                    'value'   => $today,
                    'compare' => '>=',
                    'type'    => 'DATE',
                ],
                [
                    'key'     => '_opphub_deadline',
                    'compare' => 'NOT EXISTS',
                ],
                [
                    'key'     => '_opphub_deadline',
                    'value'   => '',
                    'compare' => '=',
                ],
            ];
        } elseif ($_POST['deadline_status'] === 'closing_soon') {
            $meta_query[] = [
                'key'     => '_opphub_deadline',
                'value'   => [$today, date('Y-m-d', strtotime('+30 days'))],
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ];
        }
    }

    // Funding size filter — include posts without funding set (auto-imported)
    if (!empty($_POST['funding_size'])) {
        $size = sanitize_text_field($_POST['funding_size']);
        $ranges = [
            'under_50k'   => [0, 50000],
            '50k_100k'    => [50000, 100000],
            '100k_500k'   => [100000, 500000],
            'over_500k'   => [500000, 99999999],
        ];
        if (isset($ranges[$size])) {
            $meta_query[] = [
                'relation' => 'OR',
                [
                    'key'     => '_opphub_funding_max',
                    'value'   => $ranges[$size],
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC',
                ],
                [
                    'key'     => '_opphub_funding_max',
                    'compare' => 'NOT EXISTS',
                ],
                [
                    'key'     => '_opphub_funding_max',
                    'value'   => '',
                    'compare' => '=',
                ],
            ];
        }
    }

    $args = [
        'post_type'      => 'opportunity',
        'posts_per_page' => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if (!empty($tax_query)) {
        $args['tax_query'] = array_merge(['relation' => 'AND'], $tax_query);
    }
    if (!empty($meta_query)) {
        $args['meta_query'] = array_merge(['relation' => 'AND'], $meta_query);
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            include OPP_HUB_PATH . 'templates/partials/opportunity-card.php';
        endwhile;
    else :
        echo '<div class="opphub-no-results"><p>No opportunities match your filters. Try adjusting your criteria.</p></div>';
    endif;
    wp_reset_postdata();

    wp_send_json_success(['html' => ob_get_clean(), 'count' => $query->found_posts]);
}

// ============================================================
// 8. ADMIN COLUMNS
// ============================================================
add_filter('manage_opportunity_posts_columns', 'opphub_admin_columns');
function opphub_admin_columns($columns) {
    $new = [];
    foreach ($columns as $key => $val) {
        $new[$key] = $val;
        if ($key === 'title') {
            $new['institution']  = 'Institution';
            $new['funding_type'] = 'Funding Type';
            $new['region']       = 'Region';
            $new['funding']      = 'Funding Range';
            $new['deadline']     = 'Deadline';
            $new['opp_status']   = 'Status';
        }
    }
    return $new;
}

add_action('manage_opportunity_posts_custom_column', 'opphub_admin_column_content', 10, 2);
function opphub_admin_column_content($column, $post_id) {
    switch ($column) {
        case 'institution':
            $terms = get_the_terms($post_id, 'institution');
            echo $terms && !is_wp_error($terms) ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : '—';
            break;
        case 'funding_type':
            $terms = get_the_terms($post_id, 'funding_type');
            echo $terms && !is_wp_error($terms) ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : '—';
            break;
        case 'region':
            $terms = get_the_terms($post_id, 'region');
            echo $terms && !is_wp_error($terms) ? esc_html(implode(', ', wp_list_pluck($terms, 'name'))) : '—';
            break;
        case 'funding':
            $min = get_post_meta($post_id, '_opphub_funding_min', true);
            $max = get_post_meta($post_id, '_opphub_funding_max', true);
            echo ($min || $max) ? '$' . number_format((int)$min) . ' – $' . number_format((int)$max) : '—';
            break;
        case 'deadline':
            $d = get_post_meta($post_id, '_opphub_deadline', true);
            echo $d ? esc_html(date('M j, Y', strtotime($d))) : '—';
            break;
        case 'opp_status':
            $s = get_post_meta($post_id, '_opphub_status', true) ?: 'open';
            $labels = ['open' => 'Open', 'closing_soon' => 'Closing Soon', 'closed' => 'Closed'];
            echo esc_html($labels[$s] ?? $s);
            break;
    }
}

// ============================================================
// 9. AUTO-FLUSH PERMALINKS ON UPDATE
// ============================================================
add_action('init', 'opphub_maybe_flush_rewrite', 99);
function opphub_maybe_flush_rewrite() {
    if (get_option('opphub_flush_version') !== OPP_HUB_VERSION) {
        flush_rewrite_rules();
        update_option('opphub_flush_version', OPP_HUB_VERSION);
    }
}

// ============================================================
// 10. CTA BUTTON INJECTED AFTER "START FREE LEARNING"
// ============================================================
add_action('wp_footer', 'opphub_cta_html', 999);
function opphub_cta_html() {
    if (is_admin()) return;
    $hub_url = esc_url(home_url('/funding-hub'));
    ?>
    <style id="opphub-cta-css">
        #opphub-inline-cta {
            text-align: center;
            padding: 30px 20px 40px;
            width: 100%;
            background: linear-gradient(135deg, #0d1b4a 0%, #1a237e 100%);
        }
        #opphub-inline-cta a {
            display: inline-block;
            background: linear-gradient(135deg, #D32F2F, #B71C1C);
            color: #fff !important;
            padding: 18px 40px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none !important;
            box-shadow: 0 4px 20px rgba(211,47,47,0.4);
            transition: all 0.3s ease;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.4;
            max-width: 500px;
            width: 85%;
            text-align: center;
            letter-spacing: 0.5px;
        }
        #opphub-inline-cta a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 28px rgba(211,47,47,0.5);
            background: linear-gradient(135deg, #E53935, #C62828);
            color: #fff !important;
        }
        @media (max-width: 768px) {
            #opphub-inline-cta { padding: 25px 15px 30px; }
            #opphub-inline-cta a { width: 90%; font-size: 16px; padding: 16px 24px; }
        }
    </style>
    <script>
    (function(){
        if(document.getElementById('opphub-inline-cta')) return;
        if(window.location.pathname.indexOf('funding-hub') !== -1) return;

        var cta = document.createElement('div');
        cta.id = 'opphub-inline-cta';
        cta.innerHTML = '<a href="<?php echo $hub_url; ?>">&#128176; Explore Funding Opportunities</a>';

        // Primary: Insert before the "Choose the application type" parent section
        var chooseSection = document.querySelector('[data-id="de4e74e"]');
        if (chooseSection && chooseSection.parentNode) {
            chooseSection.parentNode.insertBefore(cta, chooseSection);
            return;
        }

        // Fallback 1: Find the link to /affiliate-learn/ (Start Free Learning image)
        // and insert after its top-level parent section
        var learnLink = document.querySelector('a[href*="affiliate-learn"]');
        if (learnLink) {
            var parentSection = learnLink.closest('.e-con.e-parent') || learnLink.closest('[data-element_type="container"].e-parent');
            if (parentSection && parentSection.parentNode) {
                parentSection.parentNode.insertBefore(cta, parentSection.nextSibling);
                return;
            }
        }

        // Fallback 2: Find "Choose the application type" text and go up to top-level parent
        var allEls = document.querySelectorAll('p, span, div');
        for (var i = 0; i < allEls.length; i++) {
            var txt = (allEls[i].textContent || '').trim().toLowerCase();
            if (txt.indexOf('choose the application type') !== -1) {
                var topParent = allEls[i].closest('.e-con.e-parent') || allEls[i].closest('[data-element_type="container"].e-parent');
                if (topParent && topParent.parentNode) {
                    topParent.parentNode.insertBefore(cta, topParent);
                    return;
                }
            }
        }

        // Final fallback: do not show (don't show a broken floating bar)
    })();
    </script>
    <?php
}

// ============================================================
// 11. SETTINGS PAGE FOR CTA LINKS
// ============================================================
add_action('admin_menu', 'opphub_settings_menu');
function opphub_settings_menu() {
    add_submenu_page(
        'edit.php?post_type=opportunity',
        'Hub Settings',
        'Settings',
        'manage_options',
        'opphub-settings',
        'opphub_settings_page'
    );
}

function opphub_settings_page() {
    // Handle manual import trigger
    if (isset($_POST['opphub_import_now']) && check_admin_referer('opphub_settings_nonce')) {
        $count = opphub_import_from_feeds();
        echo '<div class="notice notice-success"><p>Import complete! ' . intval($count) . ' new opportunities imported.</p></div>';
    }

    if (isset($_POST['opphub_save_settings']) && check_admin_referer('opphub_settings_nonce')) {
        update_option('opphub_structured_url', esc_url_raw($_POST['opphub_structured_url']));
        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }

    $structured_url = get_option('opphub_structured_url', '');
    $last_import = get_option('opphub_last_import', 'Never');
    $import_count = get_option('opphub_last_import_count', 0);
    ?>
    <div class="wrap">
        <h1>Opportunities Hub Settings</h1>
        <form method="post">
            <?php wp_nonce_field('opphub_settings_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="opphub_structured_url">"Get Structured" CTA URL</label></th>
                    <td>
                        <input type="url" id="opphub_structured_url" name="opphub_structured_url" value="<?php echo esc_url($structured_url); ?>" class="regular-text" placeholder="https://48hoursready.com/your-page">
                        <p class="description">The URL for the "Get Structured in 48 Hours" and "Get Ready for $199" buttons on the Funding Hub page.</p>
                    </td>
                </tr>
            </table>
            <input type="submit" name="opphub_save_settings" class="button button-primary" value="Save Settings">
        </form>

        <hr>
        <h2>RSS Auto-Import</h2>
        <p>The plugin automatically imports funding opportunities from global institutions every 12 hours.</p>
        <p><strong>Sources:</strong> Devex Funding, ReliefWeb (UN), UN News, Green Climate Fund, IDB, Asian Development Bank</p>
        <p><strong>Last import:</strong> <?php echo esc_html($last_import); ?> (<?php echo intval($import_count); ?> items imported)</p>
        <form method="post">
            <?php wp_nonce_field('opphub_settings_nonce'); ?>
            <input type="submit" name="opphub_import_now" class="button button-secondary" value="Import Now">
        </form>
    </div>
    <?php
}

// ============================================================
// 12. RSS AUTO-IMPORT FROM EXTERNAL FEEDS
// ============================================================

// Schedule the cron event
add_action('init', 'opphub_schedule_import');
function opphub_schedule_import() {
    if (!wp_next_scheduled('opphub_cron_import')) {
        wp_schedule_event(time(), 'twicedaily', 'opphub_cron_import');
    }
}

add_action('opphub_cron_import', 'opphub_import_from_feeds');

// Run import on plugin activation and version update
add_action('init', 'opphub_maybe_initial_import', 100);
function opphub_maybe_initial_import() {
    if (get_option('opphub_import_version') !== OPP_HUB_VERSION) {
        update_option('opphub_import_version', OPP_HUB_VERSION);
        // Re-import on every version update to pick up new feed sources
        opphub_import_from_feeds();
    }
}

function opphub_import_from_feeds() {
    include_once(ABSPATH . WPINC . '/feed.php');

    $feeds = [
        [
            'url'         => 'https://www.devex.com/funding/feed',
            'institution' => 'Global',
            'type'        => 'Grant',
            'region'      => 'Global',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://search.worldbank.org/api/v2/projects?format=atom&rows=10',
            'institution' => 'World Bank',
            'type'        => 'Loan',
            'region'      => 'Global',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://search.worldbank.org/api/v2/news?format=atom&rows=10',
            'institution' => 'World Bank',
            'type'        => 'Grant',
            'region'      => 'Global',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://www.greenclimate.fund/news/feed',
            'institution' => 'UN',
            'type'        => 'Grant',
            'region'      => 'Global',
            'sector'      => 'Energy',
        ],
        [
            'url'         => 'https://news.un.org/feed/subscribe/en/news/topic/economic-development/feed/rss.xml',
            'institution' => 'UN',
            'type'        => 'Grant',
            'region'      => 'Global',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://blogs.iadb.org/ideas-matter/en/feed/',
            'institution' => 'IDB',
            'type'        => 'Grant',
            'region'      => 'Caribbean',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://www.caribank.org/rss.xml',
            'institution' => 'IDB',
            'type'        => 'Loan',
            'region'      => 'Caribbean',
            'sector'      => 'SME',
        ],
        [
            'url'         => 'https://reliefweb.int/updates/rss.xml',
            'institution' => 'UN',
            'type'        => 'Grant',
            'region'      => 'Global',
            'sector'      => 'NGO',
        ],
    ];

    $imported = 0;

    foreach ($feeds as $feed_config) {
        $rss = fetch_feed($feed_config['url']);

        if (is_wp_error($rss)) {
            continue;
        }

        $max_items = $rss->get_item_quantity(10);
        $items = $rss->get_items(0, $max_items);

        foreach ($items as $item) {
            $title = sanitize_text_field($item->get_title());
            $link  = esc_url_raw($item->get_permalink());
            $desc  = wp_kses_post($item->get_description());
            $date  = $item->get_date('Y-m-d H:i:s');

            // Skip if we already imported this (check by title + source URL)
            $existing = get_posts([
                'post_type'   => 'opportunity',
                'title'       => $title,
                'post_status' => 'publish',
                'numberposts' => 1,
                'meta_query'  => [
                    [
                        'key'   => '_opphub_source_url',
                        'value' => $link,
                    ],
                ],
            ]);

            if (!empty($existing)) {
                continue;
            }

            // Also check by title alone to avoid near-duplicates
            $title_exists = get_posts([
                'post_type'   => 'opportunity',
                'title'       => $title,
                'post_status' => 'publish',
                'numberposts' => 1,
            ]);

            if (!empty($title_exists)) {
                continue;
            }

            // Create the opportunity post
            $post_id = wp_insert_post([
                'post_type'    => 'opportunity',
                'post_title'   => $title,
                'post_content' => $desc,
                'post_excerpt' => wp_trim_words(wp_strip_all_tags($desc), 30),
                'post_status'  => 'publish',
                'post_date'    => $date ?: current_time('mysql'),
            ]);

            if ($post_id && !is_wp_error($post_id)) {
                // Save source metadata
                update_post_meta($post_id, '_opphub_source_url', $link);
                update_post_meta($post_id, '_opphub_apply_url', $link);
                update_post_meta($post_id, '_opphub_status', 'open');
                update_post_meta($post_id, '_opphub_imported', true);

                // Assign taxonomy terms
                if (!empty($feed_config['institution'])) {
                    wp_set_object_terms($post_id, $feed_config['institution'], 'institution');
                }
                if (!empty($feed_config['type'])) {
                    wp_set_object_terms($post_id, $feed_config['type'], 'funding_type');
                }
                if (!empty($feed_config['region'])) {
                    wp_set_object_terms($post_id, $feed_config['region'], 'region');
                }
                if (!empty($feed_config['sector'])) {
                    wp_set_object_terms($post_id, $feed_config['sector'], 'sector');
                }

                $imported++;
            }
        }
    }

    update_option('opphub_last_import', current_time('F j, Y g:i A'));
    update_option('opphub_last_import_count', $imported);

    return $imported;
}

// Clean up cron on deactivation
register_deactivation_hook(__FILE__, 'opphub_clear_cron');
function opphub_clear_cron() {
    wp_clear_scheduled_hook('opphub_cron_import');
}
