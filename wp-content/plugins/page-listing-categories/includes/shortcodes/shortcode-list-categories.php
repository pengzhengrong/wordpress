<?php
/**
 * PAGE LISTING CATEGORIES - LIST CATEGORIES SHORTCODE
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
 * */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Controller For List Categories Shortcode
 */
class ShortcodeListCategories {
    
    private $shortcode_view;
    
    /**
     * Get everything shortcode needs
     * 
     * @since 0.1.0
     * 
     * @param array $atts       Attributes defined by the user
     * @param string $content   Shortcode Content
     * @param array $templates  Templates
     * @param array $wp_query   Subcategory ID
     */
    public function set_shortcode ($atts, $content, $templates, $wp_query) {
        
        $plc          = new PageListingCategories();
        $get_categories   = new GetCategories();
        $functions    = new PageListingCategoriesFunctions();
        
        $functions->plc_set_sc_atts($atts, $content);
        $atts = $functions->plc_get_atts();
        $functions->plc_set_view_template($templates, $wp_query, 'shortcode');
        $template = $functions->plc_get_view_template();
        $get_categories->plc_set_categories($atts, $wp_query);
        $categories = $get_categories->plc_get_categories();
        $viewData = [ 'categories' => $categories, 'args' => $atts];
        $functions->plc_set_view($viewData, $template);
        $this->shortcode_view = $functions->plc_get_view();
    }
    
    /**
     * Shortcode getter
     * 
     * @since 0.1.0
     *  
     * @return string View
     */
    public function get_shortcode(){ 
        return $this->shortcode_view;
    }   
}