<?php

function mnfb_load_admin_stylesheet() {

    // Enqueue jQuery UI
    wp_enqueue_style( 'mnfb-jquery-ui-css', plugins_url( 'assets/css/jquery.ui.theme.css', __FILE__ ), array(), null );

    wp_enqueue_style( 'mnfb-font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

    wp_enqueue_style( 'mnfb-bootstrap-css', plugins_url( 'assets/css/bootstrap.css', __FILE__ ), array(), null );

    wp_enqueue_script( 'mnfb-jquery-main', plugins_url( 'assets/js/jquery.min.js', __FILE__ ), array(), null, false );

    wp_enqueue_script( 'mnfb-jquery-ui-js', plugins_url( 'assets/js/jquery.ui.min.js', __FILE__ ), array(), null, false );

    wp_enqueue_script( 'mnfb-bootstrap-js', plugins_url( 'assets/js/bootstrap.js', __FILE__ ), array(), null, false );

    wp_enqueue_script( 'mnfb-beautifyhtml-js', plugins_url( 'assets/js/beautifyhtml.js', __FILE__ ), array(), null, false );
}
add_action( 'admin_enqueue_scripts', 'mnfb_load_admin_stylesheet' );


function mnfb_load_admin_scripts()
{
    wp_enqueue_script('mnfb_admin_scripts', plugins_url('assets/js/app.js', __FILE__), array(), null, true);
}
add_action('admin_enqueue_scripts', 'mnfb_load_admin_scripts');
