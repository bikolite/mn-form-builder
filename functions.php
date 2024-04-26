<?php
// Define a function to create the admin menu
function mnfb_form_builder_menu()
{
    // Add the main menu page
    add_menu_page(
        'MN Form Builder',          // Page title
        'MN Form Builder',          // Menu title
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


add_action('init', 'handle_custom_form_submission');
function handle_custom_form_submission()
{
    // Check if the form was submitted
    if (isset($_POST['submit_custom_form'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fields';

        $label_names = $_POST['label'];
        $contents = $_POST['content'];
        $types = $_POST['type'];
        $grid = $_POST['grid'];

        $data = array();
        // Loop through the arrays to add each set of data to the main array
        for ($i = 0; $i < count($label_names); $i++) {
            $name = sanitize_text_field($label_names[$i]);
            $content = sanitize_text_field($contents[$i]);
            $type = sanitize_text_field($types[$i]);
            $selected_grid = sanitize_text_field($grid[$i]);

            $data[] = array(
                'label_name' => $name,
                'content' => $content,
                'type' => $type,
                'grid' => $selected_grid,
            );
        }

        $data_json = json_encode($data);
        // Insert data into the database
        $wpdb->insert(
            $table_name,
            array(
                'form_data' => $data_json,
            )
        );
        wp_redirect(admin_url('admin.php?page=mnfb-all-form-pages'));
        exit;
    }
}
