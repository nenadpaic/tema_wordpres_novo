<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 5/1/14
 * Time: 10:04 AM
 */

require_once "wp-bootstrap-navwalker-master/wp_bootstrap_navwalker.php";
require_once "scripts/scriptsjs.php";

require_once "scripts/hooks.php";

require_once "include/slider_admin_options.php";
require_once "include/logo_admin_options.php";
require_once "include/cart_widget.php";
if(function_exists('register_nav_menus')){
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'CCtheme' ),
) );

}

if(function_exists('add_theme_support')){
    add_theme_support('post-thumbnails');
}
if(function_exists('add_image_size')){
    add_image_size('featured', 400, 250, true);
    add_image_size('post-thumb', 200, 125, true);
}

$option_name = 'cc_theme_options';

$option = get_option($option_name);

function slider(){
    $option_name = 'cc_theme_options';
    $option = get_option($option_name);

         for ($i=1; $i<count($option)+1; $i++){
            if (isset($option["slider{$i}"])){
                    $slides[$i] = '<li><img src="'.$option["slider{$i}"].'" /></li>';

            }
        }
        echo '<div id="container" class="cf"><div id="main" role="main">
     <div id="slider" class="flexslider"> <ul class="slides">';

    foreach ($slides as $slide) {
        echo "$slide";
    } 
    echo "</ul></div>";

echo '<div id="carousel" class="flexslider"><ul class="slides">';

     foreach ($slides as $slide) {
        echo "$slide";
    }  
    
    echo '</ul></div></div></div>
    ';

}


//Za sredjivanje URL-a, pretvara razmak u - i stavlja sva slova u mala
function url_prepare($word){
    $t = strtr($word," ","-");
    return strtolower($t);
}

register_sidebar(array(
    'name' => 'Right sidebar',
    'id'   => 'rightsidebar',
    'description' => 'this is right sidebar',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',

));
register_sidebar(array(
    'name' => 'Left sidebar',
    'id'   => 'leftsidebar',
    'description' => 'this is left sidebar',
    'before_widget' => '<div class="side_bar_right">',
    'after_widget'  => '</div>',

));
register_sidebar(array(
    'name' => 'Footer sidebar',
    'id'   => 'dole',
    'description' => 'this is footer area',
));
//Za dobijanje prve stranice u lancu, grandparrent
function get_root_parent($page_id) {
global $wpdb;
	$parent = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND ID = '$page_id'");
	if ($parent == 0) return $page_id;
	else return get_root_parent($parent);
}
//Drugi nav bar
function nav_bar($page_id){
    //Izvlacimo pocetne roditelje
    $root = get_root_parent($page_id);
    //Nakon toga decu iliti meni koji cemo i ispisati
    $nav_meni = get_children($root);
    if (!empty($nav_meni)){
    //Provlacimo kroz for each petlju i ako nema postavljen Order,stavljamo mu ID kao isti. Dodeljujemo li i a tagove zbog linka
        foreach ($nav_meni as $nav){
            //Ako vrednost nije postavljena iliti jednaka je 0, kao vrednost stavljamo ID
            if ($nav->menu_order == 0)
               $write[$nav->ID] = "<li><a href='" . home_url() ."/". url_prepare(get_the_title($root)) ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
            //Ako je postavljena i ako postoji vec ta vrednost, dodajemo joj vrednost ID-a u decimali
            elseif (isset($write[$nav->menu_order]))
                $write[$nav->menu_order."+0.".$nav->ID] = "<li><a href='" . home_url() ."/". url_prepare(get_the_title($root)) ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
            //U suprotnom, dodajemo joj samo vrednost iz Page ordera i tako i sortiramo
            else 
                $write[$nav->menu_order] = "<li><a href='" . home_url() ."/". url_prepare(get_the_title($root)) ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
        }
        //Sortiramo od manjeg ka vecem i ispisujemo tako
        ksort ($write);
        foreach ($write as $w)
            $ispis .= $w;
        echo $ispis;
    }
}
//Funkcija za izlistavanje side meni-a
function side_nav_menu($page_id){
    //Proveravamo su decu od glavnog roditelja, meni koji nam treba je uvek drugi
    $svi_roditelji = get_post_ancestors($page_id); 
    end($svi_roditelji);
    $drugi = prev($svi_roditelji);
    //Ako ne postoji drugi, dodeljujemo mu vrednost
    if (empty($drugi))
        $drugi = $page_id;
    $args = array(
        'child_of' => $drugi,
        'depth' => 0,
        'sort_column' => 'post_date',
        'title_li'=> get_the_title($drugi),
        'echo' => 0,
    );
    //Dajemu mu izlistavanje
       $meni = wp_list_pages($args);
       echo "<div class='side_menu'>";
        echo $meni;
       echo '</div>';
  }
//Ubacujemo ID trenutne stranice i ispisujemo putanju do te stranice
function breadcumb($page_id){
    //get_post_ancestors izlistava sve stranice iznad u array
    $svi_roditelji = get_post_ancestors($page_id); 
    //Redjamo ih u obrnutom redu,tj od Roditelja pa na dole
    krsort($svi_roditelji);
    //Ispisivanje kroz petlju
    $bc = '<div id="breadcumb">';
    foreach ($svi_roditelji as $r)
        $bc .=  "<a href='". get_permalink($r) ."'>". get_the_title($r) ."</a> / ";
    //I na kraju title trenutne stranice
    $bc .= get_the_title($page_id) . "</div>";
        return $bc; 
}
register_sidebar(array(
    'name' => 'Header section',
    'id'   => 'headersection',
    'description' => 'this is header section',
    'before_widget' => '<div class="widget-header">',
    'after_widget'  => '</div>',
));
function add_logo(){
    $cc_logo_option = get_option('cc_theme_logo_options'); ?>
                <a href="<?php home_url(); ?>"></a> <img src="<?php echo $cc_logo_option['logourl'] ?>" alt="Logo image" /></a>
    <?php

}

function wpbeginner_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}
function get_item_count(){
    global $woocommerce;

    echo $woocommerce->cart->cart_contents_count;
    echo $woocommerce->cart->get_cart_total();
}
//Izlistava sve menije, za ime je potrebno uneti: Get_All_Wordpress_Menus()[0]->name
function Get_All_Wordpress_Menus(){
    return get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
}

//Izlistava sve podmenije jednog menija
function Get_sub_menus($name){
    return wp_get_nav_menu_items($name);
}
//Menja style u zavisnosti od trenutne stranice
function style($page_id){
    //Saznajemo koji je root stranice gde se nalazimo
    $pocetak = get_the_title(get_root_parent($page_id));
    //Izlistavamo sve menije
    $menus = Get_All_Wordpress_Menus()[0]->name;
    //Izlistavamo sve podmenije
    $sub_menus = Get_sub_menus($menus);
    //ako je naziv roota trenutne stranice isti sa imenom nekog podmenija, menjamo mu boju
    if ($pocetak == $sub_menus[0]->title)
        return "blue";
    elseif($pocetak == $sub_menus[1]->title)
        return "green";
    elseif(is_front_page())
        return "none_color";
    else {
        return 'red';
    }
}


