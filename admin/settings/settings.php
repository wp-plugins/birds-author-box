<?php
/**
* Settings page
*
* @package    Birds_Authorbox
* @subpackage birds-author-box/admin/settings
* @since      1.0.0
*/

$text_domain = 'birds-authorbox';
$icon = plugins_url() . '/birds-author-box/admin/images/birds.png' ;
$icons_circle = '<img src="' . plugins_url() . '/birds-author-box/public/icons/circle/icons.png">' ;
$icons_line = '<img src="' . plugins_url() . '/birds-author-box/public/icons/line/icons.png">' ;
$icons_volumetric = '<img src="' . plugins_url() . '/birds-author-box/public/icons/volumetric/icons.png">' ;
$icons_flat = '<img src="' . plugins_url() . '/birds-author-box/public/icons/flat/icons.png">' ;
$icons_subtle = '<img src="' . plugins_url() . '/birds-author-box/public/icons/subtle/icons.png">' ;

// Top level page & First Section
$birds_author_box_top_page = create_settings_page_bab(
    'birds_author_box_settings',
    '<img src="'.$icon.'"> '.__('Author Box Settings', $text_domain),
    array(
            'parent' => 'users.php',
            'title' => __('Birds Author Box', $text_domain),
            'icon_url' => 'dashicons-businessman',
            'position' => '63.1'
        ),
    array(
            'bab_general_section' => array(
                'title' => __('General', $text_domain),
                'description' => '',
                'fields' => array(
                    'bab_show_posts' => array(
                        'type'    => 'select',
                        'label'   => __( 'Show in posts', $text_domain ),
                        'description' => __('Do you want to insert the Author Box after the content in Posts?', $text_domain),
                        'options' => array(
                            'yes'   => __( 'Yes', $text_domain ),
                            'no'   => __( 'No', $text_domain )
                        ),
                        'default' => 'yes'
                    ),
                    'bab_show_pages' => array(
                        'type'    => 'select',
                        'label'   => __( 'Show in pages', $text_domain ),
                        'description' => __('Do you want to insert the Author Box after the content in Pages?', $text_domain),
                        'options' => array(
                            'yes'   => __( 'Yes', $text_domain ),
                            'no'   => __( 'No', $text_domain )
                        ),
                        'default' => 'yes'
                    ),
                    'bab_avatar_style' => array(
                        'type'    => 'select',
                        'label'   => __( 'Profile Picture style', $text_domain ),
                        'description' => __('Choose the avatar style', $text_domain),
                        'options' => array(
                            'round'   => __( 'Round', $text_domain ),
                            'square'   => __( 'Square', $text_domain )
                        ),
                        'default' => 'round'
                    ),
                    'bab_social_tab' => array(
                        'type'    => 'select',
                        'label'   => __( 'Social Medias', $text_domain ),
                        'description' => __('Do you want to display the authors\' social medias tab?', $text_domain),
                        'options' => array(
                            'yes'   => __( 'Yes', $text_domain ),
                            'no'   => __( 'No', $text_domain )
                        ),
                        'default' => 'yes'
                    ),
                    'bab_author_website' => array(
                        'type'    => 'select',
                        'label'   => __( 'Show Author website', $text_domain ),
                        'description' => __('Do you want to display the authors\' website?', $text_domain),
                        'options' => array(
                            'yes'   => __( 'Yes', $text_domain ),
                            'no'   => __( 'No', $text_domain )
                        ),
                        'default' => 'yes'
                    ),
                    'bab_latest_posts' => array(
                        'type'    => 'select',
                        'label'   => __( 'Latest Posts', $text_domain ),
                        'description' => __('Do you want to display the authors\' most recent posts tab?', $text_domain),
                        'options' => array(
                            'yes'   => __( 'Yes', $text_domain ),
                            'no'   => __( 'No', $text_domain )
                        ),
                        'default' => 'yes'
                    ),
                    'bab_lp_amount' => array(
                        'type'  => 'number',
                        'label' => __( 'Amount', $text_domain ),
                        'description' => __('How many Latest Posts do you want to show?', $text_domain),
                        'attributes' => array( 'placeholder' => '5' ),
                        'default' => '5'
                    ),
                )
            )
    ),
    array(
            'tabs' => true,
            'submit' => __('Save Settings', $text_domain),
            'reset' => __('Reset', $text_domain),
        'description' => '',
            'updated' => __('Settings saved!', $text_domain)
    )
);

// Icons Sets, Colors & Help
$birds_author_box_top_page->apply_settings( array(
    'bab_colors_section' => array(
        'title'  => __( 'Colors', $text_domain ),
        'fields' => array(
            'bab_bg_color'  => array(
                'type'  => 'color',
                'label' => __( 'Active Tab Background Color', $text_domain ),
                'description' => __( 'Default color is: #f8f8f8', $text_domain ),
                'default' => '#f8f8f8'
            ),
            'bab_link_color'  => array(
                'type'  => 'color',
                'label' => __( 'Links Color', $text_domain ),
                'description' => __( 'Default color is: #757575', $text_domain ),
                'default' => '#757575'
            ),
            'bab_text_color'  => array(
                'type'  => 'color',
                'label' => __( 'Text Color', $text_domain ),
                'description' => __( 'Default color is: #757575', $text_domain ),
                'default' => '#757575'
            ),
            'bab_author_name_color'  => array(
                'type'  => 'color',
                'label' => __( 'Author Name Color', $text_domain ),
                'description' => __( 'Default color is: #666666', $text_domain ),
                'default' => '#666666'
            ),
        )
    ),
    'bab_icons_section' => array(
        'title'  => __( 'Icons Sets', $text_domain ),
        'fields' => array(
            'bab_icons_set' => array(
                'type'    => 'select',
                'label'   => __( 'Icons set', $text_domain ),
                'description' => __('Choose the icons style', $text_domain).'<br><br>Circle<br>'.$icons_circle.'<br>Line<br>'.$icons_line.'<br>Volumetric<br>'.$icons_volumetric.'<br>Flat<br>'.$icons_flat.'<br>Subtle<br>'.$icons_subtle,
                'options' => array(
                    'circle'   => 'Circle',
                    'line'   => 'Line',
                    'volumetric'   => 'Volumetric',
                    'flat'   => 'Flat',
                    'subtle'   => 'Subtle'
                ),
                'default' => 'circle'
            ),
        )
    ),
    'bab_custom_css_section' => array(
        'title'  => __( 'Custom CSS', $text_domain ),
        'fields' => array(
            'bab_custom_css'  => array(
                'type'  => 'textarea',
                'label'   => __( 'Custom CSS', $text_domain ),
                'description' => __( 'If you want to add some extra CSS to the author box, you can do it here', $text_domain ),
                'attributes' => array( 'style' => 'max-width: 50%;min-height: 200px;padding:10px;font-size: 0.9em;' ),
            ),
        )
    ),
    'bab_help_section' => array(
        'title'  => __( 'Some instructions', $text_domain ),
        'fields' => array(
            'bab_help_1' => array(
                'type'    => 'preview',
                'label'   => '',
                'description' => __( 'Every Author Profile has to be updated for the Author Box to be displayed elegantly...', $text_domain )
            ),
            'bab_help_2' => array(
                'type'    => 'preview',
                'label'   => __( 'Edit your Profile', $text_domain ),
                'description' => __( 'To edit your profile details, simply click on your user name, when viewing the list of Users or click on the <strong>Edit</strong> link that appears beneath your user name when hovering your cursor over each row. Alternatively, click on the <strong>Your Profile</strong> link in the left-hand navigation.', $text_domain )
                .'<br><br>'.
                __( 'Update the various fields for your profile. The <strong>Username</strong> field can\'t be changed.', $text_domain )
                .'<br><br>'.
                __( 'Choose the way you want your name to be publicly displayed with the <strong>Display name publicly</strong> as dropdown.', $text_domain )
                .'<br><br>'.
                __( 'Fill in the different fields concerning your social media network.', $text_domain )
                .'<br><br>'.
                __( 'Say a little something about you in the <strong>Biographical Info</strong>.', $text_domain )
                .'<br><br>'.
                __( 'Don\'t forget to upload a picture of you in the <strong>Avatar</strong> section.', $text_domain )
                .'<br><br>'.
                __( 'After updating your profile, click the <strong>Update Profile</strong> button to save your changes.', $text_domain )
            ),
            'bab_help_3' => array(
                'type'    => 'preview',
                'label'   => __( 'Team', $text_domain ),
                'description' => __( 'If you\'re an Administrator, you\'ll have to repeat the operations described above for every author.', $text_domain )
            ),
        )
    )
) );
