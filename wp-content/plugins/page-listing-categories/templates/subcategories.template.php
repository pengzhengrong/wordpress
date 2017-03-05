<?php
/**
 * PAGE LISTING CATEGORIES PLUGIN - SUBCATEGORIES HTML TEMPLATE
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
    <div class="plc-subcategories-header">            
        <div class="plc-subcategories-header-title">
            <h2><?=get_term($view_data[0]->category_parent)->name;?></h2>
            <!--<hr>-->
        </div>
        <div class="plc-subcategories-header-back">
            <a class="plc-button plc-hover" href=".">Volver</a>
        </div>
    </div>
    <div class="plc-items-container">
    <?php
        if ($view_data['categories']) {
            foreach ($view_data['categories'] as $subcategory):
                $category_id = $subcategory->term_id;
                $subcategory_name = $subcategory->name;
                $subcategory_description = $subcategory->description;
                $subcategory_image = wp_get_attachment_thumb_url(get_woocommerce_term_meta($category_id, 'thumbnail_id', true));
                $subcategory_term_link = get_term_link($subcategory->slug, 'product_cat');
    ?>
    <!-- Categories Loop -->
     
        <div class="plc-category">
            <a href="<?= $subcategory_term_link ?>">
                <div class="plc-header">
                    <div class="plc-image">
                        <img alt="<?= $subcategory_name ?>-image" src="<?= $subcategory_image ?>"/>
                    </div>
                    <div class="plc-title">
                        <h3><?= $subcategory_name ?><h3>
                    </div>
                </div>
                <div class="plc-desc">
                    <p><?= $subcategory_description ?></p>
                </div>
            </a>
        </div>
    
    <!-- Categories Loop End -->
    <?php endforeach; } ?>
    </div>
    <div style="clear:both;"></div>
</div>