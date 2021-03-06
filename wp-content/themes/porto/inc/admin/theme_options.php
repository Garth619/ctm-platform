<?php

/**
 * Porto Theme Options
 */

require_once( porto_admin . '/functions.php' );

// include redux framework core functions
require_once( porto_admin . '/ReduxCore/framework.php' );

// porto theme settings options
require_once( porto_admin . '/theme_options/settings.php' );

require_once( porto_admin . '/theme_options/save_settings.php' );

if ( get_option('porto_init_theme', '0') != '1' ) {
    porto_check_theme_options();
}

// regenerate default css, skin css files after update theme
$porto_cur_version = get_option( 'porto_version', '1.0' );
if ( !porto_is_ajax() && version_compare( porto_version, $porto_cur_version, '>' ) && version_compare( phpversion(), '5.3', '>=' ) ) {

    // fix container width value
    if ( version_compare( $porto_cur_version, '2.8.3', '<=' ) ) {
        global $porto_settings, $reduxPortoSettings;

        switch ($porto_settings['container-width']) {
            case 1024: $reduxPortoSettings->ReduxFramework->set('container-width', '1020'); break;
            case 1170: $reduxPortoSettings->ReduxFramework->set('container-width', '1140'); break;
            case 1280: $reduxPortoSettings->ReduxFramework->set('container-width', '1260'); break;
        }
    }

    update_option( 'porto_version', porto_version );

    // regenerate skin css
    porto_save_theme_settings();

    // regenerate default css
    if ( is_rtl() ) {
        porto_compile_css( 'bootstrap_rtl' );
    } else {
        porto_compile_css( 'bootstrap' );
    }

    // regenerate shortcodes css
    porto_compile_css( 'shortcodes' );

} else if ( !porto_is_ajax() && version_compare( porto_version, $porto_cur_version, '>' ) && version_compare( phpversion(), '5.3', '<' ) ) {
    update_option( 'porto_version', porto_version );
}
