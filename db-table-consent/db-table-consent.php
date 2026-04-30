<?php
/*
Plugin Name: DB table creation
Plugin URI: http://w3wg.com
Description: Creates new table in database, required for logging consents
Author: ---
Version: 1.0
 */

function cookieconsent_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cookie_consents';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        consent_id VARCHAR(255) NOT NULL,
        accept_type VARCHAR(50) NOT NULL,
        accepted_categories TEXT,
        rejected_categories TEXT,
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY consent_id (consent_id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'cookieconsent_create_table');
// Or call directly if adding to functions.php:
// add_action('after_switch_theme', 'cookieconsent_create_table');