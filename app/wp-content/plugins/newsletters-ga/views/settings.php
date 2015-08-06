<!-- Newsletters - Google Analytics settings -->

<?php

$newsletters_ga_tracking = $this -> get_option('newsletters_ga_tracking');
$newsletters_ga_tracking_ua = $this -> get_option('newsletters_ga_tracking_ua');

?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="newsletters_ga_tracking"><?php _e('Add Tracking Code', $this -> extension_name); ?></label></th>
			<td>
				<label><input <?php echo (!empty($newsletters_ga_tracking)) ? 'checked="checked"' : ''; ?> onclick="if (jQuery(this).is(':checked')) { jQuery('#newsletters_ga_tracking_div').show(); } else { jQuery('#newsletters_ga_tracking_div').hide(); }" type="checkbox" name="newsletters_ga_tracking" value="1" id="newsletters_ga_tracking" /> <?php _e('Yes, add Google Analytics tracking code', $this -> extension_name); ?></label>
				<span class="howto"><?php _e('If you do not already have Google Analytics tracking code on your site, tick/check this to add it.', $this -> extension_name); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<div id="newsletters_ga_tracking_div" style="display:<?php echo (!empty($newsletters_ga_tracking)) ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="newsletters_ga_tracking_ua"><?php _e('Google Analytics Account', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" class="widefat" name="newsletters_ga_tracking_ua" value="<?php echo esc_attr(stripslashes($newsletters_ga_tracking_ua)); ?>" id="newsletters_ga_tracking_ua" />
					<span class="howto"><?php _e('Google Analytics property account code in the format UA-XXXXXXX-XX. Obtain it from Google Analytics tracking code page.', $this -> extension_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>