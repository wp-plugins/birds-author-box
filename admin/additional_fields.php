<?php
/**
 * Contact Info Fields
 *
 * @package    Birds_Authorbox
 * @subpackage birds-author-box/admin
 * @since      1.0.0
 */


/**
 * Enqueue before anything, silly boy!
 */
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
function load_wp_media_files() {
    wp_enqueue_media();
}

/**
 * Social Medias
 */
add_filter('user_contactmethods', 'birds_contactmethods');

function birds_contactmethods($user_contactmethods)
{
    $user_contactmethods['twitter_birds'] = __('Twitter URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['facebook_birds'] = __('Facebook URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['google_plus_birds'] = __('Google+ URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['linkedin_birds'] = __('LinkedIn URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['flickr_birds'] = __('Flickr URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['youtube_birds'] = __('YouTube URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['pinterest_birds'] = __('Pinterest URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['instagram_birds'] = __('Instagram URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['github_birds'] = __('GitHub URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
    $user_contactmethods['dribbble_birds'] = __('Dribbble URL', 'birds-authorbox') . '<p class="description">' . __('URL must be complete, i.e. beginning with http:// or https://', 'birds-authorbox') . '</p>';
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
                    ?>
                </p>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    ;(function ($, window, document, undefined) {

        var birds_avatar_uploader;


        $('#uploadimage').click(function(e) {

            e.preventDefault();

            //If the uploader object has already been created, reopen the dialog
            if (birds_avatar_uploader) {
                birds_avatar_uploader.open();
                return;
            }

            //Extend the wp.media object
            birds_avatar_uploader = wp.media.frames.file_frame = wp.media({
                title: '<?php _e('Choose Image','birds-authorbox') ; ?>',
                button: {
                    text: '<?php _e('Choose Image','birds-authorbox') ; ?>'
                },
                library: {
                    type: 'image'
                },
                multiple: false
            });

            //When a file is selected, grab the URL and set it as the text field's value
            birds_avatar_uploader.on('select', function() {
                attachment = birds_avatar_uploader.state().get('selection').first().toJSON();
                $('#image').val(attachment.url);
                $('.user-preview-image').attr('src',attachment.url);
            });

            //Open the uploader dialog
            birds_avatar_uploader.open();

        });

    }(jQuery, window, window.document)); //no conflict wrapper
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
