<?php
defined('ABSPATH') || exit;

add_filter( 'woocommerce_settings_tabs_array', 'wtnp_filter_woocommerce_settings_tabs_array', 99 );

function wtnp_filter_woocommerce_settings_tabs_array( $settings_tabs ) {
    $settings_tabs['woo-wtnp-tab'] = 'وو نوتیفیکیتور';

    return $settings_tabs;
}

function wtnp_get_settings() {

	$wtnp_main_settings = array();

        $wtnp_main_settings = array(

            // Title
            array(
                'title'     =>  'تنظیمات ربات اطلاع رسانی', 
                'type'      => 'title',
                'id'        => 'wtnp_settings'
            ),
			// Telegram Checkbox
			array(
				'title'     => 'اطلاع رسانی تلگرام', 
				'desc'      => 'فعال کردن اطلاع رسانی تلگرام', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_telegramcb',
				'type'      => 'checkbox', // 
			),			
            // Telegram Token
            array(
                'title'     => 'توکن تلگرام', 
                'type'      => 'text',
				'placeholder'   => 'Telegram Token', 
                'id'        => 'wtnp_settings_teltoken',
                'css'       => 'min-width:300px;',
				'desc'      => 'برای دریافت توکن ربات wpnotificatorbot تلگرام به راهنمای بالای صفحه مراجعه کنید ', 
				'desc_tip'  => true,
				'attributes'    => array(
					'required'  => 'required' // اضافه کردن ویژگی اجباری به فیلد input
				),
            ),

			
            // Section end
            array(
                'type'      => 'sectionend',
                'id'        => 'wtnp_settings_div'
            ),
			// Title
            array(
                'title'     => 'تنظیمات اطلاع رسانی ووکامرس',
                'type'      => 'title',
                'id'        => 'wtnp_settings_thank'
            ),
			// New Order Checkbox
			array(
				'title'     => 'اطلاع رسانی سفارش جدید', 
				'desc'      => 'فعال کردن اطلاع رسانی سفارش جدید محصول', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_neworder',
				'type'      => 'checkbox', // 
			),
			// Order Status Checkbox
			array(
				'title'     => 'اطلاع رسانی تغییر وضعیت سفارش', 
				'desc'      => 'فعال کردن اطلاع رسانی تغییر وضعیت سفارش', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_orderstatus',
				'type'      => 'checkbox', // 
			),
			// Out of Stock Checkbox
			array(
				'title'     => 'اطلاع رسانی ناموجود', 
				'desc'      => 'فعال کردن اطلاع رسانی ناموجود شدن محصول', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_outofstock',
				'type'      => 'checkbox', // 
			),
			// Low Stock Checkbox
			array(
				'title'     => 'اطلاع رسانی کم بودن موجودی', 
				'desc'      => 'فعال کردن اطلاع رسانی کم بودن موجودی محصول', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_lowstock',
				'type'      => 'checkbox', // 
			),
			// Comment Checkbox
			array(
				'title'     => 'اطلاع رسانی ثبت دیدگاه', 
				'desc'      => 'فعال کردن اطلاع رسانی ثبت دیدگاه جدید برای محصول', 
				'default'   => 'no', 
				'id'        => 'wtnp_settings_comment',
				'type'      => 'checkbox', // 
			),
			// Section end
            array(
                'type'      => 'sectionend',
                'id'        => 'wtnp_settings_end'
            ),
			
        );
		
    
    
    return $wtnp_main_settings;
	
}

// Add settings
function action_woocommerce_settings_woo_wtnp_tab() {
    $settings = wtnp_get_settings();

    WC_Admin_Settings::output_fields( $settings );  
}
add_action( 'woocommerce_sections_woo-wtnp-tab', 'action_woocommerce_settings_woo_wtnp_tab', 10 );



// Process/save the settings
function action_woocommerce_settings_save_woo_wtnp_tab() {
    global $current_section;

    $tab_id = 'woo-wtnp-tab';

    $settings = wtnp_get_settings();

    WC_Admin_Settings::save_fields( $settings );

    if ( $current_section ) {
        do_action( 'woocommerce_update_options_' . $tab_id . '_' . $current_section );
    }
}
add_action( 'woocommerce_settings_save_woo-wtnp-tab', 'action_woocommerce_settings_save_woo_wtnp_tab', 10 );

//add help
add_action('admin_head', 'wtnp_add_custom_help_tab');
function wtnp_add_custom_help_tab() {
    $screen = get_current_screen();
    if ($screen->id === 'woocommerce_page_wc-settings') {
        $screen->add_help_tab(
            array(
                'id'      => 'wtnp_help_tab',
                'title'   => 'راهنمای وو نوتیفیکیتور',
                'content' => '<p>برای دریافت توکن ربات طبق راهنمای زیر اقدام کنید.</p>',
				'callback' => 'wtnp_help_tabcallback',
				'priority' => 1
            )
        );
    }
}

function wtnp_help_tabcallback() {
	?>
	<div class="wtnp-help-cls">

		<div class="wtnp-help-mainsep">
			<div class="wtnp-help-section">
				<img src="<?php echo WTNP_TNOTIF_IMAGES_URL . 'wtnp-telegram.svg'?>">
				<p><strong>دریافت توکن تلگرام:</strong></p>
			</div>		
			<p>در اپلیکیشن تلگرام، یوزرنیم @wpnotificatorbot را جستجو کنید و یا روی <a href="https://t.me/wpnotificatorbot" target="_blank">لینک</a> کلیک کنید
			دستور /token را وارد کنید و توکن را کپی کنید.		
			</p>
			<p>⚠ در صورتی که قصد عضو کردن ربات نوتیفیکیتور تلگرام را در گروه دارید، ابتدا ربات را در گروه عضو نمایید سپس توکن گروه را دریافت و در تنظیمات افزونه وارد نمایید.</p>
		</div>
		<div class="wtnp-help-section">
			<p>⚠ تعداد "آستانه کم‌بودن موجودی انبار" و "آستانه تمام‌شدن موجودی انبار" را از صفحه <a href="?page=wc-settings&tab=products&section=inventory">"پیکربندی ووکامرس/محصولات/فهرست موجودی"</a> مدیریت کنید.
</p>
		</div>
	</div>
	<?php
}
