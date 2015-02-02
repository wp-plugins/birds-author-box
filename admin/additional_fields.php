<?php
/**
 * Contact Info Fields
 *
 * @package    birds-author-box
 * @subpackage birds-author-box/admin
 * @since      1.0.0
 */

/**
 * Social Medias
 */
add_filter('user_contactmethods', 'birds_contactmethods');

function birds_contactmethods($user_contactmethods)
{
    $user_contactmethods['twitter'] = __('Twitter URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['facebook'] = __('Facebook URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['google_plus'] = __('Google+ URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['linkedin'] = __('LinkedIn URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['flickr'] = __('Flickr URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['youtube'] = __('YouTube URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['pinterest'] = __('Pinterest URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['instagram'] = __('Instagram URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['github'] = __('GitHub URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['dribbble'] = __('Dribbble URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    return $user_contactmethods;
}

/**
 * Adding Image Upload Fields
 */
add_action('show_user_profile', 'birds_show_extra_profile_fields');
add_action('edit_user_profile', 'birds_show_extra_profile_fields');

function birds_show_extra_profile_fields($user)
{
?>

<div class="author_boxes">
    <h3><?php
    _e('Avatar', 'birds-authorbox'); ?></h3>
    <table class="form-table birds-profile-upload-options">
        <tr>
            <th>
                <label for="image"><?php
    _e('Profile Image', 'birds-authorbox'); ?></label>
            </th>

            <td>
                <img class="user-preview-image" src="<?php
    echo esc_attr(get_the_author_meta('image', $user->ID)); ?>">
                <input type="text" name="image" id="image" value="<?php
    echo esc_attr(get_the_author_meta('image', $user->ID)); ?>" class="regular-text" />
                <input type='button' class="button-primary" value="<?php
    _e('Upload Image', 'birds-authorbox'); ?>" id="uploadimage"/><br />
                <p class="description">
                    <?php
    _e('Please upload an image for your profile.', 'birds-authorbox');
    echo '<br />';
    _e('Choose a square picture', 'birds-authorbox');
    echo '<br /><br />';
    _e('Your picture will appear above after updating your profile.', 'birds-authorbox');
                    ?>
                </p>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    (function( $ ) {
        $( '#uploadimage' ).on( 'click', function() {
            tb_show('', 'media-upload.php?type=image&TB_iframe=1');

            window.send_to_editor = function( html )
            {
                imgurl = $( 'img',html ).attr( 'src' );
                $( '#image' ).val(imgurl);
                tb_remove();
            }
            return false;
        });
    })(jQuery);
</script>

<?php
}

/**
 * Saving Image Upload Fields
 */
add_action('personal_options_update', 'birds_save_extra_profile_fields');
add_action('edit_user_profile_update', 'birds_save_extra_profile_fields');

function birds_save_extra_profile_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id))
    {
        return false;
    }

    update_user_meta($user_id, 'image', $_POST['image']);
}

// $authorImage = get_the_author_meta('image', get_query_var('author') );
// The "image" parameter here matches the id of the field we added to the user page in our functions.php

/*<img src='<?php echo $authorImage; ?>' /> */
