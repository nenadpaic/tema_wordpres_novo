<?php
/*
 * Slider scripts for upload images
 *
 *
 */


add_action('admin_enqueue_scripts', 'cc_admin_scripts');

function cc_admin_scripts() {

        wp_enqueue_media();
        wp_register_script("jquery_admin",'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', null, true);
        wp_enqueue_script('jquery_admin');

}


/*
 *
 *
 * Mechanic for back-end
 *
 *
 *
 *
 */

function cc_theme_menu()
{
    add_theme_page( 'Slider Options', 'Slider Options', 'manage_options', 'cc_theme_options.php', 'cc_theme_page');
}
add_action('admin_menu', 'cc_theme_menu');

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cc_theme_page()
{
    ?>
    <div class="section panel">
        <h1>Slider options</h1>
        <form method="post" enctype="multipart/form-data" action="options.php">
            <?php
            settings_fields('cc_theme_options');

            do_settings_sections('cc_theme_options.php');
            ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>

        </form>
        <script>
            jQuery(document).ready(function($){


                var custom_uploader;

                //button1 upload options
                $('#sliderbutton1').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider1').val(attachment.url);
                        
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });
                //button2 upload options
                $('#sliderbutton2').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider2').val(attachment.url);
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });
                //button3 upload options
                $('#sliderbutton3').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider3').val(attachment.url);
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });
                //button4upload options
                $('#sliderbutton4').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider4').val(attachment.url);
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });
                //button5 upload options
                $('#sliderbutton5').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider5').val(attachment.url);
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });
                //button6 upload options
                $('#sliderbutton6').click(function(e) {

                    e.preventDefault();

                    //If the uploader object has already been created, reopen the dialog
                    if (custom_uploader) {
                        custom_uploader.open();
                        return;
                    }

                    //Extend the wp.media object
                    custom_uploader = wp.media.frames.file_frame = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Choose Image'
                        },
                        multiple: false
                    });

                    //When a file is selected, grab the URL and set it as the text field's value
                    custom_uploader.on('select', function() {
                        attachment = custom_uploader.state().get('selection').first().toJSON();
                        $('#slider6').val(attachment.url);
                    });

                    //Open the uploader dialog
                    custom_uploader.open();

                });



            });
        </script>

        <p>Created by CodeCrew team</p>
    </div>
<?php
}
/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'cc_register_settings' );

/**
 * Function to register the settings
 */
function cc_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'cc_theme_options', 'cc_theme_options', 'cc_validate_settings' );

    // Add settings section
    add_settings_section( 'cc_text_section','Select images for front-end slider', 'cc_display_section', 'cc_theme_options.php' );

    // Create textbox field
    $slider_1 = array(
        'type'      => 'text',
        'id'        => 'slider1',
        'name'      => 'slider1',
        'desc'      => 'URL of first image',
        'std'       => '',
        'label_for' => 'Slider image 1',
        'class'     => 'css_class'
    );
    $slider_button_1 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton1',
        'name'      => 'sliderbutton1',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );
    $slider_2 = array(
        'type'      => 'text',
        'id'        => 'slider2',
        'name'      => 'slider2',
        'desc'      => 'URL for second image',
        'std'       => '',
        'label_for' => 'Slider image 2',
        'class'     => 'css_class'
    );
    $slider_button_2 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton2',
        'name'      => 'sliderbutton2',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );
    $slider_3 = array(
        'type'      => 'text',
        'id'        => 'slider3',
        'name'      => 'slider3',
        'desc'      => 'URL for third image',
        'std'       => '',
        'label_for' => 'Slider image 3',
        'class'     => 'css_class'
    );
    $slider_button_3 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton3',
        'name'      => 'sliderbutton3',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );
    $slider_4 = array(
        'type'      => 'text',
        'id'        => 'slider4',
        'name'      => 'slider4',
        'desc'      => 'URL for fourth image',
        'std'       => '',
        'label_for' => 'Slider image 4',
        'class'     => 'css_class'
    );
    $slider_button_4 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton4',
        'name'      => 'sliderbutton4',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );
    $slider_5 = array(
        'type'      => 'text',
        'id'        => 'slider5',
        'name'      => 'slider5',
        'desc'      => 'URL for fifth image',
        'std'       => '',
        'label_for' => 'Slider image 5',
        'class'     => 'css_class'
    );
    $slider_button_5 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton5',
        'name'      => 'sliderbutton5',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );
    $slider_6 = array(
        'type'      => 'text',
        'id'        => 'slider6',
        'name'      => 'slider6',
        'desc'      => 'URL for sixth image',
        'std'       => '',
        'label_for' => 'Slider image 6',
        'class'     => 'css_class'
    );
    $slider_button_6 = array(
        'type'      => 'button',
        'id'        => 'sliderbutton6',
        'name'      => 'sliderbutton6',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );

    add_settings_field( 'slider_image1', 'Slider image 1', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_1 );
    add_settings_field( 'slider_button1', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_1 );
    add_settings_field('slider_image2','Slider image 2', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_2 );
    add_settings_field( 'slider_button2', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_2 );
    add_settings_field('slider_image3','Slider image 3', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_3 );
    add_settings_field( 'slider_button3', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_3);
    add_settings_field('slider_image4','Slider image 4', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_4 );
    add_settings_field( 'slider_button4', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_4);
    add_settings_field('slider_image5','Slider image 5', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_5 );
    add_settings_field( 'slider_button5', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_5);
    add_settings_field('slider_image6','Slider image 6', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_6 );
    add_settings_field( 'slider_button6', '', 'cc_display_setting', 'cc_theme_options.php', 'cc_text_section', $slider_button_6);
}
/**
 * Function to add extra text to display on each section
 */
function cc_display_section($section){

}
function cc_display_setting($args)
{
    extract( $args );

    $option_name = 'cc_theme_options';

    $options = get_option( $option_name );


    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$class' type='text' size='80' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
        case 'button':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<button class='button-primary' type='button' id='$id'>Add image</button>";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
            break;
    }
}
/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cc_validate_settings($input)
{
    foreach($input as $k => $v)
    {
        $newinput[$k] = trim($v);

        // Check the input is a letter or a number

    }

    return $newinput;
}

