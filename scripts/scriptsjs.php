<?php

function add_nessesery_scripts(){
    wp_register_script('jquery_new', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', null, true);
    wp_register_script("angularjs", "http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js", null, true);
    wp_register_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.js", null, true);
    wp_register_script("flex", get_template_directory_uri(). "/js/jquery.flexslider.js", null, true);

    wp_enqueue_script('jquery_new');
    wp_enqueue_script("angularjs");
    wp_enqueue_script('bootstrap');
    wp_enqueue_script("flex");

}

add_action('wp_enqueue_scripts', "add_nessesery_scripts");