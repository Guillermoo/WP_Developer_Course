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
        //Le pasamo el js que genera JSX, por eso apuntamos a build/index.js
        wp_register_script('ournewblocktype',plugin_dir_url( __FILE__) . 'build/index.js',array('wp-blocks','wp-element'));
        register_block_type('ourplugin/are-you-paying-attention',array(
            'editor_script' => 'ournewblocktype',
            'render_callback' => array($this,'theHTML')
        ));
       //Usamos este código con el constructor que no deja actualizar bloques
        // wp_enqueue_script('ournewblocktype',plugin_dir_url( __FILE__) . 'build/index.js',array('wp-blocks','wp-element'));
    }

    function theHTML($attributes){
        ob_start(); ?>

        <p>Today the sky is <?php echo $attributes['skyColor'] ?> and the grass is <?php echo $attributes['grassColor']  ?>!!!</p>

        <?php return ob_get_clean();

        // SE usa este return pero es menos cómodo para poner html, por eso usamos o de ob_start
        //return '<p>Today the sky is ' . $attributes['skyColor'] . ' and the grass is ' . $attributes['grassColor'] . '!!!</p>';
    }
}

$areYouPayingAttention = new AreYouPayingAttention();
