<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Settings Page for Global Plugin Settings
 */
add_action( 'admin_menu', 'wpc_add_settings_page' );
function wpc_add_settings_page() {
    add_submenu_page(
        'edit.php?post_type=comparison_item',
        __( 'Settings', 'wp-comparison-builder' ),
        __( 'Settings', 'wp-comparison-builder' ),
        'manage_options',
        'wpc-settings',
        'wpc_render_settings_page'
    );
}

/**
 * Register Settings
 */
add_action( 'admin_init', 'wpc_register_settings' );
function wpc_register_settings() {
    // Register Settings
    register_setting( 'wpc_settings_group', 'wpc_primary_color' );
    register_setting( 'wpc_settings_group', 'wpc_accent_color' );
    register_setting( 'wpc_settings_group', 'wpc_secondary_color' );
    register_setting( 'wpc_settings_group', 'wpc_card_border_color' );
    register_setting( 'wpc_settings_group', 'wpc_pricing_banner_color' );
    register_setting( 'wpc_settings_group', 'wpc_button_hover_color' );
    
    // Show Plan Buttons Setting
    register_setting( 'wpc_settings_group', 'wpc_show_plan_buttons' );
    register_setting( 'wpc_settings_group', 'wpc_show_footer_button_global' );
    
    // Filter Style Setting
    register_setting( 'wpc_settings_group', 'wpc_filter_style' );
    
    // Search Type Setting (Global)
    register_setting( 'wpc_settings_group', 'wpc_search_type' );

    // Link Behavior (New Tab)
    register_setting( 'wpc_settings_group', 'wpc_target_details' );
    register_setting( 'wpc_settings_group', 'wpc_target_direct' );
    register_setting( 'wpc_settings_group', 'wpc_target_pricing' );

    // Legacy (keep for fallback if needed, or remove if migrated? Keeping for now)
    // register_setting( 'wpc_settings_group', 'wpc_open_links_new_tab' );

    // List Style Global Default
    register_setting( 'wpc_settings_group', 'wpc_default_list_style' );

    // Pricing Table Visuals
    register_setting( 'wpc_settings_group', 'wpc_pt_header_bg' );
    register_setting( 'wpc_settings_group', 'wpc_pt_header_text' );
    register_setting( 'wpc_settings_group', 'wpc_pt_btn_bg' );
    register_setting( 'wpc_settings_group', 'wpc_pt_btn_text' );
    // Position Settings
    register_setting( 'wpc_settings_group', 'wpc_pt_btn_pos_table' );
    register_setting( 'wpc_settings_group', 'wpc_pt_btn_pos_popup' );

    // Text Label Settings
    register_setting( 'wpc_settings_group', 'wpc_text_view_details' );
    register_setting( 'wpc_settings_group', 'wpc_text_compare_alternatives' );
    register_setting( 'wpc_settings_group', 'wpc_text_compare_now' );
    register_setting( 'wpc_settings_group', 'wpc_text_reviews' );
    register_setting( 'wpc_settings_group', 'wpc_text_back_to_reviews' );
    register_setting( 'wpc_settings_group', 'wpc_text_filters' );
    register_setting( 'wpc_settings_group', 'wpc_text_search_placeholder' );
    register_setting( 'wpc_settings_group', 'wpc_text_category' );
    register_setting( 'wpc_settings_group', 'wpc_text_features' );
    register_setting( 'wpc_settings_group', 'wpc_text_items_count' );
    register_setting( 'wpc_settings_group', 'wpc_text_selected' );
    register_setting( 'wpc_settings_group', 'wpc_text_clear_all' );
    register_setting( 'wpc_settings_group', 'wpc_text_visit' ); // "Visit" (short)
    register_setting( 'wpc_settings_group', 'wpc_text_about' );
    register_setting( 'wpc_settings_group', 'wpc_text_sort_default' );
    
    // New Configurable Text Fields
    register_setting( 'wpc_settings_group', 'wpc_text_feat_header' );
    register_setting( 'wpc_settings_group', 'wpc_text_feat_prod' );
    register_setting( 'wpc_settings_group', 'wpc_text_feat_fees' );
    register_setting( 'wpc_settings_group', 'wpc_text_feat_channels' );
    register_setting( 'wpc_settings_group', 'wpc_text_feat_ssl' );
    register_setting( 'wpc_settings_group', 'wpc_text_feat_supp' );
    register_setting( 'wpc_settings_group', 'wpc_text_pros' );
    register_setting( 'wpc_settings_group', 'wpc_text_cons' );
    register_setting( 'wpc_settings_group', 'wpc_text_price' );
    register_setting( 'wpc_settings_group', 'wpc_text_rating' );
    register_setting( 'wpc_settings_group', 'wpc_text_mo_suffix' );
    
    // New Misc Configurable Texts
    register_setting( 'wpc_settings_group', 'wpc_text_no_compare' );
    register_setting( 'wpc_settings_group', 'wpc_text_remove' );
    register_setting( 'wpc_settings_group', 'wpc_text_logo' );
    register_setting( 'wpc_settings_group', 'wpc_text_analysis' );
    register_setting( 'wpc_settings_group', 'wpc_text_start_price' );
    register_setting( 'wpc_settings_group', 'wpc_text_dash_prev' );
    
    // Filter & Search Internal Labels
    register_setting( 'wpc_settings_group', 'wpc_text_reset_filt' );
    register_setting( 'wpc_settings_group', 'wpc_text_select_fmt' );
    register_setting( 'wpc_settings_group', 'wpc_text_clear' );
    register_setting( 'wpc_settings_group', 'wpc_text_sel_prov' );
    register_setting( 'wpc_settings_group', 'wpc_text_no_item' );
    register_setting( 'wpc_settings_group', 'wpc_text_more' );
    
    // Additional UI Texts (Show All card)
    register_setting( 'wpc_settings_group', 'wpc_text_show_all' );
    register_setting( 'wpc_settings_group', 'wpc_text_reveal_more' );
    register_setting( 'wpc_settings_group', 'wpc_text_no_logo' );
    
    // Additional UI Texts (Missing - New)
    register_setting( 'wpc_settings_group', 'wpc_text_visit_site' );
    register_setting( 'wpc_settings_group', 'wpc_text_copied' );
    register_setting( 'wpc_settings_group', 'wpc_text_selected' );
    register_setting( 'wpc_settings_group', 'wpc_text_compare_now' );
    register_setting( 'wpc_settings_group', 'wpc_text_category' );
    register_setting( 'wpc_settings_group', 'wpc_text_features' );
    register_setting( 'wpc_settings_group', 'wpc_text_filters' );
    register_setting( 'wpc_settings_group', 'wpc_text_search' );
    register_setting( 'wpc_settings_group', 'wpc_text_coupon_label' );
    
    // Color Settings
    register_setting( 'wpc_settings_group', 'wpc_color_pros_bg' );
    register_setting( 'wpc_settings_group', 'wpc_color_pros_text' );
    register_setting( 'wpc_settings_group', 'wpc_color_cons_bg' );
    register_setting( 'wpc_settings_group', 'wpc_color_cons_text' );
    register_setting( 'wpc_settings_group', 'wpc_color_coupon_bg' );
    register_setting( 'wpc_settings_group', 'wpc_color_coupon_text' );
    register_setting( 'wpc_settings_group', 'wpc_color_coupon_hover' );
    register_setting( 'wpc_settings_group', 'wpc_color_copied' );
    
    // Plan Features Global Settings
    register_setting( 'wpc_settings_group', 'wpc_ft_display_mode' );
    register_setting( 'wpc_settings_group', 'wpc_ft_header_label' );
    register_setting( 'wpc_settings_group', 'wpc_ft_header_bg' );
    register_setting( 'wpc_settings_group', 'wpc_ft_check_color' );
    register_setting( 'wpc_settings_group', 'wpc_ft_x_color' );
    register_setting( 'wpc_settings_group', 'wpc_ft_alt_row_bg' );
}

/**
 * Handle Import/Export AJAX
 */
add_action( 'wp_ajax_wpc_export_data', 'wpc_handle_export_data' );
function wpc_handle_export_data() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );
    
    // Get selected export types (default to all)
    $export_types = isset( $_POST['export_types'] ) ? json_decode( stripslashes( $_POST['export_types'] ), true ) : array();
    if ( empty( $export_types ) ) {
        $export_types = array( 'items', 'categories', 'features', 'lists', 'settings' );
    }
    $should_export = array_flip( $export_types );

    $export_data = array(
        'version' => '1.0',
        'exported_at' => current_time( 'mysql' ),
        'site_url' => get_site_url(),
        'categories' => array(),
        'features' => array(),
        'comparison_items' => array(),
        'custom_lists' => array(),
        'settings' => array(),
    );

    // Export Categories (Taxonomy Terms)
    if ( isset( $should_export['categories'] ) ) {
        $cat_terms = get_terms( array( 'taxonomy' => 'comparison_category', 'hide_empty' => false ) );
        if ( ! is_wp_error( $cat_terms ) ) {
            foreach ( $cat_terms as $term ) {
                $export_data['categories'][] = array(
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'description' => $term->description,
                );
            }
        }
    }

    // Export Features (Taxonomy Terms)
    if ( isset( $should_export['features'] ) ) {
        $feat_terms = get_terms( array( 'taxonomy' => 'comparison_feature', 'hide_empty' => false ) );
        if ( ! is_wp_error( $feat_terms ) ) {
            foreach ( $feat_terms as $term ) {
                $export_data['features'][] = array(
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'description' => $term->description,
                );
            }
        }
    }

    // Export Comparison Items
    if ( isset( $should_export['items'] ) ) {
        $items = get_posts( array(
            'post_type' => 'comparison_item',
            'posts_per_page' => -1,
            'post_status' => array( 'publish', 'draft' ),
        ));

        foreach ( $items as $item ) {
            $item_data = array(
                'post_title' => $item->post_title,
                'post_name' => $item->post_name,
                'post_status' => $item->post_status,
                'post_content' => $item->post_content,
                'meta' => array(),
            );

            // Get all meta for this item
            $all_meta = get_post_meta( $item->ID );
            foreach ( $all_meta as $key => $value ) {
                if ( strpos( $key, '_wpc_' ) === 0 || strpos( $key, 'wpc_' ) === 0 ) {
                    $item_data['meta'][ $key ] = maybe_unserialize( $value[0] );
                }
            }

            // Get taxonomies
            $categories = wp_get_post_terms( $item->ID, 'comparison_category', array( 'fields' => 'slugs' ) );
            $features = wp_get_post_terms( $item->ID, 'comparison_feature', array( 'fields' => 'slugs' ) );
            $item_data['categories'] = is_array( $categories ) ? $categories : array();
            $item_data['features'] = is_array( $features ) ? $features : array();

            $export_data['comparison_items'][] = $item_data;
        }
    }

    // Export Custom Lists
    if ( isset( $should_export['lists'] ) ) {
        $lists = get_posts( array(
            'post_type' => 'comparison_list',
            'posts_per_page' => -1,
            'post_status' => array( 'publish', 'draft' ),
        ));

        foreach ( $lists as $list ) {
            $list_data = array(
                'post_title' => $list->post_title,
                'post_name' => $list->post_name,
                'post_status' => $list->post_status,
                'meta' => array(),
            );

            $all_meta = get_post_meta( $list->ID );
            foreach ( $all_meta as $key => $value ) {
                if ( strpos( $key, '_wpc_' ) === 0 || strpos( $key, 'wpc_' ) === 0 ) {
                    $list_data['meta'][ $key ] = maybe_unserialize( $value[0] );
                }
            }

            $export_data['custom_lists'][] = $list_data;
        }
    }

    // Export Settings
    if ( isset( $should_export['settings'] ) ) {
        $settings_to_export = array(
            'wpc_primary_color',
            'wpc_accent_color',
            'wpc_secondary_color',
            'wpc_card_border_color',
            'wpc_pricing_banner_color',
            'wpc_button_hover_color',
            'wpc_show_plan_buttons',
            'wpc_show_footer_button_global',
            'wpc_filter_style',
            'wpc_pt_header_bg',
            'wpc_pt_header_text',
            'wpc_pt_btn_bg',
            'wpc_pt_btn_text',
            'wpc_pt_btn_pos_table',
            'wpc_pt_btn_pos_popup',
            'wpc_schema_settings',
        );

        foreach ( $settings_to_export as $setting ) {
            $export_data['settings'][ $setting ] = get_option( $setting );
        }
    }

    wp_send_json_success( $export_data );
}

add_action( 'wp_ajax_wpc_import_data', 'wpc_handle_import_data' );
function wpc_handle_import_data() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );

    $json_data = isset( $_POST['json_data'] ) ? $_POST['json_data'] : '';
    $overwrite = isset( $_POST['overwrite'] ) && $_POST['overwrite'] === 'true';

    if ( empty( $json_data ) ) {
        wp_send_json_error( 'No data provided' );
    }

    $data = json_decode( stripslashes( $json_data ), true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        wp_send_json_error( 'Invalid JSON: ' . json_last_error_msg() );
    }

    $results = array(
        'items_created' => 0,
        'items_updated' => 0,
        'lists_created' => 0,
        'lists_updated' => 0,
        'settings_updated' => 0,
    );

    // Import Comparison Items (only if allowed)
    $import_items = isset( $_POST['import_items'] ) && $_POST['import_items'] === 'true';
    if ( $import_items && ! empty( $data['comparison_items'] ) ) {
        foreach ( $data['comparison_items'] as $item_data ) {
            $existing = get_page_by_path( $item_data['post_name'], OBJECT, 'comparison_item' );
            
            if ( $existing && $overwrite ) {
                // Update existing
                wp_update_post( array(
                    'ID' => $existing->ID,
                    'post_title' => $item_data['post_title'],
                    'post_content' => $item_data['post_content'] ?? '',
                    'post_status' => $item_data['post_status'],
                ));
                $post_id = $existing->ID;
                $results['items_updated']++;
            } elseif ( ! $existing ) {
                // Create new
                $post_id = wp_insert_post( array(
                    'post_type' => 'comparison_item',
                    'post_title' => $item_data['post_title'],
                    'post_name' => $item_data['post_name'],
                    'post_content' => $item_data['post_content'] ?? '',
                    'post_status' => $item_data['post_status'],
                ));
                $results['items_created']++;
            } else {
                continue; // Skip if exists and not overwriting
            }

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                // Import meta
                if ( ! empty( $item_data['meta'] ) ) {
                    foreach ( $item_data['meta'] as $key => $value ) {
                        // Convert arrays to newline-separated strings for textarea fields
                        if ( in_array( $key, ['_wpc_pros', '_wpc_cons'], true ) && is_array( $value ) ) {
                            $value = implode( "\n", $value );
                        }
                        // Convert pricing plan fields and map JSON names to WordPress field names
                        if ( $key === '_wpc_pricing_plans' && is_array( $value ) ) {
                            foreach ( $value as &$plan ) {
                                // Map JSON field names to WordPress field names
                                if ( isset( $plan['cta_url'] ) && !isset( $plan['link'] ) ) {
                                    $plan['link'] = $plan['cta_url'];
                                    unset( $plan['cta_url'] );
                                }
                                if ( isset( $plan['cta_text'] ) && !isset( $plan['button_text'] ) ) {
                                    $plan['button_text'] = $plan['cta_text'];
                                    unset( $plan['cta_text'] );
                                }
                                // Handle discount_badge -> banner_text mapping
                                if ( isset( $plan['discount_badge'] ) && !isset( $plan['banner_text'] ) ) {
                                    $plan['banner_text'] = $plan['discount_badge'];
                                    $plan['show_banner'] = '1';
                                    unset( $plan['discount_badge'] );
                                }
                                // Handle original_price -> show_banner
                                if ( isset( $plan['original_price'] ) && !isset( $plan['show_banner'] ) ) {
                                    $plan['show_banner'] = '1';
                                }
                                // Set default visibility flags if not present
                                if ( !isset( $plan['show_popup'] ) ) {
                                    $plan['show_popup'] = '1';
                                }
                                if ( !isset( $plan['show_table'] ) ) {
                                    $plan['show_table'] = '1';
                                }
                                if ( !isset( $plan['banner_color'] ) && isset( $plan['show_banner'] ) ) {
                                    $plan['banner_color'] = '#10b981';
                                }
                                // Convert features array to newline string
                                if ( isset( $plan['features'] ) && is_array( $plan['features'] ) ) {
                                    $plan['features'] = implode( "\n", $plan['features'] );
                                }
                            }
                        }
                        update_post_meta( $post_id, $key, $value );
                    }
                }

                // Import taxonomies
                if ( ! empty( $item_data['categories'] ) ) {
                    wp_set_object_terms( $post_id, $item_data['categories'], 'comparison_category' );
                }
                if ( ! empty( $item_data['features'] ) ) {
                    wp_set_object_terms( $post_id, $item_data['features'], 'comparison_feature' );
                }
            }
        }
    }

    // Import Custom Lists (only if allowed)
    $import_lists = isset( $_POST['import_lists'] ) && $_POST['import_lists'] === 'true';
    if ( $import_lists && ! empty( $data['custom_lists'] ) ) {
        foreach ( $data['custom_lists'] as $list_data ) {
            $existing = get_page_by_path( $list_data['post_name'], OBJECT, 'comparison_list' );
            
            if ( $existing && $overwrite ) {
                wp_update_post( array(
                    'ID' => $existing->ID,
                    'post_title' => $list_data['post_title'],
                    'post_status' => $list_data['post_status'],
                ));
                $post_id = $existing->ID;
                $results['lists_updated']++;
            } elseif ( ! $existing ) {
                $post_id = wp_insert_post( array(
                    'post_type' => 'comparison_list',
                    'post_title' => $list_data['post_title'],
                    'post_name' => $list_data['post_name'],
                    'post_status' => $list_data['post_status'],
                ));
                $results['lists_created']++;
            } else {
                continue;
            }

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                if ( ! empty( $list_data['meta'] ) ) {
                    foreach ( $list_data['meta'] as $key => $value ) {
                        update_post_meta( $post_id, $key, $value );
                    }
                }
            }
        }
    }

    // Import Settings (only if allowed)
    $import_settings = isset( $_POST['import_settings'] ) && $_POST['import_settings'] === 'true';
    if ( $import_settings && ! empty( $data['settings'] ) ) {
        foreach ( $data['settings'] as $key => $value ) {
            if ( strpos( $key, 'wpc_' ) === 0 ) {
                update_option( $key, $value );
                $results['settings_updated']++;
            }
        }
    }

    // Import Categories (taxonomy terms)
    $import_categories = isset( $_POST['import_categories'] ) && $_POST['import_categories'] === 'true';
    if ( $import_categories && ! empty( $data['categories'] ) ) {
        foreach ( $data['categories'] as $cat ) {
            if ( ! term_exists( $cat['slug'], 'comparison_category' ) ) {
                wp_insert_term( $cat['name'], 'comparison_category', array(
                    'slug' => $cat['slug'],
                    'description' => $cat['description'] ?? '',
                ));
                $results['categories_created'] = ( $results['categories_created'] ?? 0 ) + 1;
            }
        }
    }

    // Import Features (taxonomy terms)
    $import_features = isset( $_POST['import_features'] ) && $_POST['import_features'] === 'true';
    if ( $import_features && ! empty( $data['features'] ) ) {
        foreach ( $data['features'] as $feat ) {
            if ( ! term_exists( $feat['slug'], 'comparison_feature' ) ) {
                wp_insert_term( $feat['name'], 'comparison_feature', array(
                    'slug' => $feat['slug'],
                    'description' => $feat['description'] ?? '',
                ));
                $results['features_created'] = ( $results['features_created'] ?? 0 ) + 1;
            }
        }
    }

    wp_send_json_success( $results );
}

/**
 * Detect conflicts before import
 */
add_action( 'wp_ajax_wpc_detect_conflicts', 'wpc_detect_conflicts' );
function wpc_detect_conflicts() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );

    $json_data = isset( $_POST['json_data'] ) ? $_POST['json_data'] : '';
    if ( empty( $json_data ) ) {
        wp_send_json_error( 'No data provided' );
    }

    $data = json_decode( stripslashes( $json_data ), true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        wp_send_json_error( 'Invalid JSON' );
    }

    $conflicts = array();
    $new_items = array();

    // Check items
    if ( ! empty( $data['comparison_items'] ) ) {
        foreach ( $data['comparison_items'] as $item_data ) {
            $existing = get_page_by_path( $item_data['post_name'], OBJECT, 'comparison_item' );
            if ( $existing ) {
                $conflicts[] = array(
                    'type' => 'item',
                    'slug' => $item_data['post_name'],
                    'title' => $item_data['post_title'],
                );
            } else {
                $new_items[] = array(
                    'type' => 'item',
                    'slug' => $item_data['post_name'],
                    'title' => $item_data['post_title'],
                );
            }
        }
    }

    // Check lists
    if ( ! empty( $data['custom_lists'] ) ) {
        foreach ( $data['custom_lists'] as $list_data ) {
            $existing = get_page_by_path( $list_data['post_name'], OBJECT, 'comparison_list' );
            if ( $existing ) {
                $conflicts[] = array(
                    'type' => 'list',
                    'slug' => $list_data['post_name'],
                    'title' => $list_data['post_title'],
                );
            } else {
                $new_items[] = array(
                    'type' => 'list',
                    'slug' => $list_data['post_name'],
                    'title' => $list_data['post_title'],
                );
            }
        }
    }

    wp_send_json_success( array(
        'conflicts' => $conflicts,
        'new_items' => $new_items,
        'summary' => array(
            'categories_count' => count( $data['categories'] ?? array() ),
            'features_count' => count( $data['features'] ?? array() ),
            'items_count' => count( $data['comparison_items'] ?? array() ),
            'lists_count' => count( $data['custom_lists'] ?? array() ),
        ),
    ));
}

/**
 * Reset settings to defaults
 */
add_action( 'wp_ajax_wpc_reset_settings', 'wpc_reset_settings' );
function wpc_reset_settings() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );

    $defaults = array(
        'wpc_primary_color' => '#6366f1',
        'wpc_accent_color' => '#0d9488',
        'wpc_secondary_color' => '#1e293b',
        'wpc_card_border_color' => '#e2e8f0',
        'wpc_pricing_banner_color' => '#10b981',
        'wpc_button_hover_color' => '',
        'wpc_show_plan_buttons' => '1',
        'wpc_show_footer_button_global' => '1',
        'wpc_filter_style' => 'top',
        'wpc_pt_header_bg' => '#f8fafc',
        'wpc_pt_header_text' => '#0f172a',
        'wpc_pt_btn_bg' => '#0f172a',
        'wpc_pt_btn_text' => '#ffffff',
        'wpc_pt_btn_pos_table' => 'after_price',
        'wpc_pt_btn_pos_table' => 'after_price',
        'wpc_pt_btn_pos_popup' => 'after_price',
        'wpc_target_details' => '_blank',
        'wpc_target_direct' => '_blank',
        'wpc_target_details' => '_blank',
        'wpc_target_direct' => '_blank',
        'wpc_target_pricing' => '_blank',
        'wpc_default_list_style' => 'grid',
    );

    foreach ( $defaults as $key => $value ) {
        update_option( $key, $value );
    }

    wp_send_json_success( 'Settings reset to defaults' );
}

/**
 * Delete all data and reset settings
 */
add_action( 'wp_ajax_wpc_delete_all_data', 'wpc_delete_all_data' );
function wpc_delete_all_data() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );

    $results = array(
        'items_deleted' => 0,
        'lists_deleted' => 0,
        'categories_deleted' => 0,
        'features_deleted' => 0,
    );

    // Delete all comparison items
    $items = get_posts( array( 'post_type' => 'comparison_item', 'posts_per_page' => -1, 'fields' => 'ids' ) );
    foreach ( $items as $id ) {
        wp_delete_post( $id, true );
        $results['items_deleted']++;
    }

    // Delete all custom lists
    $lists = get_posts( array( 'post_type' => 'comparison_list', 'posts_per_page' => -1, 'fields' => 'ids' ) );
    foreach ( $lists as $id ) {
        wp_delete_post( $id, true );
        $results['lists_deleted']++;
    }

    // Delete all categories
    $cats = get_terms( array( 'taxonomy' => 'comparison_category', 'hide_empty' => false, 'fields' => 'ids' ) );
    if ( ! is_wp_error( $cats ) ) {
        foreach ( $cats as $term_id ) {
            wp_delete_term( $term_id, 'comparison_category' );
            $results['categories_deleted']++;
        }
    }

    // Delete all features
    $feats = get_terms( array( 'taxonomy' => 'comparison_feature', 'hide_empty' => false, 'fields' => 'ids' ) );
    if ( ! is_wp_error( $feats ) ) {
        foreach ( $feats as $term_id ) {
            wp_delete_term( $term_id, 'comparison_feature' );
            $results['features_deleted']++;
        }
    }

    // Reset settings to defaults
    $defaults = array(
        'wpc_primary_color' => '#6366f1',
        'wpc_accent_color' => '#0d9488',
        'wpc_secondary_color' => '#1e293b',
        'wpc_card_border_color' => '#e2e8f0',
        'wpc_pricing_banner_color' => '#10b981',
        'wpc_button_hover_color' => '',
        'wpc_show_plan_buttons' => '1',
        'wpc_show_footer_button_global' => '1',
        'wpc_filter_style' => 'top',
    );

    foreach ( $defaults as $key => $value ) {
        update_option( $key, $value );
    }

    wp_send_json_success( $results );
}

/**
 * Apply Theme Preset
 */
add_action( 'wp_ajax_wpc_apply_theme_preset', 'wpc_apply_theme_preset' );
function wpc_apply_theme_preset() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }

    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );

    $theme = isset( $_POST['theme'] ) ? sanitize_text_field( $_POST['theme'] ) : 'indigo';
    
    $themes = array(
        'indigo' => array(
            'wpc_primary_color' => '#6366f1',
            'wpc_accent_color' => '#0d9488',
            'wpc_secondary_color' => '#1e293b',
            'wpc_card_border_color' => '#e2e8f0',
            'wpc_pricing_banner_color' => '#10b981',
            'wpc_pt_header_bg' => '#f8fafc',
            'wpc_pt_header_text' => '#0f172a',
            'wpc_pt_btn_bg' => '#0f172a',
            'wpc_pt_btn_text' => '#ffffff',
            'wpc_color_pros_bg' => '#f0fdf4',
            'wpc_color_pros_text' => '#166534',
            'wpc_color_cons_bg' => '#fef2f2',
            'wpc_color_cons_text' => '#991b1b',
            'wpc_color_coupon_bg' => '#fef3c7',
            'wpc_color_coupon_text' => '#92400e',
        ),
        'emerald' => array(
            'wpc_primary_color' => '#10b981',
            'wpc_accent_color' => '#3b82f6',
            'wpc_secondary_color' => '#064e3b',
             'wpc_card_border_color' => '#d1fae5',
            'wpc_pricing_banner_color' => '#059669',
            'wpc_pt_header_bg' => '#ecfdf5',
            'wpc_pt_header_text' => '#064e3b',
            'wpc_pt_btn_bg' => '#059669',
            'wpc_pt_btn_text' => '#ffffff',
             'wpc_color_pros_bg' => '#ecfdf5',
            'wpc_color_pros_text' => '#065f46',
            'wpc_color_cons_bg' => '#fff1f2',
            'wpc_color_cons_text' => '#9f1239',
            'wpc_color_coupon_bg' => '#ffedd5',
            'wpc_color_coupon_text' => '#c2410c',
        ),
        'sunset' => array(
            'wpc_primary_color' => '#f97316',
            'wpc_accent_color' => '#be123c',
            'wpc_secondary_color' => '#431407',
            'wpc_card_border_color' => '#ffedd5',
            'wpc_pricing_banner_color' => '#ea580c',
            'wpc_pt_header_bg' => '#fff7ed',
            'wpc_pt_header_text' => '#7c2d12',
            'wpc_pt_btn_bg' => '#ea580c',
            'wpc_pt_btn_text' => '#ffffff',
            'wpc_color_pros_bg' => '#fff7ed',
            'wpc_color_pros_text' => '#9a3412',
            'wpc_color_cons_bg' => '#fef2f2',
            'wpc_color_cons_text' => '#991b1b',
            'wpc_color_coupon_bg' => '#fee2e2',
            'wpc_color_coupon_text' => '#991b1b',
        ),
        'ocean' => array(
            'wpc_primary_color' => '#0ea5e9', // Sky
            'wpc_accent_color' => '#6366f1', // Indigo
            'wpc_secondary_color' => '#0c4a6e', // Sky 900
            'wpc_card_border_color' => '#e0f2fe',
            'wpc_pricing_banner_color' => '#0284c7',
            'wpc_pt_header_bg' => '#f0f9ff',
            'wpc_pt_header_text' => '#075985',
            'wpc_pt_btn_bg' => '#0284c7',
            'wpc_pt_btn_text' => '#ffffff',
            'wpc_color_pros_bg' => '#f0f9ff',
            'wpc_color_pros_text' => '#0369a1',
            'wpc_color_cons_bg' => '#fef2f2',
            'wpc_color_cons_text' => '#b91c1c',
            'wpc_color_coupon_bg' => '#e0e7ff',
            'wpc_color_coupon_text' => '#3730a3',
        ),
         'minimal' => array(
            'wpc_primary_color' => '#0f172a', // Slate 900
            'wpc_accent_color' => '#64748b', // Slate 500
            'wpc_secondary_color' => '#334155', 
            'wpc_card_border_color' => '#e2e8f0',
            'wpc_pricing_banner_color' => '#000000',
            'wpc_pt_header_bg' => '#ffffff',
            'wpc_pt_header_text' => '#0f172a',
            'wpc_pt_btn_bg' => '#0f172a',
            'wpc_pt_btn_text' => '#ffffff',
            'wpc_color_pros_bg' => '#f8fafc',
            'wpc_color_pros_text' => '#0f172a',
            'wpc_color_cons_bg' => '#f8fafc',
            'wpc_color_cons_text' => '#0f172a',
            'wpc_color_coupon_bg' => '#f1f5f9',
            'wpc_color_coupon_text' => '#0f172a',
        ),
    );

    if ( isset( $themes[$theme] ) ) {
        foreach ( $themes[$theme] as $key => $value ) {
            update_option( $key, $value );
        }
        wp_send_json_success( 'Theme applied successfully' );
    } else {
        wp_send_json_error( 'Theme not found' );
    }
}

/**
 * Render Settings Page
 */
function wpc_render_settings_page() {
    ?>
    <div class="wrap" style="padding-bottom: 60px;">
        <h1><?php _e( 'Comparison Builder Settings', 'wp-comparison-builder' ); ?></h1>
        
        <!-- Premium UI Helpers -->
        <style>
            .wpc-modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 10000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
            .wpc-modal { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1); width: 90%; max-width: 450px; animation: wpcSlideDown 0.2s ease-out; border: 1px solid #e2e8f0; }
            .wpc-modal h3 { margin-top: 0; color: #0f172a; font-size: 20px; font-weight: 600; margin-bottom: 10px; }
            .wpc-modal p { color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 25px; }
            .wpc-modal-actions { display: flex; justify-content: flex-end; gap: 12px; }
            .wpc-modal-actions .button { padding: 6px 16px; height: auto; font-size: 14px; }
            .wpc-modal-actions .button-primary { background: #6366f1; border-color: #6366f1; transition: all 0.2s; }
            .wpc-modal-actions .button-primary:hover { background: #4f46e5; border-color: #4f46e5; }
            
            .wpc-toast { position: fixed; bottom: 30px; right: 30px; background: #fff; border-left: 5px solid #10b981; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); z-index: 10001; font-weight: 500; font-size: 14px; color: #334155; animation: wpcSlideIn 0.3s ease-out; display: none; align-items: center; gap: 12px; max-width: 400px; }
            .wpc-toast.error { border-left-color: #ef4444; }
            .wpc-toast-icon { font-size: 18px; }
            
            @keyframes wpcSlideDown { from { opacity: 0; transform: translateY(-20px) scale(0.95); } to { opacity: 1; transform: translateY(0) scale(1); } }
            @keyframes wpcSlideIn { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
            
            /* Loading Spinner */
            .wpc-spinner-icon { width: 16px; height: 16px; border: 2px solid #e2e8f0; border-top-color: currentColor; border-radius: 50%; animation: wpcSpin 0.6s linear infinite; display: inline-block; vertical-align: middle; margin-right: 8px; }
            @keyframes wpcSpin { to { transform: rotate(360deg); } }
        </style>
        
        <div id="wpc-premium-modal" class="wpc-modal-overlay">
            <div class="wpc-modal">
                <h3 id="wpc-modal-title">Confirm Action</h3>
                <p id="wpc-modal-message">Are you sure you want to proceed?</p>
                <div class="wpc-modal-actions">
                    <button id="wpc-modal-cancel-btn" class="button">Cancel</button>
                    <button id="wpc-modal-confirm-btn" class="button button-primary">Confirm</button>
                </div>
            </div>
        </div>
        
        <div id="wpc-toast" class="wpc-toast">
            <span class="wpc-toast-icon">&#x2713;</span>
            <span id="wpc-toast-message">Operation successful</span>
        </div>
        
        <script>
        window.wpcAdmin = {
            toast: function(msg, type='success') {
                var t = document.getElementById('wpc-toast');
                var m = document.getElementById('wpc-toast-message');
                var i = t.querySelector('.wpc-toast-icon');
                
                t.className = 'wpc-toast ' + type;
                m.innerText = msg;
                i.innerText = type === 'success' ? '&#x2713;' : '&#x26A0;&#xFE0F;';
                i.style.color = type === 'success' ? '#10b981' : '#ef4444';
                
                t.style.display = 'flex';
                setTimeout(function() {
                    t.style.display = 'none';
                }, 4000);
            },
            
            confirm: function(title, msg, onConfirm, confirmText='Confirm', confirmColor='#6366f1') {
                var modal = document.getElementById('wpc-premium-modal');
                document.getElementById('wpc-modal-title').innerText = title;
                document.getElementById('wpc-modal-message').innerHTML = msg; // Allowed HTML
                
                var btn = document.getElementById('wpc-modal-confirm-btn');
                btn.innerText = confirmText;
                btn.style.background = confirmColor;
                btn.style.borderColor = confirmColor;
                
                // Clone button to remove old listeners
                var newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
                
                newBtn.addEventListener('click', function() {
                    modal.style.display = 'none';
                    if (onConfirm) onConfirm();
                });
                
                var cancelBtn = document.getElementById('wpc-modal-cancel-btn');
                var newCancel = cancelBtn.cloneNode(true);
                cancelBtn.parentNode.replaceChild(newCancel, cancelBtn);
                
                newCancel.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
                
                modal.style.display = 'flex';
            },
            
            loading: function(btn, text='Processing...') {
                if (!btn) return;
                btn.dataset.originalText = btn.innerText;
                btn.disabled = true;
                btn.innerHTML = '<span class="wpc-spinner-icon"></span> ' + text;
            },
            
            reset: function(btn) {
                if (!btn) return;
                btn.disabled = false;
                btn.innerText = btn.dataset.originalText || 'Save';
            }
        };
        </script>
        
        <!-- Tab Navigation -->
        <nav class="nav-tab-wrapper wpc-tabs-nav" style="margin-bottom: 20px;">
            <a href="#" class="nav-tab nav-tab-active" data-tab="general">
                <?php _e( 'General & Visuals', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="texts">
                <?php _e( 'Text Labels', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="pricing">
                <?php _e( 'Pricing Table', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="schema-seo">
                <?php _e( 'Schema SEO', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="links">
                <?php _e( 'Link Behavior', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="import-export">
                <?php _e( 'Import / Export', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="json-schema">
                <?php _e( 'JSON Schema', 'wp-comparison-builder' ); ?>
            </a>
            <a href="#" class="nav-tab" data-tab="danger-zone" style="color: #d32f2f;">
                <?php _e( '&#x26A0;&#xFE0F; Danger Zone', 'wp-comparison-builder' ); ?>
            </a>
        </nav>

        <!-- Tab Contents -->
        <div class="wpc-tab-content" id="wpc-tab-general">
            <?php wpc_render_general_tab(); ?>
        </div>

        <div class="wpc-tab-content" id="wpc-tab-links" style="display: none;">
            <?php wpc_render_links_tab(); ?>
        </div>

        <div class="wpc-tab-content" id="wpc-tab-texts" style="display: none;">
            <?php wpc_render_texts_tab(); ?>
        </div>
        
        <div class="wpc-tab-content" id="wpc-tab-pricing" style="display: none;">
            <?php wpc_render_pricing_tab(); ?>
        </div>
        
        <div class="wpc-tab-content" id="wpc-tab-schema-seo" style="display: none;">
            <?php wpc_render_schema_seo_tab(); ?>
        </div>
        
        <div class="wpc-tab-content" id="wpc-tab-import-export" style="display: none;">
            <?php wpc_render_import_export_tab(); ?>
        </div>
        
        <div class="wpc-tab-content" id="wpc-tab-json-schema" style="display: none;">
            <?php wpc_render_json_schema_tab(); ?>
        </div>
        
        <div class="wpc-tab-content" id="wpc-tab-danger-zone" style="display: none;">
            <?php wpc_render_danger_zone_tab(); ?>
        </div>
    </div>
    
    <script>
    (function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('.wpc-tabs-nav .nav-tab');
        const contents = document.querySelectorAll('.wpc-tab-content');
        
        // Check for saved tab in localStorage
        const savedTab = localStorage.getItem('wpc_active_tab');
        if (savedTab) {
            switchTab(savedTab);
        }
        
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('data-tab');
                switchTab(targetTab);
                // Save to localStorage
                localStorage.setItem('wpc_active_tab', targetTab);
            });
        });
        
        function switchTab(tabName) {
            // Remove active class from all tabs
            tabs.forEach(function(t) {
                t.classList.remove('nav-tab-active');
            });
            
            // Hide all content
            contents.forEach(function(c) {
                c.style.display = 'none';
            });
            
            // Activate selected tab
            const activeTab = document.querySelector('.nav-tab[data-tab="' + tabName + '"]');
            const activeContent = document.getElementById('wpc-tab-' + tabName);
            
            if (activeTab && activeContent) {
                activeTab.classList.add('nav-tab-active');
                activeContent.style.display = 'block';
            }
        }
    })();
    </script>
    <?php
}

/**
 * General & Visuals Tab
 */
function wpc_render_general_tab() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'wpc_settings_group' ); ?>
        <?php do_settings_sections( 'wpc_settings_group' ); ?>
        
        <h2><?php _e( 'General Options', 'wp-comparison-builder' ); ?></h2>
        <table class="form-table">
            <!-- Link Settings Moved to New Tab -->
            <!-- <tr valign="top">
                <th scope="row">
                    <label for="wpc_open_links_new_tab"><?php _e( 'Open Links in New Tab', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="checkbox" id="wpc_open_links_new_tab" name="wpc_open_links_new_tab" value="1" <?php checked( '1', get_option( 'wpc_open_links_new_tab', '1' ) ); ?> />
                    <p class="description">
                        <?php _e( 'If checked, all external links (Visit buttons, Pricing plans) will open in a new tab. Uncheck to open in the same tab.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr> -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_search_type"><?php _e( 'Default Search Bar Type', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <select name="wpc_search_type" id="wpc_search_type">
                        <option value="text" <?php selected( get_option( 'wpc_search_type', 'text' ), 'text' ); ?>><?php _e( 'Standard Text Input', 'wp-comparison-builder' ); ?></option>
                        <option value="combobox" <?php selected( get_option( 'wpc_search_type' ), 'combobox' ); ?>><?php _e( 'Advanced Combobox', 'wp-comparison-builder' ); ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Select the default search bar style for comparison lists. "Combobox" allows multi-selection ("one by one"). This setting can be overridden on a per-list basis.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e( 'Show Search Bar', 'wp-comparison-builder' ); ?>
                </th>
                <td>
                    <label>
                        <input type="checkbox" name="wpc_show_search" value="1" <?php checked( '1', get_option( 'wpc_show_search', '1' ) ); ?> />
                        <?php _e( 'Enable Search Bar by default', 'wp-comparison-builder' ); ?>
                    </label>
                    <p class="description">
                        <?php _e( 'Toggle the visibility of the search input and sort dropdown.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <?php _e( 'Show Filters', 'wp-comparison-builder' ); ?>
                </th>
                <td>
                    <label>
                        <input type="checkbox" name="wpc_show_filters" value="1" <?php checked( '1', get_option( 'wpc_show_filters', '1' ) ); ?> />
                        <?php _e( 'Enable Filter Sidebar/Top Bar by default', 'wp-comparison-builder' ); ?>
                    </label>
                    <p class="description">
                        <?php _e( 'Toggle the visibility of the category and feature filters.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_default_list_style"><?php _e( 'Default List Style', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <select name="wpc_default_list_style" id="wpc_default_list_style">
                        <option value="grid" <?php selected( get_option('wpc_default_list_style', 'grid'), 'grid' ); ?>><?php _e('Grid (Cards)', 'wp-comparison-builder'); ?></option>
                        <option value="list" <?php selected( get_option('wpc_default_list_style'), 'list' ); ?>><?php _e('List (Horizontal Row)', 'wp-comparison-builder'); ?></option>
                        <option value="detailed" <?php selected( get_option('wpc_default_list_style'), 'detailed' ); ?>><?php _e('Detailed (Table Row)', 'wp-comparison-builder'); ?></option>
                        <option value="compact" <?php selected( get_option('wpc_default_list_style'), 'compact' ); ?>><?php _e('Compact (Minimal)', 'wp-comparison-builder'); ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Choose the default layout for your comparison lists. This can be overridden per list.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>
        </table>

        <h2><?php _e( 'Visual Style', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Customize the look and feel of the comparison tool. These colors will override the defaults.', 'wp-comparison-builder' ); ?></p>
        
        <table class="form-table">
            <!-- Primary Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_primary_color"><?php _e( 'Primary Color (Buttons, Badges)', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="color" 
                        id="wpc_primary_color" 
                        name="wpc_primary_color" 
                        value="<?php echo esc_attr( get_option( 'wpc_primary_color', '#6366f1' ) ); ?>"
                        style="width: 100px; height: 40px; cursor: pointer;"
                    />
                    <p class="description">
                        Choose the primary color for buttons, badges, and highlights. Default: <code>#6366f1</code> (indigo)
                    </p>
                </td>
            </tr>
            
            <!-- Accent Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_accent_color"><?php _e( 'Accent Color (Active Filters, Highlights)', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="color" 
                        id="wpc_accent_color" 
                        name="wpc_accent_color" 
                        value="<?php echo esc_attr( get_option( 'wpc_accent_color', '#0d9488' ) ); ?>"
                        style="width: 100px; height: 40px; cursor: pointer;"
                    />
                    <p class="description">
                        Choose the accent color for active filters and highlights. Default: <code>#0d9488</code> (teal)
                    </p>
                </td>
            </tr>
            
            <!-- Secondary Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_secondary_color"><?php _e( 'Secondary Color (Dark Accents)', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="color" 
                        id="wpc_secondary_color" 
                        name="wpc_secondary_color" 
                        value="<?php echo esc_attr( get_option( 'wpc_secondary_color', '#1e293b' ) ); ?>"
                        style="width: 100px; height: 40px; cursor: pointer;"
                    />
                    <p class="description">
                        Choose the secondary color for dark accents and text. Default: <code>#1e293b</code> (slate)
                    </p>
                </td>
            </tr>
            
            <!-- Card Border Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_card_border_color"><?php _e( 'Card Border Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="color" 
                        id="wpc_card_border_color" 
                        name="wpc_card_border_color" 
                        value="<?php echo esc_attr( get_option( 'wpc_card_border_color', '' ) ); ?>"
                        style="width: 100px; height: 40px; cursor: pointer;"
                    />
                    <p class="description">
                        Choose the border color for standard items (non-featured). Leave empty to use default (light gray).
                    </p>
                    
                    <div style="margin-top: 20px; padding: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
                        <strong style="display:block; margin-bottom: 10px; color: #334155;">Global Theme Presets</strong>
                        <p class="description" style="margin-bottom: 10px;">Select a predefined theme to automatically set <strong>ALL</strong> colors (General, Card, Pricing Table, Coupons) to a professional palette.</p>
                        
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <select id="wpc_theme_selector" style="max-width: 200px;">
                                <option value="indigo">Indigo Modern (Default)</option>
                                <option value="emerald">Emerald Green</option>
                                <option value="sunset">Sunset Orange</option>
                                <option value="ocean">Ocean Blue</option>
                                <option value="minimal">Minimal Slate</option>
                            </select>
                            <button type="button" id="wpc_apply_theme_btn" class="button button-secondary">Apply Theme</button>
                            <span id="wpc_theme_status" style="margin-left: 10px; font-weight: bold;"></span>
                        </div>
                        
                        <script>
                        document.getElementById('wpc_apply_theme_btn').addEventListener('click', function() {
                            var theme = document.getElementById('wpc_theme_selector').value;
                            var nonce = '<?php echo wp_create_nonce( 'wpc_import_export_nonce' ); ?>';
                            
                            wpcAdmin.confirm(
                                'Apply Theme Preset?',
                                'This will update <strong>ALL</strong> your color settings (General, Pricing, Coupons) to the "'+theme+'" palette.<br><br>Existing color customizations will be overwritten.',
                                function() {
                                    var btn = document.getElementById('wpc_apply_theme_btn');
                                    var status = document.getElementById('wpc_theme_status');
                                    
                                    wpcAdmin.loading(btn, 'Applying...');
                                    status.innerText = '';
                                    
                                    jQuery.post(ajaxurl, {
                                        action: 'wpc_apply_theme_preset',
                                        theme: theme,
                                        nonce: nonce
                                    }, function(response) {
                                        if (response.success) {
                                            wpcAdmin.toast('Theme Applied! Reloading page...', 'success');
                                            setTimeout(function() {
                                                window.location.reload();
                                            }, 1500);
                                        } else {
                                            wpcAdmin.toast('Error: ' + (response.data || 'Unknown error'), 'error');
                                            wpcAdmin.reset(btn);
                                        }
                                    });
                                },
                                'Apply Theme',
                                '#6366f1'
                            );
                        });
                        </script>
                    </div>
                </td>
            </tr>
            
            <!-- Pricing Banner Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_pricing_banner_color"><?php _e( 'Pricing Banner Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="color" 
                        id="wpc_pricing_banner_color" 
                        name="wpc_pricing_banner_color" 
                        value="<?php echo esc_attr( get_option( 'wpc_pricing_banner_color', '#10b981' ) ); ?>"
                        style="width: 100px; height: 40px; cursor: pointer;"
                    />
                    <p class="description">
                        Choose the background color for pricing plan discount banners (e.g., "70% OFF"). Default: <code>#10b981</code> (green)
                    </p>
                </td>
            </tr>

            <!-- Button Hover Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_button_hover_color"><?php _e( 'Button Hover Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <?php $hover_color = get_option( 'wpc_button_hover_color', '' ); ?>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input 
                            type="color" 
                            id="wpc_button_hover_color_picker" 
                            value="<?php echo esc_attr( $hover_color ? $hover_color : '#059669' ); ?>"
                            style="width: 50px; height: 40px; cursor: pointer;"
                            onchange="document.getElementById('wpc_button_hover_color').value = this.value"
                        />
                        <input 
                            type="text" 
                            id="wpc_button_hover_color" 
                            name="wpc_button_hover_color" 
                            value="<?php echo esc_attr( $hover_color ); ?>"
                            placeholder="Default (Auto)"
                            style="width: 120px;"
                            onchange="document.getElementById('wpc_button_hover_color_picker').value = this.value"
                        />
                        <button type="button" class="button" onclick="resetButtonHover()">Clear / Reset</button>
                    </div>
                    <p class="description">
                        Choose a custom hover color for primary buttons. Leave empty to use the default automatic hover effect (slightly darker than Primary Color).
                    </p>
                </td>
            </tr>

            <!-- Show Plan Selection Buttons -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_show_plan_buttons"><?php _e( 'Show Plan Selection Buttons', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="checkbox" 
                        id="wpc_show_plan_buttons" 
                        name="wpc_show_plan_buttons" 
                        value="1"
                        <?php checked( get_option( 'wpc_show_plan_buttons', '1' ), '1' ); ?>
                    />
                    <label for="wpc_show_plan_buttons">
                        Show "Select Plan" buttons in pricing popups
                    </label>
                    <p class="description">
                        When enabled, pricing plan popups will include action buttons for each plan.
                    </p>
                </td>
            </tr>

            <!-- Show Footer Button (Global) -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_show_footer_button_global"><?php _e( 'Show "Visit Website" Footer Button', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input 
                        type="checkbox" 
                        id="wpc_show_footer_button_global" 
                        name="wpc_show_footer_button_global" 
                        value="1"
                        <?php checked( get_option( 'wpc_show_footer_button_global', '1' ), '1' ); ?>
                    />
                    <label for="wpc_show_footer_button_global">
                        Show the footer button (Visit Website) in pricing tables/popups by default
                    </label>
                </td>
            </tr>
        </table>

        <hr style="margin: 40px 0;">
        
        <h2><?php _e( 'Filter Layout', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Choose how the filters should look on the comparison page.', 'wp-comparison-builder' ); ?></p>
        
        <?php $current_style = get_option( 'wpc_filter_style', 'top' ); ?>
        
        <div class="filter-style-options" style="display: flex; gap: 30px; margin-top: 20px; margin-bottom: 40px;">
            <!-- Top Option -->
            <label style="cursor: pointer; flex: 1; max-width: 400px;">
                <input type="radio" name="wpc_filter_style" value="top" <?php checked( $current_style, 'top' ); ?> style="margin-bottom: 10px; display: block;" />
                <div style="border: 2px solid <?php echo ($current_style === 'top' ? '#6366f1' : '#ddd'); ?>; border-radius: 8px; padding: 15px; background: #fff;">
                    <strong style="display: block; margin-bottom: 10px;">Horizontal (Top)</strong>
                    <div style="background: #f3f4f6; height: 100px; border-radius: 4px; display: flex; flex-direction: column; gap: 8px; padding: 10px;">
                        <div style="background: #fff; height: 20px; width: 100%; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                        <div style="display: flex; gap: 8px; flex: 1;">
                            <div style="background: #fff; flex: 1; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                            <div style="background: #fff; flex: 1; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                            <div style="background: #fff; flex: 1; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                        </div>
                    </div>
                    <p class="description" style="margin-top: 10px;">Filters appear in a horizontal bar above the list. Best for few filters.</p>
                </div>
            </label>

            <!-- Sidebar Option -->
            <label style="cursor: pointer; flex: 1; max-width: 400px;">
                <input type="radio" name="wpc_filter_style" value="sidebar" <?php checked( $current_style, 'sidebar' ); ?> style="margin-bottom: 10px; display: block;" />
                <div style="border: 2px solid <?php echo ($current_style === 'sidebar' ? '#6366f1' : '#ddd'); ?>; border-radius: 8px; padding: 15px; background: #fff;">
                    <strong style="display: block; margin-bottom: 10px;">Vertical (Sidebar)</strong>
                    <div style="background: #f3f4f6; height: 100px; border-radius: 4px; display: flex; gap: 8px; padding: 10px;">
                        <div style="background: #fff; width: 30%; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                        <div style="display: flex; flex-direction: column; gap: 8px; flex: 1;">
                            <div style="background: #fff; height: 25px; width: 100%; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                            <div style="background: #fff; height: 25px; width: 100%; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                            <div style="background: #fff; height: 25px; width: 100%; border: 1px solid #e5e7eb; border-radius: 4px;"></div>
                        </div>
                    </div>
                    <p class="description" style="margin-top: 10px;">Filters appear in a sidebar on the left. Best for many features and categories.</p>
                </div>
            </label>
        </div>
        
        <style>
            input[type="radio"]:checked + div {
                border-color: #6366f1 !important;
                box-shadow: 0 0 0 1px #6366f1;
            }
        </style>
        
        <script>
        function setAllColors(primary, accent, secondary) {
            document.getElementById('wpc_primary_color').value = primary;
            document.getElementById('wpc_accent_color').value = accent;
            document.getElementById('wpc_secondary_color').value = secondary;
        }
        
        function resetButtonHover() {
            document.getElementById('wpc_button_hover_color').value = '';
            document.getElementById('wpc_button_hover_color_picker').value = '#059669';
        }
        </script>
        
        <?php submit_button(); ?>
    </form>
    
    <hr style="margin: 40px 0;">
    
    <div style="background: #f9fafb; padding: 20px; border-left: 4px solid #6366f1; border-radius: 4px;">
        <h3 style="margin-top: 0;"><?php _e( 'How to Use Featured Cards', 'wp-comparison-builder' ); ?></h3>
        <ol>
            <li><strong>In Custom Lists:</strong> Mark items as "Featured" and customize their badge text and border color individually</li>
            <li><strong>In Shortcodes:</strong> Use the <code>featured</code> attribute (e.g., <code>[wpc_compare featured="8,12"]</code>)</li>
            <li><strong>Per Item:</strong> Edit each item and set a custom "Featured Badge Text" (e.g., "Editor's Pick", "Best Value") and badge color</li>
        </ol>
        <p><em>Note: Featured card styling (badge and border color) is controlled per Custom List or per individual item, not globally.</em></p>
    </div>
    <?php
}





/**
 * Pricing Table Tab
 */
function wpc_render_pricing_tab() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'wpc_settings_group' ); ?>
        
        <h2><?php _e( 'Pricing Table Visual Style', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Customize the default appearance of the pricing table header and buttons (used when overrides are disabled).', 'wp-comparison-builder' ); ?></p>
        
        <table class="form-table">
            <!-- Header BG -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_pt_header_bg"><?php _e( 'Header Background', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                     <input type="color" name="wpc_pt_header_bg" value="<?php echo esc_attr( get_option( 'wpc_pt_header_bg', '#f8fafc' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
            <!-- Header Text -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_pt_header_text"><?php _e( 'Header Text Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                     <input type="color" name="wpc_pt_header_text" value="<?php echo esc_attr( get_option( 'wpc_pt_header_text', '#0f172a' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
             <!-- Button BG -->
             <tr valign="top">
                <th scope="row">
                    <label for="wpc_pt_btn_bg"><?php _e( 'Button Background', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                     <input type="color" name="wpc_pt_btn_bg" value="<?php echo esc_attr( get_option( 'wpc_pt_btn_bg', '#0f172a' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
             <!-- Button Text -->
             <tr valign="top">
                <th scope="row">
                    <label for="wpc_pt_btn_text"><?php _e( 'Button Text Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                     <input type="color" name="wpc_pt_btn_text" value="<?php echo esc_attr( get_option( 'wpc_pt_btn_text', '#ffffff' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
             <!-- Table Button Position -->
            <tr valign="top">
                <th scope="row"><label for="wpc_pt_btn_pos_table"><?php _e('Table Button Position', 'wp-comparison-builder'); ?></label></th>
                <td>
                    <select name="wpc_pt_btn_pos_table" id="wpc_pt_btn_pos_table">
                        <option value="after_price" <?php selected(get_option('wpc_pt_btn_pos_table', 'after_price'), 'after_price'); ?>>After Pricing</option>
                        <option value="bottom" <?php selected(get_option('wpc_pt_btn_pos_table', 'after_price'), 'bottom'); ?>>Bottom (After Features)</option>
                    </select>
                    <p class="description">Where to show the "Select Plan" button in inline tables.</p>
                </td>
            </tr>
             <!-- Popup Button Position -->
            <tr valign="top">
                <th scope="row"><label for="wpc_pt_btn_pos_popup"><?php _e('Popup Button Position', 'wp-comparison-builder'); ?></label></th>
                <td>
                    <select name="wpc_pt_btn_pos_popup" id="wpc_pt_btn_pos_popup">
                        <option value="after_price" <?php selected(get_option('wpc_pt_btn_pos_popup', 'after_price'), 'after_price'); ?>>After Pricing</option>
                        <option value="bottom" <?php selected(get_option('wpc_pt_btn_pos_popup', 'after_price'), 'bottom'); ?>>Bottom (After Features)</option>
                    </select>
                     <p class="description">Where to show the "Select Plan" button in popups.</p>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
        
        <!-- Plan Features Settings -->
        <h2><?php _e( 'Plan Features Table Defaults', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Default settings for the [wpc_feature_table] shortcode. These can be overridden per-item in the "Plan Features" tab.', 'wp-comparison-builder' ); ?></p>
        
        <table class="form-table">
            <!-- Display Mode -->
            <tr valign="top">
                <th scope="row">
                    <label><?php _e( 'Default Display Mode', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <?php $ft_display = get_option( 'wpc_ft_display_mode', 'full_table' ); ?>
                    <label style="margin-right: 20px;">
                        <input type="radio" name="wpc_ft_display_mode" value="full_table" <?php checked( $ft_display, 'full_table' ); ?> />
                        <?php _e( 'Full Table (Plans + Check/X)', 'wp-comparison-builder' ); ?>
                    </label>
                    <label>
                        <input type="radio" name="wpc_ft_display_mode" value="features_only" <?php checked( $ft_display, 'features_only' ); ?> />
                        <?php _e( 'Features Only (No Plans)', 'wp-comparison-builder' ); ?>
                    </label>
                </td>
            </tr>
            <!-- Header Label -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_ft_header_label"><?php _e( 'Default Header Label', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="text" name="wpc_ft_header_label" id="wpc_ft_header_label" value="<?php echo esc_attr( get_option( 'wpc_ft_header_label', 'Key Features' ) ); ?>" class="regular-text" />
                    <p class="description"><?php _e( 'Left blank = "Key Features"', 'wp-comparison-builder' ); ?></p>
                </td>
            </tr>
            <!-- Header BG -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_ft_header_bg"><?php _e( 'Header Background', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="color" name="wpc_ft_header_bg" id="wpc_ft_header_bg" value="<?php echo esc_attr( get_option( 'wpc_ft_header_bg', '#f3f4f6' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
            <!-- Check Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_ft_check_color"><?php _e( 'Check Icon Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="color" name="wpc_ft_check_color" id="wpc_ft_check_color" value="<?php echo esc_attr( get_option( 'wpc_ft_check_color', '#10b981' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
            <!-- X Color -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_ft_x_color"><?php _e( 'X Icon Color', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="color" name="wpc_ft_x_color" id="wpc_ft_x_color" value="<?php echo esc_attr( get_option( 'wpc_ft_x_color', '#ef4444' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
            <!-- Alt Row BG -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_ft_alt_row_bg"><?php _e( 'Alternating Row Background', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <input type="color" name="wpc_ft_alt_row_bg" id="wpc_ft_alt_row_bg" value="<?php echo esc_attr( get_option( 'wpc_ft_alt_row_bg', '#f9fafb' ) ); ?>" style="height:35px; cursor:pointer;" />
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
    <?php
}

/**
 * Import / Export Tab
 */
function wpc_render_import_export_tab() {
    ?>
    <div style="max-width: 900px;">
        <p><?php _e( 'Backup your data or migrate to another site. Export/Import includes Comparison Items, Categories, Features, Custom Lists, and Plugin Settings.', 'wp-comparison-builder' ); ?></p>
        
        <?php wp_nonce_field( 'wpc_import_export_nonce', 'wpc_ie_nonce' ); ?>
        
        <!-- Export Section -->
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Export Data', 'wp-comparison-builder' ); ?></h3>
            <p><?php _e( 'Download a JSON file containing selected plugin data.', 'wp-comparison-builder' ); ?></p>
            
            <!-- What to Export -->
            <div style="margin-bottom: 15px; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                <strong style="display: block; margin-bottom: 10px;"><?php _e( 'What to Export:', 'wp-comparison-builder' ); ?></strong>
                <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-export-all" checked /> <strong>Select All</strong>
                </label>
                <div style="margin-top: 10px; display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 8px;">
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" class="wpc-export-opt" data-type="items" checked /> Comparison Items
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" class="wpc-export-opt" data-type="categories" checked /> Categories
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" class="wpc-export-opt" data-type="features" checked /> Features
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" class="wpc-export-opt" data-type="lists" checked /> Custom Lists
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" class="wpc-export-opt" data-type="settings" checked /> Settings
                    </label>
                </div>
            </div>
            
            <button type="button" id="wpc-export-btn" class="button button-primary">
                <?php _e( 'Download Export File', 'wp-comparison-builder' ); ?>
            </button>
            <span id="wpc-export-status" style="margin-left: 10px;"></span>
        </div>
        
        <!-- Import Section -->
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Import Data', 'wp-comparison-builder' ); ?></h3>
            <p><?php _e( 'Upload a JSON file. You can control what gets imported below.', 'wp-comparison-builder' ); ?></p>
            
            <div style="margin-bottom: 15px;">
                <input type="file" id="wpc-import-file" accept=".json" />
            </div>
            
            <!-- What to Import -->
            <div style="margin-bottom: 15px; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                <strong style="display: block; margin-bottom: 10px;"><?php _e( 'What to Import:', 'wp-comparison-builder' ); ?></strong>
                <label style="display: block; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-import-items" checked /> Comparison Items
                </label>
                <label style="display: block; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-import-categories" checked /> Categories
                </label>
                <label style="display: block; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-import-features" checked /> Features
                </label>
                <label style="display: block; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-import-lists" checked /> Custom Lists
                </label>
                <label style="display: block; margin-bottom: 5px;">
                    <input type="checkbox" id="wpc-import-settings" /> Settings (Colors, Layout, etc.)
                </label>
            </div>
            
            <button type="button" id="wpc-import-btn" class="button button-primary" disabled>
                <?php _e( 'Preview Import', 'wp-comparison-builder' ); ?>
            </button>
            <span id="wpc-import-status" style="margin-left: 10px;"></span>
        </div>
        
        <!-- Sample JSON -->
        <div style="background: #f0f6ff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Sample JSON Template', 'wp-comparison-builder' ); ?></h3>
            <p><?php _e( 'Download a comprehensive sample showing all supported fields.', 'wp-comparison-builder' ); ?></p>
            <button type="button" id="wpc-sample-btn" class="button">
                <?php _e( 'Download Sample JSON', 'wp-comparison-builder' ); ?>
            </button>
        </div>
    </div>
    
    <!-- Conflict Resolution Modal -->
    <div id="wpc-conflict-modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 99999; align-items: center; justify-content: center;">
        <div style="background: #fff; padding: 30px; border-radius: 8px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto;">
            <h2 style="margin-top: 0;"><?php _e( 'Import Preview', 'wp-comparison-builder' ); ?></h2>
            
            <div id="wpc-import-summary" style="margin-bottom: 20px; padding: 15px; background: #f0f9ff; border-radius: 4px;"></div>
            
            <div id="wpc-conflicts-section" style="display: none;">
                <h4 style="color: #e65100;"><?php _e( 'Conflicts Found', 'wp-comparison-builder' ); ?></h4>
                <p><?php _e( 'The following items already exist. Select which to overwrite:', 'wp-comparison-builder' ); ?></p>
                
                <label style="display: block; margin-bottom: 10px; padding: 10px; background: #fff3e0; border-radius: 4px;">
                    <input type="checkbox" id="wpc-override-all" /> <strong><?php _e( 'Override All Without Asking', 'wp-comparison-builder' ); ?></strong>
                </label>
                
                <div id="wpc-conflicts-list" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;"></div>
            </div>
            
            <div style="margin-top: 20px; text-align: right;">
                <button type="button" id="wpc-modal-cancel" class="button"><?php _e( 'Cancel', 'wp-comparison-builder' ); ?></button>
                <button type="button" id="wpc-modal-confirm" class="button button-primary" style="margin-left: 10px;"><?php _e( 'Continue Import', 'wp-comparison-builder' ); ?></button>
            </div>
        </div>
    </div>
    
    <script>
    (function() {
        const nonce = document.getElementById('wpc_ie_nonce').value;
        let pendingJsonData = null;
        let detectedConflicts = [];
        
        // Export Select All
        document.getElementById('wpc-export-all').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.wpc-export-opt').forEach(cb => cb.checked = isChecked);
        });
        
        // Update Export Select All when individual options change
        document.querySelectorAll('.wpc-export-opt').forEach(cb => {
            cb.addEventListener('change', function() {
                const allOpts = document.querySelectorAll('.wpc-export-opt');
                const checkedOpts = document.querySelectorAll('.wpc-export-opt:checked');
                document.getElementById('wpc-export-all').checked = allOpts.length === checkedOpts.length;
            });
        });
        
        // Export
        document.getElementById('wpc-export-btn').addEventListener('click', function() {
            const statusEl = document.getElementById('wpc-export-status');
            
            // Get selected export options
            const selectedOpts = [];
            document.querySelectorAll('.wpc-export-opt:checked').forEach(cb => {
                selectedOpts.push(cb.getAttribute('data-type'));
            });
            
            if (selectedOpts.length === 0) {
                statusEl.textContent = '\u26A0\uFE0F Select at least one option to export';
                statusEl.style.color = '#dc2626';
                return;
            }
            
            statusEl.textContent = 'Exporting...';
            statusEl.style.color = '';
            
            const formData = new FormData();
            formData.append('action', 'wpc_export_data');
            formData.append('nonce', nonce);
            formData.append('export_types', JSON.stringify(selectedOpts));
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const blob = new Blob([JSON.stringify(data.data, null, 2)], { type: 'application/json' });
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'wpc-export-' + new Date().toISOString().slice(0,10) + '.json';
                        a.click();
                        URL.revokeObjectURL(url);
                        statusEl.textContent = '\u2713 Downloaded!';
                        statusEl.style.color = '#16a34a';
                    } else {
                        statusEl.textContent = '\u2717 Error: ' + data.data;
                        statusEl.style.color = '#dc2626';
                    }
                })
                .catch(e => { 
                    statusEl.textContent = '\u2717 Request failed'; 
                    statusEl.style.color = '#dc2626';
                });
        });
        
        // Import file selection
        document.getElementById('wpc-import-file').addEventListener('change', function() {
            document.getElementById('wpc-import-btn').disabled = !this.files.length;
        });
        
        // Import Preview (detect conflicts)
        document.getElementById('wpc-import-btn').addEventListener('click', function() {
            const fileInput = document.getElementById('wpc-import-file');
            const statusEl = document.getElementById('wpc-import-status');
            
            if (!fileInput.files.length) {
                statusEl.textContent = 'Please select a file';
                return;
            }
            
            statusEl.textContent = 'Analyzing...';
            
            const reader = new FileReader();
            reader.onload = function(e) {
                pendingJsonData = e.target.result;
                
                const formData = new FormData();
                formData.append('action', 'wpc_detect_conflicts');
                formData.append('nonce', nonce);
                formData.append('json_data', pendingJsonData);
                
                fetch(ajaxurl, { method: 'POST', body: formData })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            statusEl.textContent = '';
                            showConflictModal(data.data);
                        } else {
                            statusEl.textContent = '\u2717 Error: ' + data.data;
                        }
                    })
                    .catch(e => { statusEl.textContent = '\u2717 Analysis failed'; });
            };
            reader.readAsText(fileInput.files[0]);
        });
        
        function showConflictModal(result) {
            detectedConflicts = result.conflicts || [];
            const summary = result.summary || {};
            
            // Build summary
            let summaryHtml = '<strong>Import Summary:</strong><br>';
            summaryHtml += `\u2022 Categories: ${summary.categories_count || 0}<br>`;
            summaryHtml += `\u2022 Features: ${summary.features_count || 0}<br>`;
            summaryHtml += `\u2022 Items: ${summary.items_count || 0}<br>`;
            summaryHtml += `\u2022 Lists: ${summary.lists_count || 0}`;
            document.getElementById('wpc-import-summary').innerHTML = summaryHtml;
            
            // Build conflicts
            const conflictsSection = document.getElementById('wpc-conflicts-section');
            const conflictsList = document.getElementById('wpc-conflicts-list');
            
            if (detectedConflicts.length > 0) {
                conflictsSection.style.display = 'block';
                let html = '';
                detectedConflicts.forEach((c, i) => {
                    html += `<label style="display: block; padding: 5px 0;"><input type="checkbox" class="wpc-conflict-cb" data-slug="${c.slug}" checked /> ${c.type === 'item' ? '\uD83D\uDCE6' : '\uD83D\uDCCB'} ${c.title} <span style="color: #888;">(${c.slug})</span></label>`;
                });
                conflictsList.innerHTML = html;
            } else {
                conflictsSection.style.display = 'none';
            }
            
            document.getElementById('wpc-override-all').checked = false;
            document.getElementById('wpc-conflict-modal').style.display = 'flex';
        }
        
        // Override all toggle
        document.getElementById('wpc-override-all').addEventListener('change', function() {
            const checked = this.checked;
            document.querySelectorAll('.wpc-conflict-cb').forEach(cb => {
                cb.checked = checked;
                cb.disabled = checked;
            });
        });
        
        // Modal Cancel
        document.getElementById('wpc-modal-cancel').addEventListener('click', function() {
            document.getElementById('wpc-conflict-modal').style.display = 'none';
            pendingJsonData = null;
        });
        
        // Modal Confirm Import
        document.getElementById('wpc-modal-confirm').addEventListener('click', function() {
            const statusEl = document.getElementById('wpc-import-status');
            const modal = document.getElementById('wpc-conflict-modal');
            
            // Collect which to override
            const overrideSlugs = [];
            document.querySelectorAll('.wpc-conflict-cb:checked').forEach(cb => {
                overrideSlugs.push(cb.dataset.slug);
            });
            
            const formData = new FormData();
            formData.append('action', 'wpc_import_data');
            formData.append('nonce', nonce);
            formData.append('json_data', pendingJsonData);
            formData.append('overwrite', overrideSlugs.length > 0 ? 'true' : 'false');
            formData.append('override_slugs', JSON.stringify(overrideSlugs));
            formData.append('import_items', document.getElementById('wpc-import-items').checked ? 'true' : 'false');
            formData.append('import_lists', document.getElementById('wpc-import-lists').checked ? 'true' : 'false');
            formData.append('import_settings', document.getElementById('wpc-import-settings').checked ? 'true' : 'false');
            formData.append('import_categories', document.getElementById('wpc-import-categories').checked ? 'true' : 'false');
            formData.append('import_features', document.getElementById('wpc-import-features').checked ? 'true' : 'false');
            
            modal.style.display = 'none';
            statusEl.textContent = 'Importing...';
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const r = data.data;
                        let msg = '\u2713 Import complete!<br>';
                        if (r.items_created || r.items_updated) msg += `Items: ${r.items_created || 0} created, ${r.items_updated || 0} updated<br>`;
                        if (r.lists_created || r.lists_updated) msg += `Lists: ${r.lists_created || 0} created, ${r.lists_updated || 0} updated<br>`;
                        if (r.categories_created) msg += `Categories: ${r.categories_created} created<br>`;
                        if (r.features_created) msg += `Features: ${r.features_created} created<br>`;
                        if (r.settings_updated) msg += `Settings: ${r.settings_updated} updated`;
                        statusEl.innerHTML = msg;
                    } else {
                        statusEl.textContent = '\u2717 Error: ' + data.data;
                    }
                    pendingJsonData = null;
                })
                .catch(e => { statusEl.textContent = '\u2717 Import failed'; });
        });
        
        // Sample JSON
        document.getElementById('wpc-sample-btn').addEventListener('click', function() {
            const sample = {
                "version": "1.0",
                "categories": [
                    { "name": "Web Hosting", "slug": "web-hosting", "description": "General web hosting services" },
                    { "name": "E-commerce", "slug": "ecommerce", "description": "E-commerce platforms" }
                ],
                "features": [
                    { "name": "Free SSL", "slug": "free-ssl", "description": "" },
                    { "name": "24/7 Support", "slug": "247-support", "description": "" },
                    { "name": "Free Domain", "slug": "free-domain", "description": "" }
                ],
                "comparison_items": [
                    {
                        "post_title": "Sample Platform",
                        "post_name": "sample-platform",
                        "post_status": "publish",
                        "post_content": "",
                        "meta": {
                            "_wpc_website_url": "https://example.com",
                            "_wpc_short_description": "A sample platform showing all available fields",
                            "_wpc_rating": "4.5",
                            "_wpc_price": "$29",
                            "_wpc_price_period": "/mo",
                            "_wpc_external_logo_url": "",
                            "_wpc_details_link": "https://example.com/review",
                            "_wpc_direct_link": "https://example.com/go",
                            "_wpc_button_text": "Visit Website",
                            "_wpc_featured_badge_text": "Editor's Pick",
                            "_wpc_featured_badge_color": "#6366f1",
                            "_wpc_coupon_code": "SAVE20",
                            "_wpc_coupon_label": "Get 20% Off",
                            "_wpc_show_coupon": "1",
                            "_wpc_pros": "Pro item 1\nPro item 2\nPro item 3",
                            "_wpc_cons": "Con item 1\nCon item 2",
                            "_wpc_pricing_plans": [
                                {
                                    "name": "Basic",
                                    "price": "$9.99",
                                    "period": "/mo",
                                    "features": "Feature 1\nFeature 2\nFeature 3",
                                    "link": "https://example.com/basic",
                                    "button_text": "Get Started",
                                    "show_popup": "1",
                                    "show_table": "1",
                                    "show_banner": "0",
                                    "banner_text": "",
                                    "banner_color": "#10b981"
                                },
                                {
                                    "name": "Professional",
                                    "price": "$29.99",
                                    "period": "/mo",
                                    "features": "All Basic features\nPriority Support\nAdvanced Analytics",
                                    "link": "https://example.com/pro",
                                    "button_text": "Choose Pro",
                                    "show_popup": "1",
                                    "show_table": "1",
                                    "show_banner": "1",
                                    "banner_text": "MOST POPULAR",
                                    "banner_color": "#10b981"
                                },
                                {
                                    "name": "Enterprise",
                                    "price": "$99.99",
                                    "period": "/mo",
                                    "features": "All Pro features\nDedicated Support\nCustom Solutions",
                                    "link": "https://example.com/enterprise",
                                    "button_text": "Contact Sales",
                                    "show_popup": "1",
                                    "show_table": "1",
                                    "show_banner": "1",
                                    "banner_text": "BEST VALUE",
                                    "banner_color": "#f59e0b"
                                }
                            ]
                        },
                        "categories": ["web-hosting", "ecommerce"],
                        "features": ["free-ssl", "247-support", "free-domain"]
                    }
                ],
                "custom_lists": [
                    {
                        "post_title": "Sample Custom List",
                        "post_name": "sample-custom-list",
                        "post_status": "publish",
                        "meta": {
                            "_wpc_list_items": [],
                            "_wpc_enable_comparison": "1",
                            "_wpc_show_filters": "1",
                            "_wpc_initial_visible_count": "6",
                            "_wpc_filter_layout": "top"
                        }
                    }
                ],
                "settings": {
                    "wpc_primary_color": "#6366f1",
                    "wpc_accent_color": "#0d9488",
                    "wpc_secondary_color": "#1e293b",
                    "wpc_card_border_color": "#e2e8f0",
                    "wpc_pricing_banner_color": "#10b981"
                }
            };
            
            const blob = new Blob([JSON.stringify(sample, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'wpc-sample-import.json';
            a.click();
            URL.revokeObjectURL(url);
        });
        

    })();
    </script>
    <?php
}

/**
 * JSON Schema Tab
 */
function wpc_render_json_schema_tab() {
    ?>
    <div style="max-width: 900px;">
        <h2><?php _e( 'JSON Schema Reference', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'This page documents the JSON structure used for import/export operations.', 'wp-comparison-builder' ); ?></p>
        
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Root Structure', 'wp-comparison-builder' ); ?></h3>
            <pre style="background: #f6f7f7; padding: 15px; border-radius: 4px; overflow-x: auto;">{
  "version": "1.0",
  "categories": [...],
  "features": [...],
  "comparison_items": [...],
  "custom_lists": [...],
  "settings": {...}
}</pre>
        </div>
        
        <!-- Complete Example -->
        <div style="background: #e8f5e9; border: 1px solid #4caf50; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0; color: #2e7d32;"><?php _e( 'Complete Import Example', 'wp-comparison-builder' ); ?></h3>
            <p>Copy this JSON to import multiple categories, features, and items at once:</p>
            <textarea id="wpc-complete-json" readonly style="width: 100%; height: 400px; font-family: monospace; font-size: 12px;">{
  "version": "1.0",
  "categories": [
    { "name": "All-in-One Platform", "slug": "all-in-one-platform", "description": "Complete ecommerce solutions" },
    { "name": "Open Source", "slug": "open-source", "description": "Free and open-source platforms" },
    { "name": "Enterprise", "slug": "enterprise", "description": "Solutions for large businesses" },
    { "name": "WordPress Plugin", "slug": "wordpress-plugin", "description": "WooCommerce and other WP solutions" }
  ],
  "features": [
    { "name": "24/7 Support", "slug": "247-support", "description": "" },
    { "name": "Free SSL", "slug": "free-ssl", "description": "" },
    { "name": "Multi-Currency", "slug": "multi-currency", "description": "" },
    { "name": "Abandoned Cart", "slug": "abandoned-cart", "description": "" },
    { "name": "SEO Tools", "slug": "seo-tools", "description": "" },
    { "name": "Dropshipping", "slug": "dropshipping", "description": "" }
  ],
  "comparison_items": [
    {
      "post_title": "Shopify",
      "post_name": "shopify",
      "post_status": "publish",
      "meta": {
        "_wpc_website_url": "https://shopify.com",
        "_wpc_short_description": "Leading ecommerce platform for online stores",
        "_wpc_rating": "4.8",
        "_wpc_price": "$29",
        "_wpc_price_period": "/mo",
        "_wpc_featured_badge_text": "Top Choice",
        "_wpc_featured_badge_color": "#96bf48",
        "_wpc_coupon_code": "SAVE10",
        "_wpc_coupon_label": "Get 10% Off",
        "_wpc_pros": ["Easy to use", "Great themes", "24/7 support"],
        "_wpc_cons": ["Transaction fees", "Limited customization"],
        "_wpc_pricing_plans": [
          {"name": "Basic", "price": "$29", "period": "/mo", "features": ["Online store", "Unlimited products", "24/7 support"], "cta_text": "Start Free Trial", "cta_url": "https://shopify.com/basic"},
          {"name": "Shopify", "price": "$79", "period": "/mo", "features": ["Everything in Basic", "5 staff accounts", "Professional reports"], "cta_text": "Start Free Trial", "cta_url": "https://shopify.com/standard", "is_popular": true},
          {"name": "Advanced", "price": "$299", "period": "/mo", "features": ["Everything in Shopify", "15 staff accounts", "Advanced reports"], "cta_text": "Start Free Trial", "cta_url": "https://shopify.com/advanced"}
        ]
      },
      "categories": ["all-in-one-platform"],
      "features": ["247-support", "free-ssl", "abandoned-cart"]
    },
    {
      "post_title": "WooCommerce",
      "post_name": "woocommerce",
      "post_status": "publish",
      "meta": {
        "_wpc_website_url": "https://woocommerce.com",
        "_wpc_short_description": "The most customizable ecommerce platform",
        "_wpc_rating": "4.6",
        "_wpc_price": "Free",
        "_wpc_price_period": "",
        "_wpc_featured_badge_text": "",
        "_wpc_pros": ["Free to use", "Highly customizable", "Large community"],
        "_wpc_cons": ["Requires hosting", "Steeper learning curve"]
      },
      "categories": ["open-source", "wordpress-plugin"],
      "features": ["multi-currency", "seo-tools", "dropshipping"]
    },
    {
      "post_title": "BigCommerce",
      "post_name": "bigcommerce",
      "post_status": "publish",
      "meta": {
        "_wpc_website_url": "https://bigcommerce.com",
        "_wpc_short_description": "Enterprise-grade ecommerce for growth",
        "_wpc_rating": "4.5",
        "_wpc_price": "$29",
        "_wpc_price_period": "/mo",
        "_wpc_coupon_code": "BC15OFF",
        "_wpc_coupon_label": "15% Discount"
      },
      "categories": ["all-in-one-platform", "enterprise"],
      "features": ["247-support", "multi-currency", "seo-tools"]
    }
  ],
  "settings": {
    "wpc_primary_color": "#6366f1",
    "wpc_accent_color": "#0d9488",
    "wpc_secondary_color": "#1e293b"
  }
}</textarea>
            <button type="button" class="button" onclick="navigator.clipboard.writeText(document.getElementById('wpc-complete-json').value); this.textContent='Copied!'; setTimeout(()=>this.textContent='Copy JSON', 2000);" style="margin-top: 10px;">Copy JSON</button>
            <button type="button" class="button button-primary" onclick="var a=document.createElement('a');a.href=URL.createObjectURL(new Blob([document.getElementById('wpc-complete-json').value],{type:'application/json'}));a.download='wpc-complete-import.json';a.click();" style="margin-top: 10px; margin-left: 5px;">Download as File</button>
        </div>
        
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Comparison Item Structure', 'wp-comparison-builder' ); ?></h3>
            <pre style="background: #f6f7f7; padding: 15px; border-radius: 4px; overflow-x: auto;">{
  "post_title": "Platform Name",
  "post_name": "platform-slug",
  "post_status": "publish",
  "post_content": "",
  "meta": {
    "_wpc_website_url": "https://example.com",
    "_wpc_short_description": "Brief description",
    "_wpc_rating": "4.5",
    "_wpc_featured_badge_text": "Editor's Pick",
    "_wpc_featured_badge_color": "#6366f1",
    "_wpc_pricing_plans": [...],
    "_wpc_pros": [...],
    "_wpc_cons": [...]
  },
  "categories": ["category-slug-1", "category-slug-2"],
  "features": ["feature-slug-1", "feature-slug-2"]
}</pre>
        </div>
        
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Pricing Plan Structure', 'wp-comparison-builder' ); ?></h3>
            <pre style="background: #f6f7f7; padding: 15px; border-radius: 4px; overflow-x: auto;">{
  "name": "Basic Plan",
  "price": "$9.99",
  "period": "/month",
  "features": "Feature 1\nFeature 2",
  "link": "https://example.com/signup",
  "button_text": "Get Started",
  "show_popup": "1",
  "show_table": "1",
  "show_banner": "1",
  "banner_text": "50% OFF",
  "banner_color": "#10b981"
}</pre>
            <p class="description" style="margin-top: 10px;">
                <strong>Note:</strong> Legacy field names <code>cta_url</code> and <code>cta_text</code> are also supported and will be automatically mapped to <code>link</code> and <code>button_text</code>.
            </p>
        </div>
        
        <div style="background: #fff; border: 1px solid #c3c4c7; border-radius: 4px; padding: 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Available Meta Keys', 'wp-comparison-builder' ); ?></h3>
            <table class="widefat">
                <thead>
                    <tr>
                        <th><?php _e( 'Meta Key', 'wp-comparison-builder' ); ?></th>
                        <th><?php _e( 'Description', 'wp-comparison-builder' ); ?></th>
                        <th><?php _e( 'Type', 'wp-comparison-builder' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><code>_wpc_website_url</code></td><td>Main website URL</td><td>string</td></tr>
                    <tr><td><code>_wpc_short_description</code></td><td>Brief description</td><td>string</td></tr>
                    <tr><td><code>_wpc_rating</code></td><td>Rating (0-5)</td><td>number</td></tr>
                    <tr><td><code>_wpc_pricing_plans</code></td><td>Array of pricing plans</td><td>array</td></tr>
                    <tr><td><code>_wpc_pros</code></td><td>List of pros (array or newline-separated string)</td><td>array/string</td></tr>
                    <tr><td><code>_wpc_cons</code></td><td>List of cons (array or newline-separated string)</td><td>array/string</td></tr>
                    <tr><td><code>_wpc_featured_badge_text</code></td><td>Featured badge text</td><td>string</td></tr>
                    <tr><td><code>_wpc_featured_badge_color</code></td><td>Featured badge color (hex)</td><td>string</td></tr>
                    <tr><td><code>_wpc_competitors</code></td><td>Default competitor IDs</td><td>array</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * Danger Zone Tab
 */
function wpc_render_danger_zone_tab() {
    ?>
    <div style="max-width: 800px;">
        <?php wp_nonce_field( 'wpc_import_export_nonce', 'wpc_ie_nonce' ); ?>
        
        <!-- Spinner Style -->
        <style>
            .wpc-spinner {
                display: inline-block;
                width: 16px;
                height: 16px;
                border: 2px solid #e2e8f0;
                border-top-color: #0284c7;
                border-radius: 50%;
                animation: wpc-spin 0.8s linear infinite;
                margin-right: 8px;
                vertical-align: middle;
            }
            @keyframes wpc-spin {
                to { transform: rotate(360deg); }
            }
            .wpc-tool-status {
                margin-top: 12px;
                padding: 10px 12px;
                border-radius: 4px;
                font-size: 13px;
                display: none;
            }
            .wpc-tool-status.success {
                background: #f0fdf4;
                border: 1px solid #86efac;
                color: #166534;
            }
            .wpc-tool-status.error {
                background: #fef2f2;
                border: 1px solid #fca5a5;
                color: #dc2626;
            }
            .wpc-tool-status.loading {
                background: #f0f9ff;
                border: 1px solid #bae6fd;
                color: #0369a1;
            }
        </style>
        
        <!-- Maintenance Tools Section -->
        <div style="background: #f0f9ff; border: 2px solid #0284c7; border-radius: 8px; padding: 30px; margin-bottom: 30px;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <span style="font-size: 40px;">&#128295;</span>
                <div>
                    <h2 style="margin: 0; color: #0369a1;"><?php _e( 'Maintenance Tools', 'wp-comparison-builder' ); ?></h2>
                    <p style="margin: 5px 0 0 0; color: #0c4a6e;">Safe utilities to maintain and troubleshoot your data.</p>
                </div>
            </div>
            
            <!-- Clear Transients -->
            <div style="background: #fff; border: 1px solid #bae6fd; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #0369a1;"><?php _e( 'Clear Plugin Cache', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Remove all cached data and transients. Useful if you see stale or incorrect data.
                        </p>
                    </div>
                    <button type="button" id="wpc-clear-cache-btn" class="button button-secondary" style="white-space: nowrap;">
                        <?php _e( 'Clear Cache', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                <div id="wpc-cache-status" class="wpc-tool-status"></div>
            </div>
            
            <!-- Fix Orphaned Data -->
            <div style="background: #fff; border: 1px solid #bae6fd; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #0369a1;"><?php _e( 'Clean Orphaned Data', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Remove leftover meta data from deleted items. Keeps your database clean.
                        </p>
                    </div>
                    <button type="button" id="wpc-orphan-btn" class="button button-secondary" style="white-space: nowrap;">
                        <?php _e( 'Clean Up', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                <div id="wpc-orphan-status" class="wpc-tool-status"></div>
            </div>
            
            <!-- Rebuild Term Counts -->
            <div style="background: #fff; border: 1px solid #bae6fd; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #0369a1;"><?php _e( 'Rebuild Term Counts', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Recalculate category and feature item counts. Fixes incorrect numbers.
                        </p>
                    </div>
                    <button type="button" id="wpc-recount-btn" class="button button-secondary" style="white-space: nowrap;">
                        <?php _e( 'Rebuild Counts', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                <div id="wpc-recount-status" class="wpc-tool-status"></div>
            </div>
            
            <!-- Data Integrity Check -->
            <div style="background: #fff; border: 1px solid #bae6fd; border-radius: 6px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #0369a1;"><?php _e( 'Check Data Integrity', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Scan all items and identify potential issues (missing fields, broken links, etc.).
                        </p>
                    </div>
                    <button type="button" id="wpc-integrity-btn" class="button button-secondary" style="white-space: nowrap;">
                        <?php _e( 'Run Check', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                <div id="wpc-integrity-status" class="wpc-tool-status"></div>
            </div>
        </div>
        
        <!-- Danger Zone Section -->
        <div style="background: #fef2f2; border: 2px solid #dc2626; border-radius: 8px; padding: 30px; margin-bottom: 30px;">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <span style="font-size: 40px;">&#x26A0;&#xFE0F;</span>
                <div>
                    <h2 style="margin: 0; color: #dc2626;"><?php _e( 'Danger Zone', 'wp-comparison-builder' ); ?></h2>
                    <p style="margin: 5px 0 0 0; color: #991b1b;">These actions can cause data loss and cannot be undone.</p>
                </div>
            </div>
            
            <!-- Reset Settings -->
            <div style="background: #fff; border: 1px solid #fca5a5; border-radius: 6px; padding: 20px; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #b91c1c;"><?php _e( 'Reset Settings to Default', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Select which settings to reset. Your items, lists, categories, and features will NOT be affected.
                        </p>
                    </div>
                    <button type="button" id="wpc-reset-expand-btn" class="button" style="border-color: #f97316; color: #ea580c; white-space: nowrap;">
                        <?php _e( 'Reset Settings', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                
                <!-- Inline Confirmation Panel -->
                <div id="wpc-reset-panel" style="display: none; margin-top: 15px; padding: 15px; background: #fef3c7; border: 1px solid #fbbf24; border-radius: 6px;">
                    <h4 style="margin: 0 0 10px 0; color: #92400e;">Select settings to reset:</h4>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 8px; margin-bottom: 15px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="wpc-reset-all" checked>
                            <strong>Select All</strong>
                        </label>
                    </div>
                    
                    <div id="wpc-reset-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 8px; margin-bottom: 15px; padding: 10px; background: #fff; border-radius: 4px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="colors" checked class="wpc-reset-opt">
                            Colors (Primary, Accent, etc.)
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="filter" checked class="wpc-reset-opt">
                            Filter Style
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="card" checked class="wpc-reset-opt">
                            Card Layout
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="pricing" checked class="wpc-reset-opt">
                            Pricing Table Settings
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="comparison" checked class="wpc-reset-opt">
                            Comparison Popup Settings
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="reset_option" value="schema" checked class="wpc-reset-opt">
                            Schema SEO Settings
                        </label>
                    </div>
                    
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <button type="button" id="wpc-reset-confirm-btn" class="button" style="background: #f97316; border-color: #f97316; color: #fff;">
                            Confirm Reset
                        </button>
                        <button type="button" id="wpc-reset-cancel-btn" class="button">
                            Cancel
                        </button>
                    </div>
                </div>
                
                <div id="wpc-reset-status" class="wpc-tool-status"></div>
            </div>
            
            <!-- Delete All Data -->
            <div style="background: #fff; border: 2px solid #dc2626; border-radius: 6px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; color: #dc2626;"><?php _e( 'Delete Data', 'wp-comparison-builder' ); ?></h3>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">
                            Select what to delete. <strong style="color: #dc2626;">This action cannot be undone!</strong>
                        </p>
                    </div>
                    <button type="button" id="wpc-delete-expand-btn" class="button" style="background: #dc2626; border-color: #dc2626; color: #fff; white-space: nowrap;">
                        <?php _e( 'Delete Data', 'wp-comparison-builder' ); ?>
                    </button>
                </div>
                
                <!-- Inline Confirmation Panel -->
                <div id="wpc-delete-panel" style="display: none; margin-top: 15px; padding: 15px; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 6px;">
                    <h4 style="margin: 0 0 10px 0; color: #dc2626;">&#x26A0;&#xFE0F; Critical: Select what to delete:</h4>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 8px; margin-bottom: 15px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" id="wpc-delete-all">
                            <strong>Select All</strong>
                        </label>
                    </div>
                    
                    <div id="wpc-delete-options" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 8px; margin-bottom: 15px; padding: 10px; background: #fff; border-radius: 4px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="delete_option" value="items" class="wpc-delete-opt">
                            All Comparison Items
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="delete_option" value="lists" class="wpc-delete-opt">
                            All Custom Lists
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="delete_option" value="categories" class="wpc-delete-opt">
                            All Categories
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="delete_option" value="features" class="wpc-delete-opt">
                            All Features
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="delete_option" value="settings" class="wpc-delete-opt">
                            All Settings
                        </label>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: #991b1b; font-weight: bold;">Type "DELETE" to confirm:</label>
                        <input type="text" id="wpc-delete-confirm-text" placeholder="Type DELETE here" style="width: 200px; padding: 8px; border: 2px solid #dc2626; border-radius: 4px;">
                    </div>
                    
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <button type="button" id="wpc-delete-confirm-btn" class="button" style="background: #dc2626; border-color: #dc2626; color: #fff;">
                            Confirm Delete
                        </button>
                        <button type="button" id="wpc-delete-cancel-btn" class="button">
                            Cancel
                        </button>
                    </div>
                </div>
                
                <div id="wpc-delete-status" class="wpc-tool-status"></div>
            </div>
        </div>
        
        <!-- Tips Section -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px;">
            <h3 style="margin: 0 0 15px 0; color: #334155;">&#x1F4A1; Tips</h3>
            <ul style="margin: 0; padding-left: 20px; color: #64748b;">
                <li><strong>Maintenance Tools</strong> are safe to run anytime – they don't delete your content</li>
                <li><strong>Export your data first</strong> before using Danger Zone options</li>
                <li>Run <strong>Data Integrity Check</strong> periodically to catch potential issues early</li>
            </ul>
        </div>
    </div>
    
    <script>
    (function() {
        const nonce = document.getElementById('wpc_ie_nonce').value;
        
        function showStatus(elementId, message, type = 'loading') {
            const el = document.getElementById(elementId);
            el.className = 'wpc-tool-status ' + type;
            el.innerHTML = message;
            el.style.display = 'block';
            
            // Premium Toast Integration
            if (type === 'success') {
                if (message.includes('<br>')) {
                    wpcAdmin.toast('Operation completed. See details below.', 'success');
                } else {
                    wpcAdmin.toast(message.replace(/<[^>]*>?/gm, ''), 'success');
                }
            } else if (type === 'error') {
                 wpcAdmin.toast('Error: ' + message.replace(/<[^>]*>?/gm, ''), 'error');
            }
        }
        
        function showLoading(elementId, message) {
            showStatus(elementId, '<span class="wpc-spinner-icon"></span> ' + message, 'loading');
        }
        
        // Clear Cache
        document.getElementById('wpc-clear-cache-btn').addEventListener('click', function() {
            const btn = this;
            wpcAdmin.loading(btn, 'Clearing...');
            showLoading('wpc-cache-status', 'Clearing cache...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_clear_cache');
            formData.append('nonce', nonce);
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        showStatus('wpc-cache-status', '\u2713 Cache cleared! ' + data.data.message, 'success');
                    } else {
                        showStatus('wpc-cache-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-cache-status', '\u2717 Operation failed', 'error'); 
                });
        });
        
        // Clean Orphaned Data
        document.getElementById('wpc-orphan-btn').addEventListener('click', function() {
            const btn = this;
            wpcAdmin.loading(btn, 'Cleaning...');
            showLoading('wpc-orphan-status', 'Cleaning orphaned data...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_clean_orphans');
            formData.append('nonce', nonce);
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        showStatus('wpc-orphan-status', '\u2713 Cleanup complete! Removed ' + data.data.cleaned + ' orphaned entries.', 'success');
                    } else {
                        showStatus('wpc-orphan-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-orphan-status', '\u2717 Operation failed', 'error'); 
                });
        });
        
        // Rebuild Term Counts
        document.getElementById('wpc-recount-btn').addEventListener('click', function() {
            const btn = this;
            wpcAdmin.loading(btn, 'Rebuilding...');
            showLoading('wpc-recount-status', 'Rebuilding term counts...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_rebuild_counts');
            formData.append('nonce', nonce);
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        showStatus('wpc-recount-status', '\u2713 Term counts rebuilt! Categories: ' + data.data.categories + ', Features: ' + data.data.features, 'success');
                    } else {
                        showStatus('wpc-recount-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-recount-status', '\u2717 Operation failed', 'error'); 
                });
        });
        
        // Data Integrity Check
        document.getElementById('wpc-integrity-btn').addEventListener('click', function() {
            const btn = this;
            wpcAdmin.loading(btn, 'Checking...');
            showLoading('wpc-integrity-status', 'Running integrity check...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_integrity_check');
            formData.append('nonce', nonce);
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        const d = data.data;
                        let html = '<strong>&#x2713; Integrity Check Complete</strong><br><br>';
                        html += '<strong>Summary:</strong><br>';
                        html += '\u2022 Total Items: ' + d.total_items + '<br>';
                        html += '\u2022 Total Lists: ' + d.total_lists + '<br>';
                        html += '\u2022 Categories: ' + d.total_categories + '<br>';
                        html += '\u2022 Features: ' + d.total_features + '<br><br>';
                        
                        if (d.issues.length > 0) {
                            html += '<strong style="color: #f59e0b;">\u26A0\uFE0F Issues Found (' + d.issues.length + '):</strong><br>';
                            d.issues.forEach(function(issue) {
                                html += '\u2022 ' + issue + '<br>';
                            });
                            showStatus('wpc-integrity-status', html, 'success');
                        } else {
                            html += '<strong style="color: #16a34a;">\u2713 No issues found!</strong>';
                            showStatus('wpc-integrity-status', html, 'success');
                        }
                    } else {
                        showStatus('wpc-integrity-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-integrity-status', '\u2717 Operation failed', 'error'); 
                });
        });
        
        // ========== RESET SETTINGS ==========
        
        // Expand Reset Panel
        document.getElementById('wpc-reset-expand-btn').addEventListener('click', function() {
            const panel = document.getElementById('wpc-reset-panel');
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        });
        
        // Cancel Reset
        document.getElementById('wpc-reset-cancel-btn').addEventListener('click', function() {
            document.getElementById('wpc-reset-panel').style.display = 'none';
        });
        
        // Select All Reset Options
        document.getElementById('wpc-reset-all').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.wpc-reset-opt').forEach(cb => cb.checked = isChecked);
        });
        
        // Update Select All when individual options change
        document.querySelectorAll('.wpc-reset-opt').forEach(cb => {
            cb.addEventListener('change', function() {
                const allOpts = document.querySelectorAll('.wpc-reset-opt');
                const checkedOpts = document.querySelectorAll('.wpc-reset-opt:checked');
                document.getElementById('wpc-reset-all').checked = allOpts.length === checkedOpts.length;
            });
        });
        
        // Confirm Reset
        document.getElementById('wpc-reset-confirm-btn').addEventListener('click', function() {
            const selectedOpts = [];
            document.querySelectorAll('.wpc-reset-opt:checked').forEach(cb => selectedOpts.push(cb.value));
            
            if (selectedOpts.length === 0) {
                wpcAdmin.toast('Please select at least one setting to reset.', 'error');
                return;
            }
            
            const btn = this;
            wpcAdmin.loading(btn, 'Resetting...');
            showLoading('wpc-reset-status', 'Resetting selected settings...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_reset_settings');
            formData.append('nonce', nonce);
            formData.append('options', JSON.stringify(selectedOpts));
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        document.getElementById('wpc-reset-panel').style.display = 'none';
                        showStatus('wpc-reset-status', '\u2713 Selected settings reset to defaults! <a href="">Refresh page to see changes</a>', 'success');
                    } else {
                        showStatus('wpc-reset-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-reset-status', '\u2717 Reset failed', 'error'); 
                });
        });
        
        // ========== DELETE DATA ==========
        
        // Expand Delete Panel
        document.getElementById('wpc-delete-expand-btn').addEventListener('click', function() {
            const panel = document.getElementById('wpc-delete-panel');
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        });
        
        // Cancel Delete
        document.getElementById('wpc-delete-cancel-btn').addEventListener('click', function() {
            document.getElementById('wpc-delete-panel').style.display = 'none';
            document.getElementById('wpc-delete-confirm-text').value = '';
        });
        
        // Select All Delete Options
        document.getElementById('wpc-delete-all').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.wpc-delete-opt').forEach(cb => cb.checked = isChecked);
        });
        
        // Update Select All when individual options change
        document.querySelectorAll('.wpc-delete-opt').forEach(cb => {
            cb.addEventListener('change', function() {
                const allOpts = document.querySelectorAll('.wpc-delete-opt');
                const checkedOpts = document.querySelectorAll('.wpc-delete-opt:checked');
                document.getElementById('wpc-delete-all').checked = allOpts.length === checkedOpts.length;
            });
        });
        
        // Confirm Delete
        document.getElementById('wpc-delete-confirm-btn').addEventListener('click', function() {
            const confirmText = document.getElementById('wpc-delete-confirm-text').value;
            if (confirmText !== 'DELETE') {
                wpcAdmin.toast('Please type "DELETE" to confirm.', 'error');
                return;
            }
            
            const selectedOpts = [];
            document.querySelectorAll('.wpc-delete-opt:checked').forEach(cb => selectedOpts.push(cb.value));
            
            if (selectedOpts.length === 0) {
                wpcAdmin.toast('Please select at least one data type to delete.', 'error');
                return;
            }
            
            const btn = this;
            wpcAdmin.loading(btn, 'Deleting...');
            showLoading('wpc-delete-status', 'Deleting selected data... Please wait...');
            
            const formData = new FormData();
            formData.append('action', 'wpc_delete_all_data');
            formData.append('nonce', nonce);
            formData.append('options', JSON.stringify(selectedOpts));
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    wpcAdmin.reset(btn);
                    if (data.success) {
                        const r = data.data;
                        document.getElementById('wpc-delete-panel').style.display = 'none';
                        document.getElementById('wpc-delete-confirm-text').value = '';
                        showStatus('wpc-delete-status', `\u2713 Data deleted successfully!<br><br>
                            <strong>Deleted:</strong><br>
                            â€¢ Items: ${r.items_deleted || 0}<br>
                            â€¢ Lists: ${r.lists_deleted || 0}<br>
                            â€¢ Categories: ${r.categories_deleted || 0}<br>
                            â€¢ Features: ${r.features_deleted || 0}<br>
                            ${r.settings_reset ? 'â€¢ Settings: Reset to defaults' : ''}`, 'success');
                    } else {
                        showStatus('wpc-delete-status', '\u2717 Error: ' + data.data, 'error');
                    }
                })
                .catch(e => { 
                    wpcAdmin.reset(btn);
                    showStatus('wpc-delete-status', '\u2717 Delete operation failed', 'error'); 
                });
        });
    })();
    </script>
    <?php
}

/**
 * AJAX: Clear plugin cache/transients
 */
add_action( 'wp_ajax_wpc_clear_cache', 'wpc_ajax_clear_cache' );
function wpc_ajax_clear_cache() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }
    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );
    
    global $wpdb;
    
    // Delete all transients with our prefix
    $deleted = $wpdb->query(
        "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_wpc_%' OR option_name LIKE '_transient_timeout_wpc_%'"
    );
    
    // Also clear any object cache if available
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }
    
    wp_send_json_success( array( 'message' => 'Removed ' . intval($deleted / 2) . ' cached entries.' ) );
}

/**
 * AJAX: Clean orphaned post meta
 */
add_action( 'wp_ajax_wpc_clean_orphans', 'wpc_ajax_clean_orphans' );
function wpc_ajax_clean_orphans() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }
    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );
    
    global $wpdb;
    
    // Find and delete orphaned post meta (meta for posts that no longer exist)
    $deleted = $wpdb->query(
        "DELETE pm FROM {$wpdb->postmeta} pm
         LEFT JOIN {$wpdb->posts} p ON pm.post_id = p.ID
         WHERE p.ID IS NULL AND pm.meta_key LIKE '_wpc_%'"
    );
    
    wp_send_json_success( array( 'cleaned' => intval($deleted) ) );
}

/**
 * AJAX: Rebuild term counts
 */
add_action( 'wp_ajax_wpc_rebuild_counts', 'wpc_ajax_rebuild_counts' );
function wpc_ajax_rebuild_counts() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }
    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );
    
    // Get all terms and recount
    $cat_terms = get_terms( array( 'taxonomy' => 'comparison_category', 'hide_empty' => false, 'fields' => 'ids' ) );
    $feat_terms = get_terms( array( 'taxonomy' => 'comparison_feature', 'hide_empty' => false, 'fields' => 'ids' ) );
    
    $cat_count = 0;
    $feat_count = 0;
    
    if ( ! is_wp_error( $cat_terms ) ) {
        foreach ( $cat_terms as $term_id ) {
            wp_update_term_count_now( array( $term_id ), 'comparison_category' );
            $cat_count++;
        }
    }
    
    if ( ! is_wp_error( $feat_terms ) ) {
        foreach ( $feat_terms as $term_id ) {
            wp_update_term_count_now( array( $term_id ), 'comparison_feature' );
            $feat_count++;
        }
    }
    
    wp_send_json_success( array( 'categories' => $cat_count, 'features' => $feat_count ) );
}

/**
 * AJAX: Data integrity check
 */
add_action( 'wp_ajax_wpc_integrity_check', 'wpc_ajax_integrity_check' );
function wpc_ajax_integrity_check() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }
    check_ajax_referer( 'wpc_import_export_nonce', 'nonce' );
    
    $issues = array();
    
    // Get all comparison items
    $items = get_posts( array( 'post_type' => 'comparison_item', 'posts_per_page' => -1, 'post_status' => 'any' ) );
    $lists = get_posts( array( 'post_type' => 'comparison_list', 'posts_per_page' => -1, 'post_status' => 'any' ) );
    $categories = get_terms( array( 'taxonomy' => 'comparison_category', 'hide_empty' => false ) );
    $features = get_terms( array( 'taxonomy' => 'comparison_feature', 'hide_empty' => false ) );
    
    // Check items
    foreach ( $items as $item ) {
        $title = $item->post_title;
        
        // Check for missing website URL
        $url = get_post_meta( $item->ID, '_wpc_website_url', true );
        if ( empty( $url ) ) {
            $issues[] = "Item \"{$title}\" (ID: {$item->ID}) has no website URL";
        }
        
        // Check for missing description
        $desc = get_post_meta( $item->ID, '_wpc_short_description', true );
        if ( empty( $desc ) ) {
            $issues[] = "Item \"{$title}\" (ID: {$item->ID}) has no description";
        }
        
        // Check for no categories
        $cats = wp_get_post_terms( $item->ID, 'comparison_category' );
        if ( empty( $cats ) || is_wp_error( $cats ) ) {
            $issues[] = "Item \"{$title}\" (ID: {$item->ID}) has no categories assigned";
        }
    }
    
    // Check lists for orphaned item references
    foreach ( $lists as $list ) {
        $list_items = get_post_meta( $list->ID, '_wpc_list_items', true );
        if ( is_array( $list_items ) ) {
            foreach ( $list_items as $list_item ) {
                $item_id = isset( $list_item['id'] ) ? intval( $list_item['id'] ) : 0;
                if ( $item_id && get_post_status( $item_id ) === false ) {
                    $issues[] = "List \"{$list->post_title}\" references deleted item ID: {$item_id}";
                }
            }
        }
    }
    
    // Limit issues to 20 for readability
    if ( count( $issues ) > 20 ) {
        $total = count( $issues );
        $issues = array_slice( $issues, 0, 20 );
        $issues[] = "... and " . ($total - 20) . " more issues.";
    }
    
    wp_send_json_success( array(
        'total_items' => count( $items ),
        'total_lists' => count( $lists ),
        'total_categories' => is_wp_error( $categories ) ? 0 : count( $categories ),
        'total_features' => is_wp_error( $features ) ? 0 : count( $features ),
        'issues' => $issues
    ) );
}

/**
 * Schema SEO Tab
 */
function wpc_render_schema_seo_tab() {
    $settings = function_exists('wpc_get_schema_settings') ? wpc_get_schema_settings() : array(
        'enabled' => '1',
        'product_type' => 'Product',
        'currency' => 'USD',
        'include_rating' => '1',
        'include_offers' => '1',
        'include_pros_cons' => '1',
    );
    ?>
    <div style="max-width: 800px;">
        <?php wp_nonce_field( 'wpc_schema_settings_nonce', 'wpc_schema_nonce' ); ?>
        
        <div style="background: #f0fdf4; border: 2px solid #16a34a; border-radius: 8px; padding: 30px; margin-bottom: 30px;">
            <div style="margin-bottom: 20px;">
                <h2 style="margin: 0; color: #166534;"><?php _e( 'Schema SEO Settings', 'wp-comparison-builder' ); ?></h2>
                <p style="margin: 5px 0 0 0; color: #15803d;">Configure structured data for better search engine visibility.</p>
            </div>
            
            <!-- Enable/Disable Schema -->
            <div style="background: #fff; border: 1px solid #bbf7d0; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" id="wpc-schema-enabled" <?php checked( $settings['enabled'], '1' ); ?>>
                    <div>
                        <strong style="color: #166534;">Enable Schema Output</strong>
                        <p style="margin: 0; color: #6b7280; font-size: 13px;">Generate JSON-LD structured data for comparison items</p>
                    </div>
                </label>
            </div>
            
            <!-- Product Type -->
            <div style="background: #fff; border: 1px solid #bbf7d0; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 10px;">
                    <strong style="color: #166534;">Product Type</strong>
                    <p style="margin: 5px 0 10px 0; color: #6b7280; font-size: 13px;">Choose the Schema.org type that best describes your items</p>
                </label>
                <select id="wpc-schema-product-type" style="width: 100%; padding: 8px;">
                    <option value="Product" <?php selected( $settings['product_type'], 'Product' ); ?>>Product (Generic)</option>
                    <option value="SoftwareApplication" <?php selected( $settings['product_type'], 'SoftwareApplication' ); ?>>SoftwareApplication (Apps, SaaS)</option>
                    <option value="Service" <?php selected( $settings['product_type'], 'Service' ); ?>>Service (Services, Hosting)</option>
                    <option value="WebApplication" <?php selected( $settings['product_type'], 'WebApplication' ); ?>>WebApplication (Web Apps)</option>
                </select>
            </div>
            
            <!-- Currency -->
            <div style="background: #fff; border: 1px solid #bbf7d0; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 10px;">
                    <strong style="color: #166534;">Default Currency</strong>
                    <p style="margin: 5px 0 10px 0; color: #6b7280; font-size: 13px;">Currency code for pricing (ISO 4217)</p>
                </label>
                <select id="wpc-schema-currency" style="width: 100%; padding: 8px;">
                    <option value="USD" <?php selected( $settings['currency'], 'USD' ); ?>>USD - US Dollar</option>
                    <option value="EUR" <?php selected( $settings['currency'], 'EUR' ); ?>>EUR - Euro</option>
                    <option value="GBP" <?php selected( $settings['currency'], 'GBP' ); ?>>GBP - British Pound</option>
                    <option value="CAD" <?php selected( $settings['currency'], 'CAD' ); ?>>CAD - Canadian Dollar</option>
                    <option value="AUD" <?php selected( $settings['currency'], 'AUD' ); ?>>AUD - Australian Dollar</option>
                    <option value="INR" <?php selected( $settings['currency'], 'INR' ); ?>>INR - Indian Rupee</option>
                    <option value="BDT" <?php selected( $settings['currency'], 'BDT' ); ?>>BDT - Bangladeshi Taka</option>
                </select>
            </div>
            
            <!-- Include Options -->
            <div style="background: #fff; border: 1px solid #bbf7d0; border-radius: 6px; padding: 20px; margin-bottom: 15px;">
                <strong style="display: block; margin-bottom: 15px; color: #166534;">Include in Schema</strong>
                
                <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                    <input type="checkbox" id="wpc-schema-rating" <?php checked( $settings['include_rating'], '1' ); ?>>
                    <span>Aggregate Rating (star ratings)</span>
                </label>
                
                <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                    <input type="checkbox" id="wpc-schema-offers" <?php checked( $settings['include_offers'], '1' ); ?>>
                    <span>Offers (pricing information)</span>
                </label>
                
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" id="wpc-schema-pros-cons" <?php checked( $settings['include_pros_cons'], '1' ); ?>>
                    <span>Pros & Cons (as review positiveNotes/negativeNotes)</span>
                </label>
            </div>
            
            <button type="button" id="wpc-save-schema-settings" class="button button-primary" style="background: #16a34a; border-color: #16a34a;">
                <?php _e( 'Save Schema Settings', 'wp-comparison-builder' ); ?>
            </button>
            
            <span id="wpc-schema-status" style="margin-left: 15px;"></span>
        </div>
        
        <!-- Info Section -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 20px;">
            <h3 style="margin: 0 0 15px 0; color: #334155;">&#x1F4A1; How Schema Works</h3>
            <ul style="margin: 0; padding-left: 20px; color: #64748b;">
                <li><strong>Single Item Pages:</strong> Schema is automatically output in the &lt;head&gt;</li>
                <li><strong>Custom Lists:</strong> ItemList schema is generated with all items in the list</li>
                <li><strong>Preview:</strong> View the generated schema at the bottom of each item's edit page</li>
                <li><strong>Validation:</strong> Use <a href="https://search.google.com/test/rich-results" target="_blank">Google Rich Results Test</a> to validate</li>
            </ul>
        </div>
    </div>
    
    <script>
    (function() {
        document.getElementById('wpc-save-schema-settings').addEventListener('click', function() {
            var btn = this;
            wpcAdmin.loading(btn, 'Saving...');
            
            const settings = {
                enabled: document.getElementById('wpc-schema-enabled').checked ? '1' : '0',
                product_type: document.getElementById('wpc-schema-product-type').value,
                currency: document.getElementById('wpc-schema-currency').value,
                include_rating: document.getElementById('wpc-schema-rating').checked ? '1' : '0',
                include_offers: document.getElementById('wpc-schema-offers').checked ? '1' : '0',
                include_pros_cons: document.getElementById('wpc-schema-pros-cons').checked ? '1' : '0',
            };
            
            const formData = new FormData();
            formData.append('action', 'wpc_save_schema_settings');
            formData.append('nonce', document.getElementById('wpc_schema_nonce').value);
            formData.append('settings', JSON.stringify(settings));
            
            fetch(ajaxurl, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        wpcAdmin.toast('Schema settings saved successfully!', 'success');
                    } else {
                        wpcAdmin.toast('Error saving settings', 'error');
                    }
                    wpcAdmin.reset(btn);
                    // Clear old status if any
                    document.getElementById('wpc-schema-status').innerText = '';
                })
                .catch(e => { 
                    wpcAdmin.toast('Request failed', 'error');
                    wpcAdmin.reset(btn);
                });
        });
    })();
    </script>
    <?php
}

/**
 * AJAX: Save schema settings
 */
add_action( 'wp_ajax_wpc_save_schema_settings', 'wpc_ajax_save_schema_settings' );
function wpc_ajax_save_schema_settings() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Unauthorized' );
    }
    
    check_ajax_referer( 'wpc_schema_settings_nonce', 'nonce' );
    
    $settings = json_decode( stripslashes( $_POST['settings'] ), true );
    
    if ( ! is_array( $settings ) ) {
        wp_send_json_error( 'Invalid settings' );
    }
    
    // Sanitize
    $clean_settings = array(
        'enabled' => isset( $settings['enabled'] ) ? sanitize_text_field( $settings['enabled'] ) : '1',
        'product_type' => isset( $settings['product_type'] ) ? sanitize_text_field( $settings['product_type'] ) : 'Product',
        'currency' => isset( $settings['currency'] ) ? sanitize_text_field( $settings['currency'] ) : 'USD',
        'include_rating' => isset( $settings['include_rating'] ) ? sanitize_text_field( $settings['include_rating'] ) : '1',
        'include_offers' => isset( $settings['include_offers'] ) ? sanitize_text_field( $settings['include_offers'] ) : '1',
        'include_pros_cons' => isset( $settings['include_pros_cons'] ) ? sanitize_text_field( $settings['include_pros_cons'] ) : '1',
    );
    
    update_option( 'wpc_schema_settings', $clean_settings );
    
    wp_send_json_success( 'Settings saved' );
}

/**
 * Text Labels Tab Render Function
 */
function wpc_render_texts_tab() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'wpc_settings_group' ); ?>
        <?php do_settings_sections( 'wpc_settings_group' ); ?>
        
        <h2><?php _e( 'Text Label Customization', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Customize the text labels displayed on the frontend. Leave empty to use default values.', 'wp-comparison-builder' ); ?></p>
        
        <table class="form-table">
            <!-- Details / Links -->
            <tr valign="top">
                <th scope="row"><label for="wpc_text_view_details"><?php _e( 'View Details Button', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_view_details" name="wpc_text_view_details" value="<?php echo esc_attr( get_option( 'wpc_text_view_details', '' ) ); ?>" class="regular-text" placeholder="e.g. Visit {name}" />
                    <p class="description">Button text for visiting the provider. Use <code>{name}</code> placeholder.</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_visit"><?php _e( 'Visit Button (Short)', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_visit" name="wpc_text_visit" value="<?php echo esc_attr( get_option( 'wpc_text_visit', '' ) ); ?>" class="regular-text" placeholder="e.g. Visit" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_compare_alternatives"><?php _e( 'Compare Button (Hero)', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_compare_alternatives" name="wpc_text_compare_alternatives" value="<?php echo esc_attr( get_option( 'wpc_text_compare_alternatives', '' ) ); ?>" class="regular-text" placeholder="e.g. Compare Alternatives" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_compare_now"><?php _e( 'Compare Now Button', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_compare_now" name="wpc_text_compare_now" value="<?php echo esc_attr( get_option( 'wpc_text_compare_now', '' ) ); ?>" class="regular-text" placeholder="e.g. Compare Now" />
                </td>
            </tr>

            <!-- Navigation -->
            <tr valign="top">
                <th scope="row"><label for="wpc_text_back_to_reviews"><?php _e( 'Home / Back Link', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_back_to_reviews" name="wpc_text_back_to_reviews" value="<?php echo esc_attr( get_option( 'wpc_text_back_to_reviews', '' ) ); ?>" class="regular-text" placeholder="e.g. Home" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_reviews"><?php _e( 'Reviews Breadcrumb', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_reviews" name="wpc_text_reviews" value="<?php echo esc_attr( get_option( 'wpc_text_reviews', '' ) ); ?>" class="regular-text" placeholder="e.g. Reviews" />
                </td>
            </tr>

            <!-- Table Headers -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Comparison Table Headers</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Feature Column Header', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_header" value="<?php echo esc_attr( get_option( 'wpc_text_feat_header', 'Feature' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Pros Row Header', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_pros" value="<?php echo esc_attr( get_option( 'wpc_text_pros', 'Pros' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Cons Row Header', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_cons" value="<?php echo esc_attr( get_option( 'wpc_text_cons', 'Cons' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Price Row Header', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_price" value="<?php echo esc_attr( get_option( 'wpc_text_price', 'Price' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Rating Row Header', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_rating" value="<?php echo esc_attr( get_option( 'wpc_text_rating', 'Rating' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Month Suffix (/mo)', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_mo_suffix" value="<?php echo esc_attr( get_option( 'wpc_text_mo_suffix', '/mo' ) ); ?>" class="regular-text" /></td>
            </tr>

            <!-- Feature Labels -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Feature Labels</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( '"Products" Label', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_prod" value="<?php echo esc_attr( get_option( 'wpc_text_feat_prod', 'Products' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( '"Trans. Fees" Label', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_fees" value="<?php echo esc_attr( get_option( 'wpc_text_feat_fees', 'Trans. Fees' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( '"Sales Channels" Label', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_channels" value="<?php echo esc_attr( get_option( 'wpc_text_feat_channels', 'Sales Channels' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( '"Free SSL" Label', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_ssl" value="<?php echo esc_attr( get_option( 'wpc_text_feat_ssl', 'Free SSL' ) ); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( '"Support" Label', 'wp-comparison-builder' ); ?></label></th>
                <td><input type="text" name="wpc_text_feat_supp" value="<?php echo esc_attr( get_option( 'wpc_text_feat_supp', 'Support' ) ); ?>" class="regular-text" /></td>
            </tr>

            <!-- Filters & Search -->
            <tr valign="top">
                <th scope="row"><label for="wpc_text_filters"><?php _e( 'Filters Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_filters" name="wpc_text_filters" value="<?php echo esc_attr( get_option( 'wpc_text_filters', '' ) ); ?>" class="regular-text" placeholder="e.g. Filters" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_search_placeholder"><?php _e( 'Search Placeholder', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_search_placeholder" name="wpc_text_search_placeholder" value="<?php echo esc_attr( get_option( 'wpc_text_search_placeholder', '' ) ); ?>" class="regular-text" placeholder="e.g. Search by name..." />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_sort_default"><?php _e( 'Sort: Default Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_sort_default" name="wpc_text_sort_default" value="<?php echo esc_attr( get_option( 'wpc_text_sort_default', '' ) ); ?>" class="regular-text" placeholder="e.g. Sort: Default" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_category"><?php _e( 'Category Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_category" name="wpc_text_category" value="<?php echo esc_attr( get_option( 'wpc_text_category', '' ) ); ?>" class="regular-text" placeholder="e.g. Category" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_features"><?php _e( 'Features Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_features" name="wpc_text_features" value="<?php echo esc_attr( get_option( 'wpc_text_features', '' ) ); ?>" class="regular-text" placeholder="e.g. Platform Features" />
                </td>
            </tr>
            
            <!-- Misc -->
            <tr valign="top">
                <th scope="row"><label for="wpc_text_items_count"><?php _e( 'Item Count Label (Plural)', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_items_count" name="wpc_text_items_count" value="<?php echo esc_attr( get_option( 'wpc_text_items_count', '' ) ); ?>" class="regular-text" placeholder="e.g. items" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_selected"><?php _e( 'Selected Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_selected" name="wpc_text_selected" value="<?php echo esc_attr( get_option( 'wpc_text_selected', '' ) ); ?>" class="regular-text" placeholder="e.g. Selected:" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_clear_all"><?php _e( 'Clear All Link', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_clear_all" name="wpc_text_clear_all" value="<?php echo esc_attr( get_option( 'wpc_text_clear_all', '' ) ); ?>" class="regular-text" placeholder="e.g. Clear all" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_about"><?php _e( 'About Section Title', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_about" name="wpc_text_about" value="<?php echo esc_attr( get_option( 'wpc_text_about', '' ) ); ?>" class="regular-text" placeholder="e.g. About {name}" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_no_compare"><?php _e( '"No Items" Text', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_no_compare" name="wpc_text_no_compare" value="<?php echo esc_attr( get_option( 'wpc_text_no_compare', '' ) ); ?>" class="regular-text" placeholder="e.g. Select up to 4 items to compare" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_remove"><?php _e( '"Remove" Text', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_remove" name="wpc_text_remove" value="<?php echo esc_attr( get_option( 'wpc_text_remove', '' ) ); ?>" class="regular-text" placeholder="e.g. Remove" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_logo"><?php _e( '"Logo" Fallback', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_logo" name="wpc_text_logo" value="<?php echo esc_attr( get_option( 'wpc_text_logo', '' ) ); ?>" class="regular-text" placeholder="e.g. Logo" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_analysis"><?php _e( '"Analysis" Suffix', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_analysis" name="wpc_text_analysis" value="<?php echo esc_attr( get_option( 'wpc_text_analysis', '' ) ); ?>" class="regular-text" placeholder="e.g. (Based on our analysis)" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_start_price"><?php _e( '"Starting Price"', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_start_price" name="wpc_text_start_price" value="<?php echo esc_attr( get_option( 'wpc_text_start_price', '' ) ); ?>" class="regular-text" placeholder="e.g. Starting Price" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_dash_prev"><?php _e( '"Dashboard Preview"', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_dash_prev" name="wpc_text_dash_prev" value="<?php echo esc_attr( get_option( 'wpc_text_dash_prev', '' ) ); ?>" class="regular-text" placeholder="e.g. Dashboard Preview" />
                </td>
            </tr>

            <!-- Filter & Search Internal Labels -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Filter & Search Component Labels</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_category"><?php _e( 'Category Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_category" name="wpc_text_category" value="<?php echo esc_attr( get_option( 'wpc_text_category', '' ) ); ?>" class="regular-text" placeholder="e.g. Category" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_features"><?php _e( 'Features / Tags Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_features" name="wpc_text_features" value="<?php echo esc_attr( get_option( 'wpc_text_features', '' ) ); ?>" class="regular-text" placeholder="e.g. Tags" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_reset_filt"><?php _e( '"Reset Filters"', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_reset_filt" name="wpc_text_reset_filt" value="<?php echo esc_attr( get_option( 'wpc_text_reset_filt', '' ) ); ?>" class="regular-text" placeholder="e.g. Reset Filters" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_select_fmt"><?php _e( '"Select %s" Format', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_select_fmt" name="wpc_text_select_fmt" value="<?php echo esc_attr( get_option( 'wpc_text_select_fmt', '' ) ); ?>" class="regular-text" placeholder="e.g. Select %s" />
                     <p class="description">%s will be replaced by the category name (e.g. "Select Category")</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_clear"><?php _e( '"Clear" Button', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_clear" name="wpc_text_clear" value="<?php echo esc_attr( get_option( 'wpc_text_clear', '' ) ); ?>" class="regular-text" placeholder="e.g. Clear" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_sel_prov"><?php _e( '"Select provider..."', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_sel_prov" name="wpc_text_sel_prov" value="<?php echo esc_attr( get_option( 'wpc_text_sel_prov', '' ) ); ?>" class="regular-text" placeholder="e.g. Select provider..." />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_no_item"><?php _e( '"No item found."', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_no_item" name="wpc_text_no_item" value="<?php echo esc_attr( get_option( 'wpc_text_no_item', '' ) ); ?>" class="regular-text" placeholder="e.g. No item found." />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_more"><?php _e( '"more" Suffix', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_more" name="wpc_text_more" value="<?php echo esc_attr( get_option( 'wpc_text_more', '' ) ); ?>" class="regular-text" placeholder="e.g. more" />
                    <p class="description">Used in "+2 more" labels.</p>
                </td>
            </tr>
            
            <!-- Additional UI Texts -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Additional UI Texts</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_show_all"><?php _e( '"Show All Items"', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_show_all" name="wpc_text_show_all" value="<?php echo esc_attr( get_option( 'wpc_text_show_all', '' ) ); ?>" class="regular-text" placeholder="e.g. Show All Items" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_reveal_more"><?php _e( '"Click to reveal X more"', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_reveal_more" name="wpc_text_reveal_more" value="<?php echo esc_attr( get_option( 'wpc_text_reveal_more', '' ) ); ?>" class="regular-text" placeholder="e.g. Click to reveal" />
                    <p class="description"><?php _e( 'The number will be appended automatically (e.g. "Click to reveal 14 more")', 'wp-comparison-builder' ); ?></p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_no_logo"><?php _e( '"No Logo" Fallback', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_no_logo" name="wpc_text_no_logo" value="<?php echo esc_attr( get_option( 'wpc_text_no_logo', '' ) ); ?>" class="regular-text" placeholder="e.g. No Logo" />
                </td>
            </tr>
            
            <!-- Button & Action Texts -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Button & Action Texts</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_visit_site"><?php _e( '"Visit Site" Button', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_visit_site" name="wpc_text_visit_site" value="<?php echo esc_attr( get_option( 'wpc_text_visit_site', '' ) ); ?>" class="regular-text" placeholder="e.g. Visit Site" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_copied"><?php _e( '"Copied!" Feedback', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_copied" name="wpc_text_copied" value="<?php echo esc_attr( get_option( 'wpc_text_copied', '' ) ); ?>" class="regular-text" placeholder="e.g. Copied!" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_selected"><?php _e( '"Selected:" Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_selected" name="wpc_text_selected" value="<?php echo esc_attr( get_option( 'wpc_text_selected', '' ) ); ?>" class="regular-text" placeholder="e.g. Selected:" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_compare_now"><?php _e( '"Compare Now" Button', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_compare_now" name="wpc_text_compare_now" value="<?php echo esc_attr( get_option( 'wpc_text_compare_now', '' ) ); ?>" class="regular-text" placeholder="e.g. Compare Now" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_coupon_label"><?php _e( '"Code" (Coupon)', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_coupon_label" name="wpc_text_coupon_label" value="<?php echo esc_attr( get_option( 'wpc_text_coupon_label', '' ) ); ?>" class="regular-text" placeholder="e.g. Code" />
                </td>
            </tr>
            
            <!-- Filter & Navigation Texts -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Filter & Navigation Texts</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_category"><?php _e( '"Category" Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_category" name="wpc_text_category" value="<?php echo esc_attr( get_option( 'wpc_text_category', '' ) ); ?>" class="regular-text" placeholder="e.g. Category" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_features"><?php _e( '"Platform Features" Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_features" name="wpc_text_features" value="<?php echo esc_attr( get_option( 'wpc_text_features', '' ) ); ?>" class="regular-text" placeholder="e.g. Platform Features" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_filters"><?php _e( '"Filters" Label', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_filters" name="wpc_text_filters" value="<?php echo esc_attr( get_option( 'wpc_text_filters', '' ) ); ?>" class="regular-text" placeholder="e.g. Filters" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wpc_text_search"><?php _e( '"Search..." Placeholder', 'wp-comparison-builder' ); ?></label></th>
                <td>
                    <input type="text" id="wpc_text_search" name="wpc_text_search" value="<?php echo esc_attr( get_option( 'wpc_text_search', '' ) ); ?>" class="regular-text" placeholder="e.g. Search..." />
                </td>
            </tr>
            
            <!-- Color Settings -->
            <tr valign="top"><th colspan="2"><h3 style="margin:0;">Color Settings</h3></th></tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Pros Colors (Comparison Table)', 'wp-comparison-builder' ); ?></label></th>
                <td style="display: flex; gap: 20px;">
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Background</label>
                        <input type="color" name="wpc_color_pros_bg" value="<?php echo esc_attr( get_option( 'wpc_color_pros_bg', '#f0fdf4' ) ); ?>" />
                    </div>
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Text</label>
                        <input type="color" name="wpc_color_pros_text" value="<?php echo esc_attr( get_option( 'wpc_color_pros_text', '#166534' ) ); ?>" />
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Cons Colors (Comparison Table)', 'wp-comparison-builder' ); ?></label></th>
                <td style="display: flex; gap: 20px;">
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Background</label>
                        <input type="color" name="wpc_color_cons_bg" value="<?php echo esc_attr( get_option( 'wpc_color_cons_bg', '#fef2f2' ) ); ?>" />
                    </div>
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Text</label>
                        <input type="color" name="wpc_color_cons_text" value="<?php echo esc_attr( get_option( 'wpc_color_cons_text', '#991b1b' ) ); ?>" />
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'Coupon Colors', 'wp-comparison-builder' ); ?></label></th>
                <td style="display: flex; gap: 20px;">
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Background</label>
                        <input type="color" name="wpc_color_coupon_bg" value="<?php echo esc_attr( get_option( 'wpc_color_coupon_bg', '#fef3c7' ) ); ?>" />
                    </div>
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Text</label>
                        <input type="color" name="wpc_color_coupon_text" value="<?php echo esc_attr( get_option( 'wpc_color_coupon_text', '#92400e' ) ); ?>" />
                    </div>
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Hover</label>
                        <input type="color" name="wpc_color_coupon_hover" value="<?php echo esc_attr( get_option( 'wpc_color_coupon_hover', '#fde68a' ) ); ?>" />
                    </div>
                    <div>
                        <label style="font-size: 11px; display: block; margin-bottom: 2px;">Copied State</label>
                        <input type="color" name="wpc_color_copied" value="<?php echo esc_attr( get_option( 'wpc_color_copied', '#10b981' ) ); ?>" />
                    </div>
                </td>
            </tr>
        </table>
        
        <?php submit_button(); ?>
    </form>
    <?php
}

/**
 * Link Behavior Tab Function
 */
function wpc_render_links_tab() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'wpc_settings_group' ); ?>
        
        <h2><?php _e( 'Link Target Behavior', 'wp-comparison-builder' ); ?></h2>
        <p><?php _e( 'Control how different types of links open (New Tab vs Same Tab).', 'wp-comparison-builder' ); ?></p>
        
        <table class="form-table">
            <!-- Details Page Link -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_target_details"><?php _e( 'Comparison / Details Button', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <select name="wpc_target_details" id="wpc_target_details">
                        <option value="_blank" <?php selected( get_option('wpc_target_details', '_blank'), '_blank' ); ?>><?php _e('New Tab (Yes)', 'wp-comparison-builder'); ?></option>
                        <option value="_self" <?php selected( get_option('wpc_target_details'), '_self' ); ?>><?php _e('Same Tab (No)', 'wp-comparison-builder'); ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Applies to the "Visit Site" / "View Details" buttons in the Comparison Table, Popups, and Item Cards (Comparison Mode using Details Link).', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>

            <!-- Direct Link -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_target_direct"><?php _e( 'Direct / Non-Comparison Button', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <select name="wpc_target_direct" id="wpc_target_direct">
                        <option value="_blank" <?php selected( get_option('wpc_target_direct', '_blank'), '_blank' ); ?>><?php _e('New Tab (Yes)', 'wp-comparison-builder'); ?></option>
                        <option value="_self" <?php selected( get_option('wpc_target_direct'), '_self' ); ?>><?php _e('Same Tab (No)', 'wp-comparison-builder'); ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Applies to the main button on Item Cards in "List Mode" (when "Compare" is disabled) which uses the Direct Link.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>

            <!-- Pricing Plan Link -->
            <tr valign="top">
                <th scope="row">
                    <label for="wpc_target_pricing"><?php _e( 'Pricing Plan Buttons', 'wp-comparison-builder' ); ?></label>
                </th>
                <td>
                    <select name="wpc_target_pricing" id="wpc_target_pricing">
                        <option value="_blank" <?php selected( get_option('wpc_target_pricing', '_blank'), '_blank' ); ?>><?php _e('New Tab (Yes)', 'wp-comparison-builder'); ?></option>
                        <option value="_self" <?php selected( get_option('wpc_target_pricing'), '_self' ); ?>><?php _e('Same Tab (No)', 'wp-comparison-builder'); ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Applies to the "Select Plan" buttons within the Pricing Table and Pricing Popup.', 'wp-comparison-builder' ); ?>
                    </p>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
    <?php
}
