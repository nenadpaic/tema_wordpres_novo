<?php

// Creating the widget
class cart_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'cart_widget',

// Widget name will appear in UI
__('Woo comm cart', 'cart_widget_domain'),

// Widget description
array( 'description' => __( 'Shooping cart count and total', 'cart_widget_domain' ), )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
    global $woocommerce, $current_user;

    $count = $woocommerce->cart->cart_contents_count;
    $total = $woocommerce->cart->get_cart_total();
    $url = $woocommerce->cart->get_cart_url();
    $checkout_url = $woocommerce->cart->get_checkout_url();
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

get_currentuserinfo();

$user = (is_user_logged_in())? "<a href='#' id='forma-log' data-toggle='modal' data-target='#myModal'>HI " . $current_user->user_login . "</a>" : "<a href='#' id='forma-log' data-toggle='modal' data-target='#myModal'>SIGN IN <span class='small'>OR</span> CREATE NEW ACC</a>";
// This is where you run the code and display the output
    $output = "<div id='shopCart'><p><a href='{$url}'><i class='glyphicon glyphicon-shopping-cart'></i> MY CART({$count} - {$total} )</a><a style='border-right: 0.5px solid white;border-left: 0.5px solid white;'href='{$checkout_url}'>CHECKOUT</a>{$user}</p></div>
   ";
/*
 *

<!-- Modal -->
<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'>Modal title</h4>
      </div>
      <div class='modal-body'>
        ...
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div>
    </div>
  </div>
</div>
Make modals accessible
 */
echo __( $output, 'wpb_widget_domain' );
echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Shopping cart', 'cart_widget_domain' );
}
// Widget admin form
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'cart_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );