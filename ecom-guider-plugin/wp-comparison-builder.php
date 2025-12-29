<?php
/**
 * Plugin Name: WP Comparison Builder
 * Plugin URI:  https://example.com/
 * Description: A powerful, generic comparison builder for WordPress. Create beautiful comparison tables, lists, and hero sections for any type of item (hosting, software, products, etc.).
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://example.com/
 * Text Domain: wp-comparison-builder
 * Domain Path: /languages
 * License:     GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define Plugin Constants
define( 'WPC_VERSION', '1.0.0' );
define( 'WPC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Includes
require_once WPC_PLUGIN_DIR . 'includes/cpt-setup.php';
require_once WPC_PLUGIN_DIR . 'includes/admin-ui.php';
require_once WPC_PLUGIN_DIR . 'includes/settings-page.php';
require_once WPC_PLUGIN_DIR . 'includes/api-endpoints.php';
require_once WPC_PLUGIN_DIR . 'includes/shortcode-helper.php';
require_once WPC_PLUGIN_DIR . 'includes/sample-data.php';
require_once WPC_PLUGIN_DIR . 'includes/seo-schema.php';
require_once WPC_PLUGIN_DIR . 'includes/compare-button-shortcode.php';
require_once WPC_PLUGIN_DIR . 'includes/comparison-sets-db.php';
require_once WPC_PLUGIN_DIR . 'includes/compare-alternatives-admin.php';

require_once WPC_PLUGIN_DIR . 'includes/list-meta-box.php';
require_once WPC_PLUGIN_DIR . 'includes/migration.php';

/**
 * Register Scripts and Styles
 */
function wpc_register_scripts() {
    // Register the main app script
    wp_register_script(
        'wpc-app',
        WPC_PLUGIN_URL . 'dist/assets/wp-plugin.js', 
        array( 'wp-element', 'wp-api' ),
        WPC_VERSION,
        true
    );

    // Register Compare Button Script
    wp_register_script(
        'wpc-compare-button',
        WPC_PLUGIN_URL . 'assets/compare-button.js',
        array(),
        WPC_VERSION,
        true
    );

    // Localize script with settings
    // Default colors if not set
    $primary_color = get_option( 'wpc_primary_color', '#6366f1' );
    $accent_color = get_option( 'wpc_accent_color', '#0d9488' );
    $secondary_color = get_option( 'wpc_secondary_color', '#1e293b' );
    $featured_color = get_option( 'wpc_featured_color', '#6366f1' );
    $pricing_banner_color = get_option( 'wpc_pricing_banner_color', '#10b981' );
    $button_hover_color = get_option( 'wpc_button_hover_color', '' );
    
    // Get filter style
    $filter_style = get_option( 'wpc_filter_style', 'top' );
    $search_type = get_option( 'wpc_search_type', 'text' );
    
    // Get Pricing Table Visuals (New)
    $pt_header_bg = get_option( 'wpc_pt_header_bg', '#f8fafc' );
    $pt_header_text = get_option( 'wpc_pt_header_text', '#0f172a' );
    $pt_btn_bg = get_option( 'wpc_pt_btn_bg', '' ); // Default empty to fallback to primary
    $pt_btn_text = get_option( 'wpc_pt_btn_text', '#ffffff' );
    $pt_btn_pos_table = get_option( 'wpc_pt_btn_pos_table', 'after_price' );
    $pt_btn_pos_popup = get_option( 'wpc_pt_btn_pos_popup', 'after_price' );
    $show_plan_buttons = get_option( 'wpc_show_plan_buttons', '1' );
    $show_footer_button_global = get_option( 'wpc_show_footer_button_global', '1' );
    $open_links_new_tab = get_option( 'wpc_open_links_new_tab', '1' );

    // Text Labels (Get values or rely on defaults in JS, but passing them empty means "use default")
    $text_labels = array(
        'viewDetails' => get_option('wpc_text_view_details', ''),
        'visit' => get_option('wpc_text_visit', ''),
        'compareAlternatives' => get_option('wpc_text_compare_alternatives', ''),
        'compareNow' => get_option('wpc_text_compare_now', ''),
        'reviews' => get_option('wpc_text_reviews', ''),
        'backToReviews' => get_option('wpc_text_back_to_reviews', ''),
        'filters' => get_option('wpc_text_filters', ''),
        'searchPlaceholder' => get_option('wpc_text_search_placeholder', ''),
        'sortDefault' => get_option('wpc_text_sort_default', ''),
        'category' => get_option('wpc_text_category', ''),
        'features' => get_option('wpc_text_features', ''),
        'itemsCount' => get_option('wpc_text_items_count', ''),
        'selected' => get_option('wpc_text_selected', ''),
        'clearAll' => get_option('wpc_text_clear_all', ''),
        'about' => get_option('wpc_text_about', ''),
    );

    // Hybrid Approach: Preload Data Globally
    // Ensure API functions are loaded
    if ( ! function_exists( 'wpc_get_items' ) ) {
        // Should be loaded, but just in case
    }
    $initial_data = function_exists('wpc_get_items') ? wpc_get_items() : [];

    $localize_data = array(
        'apiUrl' => site_url( '/wp-json/wpc/v1/items' ),
        'nonce'  => wp_create_nonce( 'wp_rest' ),
        'colors' => array(
            'primary' => $primary_color,
            'accent' => $accent_color,
            'secondary' => $secondary_color,
            'featured' => $featured_color,
            'banner' => $pricing_banner_color,
            'hoverButton' => $button_hover_color
        ),
        'texts' => $text_labels, // <--- NEW TEXTS OBJECT
        'visuals' => array( // New object for PT visuals
            'wpc_pt_header_bg' => $pt_header_bg,
            'wpc_pt_header_text' => $pt_header_text,
            'wpc_pt_btn_bg' => $pt_btn_bg,
            'wpc_pt_btn_text' => $pt_btn_text,
            'wpc_pt_btn_pos_table' => $pt_btn_pos_table,
            'wpc_pt_btn_pos_popup' => $pt_btn_pos_popup,
        ),
        'showPlanButtons' => $show_plan_buttons,
        'showFooterButtonGlobal' => $show_footer_button_global,
        'openNewTab' => $open_links_new_tab === '1', // <--- NEW SETTING
        'primary_color' => $primary_color, // Explicitly pass top-level too if needed
        'filterStyle' => $filter_style,
        'searchType' => $search_type,
        'target_details' => get_option( 'wpc_target_details', '_blank' ),
        'target_direct' => get_option( 'wpc_target_direct', '_blank' ),
        'target_pricing' => get_option( 'wpc_target_pricing', '_blank' ),
        'initialData' => $initial_data // <--- INJECTED HERE
    );

    // Pass settings to wpcSettings global
    wp_localize_script( 'wpc-app', 'wpcSettings', $localize_data );
    // Legacy fallback
    wp_localize_script( 'wpc-app', 'ecommerceGuiderSettings', $localize_data );

    // Register Styles
    wp_register_style(
        'wpc-styles',
        WPC_PLUGIN_URL . 'dist/assets/wp-plugin.css',
        array(),
        WPC_VERSION
    );
    
    // Inject Custom CSS Variables using wp_add_inline_style (like working plugin)
    $primary_color = get_option( 'wpc_primary_color', '#6366f1' );
    $accent_color = get_option( 'wpc_accent_color', '#0d9488' );
    $secondary_color = get_option( 'wpc_secondary_color', '#1e293b' );
    $border_color = get_option( 'wpc_card_border_color', '' );

    $primary_hsl = wpc_hex2hsl( $primary_color );
    $accent_hsl = wpc_hex2hsl( $accent_color );
    $secondary_hsl = wpc_hex2hsl( $secondary_color );
    
    
    // Button Hover Color
    $button_hover_color = get_option( 'wpc_button_hover_color', '' );
    
    // If not set, we default to injecting a fallback OR handling it in CSS.
    // However, the cleanest way is to always define the variable, either to the custom value or to the calculated darker primary.
    // For "Automatic", we usually want HSL manipulation in CSS, but here we can't easily do calc() on the HSL variable for text hex.
    // So if empty, we won't define --wpc-btn-hover here, and let CSS fallback to its default.
    
    $custom_css = "
        :root {
            --primary: {$primary_hsl};
            --accent: {$accent_hsl};
            --secondary: {$secondary_hsl};
            --ring: {$primary_hsl};
    ";
    
    if ( ! empty( $button_hover_color ) ) {
        $custom_css .= " --wpc-btn-hover: " . esc_attr($button_hover_color) . "; ";
    }
    
    $custom_css .= " } ";

    if ( ! empty( $border_color ) ) {
        $custom_css .= " .bg-card { border-color: " . esc_attr($border_color) . " !important; }";
    }
    
    wp_add_inline_style( 'wpc-styles', $custom_css );

    // Check for shortcode presence
    global $post;
    
    // Check for custom shortcode tag setting if we decide to implement it, 
    // for now we support wpc_compare, wpc_list, wpc_hero, wpc_compare_button 
    // and their legacy equivalents.
    
    $legacy_shortcodes = array(
        'ecommerce_guider_compare',
        'ecommerce_guider_list',
        'ecommerce_guider_hero',
        'ecommerce_compare_button'
    );
    
    $new_shortcodes = array(
        'wpc_compare',
        'wpc_list',
        'wpc_hero',
        'wpc_compare_button',
        'wpc_pricing_table'
    );
    
    $all_shortcodes = array_merge($new_shortcodes, $legacy_shortcodes);
    
    $has_shortcode = false;
    if ( is_a( $post, 'WP_Post' ) ) {
        foreach ( $all_shortcodes as $tag ) {
            if ( has_shortcode( $post->post_content, $tag ) ) {
                $has_shortcode = true;
                break;
            }
        }
    }
    
    // ONLY enqueue on pages with shortcodes
    if ( $has_shortcode ) {
        wp_enqueue_script( 'wpc-app' );
        wp_enqueue_style( 'wpc-styles' ); // Inline CSS will be automatically included
    }
}
add_action( 'wp_enqueue_scripts', 'wpc_register_scripts' );

/**
 * Convert Hex to HSL
 */
function wpc_hex2hsl( $hex ) {
    $hex = str_replace( '#', '', $hex );
    
    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    
    $r /= 255;
    $g /= 255;
    $b /= 255;
    
    $max = max( $r, $g, $b );
    $min = min( $r, $g, $b );
    $h; $s; $l = ( $max + $min ) / 2;
    $d = $max - $min;
    
    if ( $d == 0 ) {
        $h = $s = 0; // achromatic
    } else {
        $s = $l > 0.5 ? $d / ( 2 - $max - $min ) : $d / ( $max + $min );
        switch( $max ) {
            case $r: $h = ( $g - $b ) / $d + ( $g < $b ? 6 : 0 ); break;
            case $g: $h = ( $b - $r ) / $d + 2; break;
            case $b: $h = ( $r - $g ) / $d + 4; break;
        }
        $h /= 6;
    }
    
    $h = floor( $h * 360 );
    $s = floor( $s * 100 );
    $l = floor( $l * 100 );
    
    return "$h $s% $l%"; 
}

/**
 * Add type="module" to the app script
 */
function wpc_add_module_type_attribute( $tag, $handle, $src ) {
    if ( 'wpc-app' === $handle ) {
        $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'wpc_add_module_type_attribute', 10, 3 );

/**
 * Shortcode to render the comparison tool
 * Usage: [wpc_compare ids="1,2" featured="1" category="cat_slug" limit="4"]
 */
function wpc_shortcode( $atts ) {
    // Enqueue assets
    wp_enqueue_script( 'wpc-app' );
    wp_enqueue_style( 'wpc-styles' );

    $attributes = shortcode_atts( array(
        'ids'      => '',
        'featured' => '',
        'category' => '',
        'limit'    => '',
    ), $atts );

    // 1. Get Data (Server Side)
    // Ensure API functions are loaded
    if ( ! function_exists( 'wpc_get_items' ) ) {
        // Fallback or load if needed, but it should be loaded by main plugin file
    }
    
    $data = wpc_get_items(); // Returns ['items' => ..., 'categories' => ..., 'filterableFeatures' => ...]
    $items = $data['items'];

    // 2. Filter Data (PHP Side - Basic Replication of JS Logic for Initial View)
    // Filter by specific IDs
    $specific_ids = !empty($attributes['ids']) ? array_map('trim', explode(',', $attributes['ids'])) : [];
    if ( ! empty( $specific_ids ) ) {
        $items = array_filter( $items, function($item) use ($specific_ids) {
            return in_array( $item['id'], $specific_ids );
        });
    }

    // Filter by Category
    $category_slug = sanitize_text_field( $attributes['category'] );
    if ( ! empty( $category_slug ) ) {
        $items = array_filter( $items, function($item) use ($category_slug) {
            // Check if any category matches (case insensitive)
            foreach ($item['category'] as $cat) {
                if ( md5(strtolower($cat)) === md5(strtolower($category_slug)) || strtolower($cat) === strtolower($category_slug)) return true;
                // Note: Real slug matching might be better but names are used in JS currently
            }
            return false;
        });
    }

    // Limit
    $limit = intval( $attributes['limit'] );
    if ( $limit > 0 ) {
        $items = array_slice( $items, 0, $limit );
    }
    
    // Sort (Optional: Featured logic could be here, but let's just stick to default order for now)

    // 3. Prepare Config for JS
    // Determine Filter Style first
    $filter_style = get_option( 'wpc_filter_style', 'top' );
    
    $config = array(
        'ids'      => $specific_ids,
        'featured' => !empty($attributes['featured']) ? array_map('trim', explode(',', $attributes['featured'])) : [],
        'category' => $category_slug,
        'limit'    => $limit,
        'filterLayout' => $filter_style, // Explicitly pass to React
        // 'initialData' => $data // REMOVED: Hybrid approach uses global wpcSettings.initialData
    );

    $config_json = htmlspecialchars(json_encode($config), ENT_QUOTES, 'UTF-8');

    // --- HTML SKELETON GENERATION (Hybrid Rendering) ---
    // We generate the exact same HTML structure as the React app to prevent layout shift ("blink")
    
    // Icons (Inline SVG)
    $icon_search = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>';
    $icon_chevron = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground pointer-events-none"><path d="m6 9 6 6 6-6"/></svg>';
    $icon_filter = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter w-5 h-5 text-muted-foreground"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>';
    $icon_plus = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle mr-2 h-4 w-4"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>';

    // Common Components HTML
    $search_bar_html = '
    <div class="mb-6 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <div class="relative flex-1">
            ' . $icon_search . '
            <input type="text" placeholder="' . __('Search by name...', 'wp-comparison-builder') . '" class="w-full pl-10 pr-4 py-2.5 bg-card border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" disabled />
        </div>
        <div class="relative min-w-[160px]">
            <select class="w-full appearance-none pl-4 pr-10 py-2.5 bg-card border border-border rounded-xl text-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" disabled>
                <option>' . __('Sort: Default', 'wp-comparison-builder') . '</option>
            </select>
            ' . $icon_chevron . '
        </div>
        <span class="text-sm text-muted-foreground whitespace-nowrap">' . count($items) . ' ' . (count($items) === 1 ? __('item', 'wp-comparison-builder') : __('items', 'wp-comparison-builder')) . '</span>
    </div>';

    $top_filter_html = '
    <div class="mb-8 p-4 bg-card rounded-xl border border-border shadow-sm">
        <div class="flex flex-wrap items-center gap-2">
            <div class="flex items-center gap-2 mr-2">
                ' . $icon_filter . '
                <span class="font-display font-bold text-lg text-foreground">' . __('Filters', 'wp-comparison-builder') . '</span>
            </div>
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 border-dashed px-3" type="button" disabled>
                ' . $icon_plus . '
                Category
            </button>
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 border-dashed px-3" type="button" disabled>
                ' . $icon_plus . '
                Platform Features
            </button>
        </div>
    </div>';
    
    $grid_class = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6";
    if ( $filter_style === 'sidebar' ) {
         $grid_class .= " xl:grid-cols-3";
    } else {
         $grid_class .= " xl:grid-cols-4";
    }

    ob_start();
    ?>
    <div class="wpc-root" data-config="<?php echo $config_json; ?>">
        <div class="wpc-comparison-wrapper bg-background text-foreground min-h-[100px] py-4">
             
             <?php if ($filter_style === 'top'): ?>
                <!-- Top Layout -->
                <?php echo $top_filter_html; ?>
                
                <div class="w-full flex flex-col lg:flex-row gap-8">
                     <div class="flex-1">
                        <?php echo $search_bar_html; ?>
                        
                        <div class="<?php echo esc_attr($grid_class); ?>">
                            <?php foreach ( $items as $item ): 
                                // Render Item (Simplified for Skeleton)
                                $item_id = $item['id'];
                                $rating = $item['rating'];
                                $logo = $item['logo'];
                                $name = $item['name'];
                                $price = $item['price'];
                                $period = $item['period']; 
                                $badge = isset($item['badge']) ? $item['badge'] : null;
                                $featured_badge_text = isset($item['featured_badge_text']) ? $item['featured_badge_text'] : '';
                                
                                $style_attr = "";
                                if (isset($item['design_overrides']) && $item['design_overrides']['enabled'] === true) {
                                    if(!empty($item['design_overrides']['primary'])) {
                                        $primary = wpc_hex2hsl($item['design_overrides']['primary']);
                                        $style_attr .= "--primary: $primary; --ring: $primary; ";
                                    }
                                    if(!empty($item['design_overrides']['accent'])) {
                                        $accent = wpc_hex2hsl($item['design_overrides']['accent']);
                                        $style_attr .= "--accent: $accent; ";
                                    }
                                }
                            ?>
                            <div class="group relative rounded-2xl border bg-card text-card-foreground shadow-sm transition-all hover:shadow-md" style="<?php echo esc_attr($style_attr); ?>">
                                <?php if ( ! empty( $featured_badge_text ) ): ?>
                                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-10 px-3 py-1 bg-primary text-primary-foreground text-xs font-bold uppercase tracking-wider rounded-full shadow-sm">
                                        <?php echo esc_html( $featured_badge_text ); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <?php if ( $logo ): ?>
                                                <div class="w-12 h-12 rounded-lg bg-muted/10 flex items-center justify-center p-1">
                                                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="w-full h-full object-contain" />
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h3 class="font-bold text-lg leading-none mb-1"><?php echo esc_html( $name ); ?></h3>
                                                <div class="flex items-center gap-1">
                                                    <div class="flex text-yellow-400">
                                                        <?php for($i=0; $i<5; $i++) echo ($i < floor($rating)) ? '★' : '☆'; ?>
                                                    </div>
                                                    <span class="text-xs text-muted-foreground font-medium">(<?php echo esc_html($rating); ?>)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-6 p-3 bg-muted/30 rounded-xl text-center">
                                         <div class="flex items-baseline justify-center gap-1">
                                            <span class="text-3xl font-bold text-primary"><?php echo esc_html($price); ?></span>
                                            <?php if($period): ?><span class="text-sm font-medium text-muted-foreground"><?php echo esc_html($period); ?></span><?php endif; ?>
                                         </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="h-10 bg-primary/20 rounded"></div>
                                        <div class="h-10 border border-input rounded"></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                     </div>
                </div>

            <?php else: ?>
                <!-- Sidebar Layout (Shortcode) -->
                <div class="w-full flex flex-col lg:grid lg:grid-cols-4 lg:gap-8">
                     <!-- Static Sidebar Skeleton -->
                <!-- Sidebar Layout (Shortcode) -->
                <div class="w-full flex flex-col lg:grid lg:grid-cols-4 lg:gap-8">
                     <!-- Static Sidebar Skeleton -->
                     <div class="lg:col-span-1 border border-border rounded-xl p-6 bg-card mb-8 lg:mb-0 h-fit lg:sticky lg:top-24">
                        <div class="flex items-center gap-2 mb-2 pb-2 border-b border-border">
                            <?php echo $icon_filter; ?>
                            <span class="font-display font-bold text-lg text-foreground"><?php _e('Filters', 'wp-comparison-builder'); ?></span>
                        </div>
                        <div class="space-y-2 py-2 opacity-60">
                            <!-- Categories Skeleton -->
                            <div class="space-y-3 pt-2">
                                <h4 class="text-sm font-bold text-foreground uppercase tracking-wider mb-2">Categories</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-4 rounded border border-input bg-background"></div>
                                        <div class="h-4 bg-muted rounded w-2/3"></div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-4 rounded border border-input bg-background"></div>
                                        <div class="h-4 bg-muted rounded w-1/2"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Features Skeleton -->
                            <div class="space-y-3 pt-2">
                                <h4 class="text-sm font-bold text-foreground uppercase tracking-wider mb-2">Features</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-4 rounded border border-input bg-background"></div>
                                        <div class="h-4 bg-muted rounded w-3/4"></div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-4 rounded border border-input bg-background"></div>
                                        <div class="h-4 bg-muted rounded w-1/2"></div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="h-4 w-4 rounded border border-input bg-background"></div>
                                        <div class="h-4 bg-muted rounded w-2/3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>

                     <div class="lg:col-span-3">
                        <?php echo $search_bar_html; ?>
                        <div class="<?php echo esc_attr($grid_class); ?>">
                            <?php foreach ( $items as $item ): 
                                // Render Item (Simplified for Skeleton)
                                $name = $item['name'];
                                $price = $item['price'];
                                $logo = $item['logo'];
                            ?>
                              <div class="group relative rounded-2xl border bg-card text-card-foreground shadow-sm">
                                  <div class="p-6">
                                     <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                             <?php if ( $logo ): ?>
                                                <div class="w-12 h-12 rounded-lg bg-muted/10 p-1 flex items-center justify-center"><img src="<?php echo esc_url( $logo ); ?>" class="w-full h-full object-contain" /></div>
                                            <?php endif; ?>
                                            <div><h3 class="font-bold text-lg"><?php echo esc_html( $name ); ?></h3></div>
                                        </div>
                                     </div>
                                     <div class="mb-6 p-3 bg-muted/30 rounded-xl text-center">
                                         <span class="text-3xl font-bold text-primary"><?php echo esc_html($price); ?></span>
                                     </div>
                                     <div class="grid grid-cols-2 gap-3 opacity-60">
                                         <div class="h-10 bg-primary/20 rounded"></div>
                                         <div class="h-10 border border-input rounded"></div>
                                     </div>
                                  </div>
                              </div>
                            <?php endforeach; ?>
                        </div>
                     </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'wpc_compare', 'wpc_shortcode' );
add_shortcode( 'ecommerce_guider_compare', 'wpc_shortcode' ); // Legacy Support

/**
 * Shortcode for Saved Lists
 * Usage: [wpc_list id="123"]
 */
function wpc_list_shortcode( $atts ) {
    // Ensure assets are loaded
    wp_enqueue_script( 'wpc-app' );
    wp_enqueue_style( 'wpc-styles' );

    $attributes = shortcode_atts( array(
        'id' => '',
    ), $atts );

    if ( empty( $attributes['id'] ) ) return '';

    $post_id = intval( $attributes['id'] );
    
    // Fetch Saved Meta (try new keys first, then legacy)
    $ids = get_post_meta( $post_id, '_wpc_list_ids', true );
    if (empty($ids)) $ids = get_post_meta( $post_id, '_hg_list_ids', true );
    
    $featured = get_post_meta( $post_id, '_wpc_list_featured', true );
    if (empty($featured)) $featured = get_post_meta( $post_id, '_hg_list_featured', true );

    $limit = get_post_meta( $post_id, '_wpc_list_limit', true );
    if (empty($limit)) $limit = get_post_meta( $post_id, '_hg_list_limit', true );
    
    // Badge Texts
    $badge_texts_raw = get_post_meta( $post_id, '_wpc_list_badge_texts', true );
    if (empty($badge_texts_raw)) $badge_texts_raw = get_post_meta( $post_id, '_hg_list_badge_texts', true );

    // Badge Colors
    $badge_colors_raw = get_post_meta( $post_id, '_wpc_list_badge_colors', true );
    if (empty($badge_colors_raw)) $badge_colors_raw = get_post_meta( $post_id, '_hg_list_badge_colors', true );

    // New List Features
    $enable_comparison = get_post_meta( $post_id, '_wpc_list_enable_comparison', true );
    if ($enable_comparison === '') $enable_comparison = '1';

    $list_button_text = get_post_meta( $post_id, '_wpc_list_button_text', true );
    $filter_layout = get_post_meta( $post_id, '_wpc_list_filter_layout', true ) ?: 'default';

    $filter_cats = get_post_meta( $post_id, '_wpc_list_filter_cats', true ) ?: [];
    $filter_feats = get_post_meta( $post_id, '_wpc_list_filter_feats', true ) ?: [];
    
    // Show All Items card settings
    $show_all_enabled = get_post_meta( $post_id, '_wpc_list_show_all_enabled', true );
    if ($show_all_enabled === '') $show_all_enabled = '1'; // Default to enabled
    $initial_visible = get_post_meta( $post_id, '_wpc_list_initial_visible', true );
    if (empty($initial_visible)) $initial_visible = 8;

    // --- NEW SETTINGS READ ---
    $cat_label = get_post_meta( $post_id, '_wpc_list_cat_label', true );
    $feat_label = get_post_meta( $post_id, '_wpc_list_feat_label', true );
    
    $show_plans_override = get_post_meta( $post_id, '_wpc_list_show_plans', true ); 
    $show_plans = true; 
    if ($show_plans_override === '1') $show_plans = true;
    elseif ($show_plans_override === '0') $show_plans = false;
    else {
        $show_plans = get_option( 'wpc_show_plan_buttons', '1' ) === '1';
    }

    // Convert Filter IDs to Names for Frontend
    $filter_cat_names = [];
    if (is_array($filter_cats)) {
        foreach($filter_cats as $fcid) {
            $term = get_term($fcid, 'comparison_category');
            if($term && !is_wp_error($term)) $filter_cat_names[] = $term->name;
        }
    }

    $filter_feat_names = [];
    if (is_array($filter_feats)) {
        foreach($filter_feats as $ffid) {
            $term = get_term($ffid, 'comparison_feature');
            if($term && !is_wp_error($term)) $filter_feat_names[] = $term->name;
        }
    }
    
    // Normalize Badge Data for JSON
    $badge_texts = array();
    if ( ! empty( $badge_texts_raw ) && is_array( $badge_texts_raw ) ) {
        foreach ( $badge_texts_raw as $pid => $text ) {
            if ( ! empty( $text ) ) $badge_texts[ strval( $pid ) ] = $text;
        }
    }
    
    $badge_colors = array();
    if ( ! empty( $badge_colors_raw ) && is_array( $badge_colors_raw ) ) {
        foreach ( $badge_colors_raw as $pid => $color ) {
            if ( ! empty( $color ) ) $badge_colors[ strval( $pid ) ] = $color;
        }
    }

    // Convert arrays to comma-separated strings
    $ids_str = !empty($ids) ? implode(',', (array)$ids) : '';
    $featured_str = !empty($featured) ? implode(',', (array)$featured) : '';
    $specific_ids = !empty($ids_str) ? array_map('trim', explode(',', $ids_str)) : [];

    // 1. Fetch Data
    if ( ! function_exists( 'wpc_get_items' ) ) { }
    $data = wpc_get_items();
    $items = $data['items'];

    // 2. Filter & Modify Data
    if ( ! empty( $specific_ids ) ) {
        $items = array_filter( $items, function($item) use ($specific_ids) {
            return in_array( $item['id'], $specific_ids );
        });
        
        // Sort items: Featured First, then by Saved Order
        // Prepare featured IDs for easy lookup
        $featured_ids_array = !empty($featured) ? (array)$featured : [];
        
        usort($items, function($a, $b) use ($specific_ids, $featured_ids_array) {
            $is_a_featured = in_array($a['id'], $featured_ids_array);
            $is_b_featured = in_array($b['id'], $featured_ids_array);
            
            // Primary Sort: Featured items first
            if ($is_a_featured && !$is_b_featured) return -1;
            if (!$is_a_featured && $is_b_featured) return 1;
            
            // Secondary Sort: Saved Drag-and-Drop Order
            $pos_a = array_search($a['id'], $specific_ids);
            $pos_b = array_search($b['id'], $specific_ids);
            return $pos_a - $pos_b;
        });
        
        // Apply Badge Overrides
        $items = array_map(function($item) use ($badge_texts, $badge_colors) {
            if (isset($badge_texts[$item['id']])) {
                $item['featured_badge_text'] = $badge_texts[$item['id']];
            }
            if (isset($badge_colors[$item['id']])) {
                // Determine if we should override the main featured color or just the badge logic
                // React logic overrides 'featured_badge_color' property.
                $item['featured_badge_color'] = $badge_colors[$item['id']];
            }
            return $item;
        }, $items);
    }
    
    // Limit
    if ( $limit > 0 ) {
        $items = array_slice( $items, 0, $limit );
    }

    // Extract sorted IDs to ensure JS follows the exact same order
    $sorted_ids = array_column($items, 'id');

    // Get list-specific color overrides for React inline styles
    $colors_override = array();
    
    if (get_post_meta($post_id, '_wpc_list_use_primary', true)) {
        $colors_override['primary'] = get_post_meta($post_id, '_wpc_list_primary_color', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_accent', true)) {
        $colors_override['accent'] = get_post_meta($post_id, '_wpc_list_accent_color', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_hover', true)) {
        $colors_override['hoverButton'] = get_post_meta($post_id, '_wpc_list_hover_color', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_secondary', true)) {
        $colors_override['secondary'] = get_post_meta($post_id, '_wpc_list_secondary_color', true);
    }
    
    // PT Visual Style Overrides
    $pt_visuals_override = array();
    
    if (get_post_meta($post_id, '_wpc_list_use_pt_header_bg', true)) {
        $pt_visuals_override['wpc_pt_header_bg'] = get_post_meta($post_id, '_wpc_list_pt_header_bg', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_pt_header_text', true)) {
        $pt_visuals_override['wpc_pt_header_text'] = get_post_meta($post_id, '_wpc_list_pt_header_text', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_pt_btn_bg', true)) {
        $pt_visuals_override['wpc_pt_btn_bg'] = get_post_meta($post_id, '_wpc_list_pt_btn_bg', true);
    }
    if (get_post_meta($post_id, '_wpc_list_use_pt_btn_text', true)) {
        $pt_visuals_override['wpc_pt_btn_text'] = get_post_meta($post_id, '_wpc_list_pt_btn_text', true);
    }
    
    // PT Button Positions (select dropdowns - no checkbox needed)
    $pt_btn_pos_table = get_post_meta($post_id, '_wpc_list_pt_btn_pos_table', true);
    if (!empty($pt_btn_pos_table)) {
        $pt_visuals_override['wpc_pt_btn_pos_table'] = $pt_btn_pos_table;
    }
    $pt_btn_pos_popup = get_post_meta($post_id, '_wpc_list_pt_btn_pos_popup', true);
    if (!empty($pt_btn_pos_popup)) {
        $pt_visuals_override['wpc_pt_btn_pos_popup'] = $pt_btn_pos_popup;
    }

    // 3. Render HTML - Prepare Config
    // Determine Grid Class & Filter Style (Resolved)
    $filter_style = get_option( 'wpc_filter_style', 'top' );
    if ($filter_layout !== 'default' && !empty($filter_layout)) {
        $filter_style = $filter_layout;
    }

    // Determine Search Type (Resolved)
    $global_search_type = get_option( 'wpc_search_type', 'text' );
    $list_search_type = get_post_meta( $post_id, '_wpc_list_search_type', true );
    $final_search_type = ($list_search_type && $list_search_type !== 'default') ? $list_search_type : $global_search_type;


    $grid_class = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6";
    if ( $filter_style === 'sidebar' ) {
         $grid_class .= " xl:grid-cols-3";
    } else {
         $grid_class .= " xl:grid-cols-4";
    }

    // Build config
    $config = array(
        'ids'      => $sorted_ids,
        'featured' => !empty($featured_str) ? array_map('trim', explode(',', $featured_str)) : [],
        'category' => '', 
        'limit'    => intval($limit),
        'enableComparison' => $enable_comparison === '1',
        'buttonText' => $list_button_text,
        'filterLayout' => $filter_style, // Pass RESOLVED style
        'searchType' => $final_search_type,
        'filterCats' => $filter_cat_names,
        'filterFeats' => $filter_feat_names,
        'badge_texts' => $badge_texts,
        'badge_colors' => $badge_colors,
        'categoriesLabel' => $cat_label,
        'featuresLabel' => $feat_label,
        'showPlanButtons' => $show_plans,
        'showAllEnabled' => $show_all_enabled === '1',
        'initialVisible' => intval($initial_visible),
        'colorsOverride' => !empty($colors_override) ? $colors_override : null,
        'visualsOverride' => !empty($pt_visuals_override) ? $pt_visuals_override : null,
    );
    
    $config_json = htmlspecialchars(json_encode($config), ENT_QUOTES, 'UTF-8');

    // SCOPED CSS GENERATION
    
    // SCOPED CSS GENERATION
    $unique_id = 'wpc-list-' . $post_id . '-' . mt_rand(1000, 9999);
    $scoped_styles = "";
    
    $use_primary = get_post_meta( $post_id, '_wpc_list_use_primary', true );
    if ($use_primary) {
        $c = get_post_meta( $post_id, '_wpc_list_primary_color', true );
        if($c) {
             $hsl = wpc_hex2hsl($c);
             $scoped_styles .= "--primary: {$hsl}; --ring: {$hsl}; "; 
        }
    }
    
    $use_accent = get_post_meta( $post_id, '_wpc_list_use_accent', true );
    if ($use_accent) {
        $c = get_post_meta( $post_id, '_wpc_list_accent_color', true );
        if($c) {
             $hsl = wpc_hex2hsl($c);
             $scoped_styles .= "--accent: {$hsl}; "; 
        }
    }

    $use_secondary = get_post_meta( $post_id, '_wpc_list_use_secondary', true );
    if ($use_secondary) {
        $c = get_post_meta( $post_id, '_wpc_list_secondary_color', true );
        if($c) {
             $hsl = wpc_hex2hsl($c);
             $scoped_styles .= "--secondary: {$hsl}; "; 
        }
    }
    
    $use_hover = get_post_meta( $post_id, '_wpc_list_use_hover', true );
    if ($use_hover) {
        $c = get_post_meta( $post_id, '_wpc_list_hover_color', true );
        if($c) {
             $scoped_styles .= "--wpc-btn-hover: {$c}; "; 
        }
    }
    
    $css_rules = "";
    if (!empty($scoped_styles)) {
        $css_rules .= "#{$unique_id} { {$scoped_styles} } ";
    }
    
    // Non-variable overrides
    $use_border = get_post_meta( $post_id, '_wpc_list_use_border', true );
    if($use_border) {
        $c = get_post_meta( $post_id, '_wpc_list_border_color', true );
        if($c) $css_rules .= "#{$unique_id} .bg-card { border-color: {$c} !important; } ";
    }
    
    $use_banner = get_post_meta( $post_id, '_wpc_list_use_banner', true );
    if($use_banner) {
        $c = get_post_meta( $post_id, '_wpc_list_banner_color', true );
         // Assuming we can pass this as a variable or we need to target a specific class. 
         // For now let's set a CSS var --wpc-banner
        if($c) $scoped_styles .= "--wpc-banner: {$c}; "; 
    }

    // --- HYBRID RENDERING VARIABLES ---
    $icon_search = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>';
    $icon_chevron = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-muted-foreground pointer-events-none"><path d="m6 9 6 6 6-6"/></svg>';
    $icon_filter = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter w-5 h-5 text-muted-foreground"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>';
    $icon_plus = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle mr-2 h-4 w-4"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>';

    $icon_chevrons = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevrons-up-down ml-2 h-4 w-4 shrink-0 opacity-50"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5-5"/></svg>';

    $search_input_html = '';
    if ($final_search_type === 'combobox') {
         // Render Combobox Trigger Skeleton (Button)
         $search_input_html = '
         <button type="button" role="combobox" aria-expanded="false" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" disabled>
            <span class="text-muted-foreground">' . __('Select provider...', 'wp-comparison-builder') . '</span>
            ' . $icon_chevrons . '
         </button>';
    } else {
         // Render Standard Text Input Skeleton
         $search_input_html = '
         <div class="relative flex-1">
            ' . $icon_search . '
            <input type="text" placeholder="' . __('Search by name...', 'wp-comparison-builder') . '" class="w-full pl-10 pr-4 py-2.5 bg-card border border-border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" disabled />
         </div>';
    }

    $search_bar_html = '
    <div class="mb-6 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <div class="relative flex-1">
            ' . $search_input_html . '
        </div>
        <div class="relative min-w-[160px]">
            <select class="w-full appearance-none pl-4 pr-10 py-2.5 bg-card border border-border rounded-xl text-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" disabled>
                <option>' . __('Sort: Default', 'wp-comparison-builder') . '</option>
            </select>
            ' . $icon_chevron . '
        </div>
        <span class="text-sm text-muted-foreground whitespace-nowrap">' . count($items) . ' ' . (count($items) === 1 ? __('item', 'wp-comparison-builder') : __('items', 'wp-comparison-builder')) . '</span>
    </div>';

    $top_filter_html = '
    <div class="mb-8 p-4 bg-card rounded-xl border border-border shadow-sm">
        <div class="flex flex-wrap items-center gap-2">
            <div class="flex items-center gap-2 mr-2">
                ' . $icon_filter . '
                <span class="font-display font-bold text-lg text-foreground">' . __('Filters', 'wp-comparison-builder') . '</span>
            </div>
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 border-dashed px-3" type="button" disabled>
                ' . $icon_plus . '
                Category
            </button>
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 border-dashed px-3" type="button" disabled>
                ' . $icon_plus . '
                Platform Features
            </button>
        </div>
    </div>';

    ob_start();
    ?>
    <?php if(!empty($css_rules)): ?>
    <style><?php echo $css_rules; ?></style>
    <?php endif; ?>

    <div id="<?php echo esc_attr($unique_id); ?>" class="wpc-root" data-config="<?php echo $config_json; ?>">
        <div class="wpc-comparison-wrapper bg-background text-foreground min-h-[100px] py-4">
             
             <?php if ($filter_style === 'top'): ?>
                <!-- Top Layout -->
                <?php echo $top_filter_html; ?>
                <div class="w-full flex flex-col lg:flex-row gap-8">
                     <div class="flex-1">
                        <?php echo $search_bar_html; ?>
                        <div class="<?php echo esc_attr($grid_class); ?>">
             <?php else: ?>
                <!-- Sidebar Layout -->
                <div class="w-full flex flex-col lg:grid lg:grid-cols-4 lg:gap-8">
                     <!-- Static Sidebar Skeleton -->
                     <div class="lg:col-span-1 border border-border rounded-xl p-6 bg-card mb-8 lg:mb-0 h-fit lg:sticky lg:top-24">
                        <div class="flex items-center gap-2 mb-2 pb-2 border-b border-border">
                            <?php echo $icon_filter; ?>
                            <span class="font-display font-bold text-lg text-foreground"><?php _e('Filters', 'wp-comparison-builder'); ?></span>
                        </div>
                        <div class="space-y-3 pt-2 opacity-60">
                            <h4 class="text-sm font-bold text-foreground uppercase tracking-wider">Categories</h4>
                            <div class="space-y-2">
                                <div class="h-4 bg-muted rounded w-3/4"></div>
                                <div class="h-4 bg-muted rounded w-1/2"></div>
                            </div>
                            <h4 class="text-sm font-bold text-foreground uppercase tracking-wider mt-4">Features</h4>
                             <div class="space-y-2">
                                <div class="h-4 bg-muted rounded w-3/4"></div>
                                <div class="h-4 bg-muted rounded w-1/2"></div>
                                <div class="h-4 bg-muted rounded w-2/3"></div>
                            </div>
                        </div>
                     </div>

                     <div class="lg:col-span-3">
                        <?php echo $search_bar_html; ?>
                        <div class="<?php echo esc_attr($grid_class); ?>">
             <?php endif; ?>
                <?php foreach ( $items as $item ): 
                    // Determine styles
                    $is_featured_in_list = !empty($config['featured']) && in_array($item['id'], $config['featured']);
                    $border_class = $is_featured_in_list ? "border-4" : "border-2";
                    $bg_class = $is_featured_in_list ? "bg-amber-50/10" : "";
                    $featured_color = !empty($item['featured_badge_color']) ? $item['featured_badge_color'] : (!empty($item['featured_color']) ? $item['featured_color'] : '#6366f1');
                    $border_style = $is_featured_in_list ? "border-color: " . esc_attr($featured_color) : "";
                ?>
                <div class="relative bg-card rounded-2xl p-5 transition-all duration-300 cursor-pointer border-border hover:border-primary/50 hover:shadow-xl hover:-translate-y-1 <?php echo $border_class . ' ' . $bg_class; ?>" style="<?php echo $border_style; ?>">
                    
                    <?php if ( $is_featured_in_list ): ?>
                        <div class="absolute -top-3 -right-3 px-3 py-1 bg-primary text-primary-foreground rounded-full text-xs font-bold shadow-lg z-10" style="background-color: <?php echo esc_attr($featured_color); ?>; color: white;">
                            <?php echo esc_html( !empty($item['featured_badge_text']) ? $item['featured_badge_text'] : 'Top Choice' ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Selection Circle -->
                    <div class="absolute top-4 right-4 w-6 h-6 rounded-full border-2 border-border bg-background flex items-center justify-center"></div>

                    <!-- Header -->
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-white p-1 shadow-sm border border-border/50 flex items-center justify-center overflow-hidden">
                            <?php if ( !empty($item['logo']) ): ?>
                                <img src="<?php echo esc_url($item['logo']); ?>" alt="<?php echo esc_attr($item['name']); ?>" class="w-full h-full object-contain" />
                            <?php endif; ?>
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-foreground leading-tight"><?php echo esc_html($item['name']); ?></h3>
                            <!-- Rating (Static Stars) -->
                            <div class="flex items-center gap-1">
                                <span class="text-xs font-medium text-muted-foreground">Rating: <?php echo esc_html($item['rating']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-6 p-3 bg-muted/30 rounded-lg text-center">
                        <span class="text-3xl font-display font-bold text-primary"><?php echo esc_html($item['price']); ?></span>
                        <?php if(!empty($item['period'])): ?><span class="text-sm text-muted-foreground"><?php echo esc_html($item['period']); ?></span><?php endif; ?>
                    </div>
                    
                    <!-- Categories -->
                     <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $cats = is_array($item['category']) ? array_slice($item['category'], 0, 2) : [];
                        foreach($cats as $cat): ?>
                             <span class="px-2 py-0.5 rounded-full bg-secondary text-secondary-foreground text-[10px] font-bold uppercase tracking-wider"><?php echo esc_html($cat); ?></span>
                        <?php endforeach; ?>
                    </div>

                    <!-- Features -->
                     <ul class="space-y-2 mb-2">
                        <?php if ( !empty($item['raw_features']) ):
                             $feats = is_array($item['raw_features']) ? array_slice($item['raw_features'], 0, 3) : [];
                             foreach($feats as $f): ?>
                                <li class="flex items-center gap-2 text-sm text-foreground/80">
                                    <svg class="w-4 h-4 text-primary flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span class="truncate"><?php echo esc_html($f); ?></span>
                                </li>
                             <?php endforeach;
                        endif; ?>
                     </ul>
                    
                     <!-- Button Placeholder -->
                     <div class="mt-4 pt-4 border-t border-border/50 text-center">
                        <span class="text-xs font-semibold text-muted-foreground block w-full">Select to Compare</span>
                     </div>
                </div>
                <?php endforeach; ?>
             </div> <!-- End Grid -->
             
             <?php if ($filter_style === 'top'): ?>
                    </div> <!-- End Flex-1 -->
                </div> <!-- End Flex Row -->
             <?php else: ?>
                    </div> <!-- End Col Span 3 -->
                </div> <!-- End Main Grid -->
             <?php endif; ?>

        </div> <!-- End Comparison Wrapper -->
    </div> <!-- End Root -->
    <?php
    $html = ob_get_clean();
    
    // Add schema output for SEO
    $schema_output = '';
    if ( function_exists( 'wpc_generate_list_schema' ) ) {
        $schema_output = wpc_generate_list_schema( $post_id );
    }
    
    return $schema_output . $html;
}

add_shortcode( 'wpc_list', 'wpc_list_shortcode' );
add_shortcode( 'ecommerce_guider_list', 'wpc_list_shortcode' ); // Legacy Support

/**
 * Shortcode: [wpc_pricing_table id="123"]
 * Displays the pricing table for a specifically identified item inline.
 * Supports overrides for colors and button visibility.
 */
function wpc_pricing_table_shortcode( $atts ) {
    // Ensure assets are loaded
    wp_enqueue_script( 'wpc-app' );
    wp_enqueue_style( 'wpc-styles' );

    $attributes = shortcode_atts( array(
        'id' => '',
        'primary_color' => '',
        'accent_color' => '',
        'banner_color' => '',
        'show_plan_buttons' => '', // '1'/'true' or '0'/'false'
        'show_footer_button' => '1',
        'footer_button_text' => '',
    ), $atts );

    if ( empty( $attributes['id'] ) ) return ''; // ID is required

    $item_id = $attributes['id'];

    // 1. Fetch Data
    // We need to fetch ALL items to find the specific one (current API structure)
    // Optimization: In a real DB scenario, we'd fetch just one. Here we rely on the cached json helper.
    if ( ! function_exists( 'wpc_get_items' ) ) { } 
    $data = wpc_get_items();
    $items = $data['items'];
    
    // Find the item
    // Use array_values to re-index after filtering to get the first match cleanly
    $found_items = array_values(array_filter($items, function($i) use ($item_id) {
        return strval($i['id']) === strval($item_id);
    }));

    if (empty($found_items)) return "<!-- WPC Pricing Table: Item ID {$item_id} not found -->";
    
    $item = $found_items[0];

    // 2. Resolve Settings
    // Priority: Shortcode Attr > Post Meta > Default
    
    // Plan Buttons
    // Priority: Shortcode Attr > Post Meta (explicit setting) > Global Default
    $show_plan_links_meta = get_post_meta($item['id'], '_wpc_show_plan_links', true); // Old meta
    $show_plan_btns_meta = get_post_meta($item['id'], '_wpc_show_plan_buttons', true); // New specific meta (1 or 0)
    
    $show_plan_buttons_val = $attributes['show_plan_buttons'];
    $show_plan_buttons = null; 
    
    // 1. Shortcode explicit
    if ($show_plan_buttons_val === '1' || strtolower($show_plan_buttons_val) === 'true') {
        $show_plan_buttons = true;
    } elseif ($show_plan_buttons_val === '0' || strtolower($show_plan_buttons_val) === 'false') {
        $show_plan_buttons = false;
    } 
    // 2. New Meta (Pricing Table Design)
    elseif ($show_plan_btns_meta !== '') {
        $show_plan_buttons = ($show_plan_btns_meta === '1');
    }
    // 3. Old Meta (List config) - partial fallback if new meta unused
    elseif ( $show_plan_links_meta === '1' ) {
         $show_plan_buttons = true;
    }
    
    // Footer Button
    $show_footer_meta = get_post_meta($item['id'], '_wpc_show_footer_button', true);
    if ($attributes['show_footer_button'] !== '1' && $attributes['show_footer_button'] !== '') {
         if ($attributes['show_footer_button'] === '0' || strtolower($attributes['show_footer_button']) === 'false') {
             $show_footer_button = false;
         } else {
             $show_footer_button = true; 
         }
    } else {
        if ($show_footer_meta === '0') {
            $show_footer_button = false;
        } else {
            $show_footer_button = true;
        }
    }

    $footer_text_meta = get_post_meta($item['id'], '_wpc_footer_button_text', true);
    $footer_button_text = !empty($attributes['footer_button_text']) ? $attributes['footer_button_text'] : $footer_text_meta;

    // 3. Scoped CSS
    $unique_id = 'wpc-pricing-' . $item_id . '-' . mt_rand(1000, 9999);
    $scoped_styles = "";
    
    // Check if Overrides are Enabled
    $enable_overrides = get_post_meta($item['id'], '_wpc_enable_design_overrides', true);

    // Only apply overriding styles if enabled (or if shortcode explicitly forces them via attrs?)
    // Decision: Shortcode attrs always win. Meta overrides only if enabled.
    
    // Colors
    $primary_meta = ($enable_overrides === '1') ? get_post_meta($item['id'], '_wpc_primary_color', true) : '';
    $accent_meta = ($enable_overrides === '1') ? get_post_meta($item['id'], '_wpc_accent_color', true) : '';
    $border_meta = ($enable_overrides === '1') ? get_post_meta($item['id'], '_wpc_border_color', true) : '';

    $primary_col = !empty($attributes['primary_color']) ? $attributes['primary_color'] : $primary_meta;
    $accent_col = !empty($attributes['accent_color']) ? $attributes['accent_color'] : $accent_meta;
    $border_col = $border_meta; // No shortcode attr for border currently, use meta

    // Helper closure to add var if color present
    $add_color_var = function($hex, $var_name) use (&$scoped_styles) {
        if (!empty($hex)) {
            // HSL conversion for primary/accent
            if (in_array($var_name, ['primary', 'accent'])) {
                $hsl = wpc_hex2hsl($hex);
                $scoped_styles .= "--{$var_name}: {$hsl}; ";
                if ($var_name === 'primary') $scoped_styles .= "--ring: {$hsl}; "; 
            } else {
                // Direct hex for border or other vars
                $scoped_styles .= "--{$var_name}: {$hex}; ";
            }
        }
    };
    
    $add_color_var($primary_col, 'primary');
    $add_color_var($accent_col, 'accent');
    $add_color_var($border_col, 'border-color-override'); // Custom var name to avoid conflict with tailwind base --border

    $css_rules = "";
    if (!empty($scoped_styles)) {
        $css_rules = "#{$unique_id} { {$scoped_styles} }";
        // Also apply to nested children that might need it if they use variables
        // But variables cascade, so ID wrapper should be enough.
    }

    if (!empty($css_rules)) {
        wp_register_style( 'wpc-pricing-inline-' . $unique_id, false );
        wp_enqueue_style( 'wpc-pricing-inline-' . $unique_id );
        wp_add_inline_style( 'wpc-pricing-inline-' . $unique_id, $css_rules );
    }

    // Config for React App
    // We pass the "view mode" as 'pricing-table'
    // item_id allows the app to fetch the full item data via API if needed, 
    // BUT we usually rely on `wpc_get_items` data embedded in window or fetched.
    // Here we might need to seed the data if it's a standalone shortcode.
    // The main-wp.tsx uses `window.wpc_items` or fetches. 
    // For single item shortcode, we should ensure this item is available.
    
    // We'll construct a direct "initial data" object for this widget instance if possible,
    // or rely on the standard `ecommerce-guider-data` localization.
    
    // Pass specific display settings for this instance
    $widget_config = [
        'viewMode' => 'pricing-table', // MATCHES main-wp.tsx check
        'item' => $item, // REQUIRED by main-wp.tsx to enter the block
        'showPlanButtons' => $show_plan_buttons,
        'showFooterButton' => $show_footer_button,
        'footerButtonText' => $footer_button_text,
        'displayContext' => 'inline', // Tell React this is the Shortcode view (Table)
    ];

    $config_json = htmlspecialchars(json_encode($widget_config), ENT_QUOTES, 'UTF-8');

    ob_start();
    ?>
    <div id="<?php echo esc_attr($unique_id); ?>" class="wpc-root" data-config="<?php echo $config_json; ?>">
        <!-- Skeleton / Loading State -->
        <div class="w-full h-64 bg-muted/10 animate-pulse rounded-xl border border-border flex items-center justify-center">
            <span class="text-muted-foreground">Loading Pricing Table...</span>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'wpc_pricing_table', 'wpc_pricing_table_shortcode' );




/**
 * Shortcode for Single Hero Section
 * Usage: [wpc_hero id="123"]
 */
function wpc_hero_shortcode( $atts ) {
    wp_enqueue_script( 'wpc-app' );
    wp_enqueue_style( 'wpc-styles' );

    $attributes = shortcode_atts( array(
        'id' => '',
    ), $atts );

    if ( empty( $attributes['id'] ) ) return '';

    // Pass config to React
    $config = array(
        'mode' => 'hero',
        'itemId' => $attributes['id'], // Updated from providerId to itemId
        // Provide legacy fallback just in case React needs it, though we refactored React to use itemId
    );
     $config_json = htmlspecialchars(json_encode($config), ENT_QUOTES, 'UTF-8');

    return '<div class="wpc-hero-root" data-config="' . $config_json . '"></div>';
}
add_shortcode( 'wpc_hero', 'wpc_hero_shortcode' );
add_shortcode( 'ecommerce_guider_hero', 'wpc_hero_shortcode' ); // Legacy Support

/**
 * Load custom template for single comparison_item
 */
function wpc_template_include( $template ) {
    if ( is_singular( 'comparison_item' ) ) {
        $new_template = plugin_dir_path( __FILE__ ) . 'templates/single-comparison_item.php';
        if ( file_exists( $new_template ) ) {
            return $new_template;
        }
    }
    // Backward compatibility for old CPT if somehow it still exists/is accessed (though we renamed register call)
    if ( is_singular( 'ecommerce_provider' ) ) {
         $new_template = plugin_dir_path( __FILE__ ) . 'templates/single-comparison_item.php';
         if ( file_exists( $new_template ) ) {
            return $new_template;
        }
    }
    return $template;
}
add_filter( 'template_include', 'wpc_template_include' );
