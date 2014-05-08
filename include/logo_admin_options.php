<?php
/*
 * Slider scripts for upload images
 *
 *
 */




function cc_theme_logo_menu()
{
    add_theme_page( 'Logo Options', 'Logo Options', 'manage_options', 'cc_theme_logo_options.php', 'cc_theme_logo_page');
}
add_action('admin_menu', 'cc_theme_logo_menu');

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cc_theme_logo_page()
{
    ?>
    <div class="section panel">
    <h1>Logo options</h1><br />
        <h2>Current logo</h2>
      <?php  $cc_logo_option = get_option('cc_theme_logo_options'); ?>

        <a href="<?php bloginfo('home'); ?>"></a><img width="250" height="70" src="<?php echo $cc_logo_option['logourl'] ?>" alt="Logo image" /></a>
    <form method="post" enctype="multipart/form-data" action="options.php">
        <?php
        settings_fields('cc_theme_logo_options');

        do_settings_sections('cc_theme_logo_options.php');
        ?>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>

    </form>


    <p>Created by CodeCrew team</p>
    </div>
<?php
}
/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'cc_register_logo_settings' );

/**
 * Function to register the settings
 */
function cc_register_logo_settings()
{
    // Register the settings with Validation callback
    register_setting( 'cc_theme_logo_options', 'cc_theme_logo_options', 'cc_validate_logo_settings' );

    // Add settings section
    add_settings_section( 'cc_text_logo_section','Select new image for logo', 'cc_display_logo_section', 'cc_theme_logo_options.php' );

    // Create textbox field
    $logo_url = array(
        'type'      => 'text',
        'id'        => 'logourl',
        'name'      => 'logourl',
        'desc'      => 'Logo image url',
        'std'       => '',
        'label_for' => 'Logo image',
        'class'     => 'css_class'
    );
    $logo_button = array(
        'type'      => 'button',
        'id'        => 'logobutton1',
        'name'      => 'logobutton1',
        'desc'      => '',
        'std'       => '',
        'label_for' => '',
        'value'     => 'Add image',
        'class'     => 'button-primary'
    );


    add_settings_field( 'logo_url', 'Logo image', 'cc_display_logo_setting', 'cc_theme_logo_options.php', 'cc_text_logo_section', $logo_url );
    add_settings_field( 'logo_button', '', 'cc_display_logo_setting', 'cc_theme_logo_options.php', 'cc_text_logo_section', $logo_button );

}
/**
 * Function to add extra text to display on each section
 */
function cc_display_logo_section($section){

}
function cc_display_logo_setting($args)
{
    extract( $args );

    $option_name = 'cc_theme_logo_options';

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
            echo "<button class='button-primary' id='$id'>Add logo</button>";

            break;

    }
}
/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cc_validate_logo_settings($input)
{
    foreach($input as $k => $v)
    {
        $newinput[$k] = trim($v);

        // Check the input is a letter or a number

    }

    return $newinput;
}

