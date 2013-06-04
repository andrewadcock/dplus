<div class="wrap">
    <h2>Directory Plus Settings</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('dplus-group'); ?>
        <?php @do_settings_fields('dplus-group'); ?>

        <?php do_settings_sections('directoryPlus'); ?>

        <?php @submit_button(); ?>
    </form>
</div>
<?php /*
<div class="wrap"> 
	<h2>Directory Plus Settings</h2> 
	<p>Set the default directory settings here. This may be overridden by the shortcode or template include.</p>
	<form method="post" action="options.php"> 
	<?php @settings_fields('dplus-group'); ?> <?php @do_settings_fields('dplus-group'); ?> 
	<table class="form-table"> 
		<tr valign="top"> 
			<th scope="row"><label for="setting_category">Select Default Category</label></th> 
			<td><input type="text" name="setting_category" id="setting_category" value="<?php echo get_option('setting_category'); ?>" /></td> 
		</tr> 
		<tr valign="top"> 
			<th scope="row"><label for="setting_images">Images</label></th> 
			<td>
				<select name="setting_images" id="setting_images">
					<option value="on" <?php if(get_option('setting_images') == 'on' ) {echo "selected='selected'";}?>>On</option>
					<option value="off" <?php if(get_option('setting_images') == 'off' ){ echo "selected='selected'"} ?>>Off</option>
				</select>
			</td> 
		</tr>
		<tr valign="top"> 
			<th scope="row"><label for="setting_bio">Bio</label></th> 
			<td>
				<select name="setting_bio" id="setting_bio">
					<option value="on" <?php if(get_option('setting_bio') == 'on' ) {echo "selected='selected'";}?>>On</option>
					<option value="off" <?php if(get_option('setting_bio') == 'off' ){ echo "selected='selected'"} ?>>Off</option>
				</select>
			</td> 
		</tr> 
		<tr valign="top"> 
			<th scope="row"><label for="setting_headers">Section Headers</label></th> 
			<td>
				<select name="setting_headers" id="setting_headers">
					<option value="on" <?php if(get_option('setting_headers') == 'on' ) {echo "selected='selected'";}?>>On</option>
					<option value="off" <?php if(get_option('setting_headers') == 'off' ){ echo "selected='selected'"} ?>>Off</option>
				</select>
			</td> 
		</tr> 
	</table> 
	<?php @submit_button(); ?> 
	</form> 
</div>

*/