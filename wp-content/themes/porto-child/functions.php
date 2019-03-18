<?php

add_action('wp_enqueue_scripts', 'porto_child_css', 1001);
 
// Load CSS
function porto_child_css() {
    // porto child theme styles
    wp_deregister_style( 'styles-child' );
    wp_register_style( 'styles-child', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'styles-child' );

    if (is_rtl()) {
        wp_deregister_style( 'styles-child-rtl' );
        wp_register_style( 'styles-child-rtl', get_stylesheet_directory_uri() . '/style_rtl.css' );
        wp_enqueue_style( 'styles-child-rtl' );
    }
}



add_action( 'woocommerce_single_product_summary', 'dev_designs_show_sku', 5 );
function dev_designs_show_sku(){
    global $product;
    echo 'SKU: ' . $product->get_sku();
}



if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' 	=> 'Sidebar Colors',
    'menu_title'	=> 'Sidebar Colors',
    'menu_slug' 	=> 'sidebar-colors',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));
}


// The main acf gui is on the PTShop site as an example


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5c8afec9ae8ea',
	'title' => 'Sidebar Color Options',
	'fields' => array(
		array(
			'key' => 'field_5c8b0864e5334',
			'label' => 'Enable Sidebar Colors',
			'name' => 'enable_sidebar_colors',
			'type' => 'select',
			'instructions' => 'Enable Sidebar Colors?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'No' => 'No',
				'Yes' => 'Yes',
			),
			'default_value' => array(
				0 => 'No',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'return_format' => 'value',
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_5c8afee6fa470',
			'label' => 'Sidebar Header Background',
			'name' => 'sidebar_header_background',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c8b0864e5334',
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
		),
		array(
			'key' => 'field_5c8b0047ac2ae',
			'label' => 'Sidebar Header Text Color',
			'name' => 'sidebar_header_text_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c8b0864e5334',
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
		),
		array(
			'key' => 'field_5c8b008a6c4c1',
			'label' => 'Sidebar List Item Text Color',
			'name' => 'sidebar_list_item_text_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c8b0864e5334',
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
		),
		array(
			'key' => 'field_5c8b00d9d89ea',
			'label' => 'Sidebar List Item Text Color (Hover)',
			'name' => 'sidebar_list_item_text_color_hover',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c8b0864e5334',
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
		),
		array(
			'key' => 'field_5c8b01254bb7d',
			'label' => 'Sidebar List Item Background Color',
			'name' => 'sidebar_list_item_background_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5c8b0864e5334',
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
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'sidebar-colors',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;