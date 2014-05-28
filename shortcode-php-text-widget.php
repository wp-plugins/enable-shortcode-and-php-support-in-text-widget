<?php
/*
 Plugin Name: Enable Shortcode and PHP in Text widget
 Plugin URI: http://tech4sky.com
 Description: Enable shortcode support and execute PHP in WordPress's Text Widget
 Author: Collizo4sky
 Author URI: http://wrox.com
 */


add_action('admin_menu', 'espw_plugin_menu');

// Adding Submenu to settings
function espw_plugin_menu() {
	add_options_page(
	'Shortcode & PHP in Text Widget',
	'Shortcode & PHP in Text Widget',
	'manage_options',
	'espw-short-code-php-widget',
	'espw_plugin_settings'
	);
}

function espw_plugin_settings() {
	echo '<div class="wrap">';
	screen_icon();
	echo '<h2>Enable Shortcode and PHP support in Text widget</h2>';
	echo '<form action="options.php" method="post">';
	do_settings_sections('espw-short-code-php-widget');
	settings_fields('espw_settings_group');
	submit_button();
	?>
		<br>
		<br>
	<table>
		<tr>
			<td>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="HAAAMDMXMSP58">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form></td>
		</td><td><a href="https://twitter.com/tech4sky" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @tech4sky</a>
<script>
			! function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
				if (!d.getElementById(id)) {
					js = d.createElement(s);
					js.id = id;
					js.src = p + '://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore(js, fjs);
				}
			}(document, 'script', 'twitter-wjs'); 
</script>
</td>
		<td>
			<div id="fb-root"></div>
<script>
				( function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id))
							return;
						js = d.createElement(s);
						js.id = id;
						js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=399748413426161&version=v2.0";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk')); 
</script>
<div class="fb-like" data-href="https://facebook.com/tech4sky" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div>
		</tr>
	</table>
	<br /><br /><br />
	<h2>Built with <3 and coffee by <strong><a href="http://tech4sky.com" target="_blank">Collizo4sky</a></strong></h2>
	
	<?php

	}

	// plugin field and sections
	function espw_plugin_option() {
	add_settings_section(
	'espw_settings_section',
	'Plugin Options',
	null,
	'espw-short-code-php-widget'
	);

	add_settings_field(
	'shortcode',
	'<label for="shortcode">Enable Shortcode Support</label>',
	'espw_shortcode_field',
	'espw-short-code-php-widget',
	'espw_settings_section'
	);

	add_settings_field(
	'php',
	'<label for="php">Enable PHP Suport</label>',
	'espw_php_field',
	'espw-short-code-php-widget',
	'espw_settings_section'
	);

	// register settings
	register_setting('espw_settings_group', 'espw_option');
	}

	function espw_shortcode_field() {
	$optionz = get_option('espw_option');
	echo '<input type="checkbox" id="shortcode" name="espw_option[shortcode]" value="1"' . checked( $optionz['shortcode'], 1, false) . '">';

	}

	function espw_php_field() {
	$optionz = get_option('espw_option');
	echo '<input type="checkbox" id="php" name="espw_option[php]" value="1"' . checked($optionz['php'], 1, false) . '">';

	}

	// register options
	add_action('admin_init', 'espw_plugin_option');

	$espw_options = get_option( 'espw_option' );

	if ($espw_options['shortcode']) {

	// shortcode support
	add_filter('widget_text', 'do_shortcode');
	}

	if ($espw_options['php']) {
	// PHP support
	function exam_plug_text_replace($text) {
	ob_start();
	eval('?>'
	.$text);
	$text = ob_get_contents();
	ob_end_clean();
	return $text;
	}
	add_filter('widget_text', 'exam_plug_text_replace');
	}
