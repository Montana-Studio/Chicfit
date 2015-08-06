<!-- Newsletters - Google Analytics send metabox -->

<?php

if (!empty($_GET['id'])) {
	$history_id = $_GET['id'];
	$Db -> model = $History -> model;
	$history = $Db -> find(array('id' => $history_id));
	$newsletters_ga_utm = $history -> newsletters_ga_utm;
	$newsletters_ga_utm_source = $history -> newsletters_ga_utm_source;
	$newsletters_ga_utm_medium = $history -> newsletters_ga_utm_medium;
	$newsletters_ga_utm_campaign = $history -> newsletters_ga_utm_campaign;
	$newsletters_ga_utm_term = $history -> newsletters_ga_utm_term;
	$newsletters_ga_utm_content = $history -> newsletters_ga_utm_content;
}

?>

<table class="form-table">
	<tbody>
		<tr>
			<th><label for="newsletters_ga_utm"><?php _e('Custom Campaign', $this -> extension_name); ?></label></th>
			<td>
				<label><input onclick="if (jQuery(this).is(':checked')) { jQuery('#newsletters_ga_utm_div').show(); } else { jQuery('#newsletters_ga_utm_div').hide(); }" <?php echo (!empty($newsletters_ga_utm)) ? 'checked="checked"' : ''; ?> type="checkbox" name="newsletters_ga_utm" value="1" id="newsletters_ga_utm" /> <?php _e('Do Google Analytics custom campaign for this newsletter', $this -> extension_name); ?></label>
			</td>
		</tr>
	</tbody>
</table>

<div id="newsletters_ga_utm_div" style="display:<?php echo (!empty($newsletters_ga_utm)) ? 'block' : 'none'; ?>;">
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="newsletters_ga_utm_source"><?php _e('UTM Source', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" name="newsletters_ga_utm_source" value="<?php echo esc_attr(stripslashes($newsletters_ga_utm_source)); ?>" id="newsletters_ga_utm_source" class="widefat" /> 
					<span class="howto"><?php _e('Identify the newsletter that is sending traffic to your site/property, eg. newsletter123', $this -> extension_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="newsletters_ga_utm_medium"><?php _e('UTM Medium', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" name="newsletters_ga_utm_medium" value="<?php echo esc_attr(stripslashes($newsletters_ga_utm_medium)); ?>" id="newsletters_ga_utm_medium" class="widefat" />
					<span class="howto"><?php _e('Advertising or marketing medium. It is recommended that you set this to "email"', $this -> extension_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="newsletters_ga_utm_campaign"><?php _e('UTM Campaign', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" name="newsletters_ga_utm_campaign" value="<?php echo esc_attr(stripslashes($newsletters_ga_utm_campaign)); ?>" id="newsletters_ga_utm_campaign" class="widefat" />
					<span class="howto"><?php _e('The individual campaign name, slogan, promo code, etc. for a product or service.', $this -> extension_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="newsletters_ga_utm_term"><?php _e('UTM Term', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" name="newsletters_ga_utm_term" value="<?php echo esc_attr(stripslashes($newsletters_ga_utm_term)); ?>" id="newsletters_ga_utm_term" class="widefat" />
					<span class="howto"><small><?php _e('(optional)', $this -> extension_name); ?></small> <?php _e('If you are manually tagging paid keyword campaigns, you should also use utm_term to specify the keyword.', $this -> extension_name); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="newsletters_ga_utm_content"><?php _e('UTM Content', $this -> extension_name); ?></label></th>
				<td>
					<input type="text" name="newsletters_ga_utm_content" value="<?php echo esc_attr(stripslashes($newsletters_ga_utm_content)); ?>" id="newsletters_ga_utm_content" class="widefat" />
					<span class="howto"><small><?php _e('(optional)', $this -> extension_name); ?></small> <?php _e('Used to differentiate similar content, or links within the same ad. For example, if you have two call-to-action links within the same email message, you can use utm_content and set different values for each so you can tell which version is more effective.', $this -> extension_name); ?></span>
				</td>
			</tr>
		</tbody>
	</table>
</div>