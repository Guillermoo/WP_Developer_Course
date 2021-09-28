<?php 



/* 
Plugin Name: Our Test Plugin
Description: A truly amazing plugin.
Version: 1.0
Author: Brad
Author URI: UDEMY
Text Domain: wcpdomain
Domain Path: /languages
*/ 

class WordCountAndTimePlugin {
    function __construct(){
        add_action('admin_menu', array($this,'adminPage')); //Se referencia a la función con el array.
        add_action('admin_init',array($this,'settings'));
        add_filter('the_content', array($this,'ifWrap'));
        add_action('init',array($this,'languages'));
    }

    function languages(){
        load_plugin_textdomain('wcpdomain',false,dirname(plugin_basename(__FILE__)) . '/languages');
    }

    function ifWrap($content){
        if (is_main_query() AND is_single() AND (get_option('wcp_wordcount','1') OR (get_option('wcp_charactercount','1')) OR (get_option('wcp_readtime','1')))) {
            return $this->createHTML($content);
        }
        return $content;
    }

    function createHTML($content){
        $html = '<h3>' . esc_html(get_option( 'wcp_headline', esc_html__('Post Statistics','wcpdomain') )) . '</h3><p>';

        //Contamos los carácteres
        if (get_option( 'wcp_wordcount', '1' ) OR get_option( 'wcp_readcount', '1' )){
            $wordCount = str_word_count(strip_tags($content));
        }

        //Cuenta letras
        if (get_option( 'wcp_wordcount', '1' )){
            $html .= esc_html__('This post has','wcpdomain') . ' ' . $wordCount . ' ' . esc_html__('words','wcpdomain') . '.<br>';
        }

        //Cuenta carácteres
        if (get_option( 'wcp_charactercount', '1' )){
            $html .= esc_html__('This post has','wcpdomain') . ' ' . strlen(strip_tags($content)) . ' ' . esc_html__('characters','wcpdomain') . '.<br>';
        }

        //Tiempo medio de lectura
        if (get_option( 'wcp_readtime', '1' )){
            $html .= esc_html__('This post will take about','wcpdomain') . round($wordCount/225) . ' ' . esc_html__('minute(s) to read','wcpdomain') . '.<br>';
        }

        $html .= '</p>';

        if (get_option( 'wcp_location', '0' ) == '0'){
            return $html . $content;
        }
        return $content . $html;

    }

    function settings(){
        add_settings_section('wcp_first_section',null,null,'word-count-settings-page');
        
        add_settings_field('wcp_location','Display Location',array($this,'locationHTML'),'word-count-settings-page','wcp_first_section');
        register_setting('wordcountplugin','wcp_location',array('sanitize_callback' => array($this,'sanitizeLocation'), 'default' => 0));

        add_settings_field('wcp_headline','Headline Text',array($this,'headlineHTML'),'word-count-settings-page','wcp_first_section');
        register_setting('wordcountplugin','wcp_headline',array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

        add_settings_field('wcp_wordcount','Word Count',array($this,'checkboxHTML'),'word-count-settings-page','wcp_first_section',array('theName'=> 'wcp_wordcount'));
        register_setting('wordcountplugin','wcp_wordcount',array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

        add_settings_field('wcp_charactercount','Character Count',array($this,'checkboxHTML'),'word-count-settings-page','wcp_first_section',array('theName'=> 'wcp_charactercount'));
        register_setting('wordcountplugin','wcp_charactercount',array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

        add_settings_field('wcp_readtime','Read Time',array($this,'checkboxHTML'),'word-count-settings-page','wcp_first_section',array('theName'=> 'wcp_readtime'));
        register_setting('wordcountplugin','wcp_readtime',array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
    }
/**
 * Función para que no se pueda hackear la entrada de datos por selector
 *
 * @param [type] $input
 * @return void
 */
    function sanitizeLocation($input){
        if($input != '0' AND $input != '1'){
            add_settings_error('wcp_location','wcp_location_error','Display location must be 1 o 0');
            return get_option('wcp_location');
        }

        return $input;
    }


    function headlineHTML(){ ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')); ?>"></input>
    <?php }


    function checkboxHTML($args){ ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value='1' <?php checked(get_option($args["theName"],'1')) ?>>
    <?php }

    function locationHTML(){ ?>
        <select name="wcp_location">
            <option value="0" <?php selected(get_option('wcp_location','0')) ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location','1')) ?>>End of post</option>
        </select>
    <?php }

    function adminPage(){
        add_options_page('Word Count Settings',esc_html__('Word Count','wcpdomain'),'manage_options','word-count-settings-page',array($this,'ourHTML'));
    }
    

    function ourHTML(){ ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
                <?php
                    settings_fields('wordcountplugin');
                    do_settings_sections('word-count-settings-page');
                    submit_button(); 
                ?>
            </form>
        </div>
    <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();


?>


