<?php

function main_nav_menu(){
    return wp_nav_menu( array(
            'menu'              => 'primary',
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav pull-right',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
            );
}

function shop_second_menu($name_of_menu){
    return wp_nav_menu( array(
            'menu'              => $name_of_menu,
            'depth'             => 2,
            'container'         => 'div',
            'container_id'      => 'bs-example-navbar-collapse-2',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()

        ));
}