z<?php
settings_fields('rtw_pgaepb_watermark_setting');
$rtw_wprh_get_setting = get_option('rtw_pgaepb_watermark_setting_opt');
?>
<table class="wp-list-table form-table">
	<tr>
		<th class="tr1"><?php esc_html_e('Watermark Text', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td class="tr2">
			<input type="checkbox" name="rtw_pgaepb_watermark_setting_opt[enable_text_watermark]" value='1' <?php echo esc_attr( isset($rtw_wprh_get_setting['enable_text_watermark']) ? 'checked = "checked"' : ''); ?> onclick="showHideCheck('text_add_watermark', this);" />
			<div class="descr"><?php esc_html_e('Check it if you want to show Watermark text', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
</table>
<table id="text_add_watermark" class="wp-list-table form-table <?php echo esc_attr(isset($rtw_wprh_get_setting['enable_text_watermark']) ? '' : 'display_none'); ?>">
	<tr>
		<th class="tr1"><?php esc_html_e('Watermark Font', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td>
			<select name="rtw_pgaepb_watermark_setting_opt[watermark_font]">
			<?php foreach( $rtw_fonts as $key => $value ) { ?>
				<option value="<?php echo esc_attr($value); ?>" <?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_font']) && $rtw_wprh_get_setting['watermark_font'] == $value ? 'selected="selected"' : ''); ?>><?php echo esc_attr($key); ?></option>
			<?php } ?>
			</select>
			<div class="descr"><?php esc_html_e('Choose the font family of Watermark text', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<tr>
		<th class="tr1"><?php esc_html_e('Watermark Rotation', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td>
			<input type="text" name="rtw_pgaepb_watermark_setting_opt[watermark_rotation]" value="<?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_rotation']) ? $rtw_wprh_get_setting['watermark_rotation'] : '45'); ?>" />
			<div class="descr"><?php esc_html_e('Enter your required rotation (in degree) for Watermark text', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<tr>
		<th class="tr1"><?php esc_html_e('Watermark Text', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td class="tr2">
			<textarea name="rtw_pgaepb_watermark_setting_opt[watermark_text]" rows="4" cols="35"><?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_text']) ? $rtw_wprh_get_setting['watermark_text'] : ''); ?></textarea>
			<div class="descr"><?php esc_html_e('Enter Watermark text which you want to show on PDF', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<tr>
		<th class="tr1"><?php esc_html_e('Text Opacity', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td class="tr2">
			<input type="number" step="0.1" min="0" max="1" name="rtw_pgaepb_watermark_setting_opt[watermark_text_trans]"
			value="<?php echo esc_attr( isset ($rtw_wprh_get_setting['watermark_text_trans']) ? $rtw_wprh_get_setting['watermark_text_trans'] : ''); ?>" />
			<div class="descr"><?php esc_html_e('Select the text opacity for Watermark', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
</table>
<!-- Image watermark -->
<table class="wp-list-table form-table">
	<tr>
		<th class="tr1"><?php esc_html_e('Image', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td class="tr2">
			<input type="checkbox" name="rtw_pgaepb_watermark_setting_opt[enable_image_watermark]" value='1' <?php echo esc_attr( isset($rtw_wprh_get_setting['enable_image_watermark']) ? 'checked = "checked"' : ''); ?> onclick="showHideCheck('add_watermark_image', this);" />
			<div class="descr"><?php esc_html_e('Check it if you want to show Watermark image', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
</table>
<table id="add_watermark_image" class="wp-list-table form-table <?php isset($rtw_wprh_get_setting['enable_image_watermark'])  ? '' : 'display_none' ?>">
	<tr>
		<th class="tr1"><?php esc_html_e('Image Opacity', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td class="tr2">
			<input type="number" step="0.1" min="0" max="1" name="rtw_pgaepb_watermark_setting_opt[watermark_image_trans]" value="<?php echo esc_attr( isset ( $rtw_wprh_get_setting['watermark_image_trans']) ? $rtw_wprh_get_setting['watermark_image_trans'] : ''); ?>" />
			<div class="descr"><?php esc_html_e('Select the image opacity for Watermark', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<tr>
		<th class="tr1"><?php esc_html_e('Watermark Image', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td>
			<?php $src_watermark= isset($rtw_wprh_get_setting['watermark_img_url'] ) ? $rtw_wprh_get_setting['watermark_img_url'] : '';?>
			<div id="watermark_img_backgrnd" style="float: left; margin-right: 10px;">
				<img id="watermark_img" src="<?php echo esc_url($src_watermark); ?>" width="60px" height="60px" />
			</div>
			<div style="line-height: 60px;">
				<input type="hidden" id="watermark_img_url" name="rtw_pgaepb_watermark_setting_opt[watermark_img_url]" value="<?php echo esc_url($src_watermark); ?>" />
				<button type="button" class="watermark_img_upload button"><?php esc_html_e( 'Upload/Add image', 'pdf-generator-addon-for-elementor-page-builder'); ?></button><br>
				<button type="button" class="watermark_remove_img button"><?php esc_html_e( 'Remove image', 'pdf-generator-addon-for-elementor-page-builder'); ?></button>
			</div>
			<div class="descr"><?php esc_html_e('Choose your Watermark Image which you want to show on PDF', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<?php $watermark_size=array('D'=>'Original size of image','P'=>'Resize to fit the full page size, keeping aspect ratio','F'=>'Resize to fit the print-area (frame) respecting current page margins, keeping aspect ratio','INT'=>'Resize to full page size minus a margin set by this integer, keeping aspect ratio','array'=>'Specify Width and Height');?>
	<tr>
		<th class="tr1"><?php esc_html_e('Image Dimension', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td>
			<select name="rtw_pgaepb_watermark_setting_opt[watermark_img_dim]" onchange="showHideImage();" id="doc-add-watermark-image-dimen-select"><?php
				foreach ( $watermark_size as $key => $value ) 
				{
					?>
					<option value="<?php echo esc_attr($key);?>" <?php echo esc_attr(isset( $rtw_wprh_get_setting['watermark_img_dim']) && $rtw_wprh_get_setting['watermark_img_dim'] == $key ? 'selected="selected"' : ''); ?>><?php echo esc_attr($value);?></option>
					<?php
		 		}
			?>  
			</select>
			<div class="descr"><?php esc_html_e('Choose the dimension of Watermark image', 'pdf-generator-addon-for-elementor-page-builder');?></div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="add_watermark_image_dimension"
			class="<?php if($rtw_wprh_get_setting['watermark_img_dim']=='array' && $rtw_wprh_get_setting['enable_image_watermark']==1): echo '';else: echo 'display_none';endif;?>">
				<tr>
					<th class="tr1"><?php esc_html_e('Image Width', 'pdf-generator-addon-for-elementor-page-builder');?></th>
					<td class="tr2">
						<input type="text" name="rtw_pgaepb_watermark_setting_opt[water_img_dim_width]"
						value="<?php echo esc_attr( isset($rtw_wprh_get_setting['water_img_dim_width']) ? $rtw_wprh_get_setting['water_img_dim_width'] : ''); ?>" />
						<div class="descr"><?php esc_html_e('Set the Width of Watermark image', 'pdf-generator-addon-for-elementor-page-builder');?></div>
					</td>
				</tr>
				<tr>
					<th class="tr1"><?php esc_html_e('Image Height', 'pdf-generator-addon-for-elementor-page-builder');?></th>
					<td class="tr2">
						<input type="text" name="rtw_pgaepb_watermark_setting_opt[water_img_dim_height]" value="<?php echo esc_attr( isset($rtw_wprh_get_setting['water_img_dim_height']) ? $rtw_wprh_get_setting['water_img_dim_height'] : ''); ?>" />
						<div class="descr"><?php esc_html_e('Set the Height of Watermark image', 'pdf-generator-addon-for-elementor-page-builder');?></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="add_watermark_image_dimen_integer" class="<?php if($rtw_wprh_get_setting['watermark_img_dim']=='INT' && $rtw_wprh_get_setting['enable_image_watermark']==1): echo '';else: echo 'display_none';endif;?>">
				<tr>
					<th class="tr1"><?php esc_html_e('Integer Value', 'pdf-generator-addon-for-elementor-page-builder');?></th>
					<td class="tr2"><input type="text" name="rtw_pgaepb_watermark_setting_opt[water_img_dim_int]"
						value="<?php echo esc_attr( isset($rtw_wprh_get_setting['water_img_dim_int']) ? $rtw_wprh_get_setting['water_img_dim_int'] : ''); ?>" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php $watermark_position=array('P'=>'Centred on the whole page area','F'=>'Centred on the page print-area (frame) respecting page margins','arrays'=>'Specify a position');
	?>
	<tr>
		<th class="tr1"><?php esc_html_e('Image Position', 'pdf-generator-addon-for-elementor-page-builder');?></th>
		<td>
			<select name="rtw_pgaepb_watermark_setting_opt[watermark_img_pos]" onchange="showHidePos();" id="doc-add-watermark-image-pos-select"><?php
				foreach ( $watermark_position as $key => $value ) 
				{
					?>
					<option value="<?php echo esc_attr($key);?>" <?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_img_pos']) && $rtw_wprh_get_setting['watermark_img_pos'] == $key ? 'selected="selected"' : ''); ?>><?php echo esc_attr($value);?></option>
					<?php
		 		}	
		?>  </select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="add_watermark_image_pos"
			class="<?php if($rtw_wprh_get_setting['watermark_img_pos']=='arrays' && $rtw_wprh_get_setting['enable_image_watermark']==1): echo '';else: echo 'display_none';endif;?>">
				<tr>
					<th class="tr1"><?php esc_html_e('Horizontal Position', 'pdf-generator-addon-for-elementor-page-builder');?></th>
					<td class="tr2"><input type="text" name="rtw_pgaepb_watermark_setting_opt[watermark_img_pos_x]"
						value="<?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_img_pos_x']) ? $rtw_wprh_get_setting['watermark_img_pos_x'] : ''); ?>" />
					</td>
				</tr>
				<tr>
					<th class="tr1"><?php esc_html_e('Vertical Position', 'pdf-generator-addon-for-elementor-page-builder');?></th>
					<td class="tr2"><input type="text" name="rtw_pgaepb_watermark_setting_opt[watermark_img_pos_y]"
						value="<?php echo esc_attr( isset($rtw_wprh_get_setting['watermark_img_pos_y']) ? $rtw_wprh_get_setting['watermark_img_pos_y'] : ''); ?>" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>