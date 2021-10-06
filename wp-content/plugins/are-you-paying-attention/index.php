<?php

/*
  Plugin Name: Are you Paying Attention
  Description: Replaces a list of words.
  Version 1.0
  Author: Brad
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AreYouPayingAttention {
    function __construct(){
        add_action('init',array($this,'adminAssets'));
    }
    //De primeras usábamos este constructor pero cuando se editaba un bloque había que actualizar todo.
    // function __construct(){
    //     add_action('enqueue_block_editor_assets',array($this,'adminAssets'));
    // }

    function adminAssets(){
        wp_register_style('quizeditcss',plugin_dir_url( __FILE__) . 'build/index.css');
        //Le pasamo el js que genera JSX, por eso apuntamos a build/index.js
        wp_register_script('ournewblocktype',plugin_dir_url( __FILE__) . 'build/index.js',array('wp-blocks','wp-element','wp-editor'));
        register_block_type('ourplugin/are-you-paying-attention',array(
            'editor_script' => 'ournewblocktype',
            'editor_style' => 'quizeditcss',
            'render_callback' => array($this,'theHTML')
        ));
       //Usamos este código con el constructor que no deja actualizar bloques
        // wp_enqueue_script('ournewblocktype',plugin_dir_url( __FILE__) . 'build/index.js',array('wp-blocks','wp-element'));
    }

    function theHTML($attributes){

        if (!is_admin()) {
            wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));
            wp_enqueue_style('attentionFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
            # code...
        }
        
        ob_start(); ?>

        <div class="paying-attention-update-me"><pre style="display:none"><?php echo wp_json_encode($attributes) ?></pre></div>
        <?php return ob_get_clean();

        // Se usa este return pero es menos cómodo para poner html, por eso usamos o de ob_start
        //return '<p>Today the sky is ' . $attributes['skyColor'] . ' and the grass is ' . $attributes['grassColor'] . '!!!</p>';
    }
}

$areYouPayingAttention = new AreYouPayingAttention();
