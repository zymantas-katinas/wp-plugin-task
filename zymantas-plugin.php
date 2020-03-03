<?php 

/**
 * @package ZymantasPlugin
 */

/*
Plugin Name: Zymantas Plugin
Plugin URI: https://github.com/zymantas-katinas/wp-plugin-task
Description: A plugin for wp task.
Version: 1.0.0
Author: Zymantas Katinas
Author URI: https://www.zymantaskatinas.com
 */

 if ( ! defined('ABSPATH')) {
     die;
 }

 class ZymantasPlugin
 {
     function register() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue'));
     }

     function activate() {
         flush_rewrite_rules(); 
     }

     function deactivate() {
        flush_rewrite_rules(); 
     }

     function enqueue() {
         wp_enqueue_style( 'style', plugins_url('/assets/newstyle.css', __FILE__) );
     }

     function addPost(){
        add_action( 'gform_after_submission', 'create_post_example', 10, 1 );
     }

 }

 if( class_exists('ZymantasPlugin')){
     $zymantasPlugin = new ZymantasPlugin();
     $zymantasPlugin->register();
     $zymantasPlugin->addPost();
 }
 //activation
 register_activation_hook( __FILE__, array ($zymantasPlugin, 'activate'));

 //deactivation
 register_deactivation_hook( __FILE__, array ($zymantasPlugin, 'deactivate'));


 function create_post_example($entry) {
    $post_data = array(
        'post_title' => rgar( $entry, 'date_created' ). ' pusperimetris - ' .rgar($entry, '6'),
        'post_content' => 
            'Pirma kraštinė - '.rgar($entry, '3').
            '<br>Antra kraštinė - '.rgar($entry, '4').
            '<br>Trečia kraštinė - '.rgar($entry, '5'),
        'post_status' => 'publish',
        'post_type' => 'post'
    );

    wp_insert_post( $post_data );
}



