<?php
/**
 * PAGE LISTING CATEGORIES - GET CATEGORIES.
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

/**
 * Gets all categories/subcategories that meet the requirements specified in the shortcode
 */
class GetCategories {
    
    private $categories;
    
    /**
     * Categories / Subcategories Setter
     *
     * @since 0.1.0
     *
     * @param   array 	$atts           Shortcode attributes.
     */
    public function plc_set_categories ($atts, $wp_query){
        if (isset($wp_query->query_vars['cid'])) {
            $args = array(
                'taxonomy'              => $atts['taxonomy'],
                'child_of'              => 0,
                'parent'                => $wp_query->query_vars['cid'],
                'orderby'               => $atts['orderby'],
                'order'                 => $atts['order'],
                'show_count'            => $atts['show_count'],
                'pad_counts'            => $atts['pad_counts'],
                'hierarchical'          => $atts['hierarchical'],
                'title_li'              => $atts['title_li'],
                'hide_empty'            => $atts['hide_empty'],
                'show_subcategories'    => $atts['show_subcategories'],
                'exclude'               => $atts['exclude']
            );
        } else {
            $args = array(
                'taxonomy'              => $atts['taxonomy'],
                'orderby'               => $atts['orderby'],
                'order'                 => $atts['order'],
                'show_count'            => $atts['show_count'],
                'pad_counts'            => $atts['pad_counts'],
                'hierarchical'          => $atts['hierarchical'],
                'title_li'              => $atts['title_li'],
                'hide_empty'            => $atts['hide_empty'],
                'show_subcategories'    => $atts['show_subcategories'],
                'exclude'               => $atts['exclude'],
            );
        }
        $this->categories = get_categories($args);
    }
    
    /**
     * Categories / Subcategories Getter.
     *
     * @since 0.1.0
     *
     * @return  array   $categories     Desired categories
     */
    public function plc_get_categories() {   
        return $this->categories;
    }
}
