<?php
// Define a function to create the admin menu
function mnfb_form_builder_menu()
{
    // Add the main menu page
    add_menu_page(
        'Form Builder',          // Page title
        'Form Builder',          // Menu title
        'manage_options',           // Capability
        'mnfb-form-builder-menu',   // Menu slug
        'mnfb_form_builder_page',   // Callback function
        'dashicons-feedback'        // Default WordPress icon
    );

    // Add the submenu page under "All Forms" menu
    add_submenu_page(
        'mnfb-form-builder-menu',   // Parent Slug
        'All Forms',                // Parent page title
        'All Forms',                // Parent menu title
        'manage_options',           // Capability
        'mnfb-all-form-pages',      // Menu slug
        'mnfb_all_form_page',       // Callback function
    );
}


// Callback function
function mnfb_form_builder_page()
{
    $html_content = file_get_contents(MNFB_PLUGIN_PATH . 'templates/form-builder-page.php');
    echo $html_content;
}
add_action('admin_menu', 'mnfb_form_builder_menu');


// Callback function
function mnfb_all_form_page() {
    include(MNFB_PLUGIN_PATH . 'templates/mnfb-form-list.php');
}


add_action('wp_ajax_save_custom_form_data', 'save_custom_form_data');
add_action('wp_ajax_nopriv_save_custom_form_data', 'save_custom_form_data');

function save_custom_form_data() {
    if (isset($_POST['textarea_content'])) {
        $json_data = wp_kses_post(wp_unslash($_POST['textarea_content']));
        $decoded_data = json_decode($json_data, true);

        if ($decoded_data !== null) {
            $post_data = array(
                'post_title'    => 'Plugin->Form Data',
                'post_content'  => $json_data,
                'post_type'     => 'form-post',
                'post_status'   => 'publish'
            );

            $post_id = wp_insert_post($post_data);

            if ($post_id) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    wp_die();
}
