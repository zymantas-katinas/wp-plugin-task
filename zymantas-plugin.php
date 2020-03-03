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
 }

 if( class_exists('ZymantasPlugin')){
     $zymantasPlugin = new ZymantasPlugin();
     $zymantasPlugin->register();
 }
 //activation
 register_activation_hook( __FILE__, array ($zymantasPlugin, 'activate'));

 //deactivation
 register_deactivation_hook( __FILE__, array ($zymantasPlugin, 'deactivate'));
