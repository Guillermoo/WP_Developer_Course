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
        add_action('enqueue_block_editor_assets',array($this,'adminAssets'));
    }

    function adminAssets(){
        //Le pasamo el js que genera JSX, por eso apuntamos a build/index.js
        wp_enqueue_script('ournewblocktype',plugin_dir_url( __FILE__) . 'build/index.js',array('wp-blocks','wp-element'));
    }
}

$areYouPayingAttention = new AreYouPayingAttention();
