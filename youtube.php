<?php
/*
Plugin Name: YouTube
Plugin URL: http://iantearle.com/
Description: Easily include your YouTube videos in your content. Simply add a URL in the format of <a href="YOUTUBE LINK">link</a> in your description and the plugin will do the rest. Set height and width in the Expanse <a href="index.php?cat=admin&sub=prefs#appearanceSettings">Admin Preferences</a>.
Version: 1.1
Author: Mr. Ian Tearle
Author URL: http://blog.iantearle.com/
*/

// Add some options to alter width and height
ozone_action('preferences_theme_menu', 'youtube_add_prefs_field');

function youtube_add_prefs_field(){
	?>
	<!-- /*  YouTube Sizist Options   //===============================*/ -->
    <label for="youtube_height">YouTube Height</label>
    <input type="text" name="youtube_height" id="youtube_height" value="<?php echo getOption('youtube_height'); ?>">
	<?php tooltip('YouTube Height', 'Set the height option of your YouTube Video.'); ?>
    <!-- /*  YouTube Sizist Options   //===============================*/ -->
    <label for="youtube_width">YouTube Width</label>
    <input type="text" name="youtube_width" id="youtube_width" value="<?php echo getOption('youtube_width'); ?>">
	<?php tooltip('YouTube Width', 'Set the width option of your YouTube Video.'); ?>
	<?php
}

/**
 * youtube
 * 
 * Wraps YouTube links (<a href="http://uk.youtube.com/watch?v=ZR8PYSze-c4">Your YouTube Link</a>
 * 
 */
function youtube( $text )
{
$text = preg_replace('/<a href=[^>]+youtube.([^>\/]+)\/watch\?[^>]*v=([^>"&]+)[^>]+>[^<]+<\/a>/', '<object width="'.getOption('youtube_width').'" height="'.getOption('youtube_height').'"><param name="movie"
value="http://www.youtube.$1/v/$2&amp;hl=en&amp;fs=1"></param><param
name="allowFullScreen" value="true"></param><embed
src="http://www.youtube.$1/v/$2&amp;hl=en&amp;fs=1"
type="application/x-shockwave-flash" allowfullscreen="true"
width="'.getOption('youtube_width').'" height="'.getOption('youtube_height').'"></embed></object>', $text);
        return $text;
}


// Expanse Plugin Hooks

if(defined('EXPANSE')){	
	// Item things
	ozone_filter('body', 'youtube');
	ozone_filter('excerpt', 'youtube');
	ozone_filter('descr', 'youtube');
}

?>