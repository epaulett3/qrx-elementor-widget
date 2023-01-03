<?php
/**
 * @package QRx
 */

/*
Plugin Name: QRx Elementor Widget
Description: A plugin that addes custom Elementor Widget
Version: 1.0.5
Author: Jessie Paul (Kaival Marketing Services)
Author URI: kaivalmarketingservices.com

*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No access of directly access.
}

define('QRXEW_TXT_DOMAIN', 'qrx-elementor-widget');
define('QRXEW_PLUGIN_NAME', 'qrx-elementor-widget');

/**
 * Register Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_qrxelementor_widget( $widgets_manager ) {

    // require widget PHP files
	require_once( __DIR__ . '/widgets/prodcat-list-widget.php' );
	require_once( __DIR__ . '/widgets/imagebox-with-button-widget.php' );
	require_once( __DIR__ . '/widgets/qrx-nav-menu.php' );

    // register widgets
        
    // custom widgets
    $widgets_manager->register( new \Widget_Image_Box_With_Button() );  
    $widgets_manager->register( new \QRx_Nav_Menu() );  

    // woocommerce related widgets
    if(class_exists('WooCommerce')) {
        $widgets_manager->register( new \Elementor_Woo_ProdCat_List_Widget() ); 
    }
    

}
add_action( 'elementor/widgets/register', 'register_qrxelementor_widget' );


// CSS
// add_action( 'elementor/preview/enqueue_styles', 'qrxew_register_enqueue_style' ); // Elementor Editor
add_action('wp_enqueue_scripts', 'qrxew_register_style');


function qrxew_register_style(){
    wp_register_style( QRXEW_TXT_DOMAIN.'-style', plugins_url( QRXEW_PLUGIN_NAME . '/assets/css/style.css' ), [], null );
    wp_register_script(QRXEW_TXT_DOMAIN.'-script', plugins_url(QRXEW_PLUGIN_NAME . '/assets/js/script.js'), ['jquery'], null);

    $enable_minified = false;
    wp_register_style('qrx-nav-menu', plugins_url(QRXEW_PLUGIN_NAME . '/assets/css/qrx-nav-menu'. ($enable_minified ? '.min' : '' ) .'.css'));
    
}

function qrxew_register_enqueue_style(){
    // load css
    wp_register_style( QRXEW_TXT_DOMAIN.'-style', plugins_url( QRXEW_PLUGIN_NAME . '/assets/css/style.css' ), [], null );
    wp_enqueue_style( QRXEW_TXT_DOMAIN.'-style' );
}

