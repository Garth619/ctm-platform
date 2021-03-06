<?php

    if ( !function_exists( 'porto_ultimate_heading_spacer' ) ) {
		function porto_ultimate_heading_spacer($wrapper_class, $wrapper_style, $icon_inline) {
			$spacer = '<div class="porto-u-heading-spacer '.$wrapper_class.'" style="'.$wrapper_style.'">'.$icon_inline.'</div>';
			return $spacer;
		}
	}
    $wrapper_style = $main_heading_style_inline = $sub_heading_style_inline = $line_style_inline = $icon_inline = $output = $el_class = $animation_type = '';
    extract(shortcode_atts(array(
        'main_heading' => '',
        "main_heading_use_theme_fonts" => "",
        "main_heading_font"         => "",
        "main_heading_font_family"  => "",
        "main_heading_font_size"    => "",
        "main_heading_font_weight"  => "",
        "main_heading_line_height"  => "",
        "main_heading_color"        => "",
        "main_heading_margin_bottom"=> "",
        "sub_heading_font"          => "",
        "sub_heading_font_family"   => "",
        "sub_heading_font_size"     => "",
        "sub_heading_font_weight"   => "",
        "sub_heading_line_height"   => "",
        "sub_heading_color"         => "",
        "sub_heading_margin_bottom" => "",
        "spacer"                    => "no_spacer",
        "spacer_position"           => "top",
        "line_style"                => "solid",
        "line_width"                => "auto",
        "line_height"               => "1",
        "line_color"                => "#ccc",
        "alignment"                 => "center",
        "spacer_margin_bottom"      => "",
        "heading_tag"               => "",
        "animation_type"            => "",
        "animation_duration"        => "",
        "animation_delay"           => "",
        "el_class" => "",
        'className' => '',
    ),$atts));
    $wrapper_class = $spacer;

    if ( $className ) {
        if ( $el_class ) {
            $el_class .= ' ' . $className;
        } else {
            $el_class = $className;
        }
    }

    if ( empty( $content ) && isset( $atts['content'] ) && !empty( $atts['content'] ) ) {
        $content = $atts['content'];
    }

    if ( $heading_tag == '' ) {
        $heading_tag = 'h2';
    }
    if ( ( !isset( $atts['main_heading_use_theme_fonts'] ) || !$atts['main_heading_use_theme_fonts'] ) && $main_heading_font ) {
        $google_fonts_data = porto_sc_parse_google_font( $main_heading_font );
        $styles = porto_sc_google_font_styles( $google_fonts_data );
        $main_heading_style_inline .= esc_attr( $styles );
    } else if ( $main_heading_font_family ) {
        $main_heading_style_inline .= 'font-family: '. esc_attr( $main_heading_font_family ) . ';';
    }
    if ( $main_heading_font_weight ) {
        $main_heading_style_inline .= 'font-weight: '. esc_attr( $main_heading_font_weight ) . ';';
    }
    if ( $main_heading_color ) {
        $main_heading_style_inline .= 'color:'. esc_attr( $main_heading_color ).';';
    }
    if ( $main_heading_margin_bottom ) {
        $main_heading_style_inline .= 'margin-bottom: '. esc_attr( $main_heading_margin_bottom ) .'px;';
    }

    if ( ( !isset( $atts['sub_heading_use_theme_fonts'] ) || 'yes' !== $atts['sub_heading_use_theme_fonts'] ) && $sub_heading_font ) {
        $google_fonts_data1 = porto_sc_parse_google_font( $sub_heading_font );
        $styles = porto_sc_google_font_styles( $google_fonts_data1 );
        $sub_heading_style_inline .= esc_attr( $styles );
    } else if ( $sub_heading_font_family ) {
        $sub_heading_style_inline .= 'font-family: '. esc_attr( $sub_heading_font_family ) . ';';
    }

    // enqueue google fonts
    $google_fonts_arr = array();
    if ( isset( $google_fonts_data ) && $google_fonts_data ) {
        $google_fonts_arr[] = $google_fonts_data;
    }
    if ( isset( $google_fonts_data1 ) && $google_fonts_data1 ) {
        $google_fonts_arr[] = $google_fonts_data1;
    }
    if ( !empty( $google_fonts_arr ) ) {
        porto_sc_enqueue_google_fonts( $google_fonts_arr );
    }

    if ( $sub_heading_font_weight ) {
        $sub_heading_style_inline .= 'font-weight: '. esc_attr( $sub_heading_font_weight ) . ';';
    }
    if ( $sub_heading_color ) {
        $sub_heading_style_inline .= 'color: '. esc_attr( $sub_heading_color ).';';
    }
    if ( $sub_heading_margin_bottom ) {
        $sub_heading_style_inline .= 'margin-bottom: '. esc_attr( $sub_heading_margin_bottom ) .'px;';
    }

    if ( $spacer && $spacer_margin_bottom ) {
        $wrapper_style .= 'margin-bottom: '. esc_attr( $spacer_margin_bottom ) .'px;';
    }
    if ( $spacer == 'line_only' ) {
        $wrap_width = $line_width;
        $line_style_inline = 'border-style:'.$line_style.';';
        $line_style_inline .= 'border-bottom-width:'.$line_height.'px;';
        $line_style_inline .= 'border-color:'.$line_color.';';
        $line_style_inline .= 'width:'.$wrap_width. ( 'auto' == $wrap_width ? ';' : 'px;' );
        $wrapper_style .= 'height:'.$line_height.'px;';
        $line = '<span class="porto-u-headings-line" style="'.esc_attr( $line_style_inline ).'"></span>';
        $icon_inline = $line;
    } else if ( $spacer == 'image_only' ) {
        if ( !empty( $spacer_img_width ) ) {
            $siwidth = array($spacer_img_width, $spacer_img_width);
        } else {
            $siwidth = 'full';
        }
        $spacer_inline = '';
        if ( $spacer_img ) {
            $attachment = wp_get_attachment_image_src( $spacer_img, $siwidth );
            if ( isset( $attachment ) ) {
                $icon_inline = $attachment[0];
            }
        }
        $alt = '';
        if($spacer_img_width !== '')
            $spacer_inline = 'width:'.$spacer_img_width.'px';
        $icon_inline = '<img src="'.esc_url( $icon_inline ).'" class="ultimate-headings-icon-image" alt="'.esc_attr($alt).'" style="'.esc_attr($spacer_inline).'"/>';
    }

    if ( !is_numeric( $main_heading_font_size ) ) {
        $main_heading_font_size = preg_replace( '/[^0-9]/', "", $main_heading_font_size );
    }
    if ( !is_numeric( $main_heading_line_height ) ) {
        $main_heading_line_height = preg_replace( '/[^0-9]/', "", $main_heading_line_height );
    }
    if ( $main_heading_font_size ) {
        $main_heading_style_inline .= 'font-size: '. esc_attr( $main_heading_font_size ) .'px;';
    }
    if ( $main_heading_line_height ) {
        $main_heading_style_inline .= 'line-height: '. esc_attr( $main_heading_line_height ) .'px;';
    }

    if ( !is_numeric( $sub_heading_font_size ) ) {
        $sub_heading_font_size = preg_replace( '/[^0-9]/', "", $sub_heading_font_size );
    }
    if ( !is_numeric( $sub_heading_line_height ) ) {
        $sub_heading_line_height = preg_replace( '/[^0-9]/', "", $sub_heading_line_height );
    }
    if ( $sub_heading_font_size ) {
        $sub_heading_style_inline .= 'font-size: '. esc_attr( $sub_heading_font_size ) .'px;';
    }
    if ( $sub_heading_line_height ) {
        $sub_heading_style_inline .= 'line-height: '. esc_attr( $sub_heading_line_height ) .'px;';
    }

    if ( is_rtl() && 'left' === $alignment ) {
        $alignment = 'right';
    } else if ( is_rtl() && 'right' === $alignment ) {
        $alignment = 'left';
    }

    $wrapper_attributes = array();
    if ($animation_type) {
        $wrapper_attributes[] = 'data-appear-animation="'.esc_attr( $animation_type ).'"';
        if ($animation_delay)
            $wrapper_attributes[] = 'data-appear-animation-delay="'. esc_attr( $animation_delay ).'"';
        if ($animation_duration && $animation_duration != 1000)
            $wrapper_attributes[] = 'data-appear-animation-duration="'. esc_attr( $animation_duration ).'"';
    }

    $output = '<div class="porto-u-heading '.esc_attr( $el_class ).'" data-hspacer="'. esc_attr( $spacer ) .'" data-halign="'. esc_attr( $alignment ) .'" style="text-align:'. esc_attr( $alignment ) .'"'. implode( ' ', $wrapper_attributes ) .'>';
        if ( $spacer_position == 'top' ) {
            $output .= porto_ultimate_heading_spacer( $wrapper_class, $wrapper_style, $icon_inline );
        }
        if ( $main_heading ) {
            $output .= '<div class="porto-u-main-heading"><'.$heading_tag.' style="'. esc_attr( $main_heading_style_inline ) .'">'. $main_heading .'</'. $heading_tag .'></div>';
        }
        if ( $spacer_position == 'middle' ) {
            $output .= porto_ultimate_heading_spacer( $wrapper_class, $wrapper_style, $icon_inline );
        }
        if ( $content ) {
            $output .= '<div class="porto-u-sub-heading" style="'. esc_attr( $sub_heading_style_inline ) .'">'. do_shortcode( $content ) .'</div>';
        }
        if ( $spacer_position == 'bottom' ) {
            $output .= porto_ultimate_heading_spacer( $wrapper_class, $wrapper_style, $icon_inline );
        }
    $output .= '</div>';

    echo $output;