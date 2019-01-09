<?php
if ( ! class_exists( 'nls_options' ) ) {
	class nls_options {
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		/* Load Redux Framework */
		public function __construct() {		 
			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}

		}

		public function initSettings() {			
    		// Set the default arguments
			$this->setArguments();

		    // Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

		    // Create the sections and fields
			$this->setSections();

		    if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
		    	return;
		    }

		    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		//setup theme option
		public function setArguments() {
			$theme = wp_get_theme();
			$this->args = array(
				'opt_name'  => 'nls_option', 
				'display_name' => $theme->get( 'Name' ), 
				'menu_type'          => 'menu',
				'allow_sub_menu'     => true,
				'menu_title'         => __( 'NLS Tech Options', 'nls' ),
				'page_title'         => __( 'NLS Tech Options', 'nls' ),
				'dev_mode' => false,
				'customizer' => true,
				'menu_icon' => '',
				'hints'              => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'light',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
						),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
						),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
							),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
							),
						),
		        ) // end Hints
				);
		}

		//setup helper tab
		public function setHelpTabs() {
			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-1',
				'title'   => __( 'Theme Information 1', 'nls' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'nls' )
				);

			$this->args['help_tabs'][] = array(
				'id'      => 'redux-help-tab-2',
				'title'   => __( 'Theme Information 2', 'nls' ),
				'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'nls' )
				);
			$this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'nls' );
		}

		//setup area
		public function setSections() {			
	    	// Header Section
			$this->sections[] = array(
				'title'  => __( 'Header', 'nls' ),
				'desc'   => __( 'All of settings for header on this theme.', 'nls' ),
				'icon'   => 'el-icon-home',
				'fields' => array(					
					array(
						'id'       => 'logo-image',
						'type'     => 'media',
						'title'    => __( 'Logo image', 'nls' ),
						'desc'     => __( 'Image that you want to use as logo', 'nls' ),
					),
					array(
						'id'       => 'favicon',
						'type'     => 'media',
						'title'    => __( 'Favicon image', 'nls' ),
						'desc'     => __( 'Image that you want to use as favicon', 'nls' ),
					),
					array(
						'id'       => 'lang_name',
						'type'     => 'text',
						'title'    => __( 'global Name', 'nls' ),
						'desc'     => __( 'The name use to translate language', 'nls' ),
					)
				)
	    	); 	
	    	// Infor Section
			$this->sections[] = array(
				'title'  => __( 'Information', 'nls' ),
				'desc'   => __( 'All of settings for information on this theme.', 'nls' ),
				'icon'   => 'el-icon-home',
				'fields' => array(		
					array(
						'id'       => 'fax',
						'type'     => 'text',
						'title'    => __( 'Fax', 'nls' ),
						'desc'     => __( 'Fax company', 'nls' ),
					),array(
						'id'       => 'phone',
						'type'     => 'text',
						'title'    => __( 'Phone', 'nls' ),
						'desc'     => __( 'Phone company', 'nls' ),
					),			
					array(
						'id'       => 'address',
						'type'     => 'text',
						'title'    => __( 'Address', 'nls' ),
						'desc'     => __( 'Address company', 'nls' ),
					),					
					array(
						'id'       => 'email',
						'type'     => 'text',
						'title'    => __( 'Email', 'nls' ),
						'desc'     => __( 'Email company', 'nls' ),
					),
				)
	    	); 	
	    	//socail links
	    	$this->sections[] = array(
				'title'  => __( 'Socical Links', 'nls' ),
				'desc'   => __( '', 'nls' ),
				'icon'   => 'el-icon-share-alt',
				'fields' => array(					
					array(
						'id'       => 'facebook',
						'type'     => 'text',
						'title'    => __( 'Facebook', 'nls' ),
					),
                    array(
						'id'       => 'instagram',
						'type'     => 'text',
						'title'    => __( 'Instagram', 'nls' ),					
                    ),
                    array(
						'id'       => 'social-email',
						'type'     => 'text',
						'title'    => __( 'Email', 'nls' ),					
                    )
				)
	    	);
           
			//Footer
	    	$this->sections[] = array(
				'title'  => __( 'Footer', 'nls' ),
				'desc'   => __( '', 'nls' ),
				'icon'   => 'el-icon-website',
				'fields' => array(					
					array(
						'id'       => 'copyright',
						'type'     => 'textarea',
						'title'    => __( 'Copyright', 'nls' ),
						'hint'     => array(
		                    'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
		                )
					)
				)
	    	);

		}
	}
	global $reduxConfig;
	$reduxConfig = new nls_options();
}