<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.piumaz.it
 * @since      1.0.0
 *
 * @package    Pmz_Weekly_Menu
 * @subpackage Pmz_Weekly_Menu/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="pmz_weekly_menu_options" action="options.php">
	
		<?php 
		$options = get_option($this->plugin_name);
		
		settings_fields($this->plugin_name); 
		do_settings_sections($this->plugin_name);
		?>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">Days</th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span>Days</span></legend>
							<?php foreach($this->days As $day): ?>
								<? $id = $this->plugin_name . '-' . $day; ?>
								<label for="<?php echo $id; ?>">
									<input name="<?php echo $this->plugin_name; ?>[days][<?php echo $day; ?>]" type="checkbox" id="<?php echo $id; ?>" <?php checked($options['days'][$day], 1); ?> value="1">
										<?php echo $day; ?>
								</label>
								<br>
							<?php endforeach; ?>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Meals</th>
					<td>
						<fieldset>
							<legend class="screen-reader-text"><span>Meals</span></legend>
							<?php foreach($this->meals As $meal): ?>
								<? $id = $this->plugin_name . '-' . $meal; ?>
								<label for="<?php echo $id; ?>">
									<input name="<?php echo $this->plugin_name; ?>[meals][<?php echo $meal; ?>]" type="checkbox" id="<?php echo $id; ?>" <?php checked($options['meals'][$meal], 1); ?> value="1">
										<?php echo $meal; ?>
								</label>
								<br>
							<?php endforeach; ?>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>


        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>