<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 03/10/2017
 * Time: 12:07
 */

# ajout des elements css et js dans mon template
function themeprefix_bootstrap_modals() {


	wp_register_script ( 'uikit' , get_stylesheet_directory_uri() . '/js/uikit.js', array( 'jquery' ), '1', true );
	wp_register_script ( 'uikit-icons' , get_stylesheet_directory_uri() . '/js/uikit-icons.js', '', '1', true );
	wp_register_script ( 'owl.carousel' , get_stylesheet_directory_uri() . '/js/owl.carousel.js', '', '1', true );
	wp_register_script ( 'dotdot' , get_stylesheet_directory_uri() . '/js/jquery.dotdotdot.js', '', '1', true );
	wp_register_script ( 'app' , get_stylesheet_directory_uri() . '/js/app.js', '', '1', true );


	wp_register_style ( 'uikit' , get_stylesheet_directory_uri() . '/css/uikit.css', '' , '', 'all' );
	wp_register_style ( 'owl.carousel' , get_stylesheet_directory_uri() . '/css/owl.carousel.css', '' , '', 'all' );
	wp_register_style ( 'owl.carousel.default' , get_stylesheet_directory_uri() . '/css/owl.theme.default.css', '' , '', 'all' );
	wp_register_style ( 'font-awesome' , get_stylesheet_directory_uri() . '/css/font-awesome.css', '' , '', 'all' );
	wp_register_style ( 'app' , get_stylesheet_directory_uri() . '/css/app.css', '' , '1.2', 'all' );


	wp_enqueue_script( 'uikit' );
	wp_enqueue_script( 'uikit-icons' );
	wp_enqueue_script( 'owl.carousel' );
	wp_enqueue_script( 'dotdot' );
	wp_enqueue_script( 'app' );

	wp_enqueue_style( 'uikit' );
	wp_enqueue_style( 'owl.carousel' );
	wp_enqueue_style( 'owl.carousel.default' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'app' );
}

add_action( 'wp_enqueue_scripts', 'themeprefix_bootstrap_modals');