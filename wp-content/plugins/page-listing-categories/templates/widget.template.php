<?php
/**
 * PAGE LISTING CATEGORIES - WIDGET HTML TEMPLATE
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

?>
<div class="wp-plc-list-categories-widget">

    <ul id="wp-plc-list-categories-widget" class="product-categories">
        <?php
        foreach ($view_data['categories'] as $cat):
            if ($cat->category_parent == 0) {
                //Get category info
                $category_id = $cat->term_id;
                $category_name = $cat->name;
                $category_term_link = get_term_link($cat->slug, 'product_cat');
                ?>
                <li class="cat-item cat-parent">
                    <a href="<?= $category_term_link ?>" class="plc-mark">
                        <span class="cat-name"><?= $category_name ?></span>
                    </a>
                    <?php 
                        echo($view_data['args']['show_subcategories'] == 1) ? '<ul class="children">' :'';
                        $view_data['args']['parent'] = $category_id;
                        $subcategories = get_categories($view_data['args']);
                        if ($subcategories && $view_data['args']['show_subcategories'] == 1) {
                            foreach ($subcategories as $subcategory):
                                $subcategory_id = $subcategory->term_id;
                                $subcategory_name = $subcategory->name;
                                $subcategory_term_link = get_term_link($subcategory->slug, 'product_cat');
                                ?>

                                <li>
                                    <a href="<?= $subcategory_term_link ?>" class="plc-mark">
                                        <span class="cat-name"><?= $subcategory_name ?></span>
                                    </a>
                                </li>

                                <?php
                            endforeach;
                        }
                        echo($view_data['args']['show_subcategories'] == 1) ? '</ul>' :'';
                    ?>
                </li>
            <?php } endforeach; ?>
    </ul>

</div>
<script>
    jQuery(document).ready(function () {

        //Accordion Nav
        jQuery('.wp-plc-list-categories-widget').navAccordion({
            expandButtonText: '<i class="fa fa-plus"></i>', //Text inside of buttons can be HTML
            collapseButtonText: '<i class="fa fa-minus"></i>'
        },
                function () {
                    console.log('Callback')
                });

    });
</script>