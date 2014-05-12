<?php 
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class Social_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function Social_Widget() {
        $widget_ops = array( 'classname' => 'social-icons', 'description' => 'Social buttons for fb and twitter' );
        $this->WP_Widget( 'social-icons', 'Social Icons', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;

        $url_icons = get_option("social_option_name");
        ?>

        <div class="social-icons">
            <a href="<?php echo $url_icons['facebook_social'];?>"> <img src="<?php echo plugins_url(); ?>/social-icons/images/facebookRect.jpg" alt="facebook link" /></a>
            <a href="<?php echo $url_icons['twitter_social'];?>"><img src="<?php echo plugins_url(); ?>/social-icons/images/twitterRect.jpg" alt="facebook link" /></a>
        </div>

<?php



    //
    // Widget display logic goes here
    //

    echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array() );

        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'Social_Widget' );" ) );



 ?>