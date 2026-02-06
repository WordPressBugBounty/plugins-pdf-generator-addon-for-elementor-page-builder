<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://redefiningtheweb.com/
 * @since      1.0.0
 *
 * @package    Pdf_Generator_Addon_For_Elementor_Page_Builder
 * @subpackage Pdf_Generator_Addon_For_Elementor_Page_Builder/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$rtw_pgaepb_home_active = '';
$rtw_pgaepb_basic_active = '';
$rtw_pgaepb_header_active = '';
$rtw_pgaepb_footer_active = '';
$rtw_pgaepb_css_active = '';
$rtw_pgaepb_water_active = '';
$rtw_custom_fonts = get_option('rtw_pgaepb_custom_fonts', array());

include(RTW_PGAEPB_DIR ."includes/mpdf/autoload.php");
$rtw_mpdf = new \Mpdf\Mpdf();
$rtw_merge_font = array();
if( !empty( $rtw_custom_fonts ) ) 
{
	foreach( $rtw_custom_fonts as $key=> $value )
	{
		$rtw_merge_font[$key] = $key;
	}
}

foreach ($rtw_mpdf->fontdata as $key=> $value)
{
	$mpdf_font[$key] = $key;
}
$rtw_fonts = array_merge( $mpdf_font, $rtw_merge_font );

$rtw_pgaepb_tabs = isset($_GET['rtw_pgaepb_tab']) ? sanitize_text_field(wp_unslash($_GET['rtw_pgaepb_tab'])) : '';  //phpcs:ignore WordPress.Security.NonceVerification.Recommended

if( $rtw_pgaepb_tabs )
{
	if($rtw_pgaepb_tabs == "rtw_pgaepb_home") {
		$rtw_pgaepb_home_active = "nav-tab-active";
	}
	if($rtw_pgaepb_tabs == "rtw_pgaepb_basic") {
		$rtw_pgaepb_basic_active = "nav-tab-active";
	}
	if($rtw_pgaepb_tabs == "rtw_pgaepb_header") {
		$rtw_pgaepb_header_active = "nav-tab-active";
	}
	elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_footer") {
		$rtw_pgaepb_footer_active = "nav-tab-active";
	}
	elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_css") {
		$rtw_pgaepb_css_active = "nav-tab-active";
	}
	elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_watermark") {
		$rtw_pgaepb_water_active = "nav-tab-active";
	}
}
else {
	$rtw_pgaepb_basic_active = "nav-tab-active";
}
?>

<div class="rtw_pgaepb_pro_banner">
	<a href="https://codecanyon.net/item/pdfmentor-wordpress-pdf-generator-for-elementor-pro/28376760" target="_blank">
		<img src="<?php echo esc_url(RTW_PGAEPB_URL.'/admin/assets/pro.jpeg'); ?>" alt="PDFMentor Promotional Banner">
	</a>
</div>

<?php
settings_errors();
// 1. Define the URL
$rtw_pgaepb_url = 'https://wpdemo.redefiningtheweb.com/get_pdf_mentor_offer.php?rtw_pgaepb_check=hqidhi492febbeinc263sdf';
$rtw_pgaepb_offer_time = get_option('rtw_pgaepb_offer_time');
$rtw_pgaepb_check_timestamp = $rtw_pgaepb_offer_time ? strtotime('+7 days', $rtw_pgaepb_offer_time) : 0;
$rtw_pgaepb_offer = false;
if($rtw_pgaepb_check_timestamp < time())
{
	// 2. Perform the request
	$rtw_pgaepb_response = wp_remote_get( $rtw_pgaepb_url, array(
		'timeout'     => 10,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => array(),
		'cookies'     => array(),
	) );

	// 3. Check for WordPress errors (e.g., DNS failure, timeout)
	if ( is_wp_error( $rtw_pgaepb_response ) ) {
		$rtw_pgaepb_offer = false;
	}

	// 4. Retrieve and validate the HTTP response code
	$rtw_pgaepb_response_code = wp_remote_retrieve_response_code( $rtw_pgaepb_response );
	if ( 200 === $rtw_pgaepb_response_code ) {
		// 5. Safely retrieve the response body
		$rtw_pgaepb_body = wp_remote_retrieve_body( $rtw_pgaepb_response );
		// 6. If the response is JSON, decode it
		$rtw_pgaepb_offer = json_decode( $rtw_pgaepb_body, true );
		update_option('rtw_pgaepb_offer_time', time());
		// Process your $data here...
	} else {
		$rtw_pgaepb_offer = false;
	}
}
if($rtw_pgaepb_offer && isset($rtw_pgaepb_offer['show_banner']) && $rtw_pgaepb_offer['show_banner'] == true)
{
?>

<div class="rtw_sb_popup">
	<div class="rtw_sb_card">
		<div class="rtw_sb_card_label">
			<label><strong><?php echo esc_html($rtw_pgaepb_offer['offer_title']) ?></strong></label>
		</div>
		<div class="rtw_sb_card_body">
			<div class="rtw_sb_close_popup">
				<div class="rtw_sb_close_icon"></div>
			</div>
			<h2><?php echo esc_html($rtw_pgaepb_offer['offer_sub_title_msg']) ?></h2>
			<a class="rtw_sb_link" href="<?php echo esc_url($rtw_pgaepb_offer['offer_url']); ?>" target="_blank"> <button id="rtw_sb_banner_button">Buy Now</button></a>
			<p class="rtw_popper"><img src="<?php echo esc_url(RTW_PGAEPB_URL.'/admin/assets/party-popper.png'); ?>" alt="offer popper image"></p>
			<p class="rtw_sb_price">Just in <span><strike><?php echo esc_html($rtw_pgaepb_offer['buy_price']) ?></strike></span><span><?php echo esc_html($rtw_pgaepb_offer['sell_price']) ?></span></p>
			<p class="rtw_sb_bottom_text">* Hurry up limited time offer <span class="rtw_sb_date"></span></p>
		</div>
	</div>
</div>
<?php
}
?>

<div class="wrap rtw_pgaepb">
	<h1><?php esc_html('PDF Generator Addon for Elementor','pdf-generator-addon-for-elementor-page-builder');?></h1>
	<nav class="nav-tab-wrapper">
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_home_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_home"><?php esc_html_e('Home','pdf-generator-addon-for-elementor-page-builder');?></a>
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_basic_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_basic"><?php esc_html_e('Basic Setting','pdf-generator-addon-for-elementor-page-builder');?></a>
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_header_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_header"><?php esc_html_e('PDF Header Setting','pdf-generator-addon-for-elementor-page-builder');?></a>
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_footer_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_footer"><?php esc_html_e('PDF Footer Setting','pdf-generator-addon-for-elementor-page-builder');?></a>
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_css_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_css"><?php esc_html_e('PDF CSS Setting','pdf-generator-addon-for-elementor-page-builder');?></a>
		<a class="nav-tab <?php echo esc_attr($rtw_pgaepb_water_active); ?>" href="<?php echo esc_url(home_url());?>/wp-admin/admin.php?page=rtw_pgaepb&rtw_pgaepb_tab=rtw_pgaepb_watermark"><?php esc_html_e('PDF WaterMark Setting','pdf-generator-addon-for-elementor-page-builder');?></a>
	</nav>
	<p style="color:red; text-align:center;"><?php esc_html_e('* All values which you enter like top-margin, font-size etc. are in <strong>mm</strong> not in px', 'pdf-generator-addon-for-elementor-page-builder');?></p>
	<form enctype="multipart/form-data" action="options.php" method="post">
		<?php
		if($rtw_pgaepb_tabs) {
			if($rtw_pgaepb_tabs == "rtw_pgaepb_home") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_home.php');
			}
			if($rtw_pgaepb_tabs == "rtw_pgaepb_basic") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_basic.php');
			}
			if($rtw_pgaepb_tabs == "rtw_pgaepb_header") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_header.php');
			}
			elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_footer") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_footer.php');
			}
			elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_css") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_css.php');
			}
			elseif ($rtw_pgaepb_tabs == "rtw_pgaepb_watermark") {
				include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_watermark.php');
			}
		}
		else {
			include_once(RTW_PGAEPB_DIR.'/admin/partials/rtw_pgaepb_tabs/pgaepb_basic.php');
		}
		?>
		<p class="rtw_submit_section">
			<input type="submit" value="<?php esc_html_e('Save Changes','pdf-generator-addon-for-elementor-page-builder');?>" class="button-primary" name="rtw_pdf_submit">
		</p>
	</form>
</div>