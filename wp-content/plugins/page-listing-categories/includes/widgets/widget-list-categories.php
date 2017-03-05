<?php
/**
 * PAGE LISTING CATEGORIES - LIST CATEGORIES WIDGET
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
 * Controller for list Categories Widget
 */
class WidgetListCategories extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'WP_PLC', // Base ID
                __('Page listing Categories', 'wp_plc'), // Name
                array('description' => __('Provides the ability to list categories on any post or page, includes support for custom taxonomies', 'wp_plc'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     * 
     * @since 0.1.1
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        $plc = new PageListingCategories();
        $getCategories = new GetCategories();
        $functions = new PageListingCategoriesFunctions();
        $functions->plc_set_widget_atts($instance);
        $atts = $functions->plc_get_atts();
        $getCategories->plc_set_categories($atts, null);
        $categories = $getCategories->plc_get_categories();
        $functions->plc_set_view_template($plc->templates, null, 'widget');
        $template = $functions->plc_get_view_template();
        $view_data = [ 'categories' => $categories, 'args' => $atts];
        $functions->plc_set_view($view_data, $template);
        $view = $functions->plc_get_view();
        echo ($view);
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     * 
     * @since 0.1.1
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     * 
     * @return string The View
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Categories', 'wp_plc');
        }
        if (isset($instance['exclude_categories'])) {
            $exclude_categories = $instance['exclude_categories'];
        } else {
            $exclude_categories = "";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by: '); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                <option <?php echo ($instance['orderby'] == 'id') ? 'selected' : ''; ?>  value="id">id</option>
                <option <?php echo ($instance['orderby'] == 'name') ? 'selected' : ''; ?> value="name">name</option>
                <option <?php echo ($instance['orderby'] == 'slug') ? 'selected' : ''; ?> value="slug">slug</option>
                <option <?php echo ($instance['orderby'] == 'count') ? 'selected' : ''; ?> value="count">count</option>
                <option <?php echo ($instance['orderby'] == 'term_group') ? 'selected' : ''; ?> value="term_group">Term group</option>   
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order: '); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option <?php echo ($instance['order'] == 'asc') ? 'selected' : ''; ?> value="asc">Ascendent</option>
                <option <?php echo ($instance['order'] == 'desc') ? 'selected' : ''; ?> value="desc">Descendent</option>
            </select> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php _e('Hide Empty: '); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>">
                <option <?php echo ($instance['hide_empty'] == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                <option <?php echo ($instance['hide_empty'] == 0) ? 'selected' : ''; ?> value="0">No</option>
            </select> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_subcategories'); ?>"><?php _e('Show Subcategories: '); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('show_subcategories'); ?>" name="<?php echo $this->get_field_name('show_subcategories'); ?>">
                <option  <?php echo ($instance['show_subcategories'] == 1) ? 'selected' : ''; ?> value="1">Yes</option>
                <option  <?php echo ($instance['show_subcategories'] == 0) ? 'selected' : ''; ?> value="0">No</option>
            </select> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('exclude_categories'); ?>"><?php _e('IDs of the categories to exclude (comma separated):'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_categories'); ?>" name="<?php echo $this->get_field_name('exclude_categories'); ?>" type="text" value="<?php echo $exclude_categories; ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     * 
     * @since 0.1.1
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['orderby'] = (!empty($new_instance['orderby']) ) ? strip_tags($new_instance['orderby']) : '';
        $instance['order'] = (!empty($new_instance['order']) ) ? strip_tags($new_instance['order']) : '';
        $instance['hide_empty'] = (!empty($new_instance['hide_empty']) ) ? strip_tags($new_instance['hide_empty']) : '';
        $instance['show_subcategories'] = (!empty($new_instance['show_subcategories']) ) ? strip_tags($new_instance['show_subcategories']) : '';
        $instance['exclude_categories'] = (!empty($new_instance['exclude_categories']) ) ? strip_tags($new_instance['exclude_categories']) : '';
        return $instance;
    }

}
