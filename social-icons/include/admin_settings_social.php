<?php
class SocialSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings social plugin', 
            'Social Settings', 
            'manage_options', 
            'social-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'social_option_name' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Social Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'social_option_group' );   
                do_settings_sections( 'social-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'social_option_group', // Option group
            'social_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Social URL Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'social-setting-admin' // Page
        );  

        add_settings_field(
            'facebook_social', // ID
            'facebook_social', // Title 
            array( $this, 'facebook_callback' ), // Callback
            'social-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'twitter_social', 
            'twitter_social', 
            array( $this, 'twitter_callback' ), 
            'social-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['facebook_social'] ) )
            $new_input['facebook_social'] = sanitize_text_field( $input['facebook_social'] );

        if( isset( $input['twitter_social'] ) )
            $new_input['twitter_social'] = sanitize_text_field( $input['twitter_social'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function facebook_callback()
    {
        printf(
            '<input type="text" id="facebook_social" name="social_option_name[facebook_social]" value="%s" />',
            isset( $this->options['facebook_social'] ) ? esc_attr( $this->options['facebook_social']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function twitter_callback()
    {
        printf(
            '<input type="text" id="twitter_social" name="social_option_name[twitter_social]" value="%s" />',
            isset( $this->options['twitter_social'] ) ? esc_attr( $this->options['twitter_social']) : ''
        );
    }
}

if( is_admin() )
    $social_settings_page = new SocialSettingsPage();