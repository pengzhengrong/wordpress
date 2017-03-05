<?php
/*
  Plugin Name: Page Listing Categories
  Plugin URI: http://www.infolab.es/servicios/internet/
  Description: Provides the ability to list categories on any post or page, includes support for custom taxonomies
  Version: 0.1.3
  Author: Infolab Software i Serveis S.L.U.
  Author URI: http://www.infolab.es
  License: Apache License, Version 2.0
 */

/**
 * @author Ricard Puigdollers Vila
 */

/**
 * Copyright © 2016 Infolab Software I Serveis S.L.U.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * */


defined('ABSPATH') or die('No script kiddies please!');

/**
 * Plugin's main class.
 *
 * @author RICARD
 */
class PageListingCategories {
    
    private $view;
    private $categories;
    private $functions;
    public  $templates;
    private $atts;
    private $widget;
    private $shortcode;
    
    /**
     * Includes.
     *
     * Includes all the files that plugin needs to work.
     *
     * @since 0.1.0
     */
    public function includes(){
        include_once('includes/view.php');
        include_once('includes/model/get-categories.php');
        include_once('includes/functions.php');
        include_once(ABSPATH.'wp-admin/includes/plugin.php');
        include_once('includes/shortcodes/shortcode-list-categories.php');
        require_once('includes/widgets/widget-list-categories.php');
    }
    
    /**
     * Constructor method     
     */
    public function __construct() { 
        $this->includes();
        $this->templates    = [
                                'categories'=>'templates/categories.template.php',
                                'subcategories'=>'templates/subcategories.template.php',
                                'widget'=>'templates/widget.template.php',
                                'widgetadmin'=>'templates/admin-area/widget-admin.template.php'
                            ];
        $this->atts         = array(
                                'taxonomy'              => 'product_cat',
                                'orderby'               => 'name',
                                'order'                 => 'ASC',
                                'exclude'               => '',
                                'show_count'            => 0,                   //1 for yes, 0 for no
                                'pad_counts'            => 0,                   //1 for yes, 0 for no
                                'hierarchical'          => 1,                   //1 for yes, 0 for no
                                'title_li'              => '',
                                'hide_empty'            => 0,                   //1 for yes, 0 for no
                                'show_subcategories'    => 1,                   //1 for yes, 0 for no
                                'show_description'      => 1,                   //1 for yes, 0 for no
                                'show_image'            => 0,                   //1 for yes, 0 for no
                            ); 
    }

    /**
     * Init Shortcode.
     *
     * This inits the shortcode
     *
     * @since 0.1.0
     *
     * @param array 	$atts           Shortcode attributes.
     * @param string 	$content        Shortcode post content.
     */
    public function plc_shortcode_init($atts, $content = null) { 
        global $wp_query;
        //INSTANCES
        $plc                = new PageListingCategories();
        $plc->shortcode     = new ShortcodeListCategories();
        //DO SHORTCODE
        $plc->shortcode->set_shortcode($atts, $content, $plc->templates, $wp_query);
        return $plc->shortcode->get_shortcode();           
    }
    /**
     * Init Widget.
     *
     * This inits the widget
     *
     * @since 0.1.1
     */
    public function plc_widget_init (){
        //INSTANCES
        $plc                = new PageListingCategories();
        $plc->widget        = new WidgetListCategories();
        //DO WIDGET 
        register_widget( 'WidgetListCategories' );
    }

    /**
     * Add plugin query vars.
     * 
     * Adds plugin's query vars. 
     *
     * @since 0.1.0
     * 
     * @param array $qvars Query Variables
     * 
     * @return array $qvars Query Variables
     *
     */
    function add_plugin_query_vars($qvars) {
        $qvars[] = 'cid';
        return $qvars;
    }

    /**
     * Add Scripts 
     * 
     * Adds all the scripts and stylesheets used by the plugin 
     *
     * @since 0.1.0
     */
    public function add_plugin_scripts_and_styles() {
        //REGISTER AND ENQUEUE STYLES
        wp_register_style('page-listing-categories-shortcode', plugins_url('/assets/css/page-listing-categories-shortcode.css', __FILE__));
        wp_enqueue_style('page-listing-categories-shortcode');
        wp_register_style('page-listing-categories-widget', plugins_url('/assets/css/page-listing-categories-widget.css', __FILE__));
        wp_enqueue_style('page-listing-categories-widget');
		
		//ADD FONT AWESOME - CAN BE IMPROVED CHEKING IF ALREADY EXISTS.
		wp_register_style('page-listing-categories-font-awesome', plugins_url('/assets/fonts/font-awesome/css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('page-listing-categories-font-awesome');
        
        //REGISTER AND ENQUEUE SCRIPTS
        wp_register_script( 'page-listing-categories-acordion-script', plugins_url( '/assets/js/accordion.js', __FILE__ ) );
        wp_enqueue_script( 'page-listing-categories-acordion-script' );
    }
}

add_shortcode('categories', array('PageListingCategories', 'plc_shortcode_init'));
add_action('wp_enqueue_scripts', array('PageListingCategories', 'add_plugin_scripts_and_styles'));
add_filter('query_vars', array('PageListingCategories', 'add_plugin_query_vars'));
add_action( 'widgets_init', array('PageListingCategories', 'plc_widget_init'));	


