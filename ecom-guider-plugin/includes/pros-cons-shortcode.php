<?php
/**
 * Shortcode: [wpc_pros_cons id="123"]
 * Displays the pros/cons table for a specific item inline.
 * Matches the design and behavior of the pricing table shortcode.
 */
function wpc_pros_cons_shortcode( $atts ) {
    // Ensure assets are loaded
    wp_enqueue_script( 'wpc-app' );
    wp_enqueue_style( 'wpc-styles' );

    $attributes = shortcode_atts( array(
        'id' => '',
    ), $atts );

    if ( empty( $attributes['id'] ) ) return ''; // ID is required

    $item_id = $attributes['id'];

    // 1. Fetch Data
    if ( ! function_exists( 'wpc_get_items' ) ) { } 
    $data = wpc_get_items();
    $items = $data['items'];
    
    // Find the item
    $found_items = array_values(array_filter($items, function($i) use ($item_id) {
        return strval($i['id']) === strval($item_id);
    }));

    if (empty($found_items)) return "<!-- WPC Pros/Cons: Item ID {$item_id} not found -->";
    
    $item = $found_items[0];

    // 2. Generate unique ID
    $unique_id = 'wpc-proscons-' . $item_id . '-' . mt_rand(1000, 9999);

    // 3. Config for React App
    $widget_config = [
        'viewMode' => 'pros-cons-table',
        'item' => $item,
        'displayContext' => 'inline',
        // Per-item label overrides
        'prosLabel' => get_post_meta($item['id'], '_wpc_txt_pros_label', true) ?: get_option('wpc_text_pros', 'Pros'),
        'consLabel' => get_post_meta($item['id'], '_wpc_txt_cons_label', true) ?: get_option('wpc_text_cons', 'Cons'),
        // Per-item color overrides (respecting the enable flag)
        'prosBg' => (get_post_meta($item['id'], '_wpc_enable_pros_cons_colors', true) === '1' ? get_post_meta($item['id'], '_wpc_color_pros_bg', true) : '') ?: get_option('wpc_color_pros_bg', '#f0fdf4'),
        'prosText' => (get_post_meta($item['id'], '_wpc_enable_pros_cons_colors', true) === '1' ? get_post_meta($item['id'], '_wpc_color_pros_text', true) : '') ?: get_option('wpc_color_pros_text', '#166534'),
        'consBg' => (get_post_meta($item['id'], '_wpc_enable_pros_cons_colors', true) === '1' ? get_post_meta($item['id'], '_wpc_color_cons_bg', true) : '') ?: get_option('wpc_color_cons_bg', '#fef2f2'),
        'consText' => (get_post_meta($item['id'], '_wpc_enable_pros_cons_colors', true) === '1' ? get_post_meta($item['id'], '_wpc_color_cons_text', true) : '') ?: get_option('wpc_color_cons_text', '#991b1b'),
        // Icon settings (global only for now, per-item can be added later)
        'prosIcon' => get_option('wpc_pros_icon', '✓'),
        'consIcon' => get_option('wpc_cons_icon', '✗'),
    ];

    $config_json = htmlspecialchars(json_encode($widget_config), ENT_QUOTES, 'UTF-8');

    ob_start();
    ?>
    <div id="<?php echo esc_attr($unique_id); ?>" class="wpc-root" data-config="<?php echo $config_json; ?>">
        <!-- Skeleton / Loading State -->
        <div class="w-full h-64 bg-muted/10 animate-pulse rounded-xl border border-border flex items-center justify-center">
            <span class="text-muted-foreground"><?php echo esc_html( get_option( 'wpc_text_loading_proscons', 'Loading Pros & Cons...' ) ); ?></span>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'wpc_pros_cons', 'wpc_pros_cons_shortcode' );
