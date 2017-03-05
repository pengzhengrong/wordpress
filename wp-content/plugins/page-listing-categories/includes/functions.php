<?php
/**
 * PAGE LISTING CATEGORIES - MAIN FUNCTIONS.
 * @author Infolab Software I Serveis S.L.U <internet@infolab.es>
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
**/

defined('ABSPATH') or die('No script kiddies please!');

class PageListingCategoriesFunctions {
    
    private $atts;
    private $view;
    private $template;
    
    /**
     * Set the shortcode arguments 
     * 
     * @since 0.1.0
     *
     * @param array 	$atts           Shortcode attributes.
     * @param string 	$content        Shortcode post content.
     */
    public function plc_set_sc_atts($atts, $content = null){
        $this->atts = shortcode_atts(
            array(
                'taxonomy'              => 'product_cat',
                'orderby'               => 'name',
                'order'                 => 'ASC',
                'exclude'               => '',
                'show_count'            => 0, //1 for yes, 0 for no
                'pad_counts'            => 0, //1 for yes, 0 for no
                'hierarchical'          => 1, //1 for yes, 0 for no
                'title_li'              => '',
                'hide_empty'            => 0, //1 for yes, 0 for no
                'show_subcategories'    => 1, //1 for yes, 0 for no
                'show_description'      => 1, //1 for yes, 0 for no
                'show_image'            => 0, //1 for yes, 0 for no
            ), $atts
        );        
    }
    
    /**
     * Set the widget attributes
     * 
     * @since 0.1.1
     *
     * @param array $instance   Attributes selected by the user in the Widget.
     */
    public function plc_set_widget_atts($instance){
        $this->atts = array(
                        'taxonomy' => 'product_cat',
                        'orderby' => $instance['orderby'],
                        'order' => $instance['order'],
                        'show_count' => 0, //1 for yes, 0 for no
                        'pad_counts' => 0, //1 for yes, 0 for no
                        'hierarchical' => 1, //1 for yes, 0 for no
                        'title_li' => '',
                        'hide_empty' => $instance['hide_empty'], //1 for yes, 0 for no
                        'show_subcategories' => $instance['show_subcategories'], //1 for yes, 0 for no
                        'show_description' => 1, //1 for yes, 0 for no
                        'show_image' => 0, //1 for yes, 0 for no
                        'exclude' => $instance['exclude_categories']
                    );
    }
    
    /**
     * Atts Getter 
     * 
     * @since 0.1.0
     *
     * @return array Attributes used for getting categories
     */
    public function plc_get_atts(){
        return $this->atts;
    }
   
    /**
     * View Template Setter 
     * 
     * @since 0.1.0
     *
     * @param array $templates Available plugin templates
     * @param array $wp_query Parent category ID
     * @param string $template_for Applicant of the template
     */
    public function plc_set_view_template($templates, $wp_query, $template_for){
        if ($template_for == 'widget'){
            $this->template = $templates['widget'];
        } 
        if ($template_for == 'widgetadmin'){
            $this->template = $templates['widgetadmin'];
        }
        if ($template_for == 'shortcode') {
            if (isset($wp_query->query_vars['cid'])) {
                $this->template = $templates['subcategories'];
            } else {
                $this->template = $templates['categories'];
            }
        }    
    }
    
    /**
     * View Template Getter 
     * 
     * @since 0.1.0
     *
     * @return string Template
     */
    public function plc_get_view_template(){
        return $this->template;
    }
    
    /**
     * Set the view 
     * 
     * @since 0.1.0
     * 
     * @param Array $view_data   Data to print
     * @param String $template  Template  relative path
     */
    public function plc_set_view($view_data,$template){
        if (class_exists('RenderView')) {
            // Get the full path to the template file.
            $template_path = ABSPATH . 'wp-content/plugins/page-listing-categories/' . $template;
            // Return the rendered HTML
            $this->view = RenderView::render_view($template_path, $view_data);
        } else {
             $this->view = "You are trying to render a template, but we can't find the View Class";
        }
    }
    
    /**
     * View Getter 
     * 
     * @since 0.1.0
     *
     * @return string View
     */
    public function plc_get_view(){
        return $this->view;
    }
}
