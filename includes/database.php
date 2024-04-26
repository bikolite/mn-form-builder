<?php

function mnfb_database_activate()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'fields';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `form_data` longtext NOT NULL,
        PRIMARY KEY (`id`)
    ) $charset_collate;";    

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function mnfb_database_deactivate()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'fields';
    $sql = "DROP TABLE `wordpress`.$table_name";
    $wpdb->query($sql);
}
