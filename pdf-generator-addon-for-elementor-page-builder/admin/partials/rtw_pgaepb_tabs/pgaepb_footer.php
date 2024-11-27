<?php
settings_fields('rtw_pgaepb_footer_setting');
$rtw_wprh_get_setting = get_option('rtw_pgaepb_footer_setting_opt');
?>
<table class="wp-list-table form-table">
		<tr>
		<th class="tr1"><?php esc_html_e('Remove Footer', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		
		<td class="tr2"><input type="checkbox" id= "rtw_foot_remv" name="rtw_pgaepb_footer_setting_opt[rtw_remove_footer]" value="1" <?php echo esc_attr( isset($rtw_wprh_get_setting['rtw_remove_footer']) ) && $rtw_wprh_get_setting['rtw_remove_footer'] == 1 ? 'checked="checked"' : ''; ?>  />
				<div class="descr"><?php esc_html_e('Check it if you want to remove footer', 'pdf-generator-addon-for-elementor-page-builder');?></div>
			</td>
		
		</tr>
		</table>
<table id="rtw_text_remv_footer" class="wp-list-table form-table <?php echo esc_attr(isset( $rtw_wprh_get_setting['rtw_remove_footer'])  ? 'display_none' : ''); ?>">
	<tbody>
		<tr>
			<th><?php esc_html_e('Footer HTML', 'pdf-generator-addon-for-elementor-page-builder');?></th>
			<td>
				<?php
					$rtw_content = isset( $rtw_wprh_get_setting['rtw_footer_html'] ) ? $rtw_wprh_get_setting['rtw_footer_html'] : '';
					$rtw_setting = array(
						'wpautop' => true,
						'media_buttons' => true,
						'textarea_name' => 'rtw_pgaepb_footer_setting_opt[rtw_footer_html]',
						'textarea_rows' => 7
					);
					wp_editor($rtw_content, 'rtw_pgaepb_footer_editor', $rtw_setting );
				?>
			</td>
		</tr>
		<tr>
			<th class="tr1"><?php esc_html_e('Footer Top Margin', 'pdf-generator-addon-for-elementor-page-builder');?></th>
			<td class="tr2"><input type="number" min="0" name="rtw_pgaepb_footer_setting_opt[footer_top_margin]" value="<?php echo esc_attr( isset($rtw_wprh_get_setting['footer_top_margin']) ? $rtw_wprh_get_setting['footer_top_margin'] : '15'); ?>" />
				<div class="descr"><?php esc_html_e('Enter your required top margin (By default 15)', 'pdf-generator-addon-for-elementor-page-builder');?></div>
			</td>
		</tr>
		<tr>
			<th class="tr1"><?php esc_html_e('Footer Section Font', 'pdf-generator-addon-for-elementor-page-builder');?></th>
			<td class="tr2">
				<select name="rtw_pgaepb_footer_setting_opt[footer_font_family]">
				<?php 
					foreach ( $rtw_fonts as $key => $value ) 
					{ 
						?>
							<option value="<?php echo esc_attr($value); ?>" <?php echo esc_attr( isset($rtw_wprh_get_setting['footer_font_family']) && $rtw_wprh_get_setting['footer_font_family'] == $value ? 'selected="selected"' : '');?>><?php echo esc_attr($key); ?></option>
						<?php
				 	}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<th class="tr1"><?php esc_html_e('Footer Section Font Size', 'pdf-generator-addon-for-elementor-page-builder');?></th>
			<td class="tr2">
				<input type="number" min="0" name="rtw_pgaepb_footer_setting_opt[footer_font_size]"
				value="<?php echo esc_attr(isset($rtw_wprh_get_setting['footer_font_size']) ? $rtw_wprh_get_setting['footer_font_size'] : '15'); ?>" />
				<div class="descr"><?php esc_html_e('Enter your required font size for PDF Footer (By default 15)', 'pdf-generator-addon-for-elementor-page-builder');?></div>

			</td>
		</tr>
		<tr>
			<th class="tr1"><?php esc_html_e('Hide Page Number', 'pdf-generator-addon-for-elementor-page-builder');?></th>
			<td class="tr2">
				<input type="checkbox" name="rtw_pgaepb_footer_setting_opt[rtw_footer_hide_pageno]" value="1" <?php echo esc_attr(isset( $rtw_wprh_get_setting['rtw_footer_hide_pageno']) && $rtw_wprh_get_setting['rtw_footer_hide_pageno'] == 1 ? 'checked="checked"' : ''); ?> />
				<div class="descr"><?php esc_html_e('Check it if you want to hide page number in PDF Footer','pdf-generator-addon-for-elementor-page-builder');?></div>

			</td>
		</tr>
	</tbody>	
</table>