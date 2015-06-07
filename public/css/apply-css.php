<?php
/**
* Author Box Users Custom CSS
*
* @package    Birds_Authorbox
* @subpackage birds-author-box/public/css
* @since      1.0.4
*/

add_action( 'wp_enqueue_scripts', 'birds_author_box_custom_css' );
function birds_author_box_custom_css() {

    // Variables
    $bab_bg_color = get_setting_bab('bab_colors_section', 'bab_bg_color');
    $bab_link_color = get_setting_bab('bab_colors_section', 'bab_link_color');
    $bab_text_color = get_setting_bab('bab_colors_section', 'bab_text_color');
    $bab_author_name_color = get_setting_bab('bab_colors_section', 'bab_author_name_color');
    if ( $bab_author_name_color == '#666666') {
        echo '
            <style type="text/css">
                span.h4_text {
                    color: '.$bab_author_name_color.';
                }
                span.by_text {
                    color: #aaaaaa;
                }
            </style>
        ';
    } else {
        echo '
            <style type="text/css">
                span.h4_text, span.by_text {
                    color: '.$bab_author_name_color.';
                }
            </style>
        ';
    }
    echo '
        <style type="text/css">
            .author_box_tabs_navigation a.selected {
                border-bottom: 1px solid '.$bab_bg_color.' !important;
                background-color: '.$bab_bg_color.' !important;
            }
            .author_box_tabs_content {
                background: '.$bab_bg_color.';
            }
            .author_box_tabs_navigation a.selected, a.box_links, a.box_links:visited, a.box_links:active, a.box_links:link, a.box_links_2, a.box_links_2:hover, a.box_links_2:visited, a.box_links_2:active, a.box_links_2:link {
                color: '.$bab_link_color.' !important;
            }
            .author_box_tabs_content li p, .birds_box_text p {
                color: '.$bab_text_color.';
            }
            .no-touch .author_box_tabs_navigation a:hover, a.box_links:hover {
                color: #757575;
            }

        </style>
    ';
}
