<?php
/**
 * PAGE LISTING CATEGORIES - RENDER VIEW.
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
 * Renders the view
 */
class RenderView {
    /**
     * Render the template.
     * 
     * @since 0.1.0
     * 
     * @param $file_path         Path to the template.
     * @param null $view_data   Data of the template.
     * 
     * @return string Template 
     */
    public static function render_view( $file_path, $view_data ) {
        //Is there any data?
        ($view_data) ? extract($view_data):null;
        ob_start();
        if (file_exists($file_path)) {
            include $file_path;
        } else {
            echo "no template file: $file_path";
        }
        //include ($file_path);
        $template = ob_get_contents();
        ob_end_clean();
        return $template;
    }
}
