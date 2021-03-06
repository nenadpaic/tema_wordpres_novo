<?php
/**
 * Created by PhpStorm.
 * User: nenadpaic
 * Date: 5/1/14
 * Time: 10:04 AM
 */

require "wp-bootstrap-navwalker-master/wp_bootstrap_navwalker.php";
require "scripts/scriptsjs.php";
require "scripts/hooks.php";
require "include/slider_admin_options.php";
require "include/logo_admin_options.php";
require "include/cart_widget.php";
require "include/widget_sections.php";
require "include/nav-menus.php";
//Sklanja gresku u WP-u, da tema ne podrzava woocommerce
add_theme_support( 'woocommerce' );
//Promena imena prve stavke u breadcumb u woocomercu iz Home u Shop
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text($defaults){
    // Change the breadcrumb home text from 'Home' to 'Appartment'
    $defaults['home']='Shop';
    return $defaults;
}
//Breadcrumb u prodavnici, kad se klikne na shop vodi u prodavnicu,a ne na homepage
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url(){
    return get_permalink(woocommerce_get_page_id('shop'));
}
//Sklanjanje komentara
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {
 unset($tabs['reviews']);
 return $tabs;
}

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
    add_image_size('event', 110, 110, true);
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

echo '<div id="carousel" class="flexslider visible-md visible-lg"><ul class="slides">';

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
    $root_title = url_prepare(get_the_title($root));
    //Prvi meni
    $menus = Get_All_Wordpress_Menus()[0]->name;
    //Izlistavamo sve podmenije
    $sub_menus = Get_sub_menus($menus);
    //Drugi meni, za product
    $menu = Get_All_Wordpress_Menus()[1]->name;
    if (is_woocommerce()){
        ?> <div class="row" id="sub-nav">
            <div class="second-menu">
                <button type="button" id="second-menu-toggle" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> </button>
                <ul id="collapsable">
                <?php
                shop_second_menu($menu);
                ?>
                </ul>
            </div>
        </div>
    <?php
    }
    else{
        //Nakon toga decu iliti meni koji cemo i ispisati
        $nav_meni = get_children($root);
        if (!empty($nav_meni)){
        //Provlacimo kroz for each petlju i ako nema postavljen Order,stavljamo mu ID kao isti. Dodeljujemo li i a tagove zbog linka
            foreach ($nav_meni as $nav){
                //Ako vrednost nije postavljena iliti jednaka je 0, kao vrednost stavljamo ID
                if ($nav->menu_order == 0)
                   $write[$nav->ID] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                //Ako je postavljena i ako postoji vec ta vrednost, dodajemo joj vrednost ID-a u decimali
                elseif (isset($write[$nav->menu_order]))
                    $write[$nav->menu_order."+0.".$nav->ID] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
                //U suprotnom, dodajemo joj samo vrednost iz Page ordera i tako i sortiramo
                else 
                    $write[$nav->menu_order] = "<li><a href='" . home_url() ."/". $root_title ."/". url_prepare($nav->post_title) . "'>" . $nav->post_title . "</a></li>";
            }
            //Sortiramo od manjeg ka vecem i ispisujemo tako
            ksort ($write);
            ?>
            <div class="row" id="sub-nav">
                <div class="second-menu">
                    <button type="button" id="second-menu-toggle" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> </button>
                    <ul id="collapsable">
                        <?php
                        foreach ($write as $w)
                            $ispis .= $w;
                        echo $ispis;
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
    }
}
//Funkcija za izlistavanje side meni-a
function side_nav_menu($page_id){
    if(!is_woocommerce()){
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
  }
//Ubacujemo ID trenutne stranice i ispisujemo putanju do te stranice
function breadcumb($page_id){
    if (!is_woocommerce()){
    //get_post_ancestors izlistava sve stranice iznad u array
    $svi_roditelji = get_post_ancestors($page_id); 
    //Redjamo ih u obrnutom redu,tj od Roditelja pa na dole
    krsort($svi_roditelji);
    //Ispisivanje kroz petlju
    foreach ($svi_roditelji as $r)
        $bc .=  "<a href='". get_permalink($r) ."'>". get_the_title($r) ."</a> / ";
    //I na kraju title trenutne stranice
    $bc .= get_the_title($page_id);
    }
    else {
        woocommerce_breadcrumb();
    }
    return $bc; 
}
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

/*
 * function returns woocommerce acc profile page link
 */
function get_acc_url(){
    $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
    if ( $myaccount_page_id ) {
        $myaccount_page_url = get_permalink( $myaccount_page_id );
    }
    return $myaccount_page_url;
}
/*
 *
 * function for check is user loged in, and check if username, email already exist if you want to register
 */
function before_header(){
    if($_GET['action'] == "logincheck"){
        if(is_user_logged_in()){
            $poruka = array(
                'message' => 'success'
            );
        }else{
            $poruka = array(
                'message' => 'fail'
            );
        }
        echo json_encode($poruka);
        exit();
    }
    if($_GET['action'] == "checkreg"){
        $username= strip_tags($_POST['user_login']);
        $email=strip_tags($_POST['user_email']);

        try{
            if(username_exists($username)){
                throw new Exception("usernameExist");
            }
            if(email_exists($email)){
                throw new Exception("emailExist");
            }
            $poruka = array('message' =>  'ok');
            echo json_encode($poruka);

        }catch(Exception $e){
            $poruka = array('message' =>  $e->getMessage());
            echo json_encode($poruka);
        }

        exit();
    }
}
/*
 *
 * function gives ajax and validation for login and register
 */
function after_footer(){
    ?>
    <script>
        $("#forma-log").click(function(){
            var log = "<?php echo $log ?>";
            if(log == "yes"){
                $("#myModalLabel").html("<b>PROFILE ACTIONS </b>");
            }
            $("#register").hide();

            $("#login").show();
        });
        $("#register-button").click(function(){
            $("#login").hide();
            $("#register").show();
        });
        $("#login-button").click(function(){
            $("#login").show();
            $("#register").hide();
        });

        function login_ajax(){

            var username_forma = $("#inputUsername").val();
            var password_forma = $("#inputPassword").val();


            try{
                if(!username_forma.match(/^[a-zA-Z0-9_-]*$/)){
                    throw "Username must contain alpha numeric and _ - characters only!";
                }
                if(username_forma == ""){
                    throw "Username can not be empty";
                }
                if(username_forma.length < 4 || username_forma > 20){
                    throw "Username must be beetwen 4 and 20 characters long!";
                }
                if(!password_forma.match(/^[a-zA-Z0-9]*$/)){
                    throw "Password must contain alpha numeric characters only!";
                }
                if(password_forma == ""){
                    throw "Password can not be empty";
                }
                if(password_forma.length < 6 || password_forma > 20){
                    throw "Password must be beetwen 6 and 20 characters long!";
                }
                $("#message").html("<div class='progress progress-striped active'> <div class='progress-bar'  role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span> </div> </div>");



                $.ajax({
                    url: "<?php echo bloginfo('home'); ?>/wp-login.php",
                    type: "post",
                    data:{
                        log : username_forma,
                        pwd : password_forma
                    },
                    success:function(){
                        uspeh();

                    },
                });

            }catch(err){
                $("#message").html("<div class='alert alert-danger'>"+ err +"</div>");
            }


            return false;
        }
        function uspeh(){
            $.ajax({
                url: "<?php echo bloginfo('home'); ?>/?action=logincheck",
                type: "get",
                dataType: "json",
                success:function(data){
                    if(data.message == "success"){
                        $("#message").html("<div class='alert alert-success'>Successfully loged in.</div>");
                        setTimeout(redirect(), 3000);

                    }
                    if(data.message == 'fail'){
                        $("#message").html("<div class='alert alert-danger'>Wrong username or password!</div>");
                    }
                }
            });
        }

        function register_ajax_form(){
            var username = $("#user_login").val();
            var email = $("#user_email").val();

            $("#messagereg").html("<div class='progress progress-striped active'> <div class='progress-bar'  role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span> </div> </div>");
            try{
                if(!username.match(/^[a-zA-Z0-9_-]*$/)){
                    throw "Username can not contain special characters!";
                }
                if(username == "") {
                    throw "You must enter username!";
                }
                if (username.length < 4 || username.length >20 ){
                    throw "Username can not contain less than 4 and more than 20 characters ";
                }
                if(!email.match(/^([a-z0-9_ -.]+@[a-z]+\.[a-z]{0,3}$)/i )){
                    throw "You must enter valid email address.";
                }
                if (email=="") {
                    throw "You must enter email address";
                }

                $.ajax({
                    url: "<?php echo bloginfo('home'); ?>/?action=checkreg",
                    type: "post",
                    data:{
                        user_login : username,
                        user_email : email
                    },
                    dataType: "json",
                    success:function(data){
                        if(data.message == "usernameExist"){
                            $("#messagereg").html("<div class='alert alert-danger'>Username exist, try another!</div>");
                        }
                        if(data.message == "emailExist"){
                            $("#messagereg").html("<div class='alert alert-danger'>Email exist, try to log in or recover data!</div>");
                        }
                        if(data.message == "ok"){
                            registration_php_form();
                            setTimeout(redirect(), 3000);

                        }

                    },
                });
            }catch (err){
                $("#messagereg").html("<div class='alert alert-danger'>"+ err+"</div>");
            }


            return false;
        }
        function registration_php_form(){
            var username = $("#user_login").val();
            var email = $("#user_email").val();


            $.ajax({
                url: "<?php echo wp_registration_url(); ?>",
                type: "post",
                data: {
                    user_login : username,
                    user_email : email
                },
                success:function(){
                    $("#messagereg").html("<div class='alert alert-success'>Success, now you will get email with your password.</div>");
                },
            });
        }
        function redirect(){

            location.href = "<?php echo $_SERVER['REQUEST_URI']; ?>";
        }

    </script>

<?php
}
   


