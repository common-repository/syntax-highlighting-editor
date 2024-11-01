<?php
/*
Plugin Name: Syntax Highlighting Editor
Plugin URI: http://www.ttweb.ru/cspassword.html
Description: Syntax highlighting in the editor plugins and themes
Version: 1.0
Author: ZetRider
Author URI: http://www.zetrider.ru
Author Email: ZetRider@bk.ru
*/
/*  Copyright 2011  zetrider  (email: zetrider@bk.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

load_plugin_textdomain( 'sh-editor', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

$WPSHE_PLUGIN_URL = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

function sheditormenu(){
	add_options_page('SH Editor', 'SH Editor', 8, 'setting_sheditor', 'setting_sheditor');
}

add_action('admin_menu', 'sheditormenu');

function setting_sheditor() {
global $WPSHE_PLUGIN_URL; 
?>
	<div class="wrap">
		<h2><?php _e("Settings Syntax Highlighting Editor"); ?> </h2>
			<a href="http://wordpress.org/extend/plugins/clone-spc/" target="_blank"><img src="<?php echo $WPSHE_PLUGIN_URL; ?>images/wpo.jpg"></a>
			<a href="http://www.zetrider.ru/" target="_blank"><img src="<?php echo $WPSHE_PLUGIN_URL; ?>images/zwd.jpg"></a><br style="clear:both;">
			<a href="http://www.ttweb.ru/" target="_blank"><img src="<?php echo $WPSHE_PLUGIN_URL; ?>images/stt.jpg"></a>
			<a href="http://www.zetrider.ru/donate" target="_blank"><img src="<?php echo $WPSHE_PLUGIN_URL; ?>images/dwy.jpg"></a>
			<br><br>
			<form method="post" action="options.php">
			<?php wp_nonce_field('update-options'); ?>
				<strong><?php _e("Syntax Editor:","sh-editor"); ?></strong><br>			
				<select name="sheditor_syntax">
				<option>html</option>
				<option>css</option>
				<option>js</option>
				<option>php</option>
				<option>xml</option>
				<option>sql</option>
				</select>
				<?php if (get_option('sheditor_syntax') == '') { echo "<small>(Default: html)</small>"; } else { echo "Selected: ".get_option('sheditor_syntax'); } ?><br><br>
				<strong><?php _e("Language editor:","sh-editor"); ?></strong><br>
				<select name="sheditor_lang">
				<option>ru</option>
				<option>en</option>
				<option>bg</option>
				<option>cs</option>
				<option>de</option>
				<option>dk</option>
				<option>eo</option>
				<option>es</option>
				<option>fi</option>
				<option>fr</option>
				<option>hr</option>
				<option>it</option>
				<option>ja</option>
				<option>mk</option>
				<option>nl</option>
				<option>pl</option>
				<option>pt</option>
				<option>sk</option>
				<option>zh</option>
				</select>
				<?php if (get_option('sheditor_lang') == '') { echo "<small>(Default: ru)</small>"; } else { echo "Selected: ".get_option('sheditor_lang'); } ?><br><br>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="sheditor_syntax, sheditor_lang" />
				<input type="submit" name="update" value="<?php _e("Save","sh-editor"); ?>" class="button-primary">
			</form>
	</div>    
<?php
}
function insert_sheditor() {
global $WPSHE_PLUGIN_URL; 

if (get_option('sheditor_lang') == "") { $sheditor_lang = "ru"; } else { $sheditor_lang = get_option('sheditor_lang'); }
if (get_option('sheditor_syntax') == "") { $sheditor_syntax = "html"; } else { $sheditor_syntax = get_option('sheditor_syntax'); }

echo '
<script language="javascript" type="text/javascript" src="'.$WPSHE_PLUGIN_URL.'edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
id : "newcontent",
language: "'.$sheditor_lang.'",
syntax: "'.$sheditor_syntax.'",
start_highlight: true,
toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight",
syntax_selection_allow: "css,html,js,php,xml,sql",
});
</script>
';
}
add_action('admin_head', 'insert_sheditor');
?>