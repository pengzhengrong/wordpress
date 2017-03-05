<?php
/**
 * PAGE LISTING CATEGORIES - CATEGORIES HTML TEMPLATE
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

?>
<div class="page-listing-categories">
    <div class="plc-items-container">
    <?php
    foreach ($view_data['categories'] as $cat):
        if ($cat->category_parent == 0) {
            //Get category info
            $category_id = $cat->term_id;
            $category_name = $cat->name;
            $category_description = $cat->description;
            $category_image = wp_get_attachment_thumb_url(get_woocommerce_term_meta($category_id, 'thumbnail_id', true));
            $category_term_link = get_term_link($cat->slug, 'product_cat');
    ?>
    <!-- Categories Loop -->
          
        <div class="plc-category">
            <a href=<?php echo($view_data['args']['show_subcategories'] == 1) ? "?cid=$category_id" : "$category_term_link";?>>
                <div class="plc-header">
                    <div class="plc-image">
                        <img alt="<?= $category_name ?>-image" src="<?= $category_image ?>"/>
                    </div>
                    <div class="plc-title">
                        <h2><?= $category_name ?></h2>
                    </div>
                </div>
                <div class="plc-desc">
                    <p><?= $category_description ?></p>
                </div>
            </a>
        </div>
    <!-- Categories Loop End -->
    <?php } endforeach; ?>
    </div>
    <div style="clear:both;"></div>
</div>