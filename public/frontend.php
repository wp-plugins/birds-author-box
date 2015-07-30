<?php
/**
 * Display the Author Box on frontend
 *
 * @package    Birds_Authorbox
 * @subpackage birds-author-box/public
 * @since      1.0.0
 */

function birds_get_related_author_posts()
{

    // Retrieve Options variables

    global $wpdb;
    global $authordata, $post;
    $yesnolast = get_setting_bab( 'bab_general_section', 'bab_latest_posts' );
    $lp_amount = get_setting_bab( 'bab_general_section', 'bab_lp_amount' );
    $authors_posts = get_posts(array(
        'author' => $authordata->ID,
        'post__not_in' => array(
            $post->ID
        ) ,
        'posts_per_page' => $lp_amount,
        'orderby' => 'post_date',
        'order' => 'DESC'
    ));
    if ($yesnolast == 'yes')
    {
        $output = '<p>';
        foreach($authors_posts as $authors_post)
        {
            $output.= '<a class="box_links_2" href="' . get_permalink($authors_post->ID) . '">' . apply_filters('the_title', $authors_post->post_title, $authors_post->ID) . '</a><br />';
        }

        $output.= '<br /><a class="box_links" href="' . get_author_posts_url(get_the_author_meta("ID")) . '">' . __("See all this author's posts", "birds-authorbox") . '</a></p>';
    }
    else
    {
        $output = '';
    }

    return $output;
}

add_filter('the_content', 'birds_authorbox_add_post_content', 0);
function birds_authorbox_add_post_content($content)
{

    // Retrieve Options variables

    global $wpdb;
    $socialtab = get_setting_bab( 'bab_general_section', 'bab_social_tab' );
    $yesnolast = get_setting_bab( 'bab_general_section', 'bab_latest_posts' );
    $posts_checkbox = get_setting_bab( 'bab_general_section', 'bab_show_posts' );
    $pages_checkbox = get_setting_bab( 'bab_general_section', 'bab_show_pages' );
    $avatarcss = get_setting_bab( 'bab_general_section', 'bab_avatar_style' );
    $yesnowebsite = get_setting_bab( 'bab_general_section', 'bab_author_website' );
    $iconsset = get_setting_bab( 'bab_icons_section', 'bab_icons_set' );

    // Custom CSS
    $bab_custom_css = get_setting_bab( 'bab_custom_css_section', 'bab_custom_css' );
    $bab_custom_css_sanitized = esc_textarea($bab_custom_css);

    if ($iconsset == 'circle')
    {
        $iconpath = plugin_dir_url(__FILE__) . 'icons/circle/';
    }

    if ($iconsset == 'line')
    {
        $iconpath = plugin_dir_url(__FILE__) . 'icons/line/';
    }

    if ($iconsset == 'volumetric')
    {
        $iconpath = plugin_dir_url(__FILE__) . 'icons/volumetric/';
    }

    if ($iconsset == 'flat')
    {
        $iconpath = plugin_dir_url(__FILE__) . 'icons/flat/';
    }

    if ($iconsset == 'subtle')
    {
        $iconpath = plugin_dir_url(__FILE__) . 'icons/subtle/';
    }

    $bodyclasses = get_body_class();
    $custpt = array(
        'birds_portfolio',
    );
    if ((!is_singular($custpt) && !in_array('woocommerce-page', $bodyclasses)))
    { // If the page is not a WooCommerce one, let's do the trick!
        if ((is_single() && ($posts_checkbox == 'yes')) || (is_page() && ($pages_checkbox == 'yes') && !is_home() && !is_front_page()))
        {
            //remove_filter('the_content', 'wpautop');
            if ($bab_custom_css != '')
            {
                echo '<style>' . $bab_custom_css_sanitized . '</style>';
            }
            if ($avatarcss == 'round')
            {
                $content.= '<style>img.birds_box_avatar {padding: 5px;background-color: #fff;border: 1px solid #ddd;-webkit-border-radius: 70px;-moz-border-radius: 70px;border-radius: 70px;}</style>';
            }
            else
            {
                $content.= '<style>img.birds_box_avatar {padding: 5px;background-color: #fff;border: 1px solid #ddd;}</style>';
            }

            $content.= '
                <div class="author_box_tabs">
                    <nav>
                        <ul class="author_box_tabs_navigation">
            ';
            $content.= '
                            <li id="bio"><a data-content="bio" class="selected icon-ab-graduation-cap" href="#0">&nbsp;&nbsp;' . __("Bio", "birds-authorbox") . '</a></li>
            ';
            if ($socialtab == 'yes')
            {
                $content.= '
                            <li id="social"><a data-content="social" class="icon-ab-globe" href="#0">&nbsp;&nbsp;' . __("Social", "birds-authorbox") . '</a></li>
            ';
            }
            if ($yesnolast == 'yes')
            {
                $content.= '
                                <li id="lposts"><a data-content="lposts" class="icon-ab-paper-plane" href="#0">&nbsp;&nbsp;' . __("Latest Posts", "birds-authorbox") . '</a></li>
                ';
            }

            $content.= '
                        </ul> <!-- author_box_tabs_navigation -->
                    </nav>

                    <ul class="author_box_tabs_content">
                        <li data-content="bio" class="selected">
            ';
            if (get_the_author_meta('image', get_query_var('author')))
            {
                $content.= '<img class="birds_box_avatar" src="' . get_the_author_meta('image', get_query_var('author')) . '">';
            }
            else
            {
                $blank = plugin_dir_url(__FILE__) . 'img/blank.png';
                $content.= '<img class="birds_box_avatar" src="' . $blank . '">';
            }

            $content.= '
                            <p><span class="by_text">' . __("By:", "birds-authorbox") . '</span> <span class="h4_text">';
            $content.= get_the_author_meta('display_name', get_query_var('author'));
            $content.= '</span></p>';
            if (get_the_author_meta('description', get_query_var('author')))
            {
                $content.= '<p>' . get_the_author_meta('description', get_query_var('author')) . '
                </p>';
            }
            else
            {
                $content.= '<p>' . __('No biography available at this time', 'birds-authorbox') . '<br /><br /><br /></p>';
            }

            $content.= '
                        </li>
            ';
            $content.= '
                        <li data-content="social">
            ';
            if (get_the_author_meta('image', get_query_var('author')))
            {
                $content.= '<img class="birds_box_avatar" src="' . get_the_author_meta('image', get_query_var('author')) . '">';
            }
            else
            {
                $blank = plugin_dir_url(__FILE__) . 'img/blank.png';
                $content.= '<img class="birds_box_avatar" src="' . $blank . '">';
            }

            if ((get_the_author_meta('user_url', get_query_var('author'))) && $yesnowebsite == 'yes')
            {
                $content.= '<p><a class="box_links" href="' . get_the_author_meta('user_url') . '" target="_blank">' . __("Visit the author's website", "birds-authorbox") . '</a><br /><br />';
            }
            else
            {
                $content.= '<p><br /> ';
            }

            if (get_the_author_meta('twitter_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('twitter_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'twitter.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('facebook_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('facebook_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'facebook.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('google_plus_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('google_plus_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'googleplus.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('linkedin_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('linkedin_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'linkedin.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('flickr_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('flickr_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'flickr.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('youtube_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('youtube_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'youtube.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('instagram_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('instagram_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'instagram.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('pinterest_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('pinterest_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'pinterest.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('github_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('github_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'github.png';
                $content.= '"></a> ';
            }

            if (get_the_author_meta('dribbble_birds', get_query_var('author')))
            {
                $content.= '<a class="social_icon" href="' . esc_url(get_the_author_meta('dribbble_birds')) . '" target="_blank"><img src="';
                $content.= $iconpath . 'dribbble.png';
                $content.= '"></a></p> ';
            }

            if ($yesnolast == 'yes')
            {
                $content.= '
                        <li data-content="lposts">
            ';
                if (get_the_author_meta('image', get_query_var('author')))
                {
                    $content.= '<img class="birds_box_avatar" src="' . get_the_author_meta('image', get_query_var('author')) . '">';
                }
                else
                {
                    $blank = plugin_dir_url(__FILE__) . 'img/blank.png';
                    $content.= '<img class="birds_box_avatar" src="' . $blank . '">';
                }

                $content.= birds_get_related_author_posts();
            }

            $content.= '
                    </ul> <!-- author_box_tabs_content -->
                </div> <!-- author_box_tabs -->
            ';
        }
    } // Endif WooCommerce Page
    return $content;
}

