<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php get_template_part('head'); ?>
    
<style type="text/css">
	
/* Sidebar Colors Enabler */

<?php if(get_field('enable_sidebar_colors','option') == 'Yes') : ?>

	body.home .widget_product_categories ul.product-categories {
		padding:13px 20px 0;
	}


	body.home .widget_product_categories h3.widget-title,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories h3.widget-title {
		padding:10px 20px;
	}

	body.home .widget_product_categories span.toggle,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories span.toggle {
		right:4px;
	}
	
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories {
		padding:0px !important;
	}
	
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories ul.product-categories {
		padding:10px 20px 20px;
	}




	
/* Header Text Color */

<?php if(get_field('sidebar_header_text_color','option')) : ?>

	body.home .widget_product_categories h3.widget-title,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories h3.widget-title {
		color:<?php the_field( 'sidebar_header_text_color','option'); ?>;
	}
	
	body.home .widget_product_categories span.toggle:before, 
	body.home .widget_product_categories span.toggle:after,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories span.toggle:before,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories span.toggle:after {
		background:#fff;
	}
	
<?php endif;?>

/* Header Background */

<?php if(get_field('sidebar_header_background','option')) : ?>

	body.home .widget_product_categories h3.widget-title,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories h3.widget-title {
		background:<?php the_field( 'sidebar_header_background','option'); ?>;
	}
	
<?php endif;?>

/* Bullet Items Text Color */

<?php if(get_field('sidebar_list_item_text_color','option')) : ?>

	body.home .widget_product_categories ul.product-categories li > a,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories ul.product-categories li > a,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories ul.product-categories li > span.count  {
		color:<?php the_field( 'sidebar_list_item_text_color','option'); ?>;
	}

<?php endif;?>

/* Bullet Items Text Color Hover */

<?php if(get_field('sidebar_list_item_text_color_hover','option')) : ?>

	body.home .widget_product_categories ul.product-categories li > a:hover,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories ul.product-categories li > a:hover {
		color:<?php the_field( 'sidebar_list_item_text_color_hover','option'); ?> !important;
	}

<?php endif;?>

/* Bullet Items Background Color */

<?php if(get_field('sidebar_list_item_background_color','option')) : ?>
	
	body.home .widget_product_categories,
	body.woocommerce-page.archive .sidebar-content aside.widget.widget_product_categories {
		background: <?php the_field( 'sidebar_list_item_background_color','option'); ?>;
	}
	
<?php endif;?>
		
<?php endif;?>

</style>
    
</head>
<?php
global $porto_settings, $porto_design;
$wrapper = porto_get_wrapper_type();
$body_class = $wrapper;
$body_class .= ' blog-' . get_current_blog_id();
$body_class .= ' ' . $porto_settings['css-type'];

$header_is_side = porto_header_type_is_side();

if ($header_is_side)
    $body_class .=  ' body-side';

$loading_overlay = porto_get_meta_value('loading_overlay');
$showing_overlay = false;
if ('no' !== $loading_overlay && ('yes' === $loading_overlay || ('yes' !== $loading_overlay && $porto_settings['show-loading-overlay']))) {
    $showing_overlay = true;
    $body_class .= ' loading-overlay-showing';
}


?>
<body <?php body_class(array($body_class)); ?><?php echo $showing_overlay ? 'data-loading-overlay' : '' ?>>
	
    <?php
    // Showing Overlay
    if ($showing_overlay) : ?><div class="loading-overlay"><div class="bounce-loader">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div></div><?php
    endif;

    // Get Meta Values
    wp_reset_postdata();
    global $porto_layout, $porto_sidebar;

    $porto_layout_arr = porto_meta_layout();
    $porto_layout = $porto_layout_arr[0];
    $porto_sidebar = $porto_layout_arr[1];

    $porto_banner_pos = porto_get_meta_value('banner_pos');

    if (($porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && !(($porto_sidebar && is_active_sidebar( $porto_sidebar )) || porto_have_sidebar_menu())) {
        $porto_layout = 'fullwidth';
    }
    if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') && !(($porto_sidebar && is_active_sidebar( $porto_sidebar )) || porto_have_sidebar_menu())) {
        $porto_layout = 'widewidth';
    }

    if (porto_show_archive_filter()) {
        if ($porto_layout == 'fullwidth') $porto_layout = 'left-sidebar';
        if ($porto_layout == 'widewidth') $porto_layout = 'wide-left-sidebar';
    }

    $breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
    $page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;
    $content_top = porto_get_meta_value('content_top');
    $content_inner_top = porto_get_meta_value('content_inner_top');

    if (( is_front_page() && is_home()) || is_front_page() ) {
        $breadcrumbs = false;
        $page_title = false;
    }

    do_action('porto_before_wrapper');
    ?>

    <div class="page-wrapper<?php if ($header_is_side) echo ' side-nav' ?><?php if (isset($porto_settings['header-side-position']) && $porto_settings['header-side-position'] ) echo ' side-nav-right' ?>"><!-- page wrapper -->

        <?php
        if ($porto_banner_pos == 'before_header') {
            porto_banner('banner-before-header');
        }
        do_action('porto_before_header');
        ?>

        <?php if (porto_get_meta_value('header', true) && 'hide' != $porto_settings['header-view']) : ?>
            <div class="header-wrapper<?php if ($porto_settings['header-wrapper'] == 'wide') echo ' wide' ?><?php if ($porto_settings['sticky-header-effect'] == 'reveal') echo ' header-reveal' ?><?php if (!($header_is_side && $wrapper == 'boxed') && ($porto_banner_pos == 'below_header' || $porto_banner_pos == 'fixed' || porto_get_meta_value('header_view') == 'fixed') || 'fixed' == $porto_settings['header-view']) { echo ' fixed-header'; if ($porto_settings['header-fixed-show-bottom']) echo ' header-transparent-bottom-border'; } ?><?php if ($header_is_side) echo ' header-side-nav' ?>"><!-- header wrapper -->
                <?php
                global $porto_settings;
                ?>
                <?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['header-wrapper'] == 'boxed') : ?>
                <div id="header-boxed">
                <?php endif; ?>
                <?php
                    get_template_part( 'header/header' );
                ?>

                <?php if ( porto_get_wrapper_type() != 'boxed' && $porto_settings['header-wrapper'] == 'boxed' ) : ?>
                </div>
                <?php endif; ?>
            </div><!-- end header wrapper -->
        <?php endif; ?>

        <?php

        do_action('porto_before_banner');
        if ($porto_banner_pos != 'before_header') {
            porto_banner(($porto_banner_pos == 'fixed' && 'boxed' !== $wrapper) ? 'banner-fixed' : '');
        }
        ?>

        <?php
        do_action('porto_before_breadcrumbs');
        get_template_part('breadcrumbs');
        do_action('porto_before_main');
        ?>

        <div id="main" class="<?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'column2' . ' column2-' . str_replace('wide-', '', $porto_layout); else echo 'column1'; ?><?php if ($porto_layout == 'widewidth' || $porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') echo ' wide clearfix'; else echo ' boxed' ?><?php if (!$breadcrumbs && !$page_title) echo ' no-breadcrumbs' ?><?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['main-wrapper'] == 'boxed') echo ' main-boxed' ?>"><!-- main -->

            <?php
            do_action('porto_before_content_top');
            if ($content_top) : ?>
                <div id="content-top"><!-- begin content top -->
                    <?php foreach (explode(',', $content_top) as $block) {
                        echo do_shortcode('[porto_block name="'.$block.'"]');
                    } ?>
                </div><!-- end content top -->
            <?php endif;
            do_action('porto_after_content_top');
            ?>

            <?php if ($wrapper == 'boxed' || $porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') : ?>
            <div class="container">
                <?php if(class_exists('WC_Vendors') ){ porto_wc_vendor_header(); }?>
            <?php else: ?>
            <div class="container-fluid">
            <?php endif; ?>

            <?php
                do_action('porto_before_content');
                global $porto_shop_filter_layout;
            ?>

            <div class="row main-content-wrap<?php echo isset( $porto_shop_filter_layout ) && 'horizontal' == $porto_shop_filter_layout ? ' porto-products-filter-body' : ''; ?>">

            <!-- main content -->
            <div class="main-content <?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'col-lg-9'; else echo 'col-lg-12'; ?>">

            <?php wp_reset_postdata(); ?>
                <?php
                do_action('porto_before_content_inner_top');
                if ($content_inner_top) : ?>
                    <div id="content-inner-top"><!-- begin content inner top -->
                        <?php foreach (explode(',', $content_inner_top) as $block) {
                            echo do_shortcode('[porto_block name="'.$block.'"]');
                        } ?>
                    </div><!-- end content inner top -->
                <?php endif;
                do_action('porto_after_content_inner_top');
                ?>