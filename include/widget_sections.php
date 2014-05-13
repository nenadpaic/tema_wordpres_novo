<?php
register_sidebar(array(
    'name' => 'Left Sidebar',
    'id'   => 'leftsidebar',
    'description' => 'this is left sidebar',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',

));
register_sidebar(array(
    'name' => 'Right Sidebar',
    'id'   => 'rightsidebar',
    'description' => 'this is right sidebar',
    'before_widget' => '<div class="side_bar_right">',
    'after_widget'  => '</div>',

));
register_sidebar(array(
    'name' => 'Footer sidebar',
    'id'   => 'dole',
    'description' => 'this is footer area',
));
register_sidebar(array(
    'name' => 'Header section',
    'id'   => 'headersection',
    'description' => 'this is header section',
    'before_widget' => '<div class="widget-header">',
    'after_widget'  => '</div>',
));
register_sidebar(array(
    'name' => 'Shop left sidebar',
    'id' => 'shopleftsidebar',
    'description' => 'Left Sidebar for Shop',
    'before_widget' => '<div class="widget-shop-left-sidebar">',
    'after_widget' => '</div>',
));