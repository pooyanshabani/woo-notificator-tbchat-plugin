<?php
defined('ABSPATH') || exit;


add_action( 'woocommerce_no_stock', 'wtnp_custom_outof_stock_action');
function wtnp_custom_outof_stock_action( $product ) {

    $current_time = date_i18n('l j F Y - H:i');
	$product_link = $product->get_permalink();
	$product_ID = $product->get_id();
	$product_name = $product->get_name();
	$stock_quantity = $product->get_stock_quantity();

	$wtnp_message = "⚠️ موجودی محصول تمام شده است!" . "\n";
	$wtnp_message .= "🕒 زمان: $current_time" . "\n";
	$wtnp_message .= "📦 محصول: $product_name" . "\n";

	if ($stock_quantity) {$wtnp_message .= "🥡 موجودی: $stock_quantity" . "\n";}
	//$wtnp_message .= "\n" . "$product_link" . "\n";
	$wtnp_message .= "#اتمام_موجودی";
	 

    global $wtnp_settings_telegramcb;
	global $wtnp_settings_teltoken;


    
    if ($wtnp_settings_telegramcb == 'yes' && $wtnp_settings_teltoken) {
		notificator_send_message_wtnp_telegram($wtnp_message, $product_link);
	}

  
}
