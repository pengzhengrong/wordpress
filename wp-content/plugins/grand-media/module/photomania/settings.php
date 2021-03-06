<?php
$default_options = array(
    'base_gallery_width'      => '800',
    'base_gallery_height'     => '500',
    'gallery_min_height'      => '230',
    'scale_mode'              => 'fit',
    'initial_slide'           => '0',
    'slideshow_autoplay'      => '0',
    'slideshow_delay'         => '7000',
    'gallery_focus'           => '0',
    'gallery_maximized'       => '0',
    'gallery_focus_maximized' => '0',
    'keyboard_help'           => '1',
    'show_comments'           => '1',
    'show_download_button'    => '1',
    'show_link_button'        => '1',
    'link_button_target'      => '_self',
    'show_description'        => '1',
    'show_author_avatar'      => '1',
    'show_share_button'       => '1',
    'show_like_button'        => '1',
    'link_color'              => '0099e5',
    'link_color_hover'        => '02adea',
    'download_button_text'    => 'Download',
    'link_button_text'        => 'Open Link',
    'comments_button_text'    => 'Discuss',
    'description_title'       => 'Description',
    'customCSS'               => ''
);
$options_tree    = array(
    array(
        'label'  => 'Common Settings',
        'fields' => array(
            'base_gallery_width'   => array(
                'label' => 'Base Width',
                'tag'   => 'input',
                'attr'  => 'type="number" min="1"',
                'text'  => ''
            ),
            'base_gallery_height'  => array(
                'label' => 'Base Height',
                'tag'   => 'input',
                'attr'  => 'type="number" min="1"',
                'text'  => 'Slider will autocalculate the ratio based on these values'
            ),
            'gallery_min_height'   => array(
                'label' => 'Minimal Height',
                'tag'   => 'input',
                'attr'  => 'type="number" min="230"',
                'text'  => ''
            ),
            'gallery_maximized'    => array(
                'label' => 'Auto Height for Each Slide',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => 'Change slider height on change slide to best fit image in it'
            ),
            'scale_mode'           => array(
                'label'   => 'Image Scale Mode',
                'tag'     => 'select',
                'attr'    => '',
                'text'    => 'Default value: Fit. Note \'Fill\' - can work inproperly on IE browser',
                'choices' => array(
                    array(
                        'label' => 'Fit',
                        'value' => 'fit'
                    ),
                    array(
                        'label' => 'Fill',
                        'value' => 'fill'
                    )
                )
            ),
            'initial_slide'        => array(
                'label' => 'Initial Slide',
                'tag'   => 'input',
                'attr'  => 'type="number" min="0"',
                'text'  => ''
            ),
            'slideshow_autoplay'   => array(
                'label' => 'Autoplay On Load',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => 'Start slideshow automatically on gallery load'
            ),
            'slideshow_delay'      => array(
                'label' => 'Slideshow Delay',
                'tag'   => 'input',
                'attr'  => 'type="number" min="1000"',
                'text'  => 'Delay between change slides in miliseconds'
            ),
            'show_download_button' => array(
                'label' => 'Show Download Button',
                'tag'   => 'checkbox',
                'attr'  => 'data-watch="change"',
                'text'  => 'Download original file or if custom field with name "download" specified for the item then its value will be used.'
            ),
            'show_link_button'     => array(
                'label' => 'Show Link Button',
                'tag'   => 'checkbox',
                'attr'  => 'data-watch="change"',
                'text'  => 'Uses link field from the item'
            ),
            'link_button_target'   => array(
                'label' => 'Link Button Target',
                'tag'   => 'input',
                'attr'  => 'type="text" placeholder="_self" data-show_link_button="is:1"',
                'text'  => '"_self" to open links in same window; "_blank" to open in new tab.'
            ),
            'show_comments'     => array(
                'label' => 'Show Comments',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'show_description'     => array(
                'label' => 'Show Slide Description',
                'tag'   => 'checkbox',
                'attr'  => 'data-watch="change"',
                'text'  => ''
            ),
            'show_author_avatar'   => array(
                'label' => 'Show Author Avatar',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'show_share_button'    => array(
                'label' => 'Show Share Button',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'show_like_button'     => array(
                'label' => 'Show Like Button',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            )
        )
    ),
    array(
        'label'  => 'Colors',
        'fields' => array(
            'link_color'            => array(
                'label' => 'Links and Buttons Color',
                'tag'   => 'input',
                'attr'  => 'type="text" data-type="color"',
                'text'  => ''
            ),
            'link_color_hover'      => array(
                'label' => 'Links and Buttons Color on Hover',
                'tag'   => 'input',
                'attr'  => 'type="text" data-type="color"',
                'text'  => ''
            )
        )
    ),
    array(
        'label'  => 'Translate Strings',
        'fields' => array(
            'download_button_text' => array(
                'label' => 'Download Button Name',
                'tag'   => 'input',
                'attr'  => 'type="text"',
                'text'  => ''
            ),
            'link_button_text'     => array(
                'label' => 'Link Button Name',
                'tag'   => 'input',
                'attr'  => 'type="text"',
                'text'  => ''
            ),
            'comments_button_text' => array(
                'label' => 'Comments Button Name',
                'tag'   => 'input',
                'attr'  => 'type="text"',
                'text'  => ''
            ),
            'description_title'    => array(
                'label' => 'Slide Description Title',
                'tag'   => 'input',
                'attr'  => 'type="text"',
                'text'  => ''
            ),
        )
    ),
    array(
        'label'  => 'Advanced Settings',
        'fields' => array(
            'gallery_focus'           => array(
                'label' => 'Full Window Mode on Start',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'gallery_focus_maximized' => array(
                'label' => 'Maximized Full Window Mode',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'keyboard_help'           => array(
                'label' => 'Show Keyboard Help',
                'tag'   => 'checkbox',
                'attr'  => '',
                'text'  => ''
            ),
            'customCSS'               => array(
                'label' => 'Custom CSS',
                'tag'   => 'textarea',
                'attr'  => 'cols="20" rows="10"',
                'text'  => 'You can enter custom style rules into this box if you\'d like. IE: <i>a{color: red !important;}</i><br />This is an advanced option! This is not recommended for users not fluent in CSS... but if you do know CSS, anything you add here will override the default styles'
            )
            /*,
            'loveLink' => array(
                'label' => 'Display LoveLink?',
                'tag' => 'checkbox',
                'attr' => '',
                'text' => 'Selecting "Yes" will show the lovelink icon (codeasily.com) somewhere on the gallery'
            )*/
        )
    )
);
