<?php
if ( !defined( 'ABSPATH' ) ) 
{
    exit;  
}

require_once CIRCLE_PROGRESS_BAR_DIR . '/includes/class-circle-progress-bar-singleton.php';

if ( !class_exists('Circle_Progress_Bar') ) {
    class Circle_Progress_Bar extends Primped_Base_Singleton {
        const PLUGIN_VERSION       = '1.0';
        const OPTIONS_PREFIX       = 'circle_bar_plugin_';
        const CPT_SW_NAME          = 'circle_bar_plugin';
        const CPT_SW_NAME_SINGULAR = 'Circle Progress bar';
        const CPT_SW_NAME_PLURAL   = 'Circle Progress bars';
        const CPT_SETTING          = 'circle_progress_settings';
        
        protected function __construct( $options = array() ) {
            parent::__construct( $options );
            // Registering CPT
            add_action( 'init', array($this, 'register_cpt_wpcptplugins') );

            //Saving a POST including Custom Fields
            add_action( 'save_post', array($this, 'save_post'), 10, 2 );

            /* Percentage Meta Box */
            add_action( 'add_meta_boxes', array($this, 'circle_percentage_meta_box' ) );
           
            /* Setting Submenu under CPT */
            add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );

            /*Frontend Enque*/
            add_action( 'wp_enqueue_scripts', array($this, 'plugin_enqueue_scripts') );

            /* Admin Enqueue */
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

            //resgister setting
            add_action( 'admin_init', array($this, 'register_circle_plugin_settings' ) );

            /* Generate Shortcode */
            add_shortcode('circlebar', array( $this,'CircleProgressStatic') );

            //19-06-2018
            add_filter( 'manage_circle_bar_plugin_posts_columns', array( $this,'set_custom_edit_circle_bar_plugin_columns' ) );
            

            //19-06-2018 Add the data to the custom columns for the Cicle progress post type:
            add_action( 'manage_circle_bar_plugin_posts_custom_column' , array( $this, 'custom_circle_bar_plugin_column'), 10, 2);
            
        }
        /* setting Percentage column before date column */
        public function set_custom_edit_circle_bar_plugin_columns($defaults){$new = array();
            foreach($defaults as $key => $title) {
                // Put the Percentage column before the Date column
                if ($key=='date') 
                {
                    $new['custom_circle_bar_9'] = 'Percentage';
                }
                $new[$key] = $title;
            }
            return $new;
        }
        /* Display Percentage meta key value */
        public function custom_circle_bar_plugin_column($column_name, $post_id) {
            if ($column_name == 'custom_circle_bar_9') {
                $value = get_post_meta( $post_id, '_circle_percentage_key', true );
                echo $value." %";
                
            }
          
        }
        
        public static function do_install() {
            update_option(static::OPTIONS_PREFIX . 'version', static::PLUGIN_VERSION);
            flush_rewrite_rules();
        }
        /**
         * Register custom post type for wpcptplugins
         */
        function register_cpt_wpcptplugins() {
            $labels = array(
                'name' => _x( static::CPT_SW_NAME_PLURAL, static::CPT_SW_NAME ),
                'singular_name' => _x( static::CPT_SW_NAME_SINGULAR, static::CPT_SW_NAME ),
                'add_new' => _x( 'Add New', static::CPT_SW_NAME ),
                'add_new_item' => _x( 'Add New ', strtolower(static::CPT_SW_NAME_SINGULAR), static::CPT_SW_NAME ),
                'edit_item' => _x( 'Edit ' . static::CPT_SW_NAME_SINGULAR, static::CPT_SW_NAME ),
                'new_item' => _x( 'New ' . static::CPT_SW_NAME_SINGULAR, static::CPT_SW_NAME ),
                'view_item' => _x( 'View ' . static::CPT_SW_NAME_SINGULAR, static::CPT_SW_NAME ),
                'search_items' => _x( 'Search ' . static::CPT_SW_NAME_PLURAL, static::CPT_SW_NAME ),
                'not_found' => _x( 'No agencies found', static::CPT_SW_NAME ),
                'not_found_in_trash' => _x( 'No ' . strtolower(static::CPT_SW_NAME_PLURAL) . ' found in Trash', static::CPT_SW_NAME ),
                'parent_item_colon' => _x( 'Parent ' . static::CPT_SW_NAME_PLURAL, static::CPT_SW_NAME ),
                'menu_name' => _x( static::CPT_SW_NAME_PLURAL, static::CPT_SW_NAME ),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => false,
                'description' => 'Switcher for PRIMPED',
                'supports' => array( 'title'),
                'public' => false,
                'menu_icon' => 'dashicons-format-gallery',
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'has_archive' => false,
                'query_var' => true,
                'can_export' => true,
                'rewrite' => true,
                'capability_type' => 'post',
            );
            register_post_type( static::CPT_SW_NAME, $args );
            
        }
        
        
        /**
         * Saves values of the the custom post type's extra fields
         *
         * @param int    $post_id
         * @param object $post
         */
        public static function save_post( $post_id, $revision ) {
            global $post;
            $ignored_actions = array( 'trash', 'untrash', 'restore' );
            if ( isset( $_GET['action'] ) && in_array( $_GET['action'], $ignored_actions ) ) {
                return;
            }
            if ( ! $post || $post->post_type != static::CPT_SW_NAME ) {
                return;
            }
            static::circle_save_percentage($post_id, $_POST );

           
        }

        /* Circel Percentage Meta Box Start */
        public function circle_percentage_meta_box() {
            add_meta_box( 'percentage_value', 'Circle Percentage', array($this, 'circle_percentage_value'), static::CPT_SW_NAME, 'normal', 'low');
        }

        /* Percentage Meta box input */
        public function circle_percentage_value( $post ) {
            wp_nonce_field( 'circle_save_percentage', 'circle_percentage_meta_box_nonce' );
            
            $value = get_post_meta( $post->ID, '_circle_percentage_key', true );
            
            echo '<label for="circle_percentage_field">Enter Circle Percentage: </lable>';
            echo '<input type="number" id="circle_percentage_field" name="circle_percentage_field" value="' . esc_attr( $value ) . '" size="25" />';
        }
         /* Percentage Meta box save */
        protected static function circle_save_percentage( $post_id, $values ) {
    
            if( ! isset( $values['circle_percentage_meta_box_nonce'] ) ){
                return;
            }
            
            if( ! wp_verify_nonce( $values['circle_percentage_meta_box_nonce'], 'circle_save_percentage') ) {
                return;
            }
            
            if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
                return;
            }
            
            if( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
            
            if( ! isset( $values['circle_percentage_field'] ) ) {
                return;
            }
            
            $my_data = sanitize_text_field( $values['circle_percentage_field'] );
            
            update_post_meta( $post_id, '_circle_percentage_key', $my_data );
            
        }
        /*Create submenu Settings*/
        public function create_admin_menu() {
            $sub_menus = apply_filters( 'wpsl_sub_menu_items', array(
                    array(
                        'page_title'  => __( 'Settings'),
                        'menu_title'  => __( 'Settings'),
                        'caps'        => 'manage_options',
                        'menu_slug'   => static::CPT_SETTING,
                        'function'    => array( $this, 'load_template' )
                    )
                )
            );
            
            if ( count( $sub_menus ) ) {
                foreach ( $sub_menus as $sub_menu ) {
                    add_submenu_page( 'edit.php?post_type=circle_bar_plugin', $sub_menu['page_title'], $sub_menu['menu_title'], $sub_menu['caps'], $sub_menu['menu_slug'], $sub_menu['function'] );
                }
            } 
  
        }

        /* Admin enquene js and css */
        public function admin_scripts(){
            wp_enqueue_script( 'circle-admin-js', plugins_url().'/circle-progress-bar/js/circle.js' , array( 'jquery' ), '', true );
            /* color picker */
            wp_enqueue_script( 'circle-color-picker', plugins_url().'/circle-progress-bar/js/jscolor.js' , array( 'jquery' ), '', false );
            
        }
        /* Frontend enquene js and css */
        public function plugin_enqueue_scripts(){
            /* css */
            wp_enqueue_style( 'cicle-plugin-css', plugins_url('/style.css', __FILE__));
           
            /* circle progress js*/
            wp_enqueue_script( 'circle-js', plugins_url().'/circle-progress-bar/js/circle-progress.min.js' , array( 'jquery' ), '', false );
        }

        /*Setting Template and form*/
        public function load_template(){
            require_once CIRCLE_PROGRESS_BAR_DIR .'/templates/create-setting-form.php';
        }

        /* Setting option */
        function register_circle_plugin_settings() {
            register_setting( 'circle-settings-group', 'circle_progress_first_stoke_color' );
            add_settings_section( 'circle-sidebar-options', 'Sidebar Option', array($this, 'circle_sidebar_options'), static::CPT_SETTING);
            add_settings_field( 'first-color-name', 'Circle First Stoke Color', array($this, 'circle_first_stoke'), static::CPT_SETTING, 'circle-sidebar-options');

            register_setting( 'circle-settings-group', 'circle_progress_second_stoke_color' );
            add_settings_field( 'second-color-name', 'Circle Second Stoke Color', array($this, 'circle_second_stoke'), static::CPT_SETTING, 'circle-sidebar-options');

            /* shortcode Notices */

        }

        function circle_sidebar_options() { ?>
            <div class="notice notice-error" style="margin-left:0px !important;">
                    <p>Before display this shortcode [circlebar] set both color of circlebar. Below settings.</p>
                </div>
        <?php }

        /* Setting option inputs */
        function circle_first_stoke() {
            $circleFirstColor = esc_attr( get_option( 'circle_progress_first_stoke_color' ) );
            echo '<input class="jscolor" type="text" id="circle_first_hexcolor" name="circle_progress_first_stoke_color" value="'.$circleFirstColor.'" placeholder="Enter color hex value" />';
        }

        function circle_second_stoke(){
            $circleLastColor = esc_attr( get_option( 'circle_progress_second_stoke_color' ) );
            echo '<input class="jscolor" type="text" name="circle_progress_second_stoke_color" id="circle_second_hexcolor" value="'.$circleLastColor.'" placeholder="Enter color hex value" />';

        }

        /* Shotcode Generate start */
        public function CircleProgressStatic(){
            $display  =  "<div class='circles'>";    
            $args = array (
              'post_type'              => static::CPT_SW_NAME,
              'post_status'            => 'publish',
              'order'                  => 'DESC',
              'orderby'                => 'post_date',
            );
            $query = new WP_Query( $args );
            $x=1;
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) { 
                    $query->the_post(); // do something
                    $percentage_val = (get_post_meta( get_the_ID(), '_circle_percentage_key', TRUE ) / 100);
                    $display .=  " <div class='circle' id='circle-".$x++."' data-value='".$percentage_val."'>
                            <strong></strong>
                            <span>".get_the_title()."</span>
                        </div>";        
                }
            }
            wp_reset_postdata(); // Restore original Post Data
          
            $first_stoke = get_option('circle_progress_first_stoke_color') ? '#'.esc_attr(get_option('circle_progress_first_stoke_color')): ''; 
            $second_stoke = get_option( 'circle_progress_second_stoke_color' ) ? '#'.esc_attr( get_option( 'circle_progress_second_stoke_color' )) : ''; 

            $display .= "</div>"; 
            $display .= "<script type='text/javascript'>
 
                      var progressBarOptions = {
                        startAngle: -1.55,
                        size: 200,
                          fill:  {gradient: ['".$first_stoke."','".$second_stoke."']}
                      }

                      jQuery('.circle').circleProgress(progressBarOptions).on('circle-animation-progress', function(event, progress, stepValue) {
                          var str = Math.round(stepValue * 100);
                          jQuery(this).find('strong').text(str+'%');
                      });
                      var count_circle =  jQuery('.circle').length;

                      for (var i = 1; i <= count_circle; i++) {

                        jQuery('#circle-'+i).circleProgress({
                          value : jQuery('#circle-'+i).attr('data-value'),
                          fill:  {gradient: ['".$first_stoke."','".$second_stoke."']}
                        });

                      }
                    </script>";
            echo $display;
        }
        /* Shotcode Generate start */

    }
}