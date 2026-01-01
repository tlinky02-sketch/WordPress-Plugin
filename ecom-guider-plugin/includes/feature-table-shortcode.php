<?php
/**
 * Feature Table Shortcode
 * 
 * Displays a table comparing features across pricing plans.
 * Usage: [wpc_feature_table id="123"]
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the shortcode
 */
add_shortcode( 'wpc_feature_table', 'wpc_feature_table_shortcode' );

function wpc_feature_table_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => 0,
    ), $atts, 'wpc_feature_table' );

    $post_id = intval( $atts['id'] );
    
    if ( ! $post_id || get_post_type( $post_id ) !== 'comparison_item' ) {
        return '<!-- WPC Feature Table: Invalid ID -->';
    }

    // Get pricing plans for column headers
    $pricing_plans = get_post_meta( $post_id, '_wpc_pricing_plans', true );
    if ( ! is_array( $pricing_plans ) ) $pricing_plans = array();
    
    // Filter to only plans with names
    $plan_names = array();
    foreach ( $pricing_plans as $idx => $plan ) {
        if ( ! empty( $plan['name'] ) ) {
            $plan_names[$idx] = $plan['name'];
        }
    }

    // Get saved features
    $features = get_post_meta( $post_id, '_wpc_plan_features', true );
    if ( ! is_array( $features ) || empty( $features ) ) {
        return '<!-- WPC Feature Table: No features defined -->';
    }

    // Get display options (per-item OR fallback to global)
    $options = get_post_meta( $post_id, '_wpc_feature_table_options', true );
    if ( ! is_array( $options ) ) $options = array();
    
    // Fall back to global settings if per-item not set
    $global_display_mode = get_option( 'wpc_ft_display_mode', 'full_table' );
    $global_header_label = get_option( 'wpc_ft_header_label', 'Key Features' );
    $global_header_bg    = get_option( 'wpc_ft_header_bg', '#f3f4f6' );
    $global_check_color  = get_option( 'wpc_ft_check_color', '#10b981' );
    $global_x_color      = get_option( 'wpc_ft_x_color', '#ef4444' );
    $global_alt_row_bg   = get_option( 'wpc_ft_alt_row_bg', '#f9fafb' );

    $display_mode   = ! empty( $options['display_mode'] ) ? $options['display_mode'] : $global_display_mode;
    $header_label   = ! empty( $options['header_label'] ) ? esc_html( $options['header_label'] ) : esc_html( $global_header_label );
    $header_bg      = ! empty( $options['header_bg'] ) ? $options['header_bg'] : $global_header_bg;
    $check_color    = ! empty( $options['check_color'] ) ? $options['check_color'] : $global_check_color;
    $x_color        = ! empty( $options['x_color'] ) ? $options['x_color'] : $global_x_color;
    $alt_row_bg     = ! empty( $options['alt_row_bg'] ) ? $options['alt_row_bg'] : $global_alt_row_bg;

    // Start output buffer
    ob_start();
    ?>
    <div class="wpc-feature-table-wrapper" style="overflow-x: auto; margin: 20px 0;">
        <table class="wpc-feature-table" style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <thead>
                <tr style="background: <?php echo esc_attr( $header_bg ); ?>;">
                    <th style="padding: 16px 20px; text-align: left; font-weight: 600; font-size: 15px; border-bottom: 2px solid #e2e8f0;">
                        <?php echo $header_label; ?>
                    </th>
                    <?php if ( $display_mode === 'features_only' ) : ?>
                        <!-- Features Only: Single checkmark column -->
                        <th style="padding: 16px 20px; text-align: center; font-weight: 600; font-size: 15px; border-bottom: 2px solid #e2e8f0; width: 80px;"></th>
                    <?php elseif ( ! empty( $plan_names ) ) : ?>
                        <?php foreach ( $plan_names as $plan_name ) : ?>
                            <th style="padding: 16px 20px; text-align: center; font-weight: 600; font-size: 15px; border-bottom: 2px solid #e2e8f0; min-width: 120px;">
                                <?php echo esc_html( $plan_name ); ?>
                            </th>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $features as $idx => $feature ) : 
                    $row_bg = ( $idx % 2 === 1 ) ? $alt_row_bg : '#fff';
                ?>
                    <tr style="background: <?php echo esc_attr( $row_bg ); ?>;">
                        <td style="padding: 14px 20px; font-size: 14px; color: #374151; border-bottom: 1px solid #f0f0f0;">
                            <?php echo esc_html( $feature['name'] ); ?>
                        </td>
                        <?php if ( $display_mode === 'features_only' ) : ?>
                            <!-- Features Only: Show checkmark for each feature -->
                            <td style="padding: 14px 20px; text-align: center; border-bottom: 1px solid #f0f0f0;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr( $check_color ); ?>" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9 12l2 2 4-4"></path>
                                </svg>
                            </td>
                        <?php elseif ( ! empty( $plan_names ) ) : ?>
                            <?php foreach ( $plan_names as $plan_idx => $plan_name ) : 
                                $is_available = ! empty( $feature['plans'][$plan_idx] );
                            ?>
                                <td style="padding: 14px 20px; text-align: center; border-bottom: 1px solid #f0f0f0;">
                                    <?php if ( $is_available ) : ?>
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr( $check_color ); ?>" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block;">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M9 12l2 2 4-4"></path>
                                        </svg>
                                    <?php else : ?>
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr( $x_color ); ?>" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block;">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    return ob_get_clean();
}
