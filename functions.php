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

        $content = $_POST['content'];
        $class = $_POST['class'];
        $placeholder = $_POST['placeholder'];
        $label = $_POST['label'];
        $required = $_POST['required'];
        $type = $_POST['type'];

        $data = array();
        // Loop through the arrays to add each set of data to the main array
        for ($i = 0; $i < count($type); $i++) {
            $post_content = sanitize_text_field($content[$i]);
            $post_class = sanitize_text_field($class[$i]);
            $post_placeholder = sanitize_text_field($placeholder[$i]);
            $post_label = sanitize_text_field($label[$i]);
            $post_required = sanitize_text_field($required[$i]);
            $post_type = sanitize_text_field($type[$i]);

            $data[] = array(
                'content' => $post_content,
                'class' => $post_class,
                'placeholder' => $post_placeholder,
                'label' => $post_label,
                'required' => $post_required,
                'type' => $post_type,
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
