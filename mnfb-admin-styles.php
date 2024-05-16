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
    wp_enqueue_script('mnfb-custom-ckeditor', 'https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js', array(), null, true);
    wp_enqueue_script('mnfb-custom-signature_pad', 'https://unpkg.com/signature_pad@1.5.3/signature_pad.min.js', array(), null, true);
    wp_enqueue_script('mnfb-custom-FormBuilder-full', 'https://unpkg.com/ng-formio-builder@latest/dist/ngFormBuilder-full.js', array(), null, true);
    wp_enqueue_script('mnfb-custom-lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js', array(), null, true);
    wp_enqueue_script('mnfb-custom-json-explorer', plugins_url('assets/js/angular-json-explorer.min.js', __FILE__), array(), null, true);
    wp_enqueue_script('mnfb-custom-app', plugins_url('assets/js/app.js', __FILE__), array(), null, true);
}
add_action('admin_enqueue_scripts', 'mnfb_load_admin_scripts');

