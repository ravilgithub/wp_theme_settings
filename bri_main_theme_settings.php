<?php
/**
 * Страница основных настроек темы.
 * https://wp-kama.ru/id_3773/api-optsiy-nastroek.html
 * http://qnimate.com/add-radio-buttons-using-wordpress-settings-api/
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'BRI_Main_Theme_Settings' ) ) {
	class BRI_Main_Theme_Settings {
		/**
		 * @var string - имя tab'a панели по умолчанию.
		 */
		public $default_tab = 'general';

		/**
		 * @var array
		 */
		private $_main_array_options = array();

		/**
		 * @var array a setting list of parameters
		 */
		public $settings = array();


		/**
		 * Construct
		 *
		 * @since		1.0
		 * @author	Ravil
		 *
		 * array $args
		 */
		function __construct( $args = array() ) {
			$default_args = array(
				'options_name'	=> 'bri_main_theme_settings',
				'parent_slug' 	=> 'options-general.php',
				'page_title'		=> __( 'Theme settings page', 'woocommerce' ),
				'menu_title'		=> __( 'Theme settings', 'woocommerce' ),
				'capability'		=> 'manage_options',
				'icon'					=> 'dashicons-screenoptions',
				'position'			=> '79.99'
			);

			$this->settings = apply_filters( 'bri_main_theme_general_option_args', wp_parse_args( $args, $default_args ) );

			// $this->debug( $this->settings, __FUNCTION__ );

			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_action( 'admin_init', array( $this, 'add_fields' ) );
			add_action( 'admin_menu', array( $this, 'add_admin_menu' ), 99 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}


		/**
		 * Check value for TRUE
		 *
		 * Return boolean type
		 *
		 * @param $value
		 *
		 * @return	bool
		 * @since		1.0
		 * @author	Ravil
		 */
		function option_is_true( $value ) {
			return true === $value || 1 === $value || '1' === $value || 'yes' === $value;
		}


		/**
		 * Определение к какому типу данных относится
		 * каждый из основных типов ввода данных,
		 * для правильной их очистки. 
		 *
		 * Return an array with names of types options.
		 *
		 * @return	array
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_sanitize_option_types() {
			$types = array(
				'bool'		=> array( 'checkbox' ),
				'string'	=> array( 'text', 'textarea', 'radio', 'select' ),
				'number'	=> array( 'number' )
			);

			return apply_filters( 'bri_sanitize_option_types', $types );
		}


		/**
		 * DEBUG
		 *
		 * Display HTML
		 *
		 * @param array $arr
		 * @param $func_name
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function debug( $arr, $func_name ) {
			echo '<div style="margin:50px 300px;"><h3>' . $func_name . '</h3><pre>';
			print_r( $arr );
			echo '</pre></div>';
		}


		/**
		 * Enqueue script and styles in admin side
		 *
		 * Add style and scripts to administrator
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function admin_enqueue_scripts() {
			wp_enqueue_style( 'bri_theme_settings_admin', get_template_directory_uri() . '/inc/bri_theme_settings/assets/css/admin.css' );
		}


		/**
		 * Get current tab
		 *
		 * get the id of tab showed, return "general" is the current tab is not defined
		 *
		 * @return	string
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_current_tab() {
			if ( isset( $_REQUEST[ 'current-tab' ] ) && ( '' != $_REQUEST[ 'current-tab' ] ) ) {
				return $_REQUEST[ 'current-tab' ];
			}
			return $this->default_tab;
		}


		/**
		 * Get main array options
		 *
		 * return an array with all options defined on options-files
		 *
		 * @return	array
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_main_array_options() {
			if ( ! empty( $this->_main_array_options ) ) {
				return $this->_main_array_options;
			}

			$options_path = get_template_directory() . '/inc/bri_theme_settings/bri_main_theme_general_options.php';
			$options_path = apply_filters( 'bri_main_theme_general_options_path', $options_path );

			if ( file_exists( $options_path ) ) {
				include $options_path; // $options = array ...
				$this->_main_array_options = array_merge( $this->_main_array_options, $options );
			}

			return $this->_main_array_options;
		}


		/**
		 * Get the title of the section
		 *
		 * return the title of section
		 *
		 * @param $section
		 *
		 * @return	string
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_section_title( $section ) {
			$main_options = $this->get_main_array_options();
			$current_tab = $this->get_current_tab();

			foreach ( $main_options[ $current_tab ][ 'sections' ][ $section ] as $option ) {

				// $this->debug( $option, __FUNCTION__ );

				if ( isset( $option[ 'type' ] ) && 'section' == $option[ 'type' ] && isset( $option[ 'name' ] ) ) {
					return $option[ 'name' ];
				}
			}
		}


		/**
		 * Get the description of the section
		 *
		 * return the description of section if is set
		 *
		 * @param $section
		 *
		 * @return	string
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_section_description( $section ) {
			$main_options = $this->get_main_array_options();
			$current_tab = $this->get_current_tab();

			// $this->debug( $section, __FUNCTION__ );

			$section_id_parts = explode( '_', $section[ 'id' ] );
			$section_id_parts_last = count( $section_id_parts ) -1;
			$section_index = $section_id_parts[ $section_id_parts_last ];
			$section_options = $main_options[ $current_tab ][ 'sections' ][ $section_index ];

			foreach ( $section_options as $option ) {

				// $this->debug( $option, __FUNCTION__ );

				if ( isset( $option[ 'type' ] ) && 'section' == $option[ 'type' ] && isset( $option[ 'desc' ] ) ) {
					echo '<p>' . $option[ 'desc' ] . '</p>';
					return;
				}
			}
		}


		/**
		 * Register Settings
		 *
		 * Generate wp-admin settings pages by registering
		 * your settings and using a few callbacks to control the output
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function register_settings() {
			$options_name = $this->settings[ 'options_name' ];
			register_setting( $options_name, $options_name, array( $this, 'options_validate' ) );
		}


		/**
		 * Get options from db
		 *
		 * return the options from db, if the options
		 * aren't defined in the db,
		 * get the default options ad add the options in the db
		 *
		 * @return	array
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_options() {
			$options_name = $this->settings[ 'options_name' ];
			$options			= get_option( $options_name );
			if ( false === $options || ( isset( $_REQUEST[ 'bri-form-action' ] ) && 'reset' == $_REQUEST[ 'bri-form-action' ] ) ) {
				$options = $this->get_default_options();
			}

			return $options;
		}


		/**
		 * Set an array with all default options
		 *
		 * put default options in an array
		 *
		 * @return	array
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_default_options() {
			$main_options = $this->get_main_array_options();
			$current_tab = $this->get_current_tab();
			$default_options = array();

			foreach ( $main_options[ $current_tab ][ 'sections' ] as $section => $data ) {
				foreach ( $data as $option ) {
					if ( 'section' !== $option[ 'type' ] && ( isset( $option[ 'id' ] ) && isset( $option[ 'default' ] ) ) ) {
						$default_options[ $option[ 'id' ] ] = $option[ 'default' ];
					}
				}
			}

			// $this->debug( $default_options, __FUNCTION__ );

			return $default_options;
		}


		/**
		 * Options Validate
		 *
		 * a callback function called by "Register Settings" function
		 *
		 * @param $input
		 *
		 * @return	array validate input fields
		 * @since		1.0
		 * @author	Ravil
		 */
		function options_validate( $input ) {
			$main_options = $this->get_main_array_options();
			$current_tab	= $this->get_current_tab();
			$valid_input	= $this->get_options();

			foreach ( $main_options[ $current_tab ][ 'sections' ] as $section => $data ) {
				foreach ( $data as $option ) {

					if ( isset( $option[ 'sanitize_call' ] ) && is_callable( $option[ 'sanitize_call' ] ) && isset( $option[ 'id' ] ) ) {

						if ( is_array( $input[ $option[ 'id' ] ] ) ) {
							$valid_input[ $option[ 'id' ] ] = array_map( $option[ 'sanitize_call' ], $input[ $option[ 'id' ] ] );
						} else {
							$valid_input[ $option[ 'id' ] ] = call_user_func( $option[ 'sanitize_call' ], $input[ $option[ 'id' ] ] );
						}

					} else {

						if ( isset( $option[ 'id' ] ) ) {
							$value = isset( $input[ $option[ 'id' ] ] ) ? $input[ $option[ 'id' ] ] : false;
							if ( isset( $option[ 'type' ] ) ) {

								// Default sanitize callbacks
								foreach ( $this->get_sanitize_option_types() as $data_type => $input_types ) {
									if ( in_array( $option[ 'type' ], $input_types ) ) {
										$method_name = 'sanitize_' . $data_type . '_type_option';
										if ( is_callable( array( $this, $method_name ) ) ) {
											if ( is_array( $value ) ) {
												$value = array_map( array( $this, $method_name ), $value );
											} else {
												$value = call_user_func( array( $this, $method_name ), $value );
											} 
										}
									}
								}
							}

							$valid_input[ $option[ 'id' ] ] = $value;
						}
					}
				}
			}

			// Вызов ошибки и получения возможности отслеживания работы функций по очистке данных.
			/*$this->debug( $input, __FUNCTION__ );
			$this->asd();*/

			return $valid_input;
		}


		/**
		 * Sanitize boolean options.
		 *
		 * Called by "Options Validate" function.
		 *
		 * @param $value
		 *
		 * @return	array string
		 * @since		1.0
		 * @author	Ravil
		 */
		function sanitize_bool_type_option( $value ) {
			$value = $this->option_is_true( $value ) ? 'yes' : 'no';
			return $value;
		}


		/**
		 * Sanitize string options.
		 *
		 * Called by "Options Validate" function.
		 *
		 * @param $value
		 *
		 * @return	array string
		 * @since		1.0
		 * @author	Ravil
		 */
		function sanitize_string_type_option( $value ) {
			$this->debug( $value, __FUNCTION__ );
			$this->debug( '-------------------------------', '' );
			$value = trim( strip_tags( $value ) );
			$this->debug( $value, '' );
			$this->debug( '===============================', '' );
			return $value;
		}


		/**
		 * Sanitize number options.
		 *
		 * Called by "Options Validate" function.
		 *
		 * @param $value
		 *
		 * @return	array nomber
		 * @since		1.0
		 * @author	Ravil
		 */
		function sanitize_number_type_option( $value ) {
			$value = intval( $value );
			return $value;
		}


		/**
		 * Add sections and fields to setting panel
		 *
		 * read all options and show sections and fields
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function add_fields() {
			$options_name = $this->settings[ 'options_name' ];
			$main_options = $this->get_main_array_options();
			$current_tab	= $this->get_current_tab();

			// $this->debug( $main_options, __FUNCTION__ );

			if ( ! $current_tab ) {
				return;
			}

			foreach ( $main_options[ $current_tab ][ 'sections' ] as $section => $data ) {
				add_settings_section( "bri_settings_{$current_tab}_{$section}", $this->get_section_title( $section ), array( $this, 'get_section_description' ), $options_name );
				foreach ( $data as $option ) {

					// $this->debug( 'bri_setting_' . $option[ 'id' ], __FUNCTION__ ); // !!!

					if ( isset( $option[ 'id' ] ) && isset( $option[ 'type' ] ) && isset( $option[ 'name' ] ) ) {
						add_settings_field( 'bri_setting_' . $option[ 'id' ], $option[ 'name' ], array( $this, 'render_field' ), $options_name, "bri_settings_{$current_tab}_{$section}", array( 'option' => $option ) );
					}
				}
			}
		}


		/**
		 * Render the field showed in the setting page
		 *
		 * include the file of the option type, if file do not exists
		 * return a text area
		 *
		 * @param array $param
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function render_field( $param ) {
			if ( ! empty( $param ) && isset( $param[ 'option' ] ) ) {
				$options_name = $this->settings[ 'options_name' ];
				$option = $param[ 'option' ];
				
				$db_options = $this->get_options();

				// $this->debug( $db_options, __FUNCTION__ ); // !!!

				// При первой инициализации поля( пока ещё не записано значение в "DB" ) его значение будет указано из "default"
				$option[ 'value' ] = ( isset( $db_options[ $option[ 'id' ] ] ) ) ? $db_options[ $option[ 'id' ] ] : $option[ 'default' ];

				// $this->debug( $option, __FUNCTION__ ); // !!!

				if ( $field_template_path = $this->get_field_template_path( $option ) ) {
					include $field_template_path;
				} else {
					echo 'Шаблона типа ' . $option[ 'type' ] . ' не существует !';
				}
			}
		}


		/**
		 * Get the html template path of the field
		 *
		 * return the template irl
		 *
		 * @param $field
		 *
		 * @return	string
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_field_template_path( $field ) {
			if ( empty( $field[ 'type' ] ) ) {
				return false;
			}

			$field_template = get_template_directory() . '/inc/bri_theme_settings/templates/fields/' . sanitize_title( $field[ 'type' ] ) . '.php';
			$field_template = apply_filters( 'bri_get_field_template_path', $field_template, $field );

			// $this->debug( $field_template, __FUNCTION__ ); // !!!

			return file_exists( $field_template ) ? $field_template : false;
		}


		/**
		 * Формируем ссылки tab'ов.
		 *
		 * return tabs HTML string.
		 *
		 * @return	string
		 * @since		1.0
		 * @author	Ravil
		 */
		function get_tabs_html() {
			$options_name = $this->settings[ 'options_name' ];
			$main_options = $this->get_main_array_options();
			$current_tab	= $this->get_current_tab();
			$tabs					= '';

			foreach ( $main_options as $tab => $items ) {
				$active_class	= ( $tab == $current_tab ) ? ' nav-tab-active' : '';
				$name = ( isset( $items[ 'name' ] ) && '' != $items[ 'name' ] ) ? $items[ 'name' ] : $tab;
				$description = ( isset( $items[ 'desc' ] ) && '' != $items[ 'desc' ] ) ? $items[ 'desc' ] : '';
				$tabs					.= '<a class="nav-tab' . $active_class . '" title="' . $description . '" href="?page=' . $options_name . '&current-tab=' . $tab . '">' . $name . '</a>';
			}

			return $tabs;
		}


		/**
		 * Add Setting Menu item to wordpress administrator 
		 *
		 * @return	void
		 * @since		1.0
		 * @author 	Ravil
		 */
		function add_admin_menu() {
			$options_name = $this->settings[ 'options_name' ];
			$parent = $this->settings[ 'parent_slug' ];
			if ( ! empty( $parent ) ) {
				add_submenu_page( $parent, $this->settings[ 'page_title' ], $this->settings[ 'menu_title' ], $this->settings[ 'capability' ], $options_name, array( $this, 'add_settings_page' ) );
			} else {
				add_menu_page( $this->settings[ 'page_title' ], $this->settings[ 'menu_title' ], $this->settings[ 'capability' ], $options_name, array( $this, 'add_settings_page' ), $this->settings[ 'icon' ], $this->settings[ 'position' ] );
			}
		}


		/**
		 * Add Setting SubPage to wordpress administrator 
		 *
		 * @return	void
		 * @since		1.0
		 * @author	Ravil
		 */
		function add_settings_page() {
			$options_name = $this->settings[ 'options_name' ];
			$current_tab = $this->get_current_tab();
			$warning = __( 'If you continue with this action, you will reset all options in this page.', 'yith-plugin-fw' );
?>
			<div id="bri_main_theme_settings">
				<h1><?php echo get_admin_page_title(); ?></h1>

				<!-- Tabs -->
				<?php if ( $tabs_html = $this->get_tabs_html() ) : ?>
					<div class="nav-tab-wrapper"><?php echo $tabs_html ?></div>
				<?php endif; ?>

				<form action="options.php" method="POST">
				<!-- <form action="" method="POST"> -->
<?php
					settings_fields( $options_name );
					do_settings_sections( $options_name );
					submit_button(
						__( 'Save Changes', 'woocommerce' ),
						'primary',
						'submit',
						false,
						array(
							'style' => 'float:left; margin-top:10px; margin-right:10px;'
						)
					);
					
?>				
					<!-- Смотри get_name_field() -->
					<input type="hidden" name="current-tab" value="<?php echo esc_attr( $current_tab ) ?>">
				</form>

				<form method="POST">
					<!-- Смотри get_name_field() -->
					<input type="hidden" name="current-tab" value="<?php echo esc_attr( $current_tab ) ?>">

					<input type="hidden" name="bri-form-action" value="reset">
<?php 
					submit_button(
						__( 'Reset defaults', 'woocommerce' ),
						'secondary',
						'bri-form-reset',
						true,
						array(
							'onclick' => 'return confirm("' . $warning . '\n' . __( 'Are you sure?', 'woccommerce' ) . '")'
						)
					);
?>
				</form>
			</div>
<?php
		}
	}
	
	$bri_obj = new BRI_Main_Theme_Settings;


	// $bri_obj = new BRI_Main_Theme_Settings( array( 'options_name' => 'bri_main_theme_settings_2', 'parent_slug' => '' ) );


	// $bri_obj = new BRI_Main_Theme_Settings( array( 'options_name' => 'bri_main_theme_settings_3', 'parent_slug' => 'edit.php' ) );

	// $bri_obj->debug( $bri_obj->get_options(), __FILE__ );

	/*if ( 'POST' == $_SERVER[ 'REQUEST_METHOD' ] ) {
		$bri_obj->debug( $_POST, __FILE__ );		
	}*/
}

