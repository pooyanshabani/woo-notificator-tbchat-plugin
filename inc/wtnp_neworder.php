<?php
defined('ABSPATH') || exit;

add_action('woocommerce_checkout_order_processed', 'wtnp_checkout_create_order_cb', 10, 4);
function wtnp_checkout_create_order_cb($order_id, $posted_data, $order) {
    if (is_user_logged_in()) {
        $userlogin = ' عضو';
		
    } else {
        $userlogin = ' مهمان';
    }

    $billing_first_name = $order->get_billing_first_name();
    $billing_last_name = $order->get_billing_last_name();
    $billing_company = $order->get_billing_company();
    $billing_address1 = $order->get_billing_address_1();
    $billing_address2 = $order->get_billing_address_2();
    $billing_email = $order->get_billing_email();
    $billing_postcode = $order->get_billing_postcode();
    $billing_city = $order->get_billing_city();
    $billing_phone = $order->get_billing_phone();
	$shipping_first_name = $order->get_shipping_first_name();
    $shipping_last_name = $order->get_shipping_last_name();
    $shipping_company = $order->get_shipping_company();
    $shipping_address1 = $order->get_shipping_address_1();
    $shipping_address2 = $order->get_shipping_address_2();  
    $shipping_postcode = $order->get_shipping_postcode();
    $shipping_city = $order->get_shipping_city();
   
	$payment_method = $order->get_payment_method_title();
	$shipping_method = $order->get_shipping_method();
    $shipping_cost = $order->get_shipping_total();
	$order_date = $order->get_date_created()->date_i18n('l j F Y - H:i:s');
	$order_note = $order->get_customer_note();

    $coupon_codes = $order->get_coupon_codes();
    $coupon_name = $coupon_codes[0];
    $discount_total = $order->get_discount_total();
    
	
	$wtnp_currency = get_woocommerce_currency();
	if($wtnp_currency == 'IRT') {
		$wtnp_currency = 'تومان';
		} elseif ($wtnp_currency == 'IRHT') {$wtnp_currency = 'هزار تومان';
		} elseif ($wtnp_currency == 'IRHR') {$wtnp_currency = 'هزار ریال';
	}

 
    $wtnp_message = "✅ سفارش جدید " . "\n";
    $wtnp_message .= "🕒 زمان: $order_date" . "\n";
    $wtnp_message .= "#️⃣ شماره سفارش: $order_id" . "\n";
    $wtnp_message .= "\n" . "🔖 جزئیات صورت حساب: ". "\n";
	$wtnp_message .= "👤 نام: $billing_first_name $billing_last_name" . "\n";
	$wtnp_message .= "🧑🏻‍💻 کاربر: $userlogin" . "\n";
	if ($billing_company) {$wtnp_message .= "🏢 شرکت: $billing_company" . "\n";}
    if ($billing_city || $billing_address1 || $billing_address2) { $wtnp_message .= "📍 آدرس: $billing_city - $billing_address1 - $billing_address2 - $billing_postcode" . "\n";}
   
    $wtnp_message .= "📞 تلفن: $billing_phone" . "\n";
    $wtnp_message .= "✉️ ایمیل: $billing_email" . "\n";
	
	if ($shipping_first_name || $shipping_last_name || $shipping_city || $shipping_address1 || $shipping_postcode) { 
		$wtnp_message .= "\n" . "📦 جزئیات حمل و نقل: ". "\n";
		$wtnp_message .= "👤 نام: $shipping_first_name $shipping_last_name" . "\n";
		if ($shipping_company) {$wtnp_message .= "🏢 شرکت: $shipping_company" . "\n";}
		$wtnp_message .= "📍 آدرس: $shipping_city - $shipping_address1 - $shipping_address2 - $shipping_postcode" . "\n";
	}
	$wtnp_message .= "🏦 روش پرداخت: $payment_method" . "\n";
	
	if ($shipping_method) {$wtnp_message .= "🚚 روش ارسال: $shipping_method" . "\n";}
	
	if($order_note) {$wtnp_message .= "\n" . "🗒 یادداشت مشتری: $order_note" . "\n";}
	

    $items = $order->get_items();
    $wtnp_message .= "\n" . "🛒 محصولات: " . "\n";
    foreach ($items as $item) {
        $product_name = $item->get_name();
        $product_quantity = $item->get_quantity();
        $product_price = $item->get_total();
        $wtnp_message .= " - $product_name • تعداد: $product_quantity • قیمت: $product_price" . "\n";
    }

    $order_total = $order->get_total();
	if($shipping_cost) {$wtnp_message .= "\n" . "📦 هزینه ارسال: $shipping_cost " . "\n";}
	if($coupon_name){$wtnp_message .= "🎟 کد تخفیف: $coupon_name" . "\n" . "💲 مقدار تخفیف: - $discount_total" . "\n";}
    $wtnp_message .= "💰 مبلغ کل: $order_total " . " $wtnp_currency". "\n";
    $wtnp_message .= "\n" . get_admin_url() . "/post.php?post=" . $order_id ."&action=edit";

    global $wtnp_settings_telegramcb;
	global $wtnp_settings_teltoken;
	global $wtnp_settings_balecb;
	global $wtnp_settings_baletoken;

    
    if ($wtnp_settings_telegramcb == 'yes' && $wtnp_settings_teltoken) {
		notificator_send_message_wtnp_telegram($wtnp_message);
	}
	if ($wtnp_settings_balecb == 'yes' && $wtnp_settings_baletoken) {
		notificator_send_message_wtnp_bale($wtnp_message);
	}
}
