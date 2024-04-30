<?php

function mnfb_load_admin_stylesheet() {
    wp_enqueue_style( 'mnfb-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
    wp_enqueue_style( 'mnfb-bootstrap', 'https://unpkg.com/bootswatch@3.3.7/yeti/bootstrap.min.css');
    wp_enqueue_style( 'mnfb-angular-json-explorer', 'https://cdn.rawgit.com/odra/ng-json-explorer/master/dist/angular-json-explorer.min.css');
    wp_enqueue_style( 'mnfb-ngFormBuilder-complete', 'https://unpkg.com/ng-formio-builder@latest/dist/ngFormBuilder-complete.css');

    wp_enqueue_style('mnfb-custom-css', plugins_url('assets/css/style.css', __FILE__));
}
add_action( 'admin_enqueue_scripts', 'mnfb_load_admin_stylesheet' );



function mnfb_load_admin_scripts() {
    wp_enqueue_script('mnfb-custom-jquery', plugins_url('assets/js/jquery.min.js', __FILE__), array(), null, true);
    wp_enqueue_script('mnfb-custom-jquery-ui', plugins_url('assets/js/jquery-ui.min.js', __FILE__), array(), null, true);
    wp_enqueue_script('mnfb-custom-tether', plugins_url('assets/js/tether.min.js', __FILE__), array(), null, true);
    wp_enqueue_script('mnfb-custom-bootstrap', plugins_url('assets/js/bootstrap.min.jss', __FILE__), array(), null, true);
    wp_enqueue_script('mnfb-custom-script', plugins_url('assets/js/app.js', __FILE__), array(), null, true);
}
add_action('admin_enqueue_scripts', 'mnfb_load_admin_scripts');

