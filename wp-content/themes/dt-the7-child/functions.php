<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}




function load_my_scripts() {
  
    
   // Enqueue Script
		    
    wp_enqueue_script( 'jquery-addon', get_stylesheet_directory_uri() . '/custom-min.js', 'jquery', '');
    
  }
 
 add_action( 'wp_enqueue_scripts', 'load_my_scripts', 20 );


if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' 	=> 'Form Overlay',
    'menu_title'	=> 'Form Overlay',
    'menu_slug' 	=> 'form-overlay',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));
}

// mdprousa has the gui acf settings

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5c99236745b4b',
	'title' => 'Form Overlay',
	'fields' => array(
		array(
			'key' => 'field_5c99248d9ad36',
			'label' => 'Activate Form Overlay?',
			'name' => 'activate_form_overlay',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'Yes' => 'Yes',
				'No' => 'No',
			),
			'default_value' => array(
			),
			'allow_null' => 1,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5c992376dc58e',
			'label' => 'Call to Action',
			'name' => 'call_to_action',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c99248d9ad36',
						'operator' => '==',
						'value' => 'Yes',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5c992395dc58f',
			'label' => 'Gravity Form ID',
			'name' => 'gravity_form_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c99248d9ad36',
						'operator' => '==',
						'value' => 'Yes',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'form-overlay',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;