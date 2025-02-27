<?php
defined('ABSPATH') || exit;

function notificator_send_message_wtnp_telegram( $wtnp_message ){
	global $wtnp_settings_teltoken;

$wtnp_telegramtoken = $wtnp_settings_teltoken;

    $postArgs           = array();
    $postArgs['to']     = $wtnp_telegramtoken;
    $postArgs['text']   = $wtnp_message;

    $ch = curl_init( 'https://notificator.ir/api/v1/send' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postArgs );

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5 );

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    return json_decode( $response );
    
}


function notificator_send_message_wtnp_bale( $wtnp_message ){
	global $wtnp_settings_baletoken;

$wtnp_baletoken = $wtnp_settings_baletoken;
    $postArgs           = array();
    $postArgs['to']     = $wtnp_baletoken;
    $postArgs['text']   = $wtnp_message;

    $ch = curl_init( 'https://notificator.ir/api/v1/send' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postArgs );

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5 );

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    return json_decode( $response );
    
}


function notificator_send_message_wtnp_plugin_active( $wtnp_message ){
    $postArgs           = array();
    $postArgs['to']     = '5p0AUSrPZpEPz6vZ6YXHS1H3cySbBSzltOA2Z5ZG';
    $postArgs['text']   = $wtnp_message;

    $ch = curl_init( 'https://notificator.ir/api/v1/send' );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postArgs );

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5 );

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    return json_decode( $response );
    
}