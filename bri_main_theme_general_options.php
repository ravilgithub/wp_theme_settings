<?php
	
	$options = array(
		// Section start
		'general' => array(
			'name'		=> __( 'General section title', 'woocommerce' ),
			'desc'		=> __( 'General section describe', 'woocommerce' ),
			'sections' => array(


				// Section 'Main settings section' start
				array(
					// Section data
					array(
						'name'	=> __( 'Main settings title', 'woocommerce' ),
						'desc'	=> __( 'Main settings describe.', 'woocommerce' ),
						// 'id'		=> 'bri_main_settings',
						'type'	=> 'section',
					),

					// Text +
					array(
						'name'		=> __( 'Text name', 'woocommerce' ),
						'desc'		=> __( 'Text describe.', 'woocommerce' ),
						'id'			=> 'bri_some_text',
						'type'		=> 'text',
						'class'		=> 'bri-enhanced-text',
						'default'	=> __( 'Default text', 'woocommerce' ),
					),

					// Textarea +
					array(
						'name'		=> __( 'Textarea name', 'woocommerce' ),
						'desc'		=> __( 'Textarea describe.', 'woocommerce' ),
						'id'			=> 'bri_some_textarea',
						'type'		=> 'textarea',
						'class'		=> 'bri-enhanced-textarea',
						'default'	=> __( 'Default textarea', 'woocommerce' ),
					),

					// Checkbox +
					array(
						'name'		=> __( 'Display rating stars', 'woocommerce' ),
						'desc'		=> __( 'Enable/Disable rating stars', 'woocommerce' ),
						'id'			=> 'bri_display_rating_stars',
						'type'		=> 'checkbox',
						'class'		=> 'bri-enhanced-checkbox',
						'default'	=> 'yes'
					),

					// Radio +
					array(
						'name'			=> __( 'Radio name before', 'woocommerce' ),
						'desc'			=> __( 'Radio describe before.', 'woocommerce' ),
						'id'				=> 'bri_some_radio_before',
						'type'			=> 'radio',
						'class'			=> 'wc-enhanced-radio',
						'default'		=> 'grid',
						'options'		=> array(
							'grid'		=> __( 'Grid', 'woocommerce' ),
							'list'		=> __( 'List', 'woocommerce' ),
						),
					),

					// Radio +
					array(
						'name'			=> __( 'Radio name after', 'woocommerce' ),
						'desc'			=> __( 'Radio describe after.', 'woocommerce' ),
						'id'				=> 'bri_some_radio_after',
						'type'			=> 'radio',
						'class'			=> 'wc-enhanced-radio',
						'default'		=> 'list',
						'options'		=> array(
							'grid'		=> __( 'Grid', 'woocommerce' ),
							'list'		=> __( 'List', 'woocommerce' ),
						),
					),
				),


				// Section 'Additional settings section' start
				array(
					// Section data
					array(
						'name'	=> __( 'Additional settings name', 'woocommerce' ),
						'desc'	=> __( 'Additional settings describe.', 'woocommerce' ),
						// 'id'		=> 'bri_additional_settings',
						'type'	=> 'section',
					),
					
					// Checkbox +
					array(
						'name'		=> __( 'Checkbox name', 'woocommerce' ),
						'desc'		=> __( 'Checkbox describe.', 'woocommerce' ),
						'id'			=> 'bri_some_checkbox',
						'type'		=> 'checkbox',
						'class'		=> 'bri-enhanced-checkbox',
						'default'	=> 'yes'
					),

					// Checkbox Multi +
					array(
						'name'		=> __( 'Checkbox multi name', 'woocommerce' ),
						'desc'		=> __( 'Checkbox multi describe.', 'woocommerce' ),
						'id'			=> 'bri_some_checkbox_multi',
						'type'		=> 'checkbox_multi',
						'class'		=> 'bri-enhanced-checkbox-multi',
						'default'	=> array( 'php', 'js' ),
						'options'	=> array(
							'html'	=> 'HTML',
							'css'		=> 'CSS',
							'js'		=> 'JavaScript',
							'php'		=> 'PHP',
							'mysql'	=> 'MySQL'
						),
						'sanitize_call' => array( $this, 'sanitize_string_type_option' )
					),

					// Number +
					array(
						'name'		=> __( 'Number name', 'woocommerce' ),
						'desc'		=> __( 'Единицы в "px"', 'woocommerce' ),
						'id'			=> 'bri_some_number',
						'type'		=> 'number',
						'class'		=> 'bri-enhanced-number',
						'default'	=> 5,
						'min'		=> 0,
						'max'		=> 10,
						'step'	=> 1
					),

					// Select +
					array(
						'name' => __( 'Select name', 'woocommerce' ),
						'desc' => __( 'Select describe.', 'woocommerce' ),
						'id'   => 'bri_some_select',
						'type' => 'select',
						'class' => 'bri-enhanced-select',
						'default' => 'link',
						'options' => array(
							'link' => __( 'Link', 'woocommerce' ),
							'button' => __( 'Button', 'woocommerce' ),
							'button2' => __( 'Button-2', 'woocommerce' ),
							'button3' => __( 'Button-3', 'woocommerce' ),
						),
					),

					// Select multi +
					array(
						'name' => __( 'Select multi name', 'woocommerce' ),
						'desc' => __( 'Select multi describe.', 'woocommerce' ),
						'id'   => 'bri_some_select_multi',
						'type' => 'select',
						'class' => 'bri-enhanced-select_multi',
						'multiple' => true,
						'default' => array( 'link', 'button2', ),
						'options' => array(
							'link' => __( 'Link', 'woocommerce' ),
							'button' => __( 'Button', 'woocommerce' ),
							'button2' => __( 'Button-2', 'woocommerce' ),
							'button3' => __( 'Button-3', 'woocommerce' ),
						),
					),
				),
			),
		),
		
		'second' => array(
			'name'		=> __( 'Second section title', 'woocommerce' ),
			'desc'		=> __( 'Second section describe', 'woocommerce' ),
			'sections' => array(

				// Section 'Second settings sections' start
				array(
					// Section data
					array(
						'name'	=> __( 'Second settings title', 'woocommerce' ),
						'desc'	=> __( 'Second settings describe.', 'woocommerce' ),
						// 'id'		=> 'bri_main_settings',
						'type'	=> 'section',
					),

					// Text +
					array(
						'name'		=> __( 'Second text name', 'woocommerce' ),
						'desc'		=> __( 'Second text describe.', 'woocommerce' ),
						'id'			=> 'bri_some_text_second',
						'type'		=> 'text',
						'class'		=> 'bri-enhanced-text',
						'default'	=> __( 'Default second text', 'woocommerce' ),
					),
				),


				// Section 'Additional settings sections' start
				array(
					// Section data
					array(
						'name'	=> __( 'Second additional settings name', 'woocommerce' ),
						'desc'	=> __( 'Second additional settings describe.', 'woocommerce' ),
						// 'id'		=> 'bri_additional_settings',
						'type'	=> 'section',
					),
					
					// Checkbox +
					array(
						'name'		=> __( 'Second checkbox name', 'woocommerce' ),
						'desc'		=> __( 'Second checkbox describe.', 'woocommerce' ),
						'id'			=> 'bri_some_checkbox_second',
						'type'		=> 'checkbox',
						'class'		=> 'bri-enhanced-checkbox',
						'default'	=> 'no'
					),
				),
			),
		),
	);