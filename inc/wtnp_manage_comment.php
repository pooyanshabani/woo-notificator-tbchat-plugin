<?php
defined('ABSPATH') || exit;


add_action( 'wp_insert_comment', 'display_comment_info', 10, 2 );

function display_comment_info( $comment_id, $comment ) {

	$current_time = date_i18n('l j F Y - H:i');
	$post_id = $comment->comment_post_ID;
    $post_name = get_the_title( $post_id );
    $post_link = get_permalink( $post_id );
	
if ( get_post_type( $post_id ) !== 'product' ) {
     return;
 }
    $comment_data = array(
        'comment_ID' => $comment_id,
        'comment_post_ID' => $comment->comment_post_ID,
        'comment_author' => $comment->comment_author,
        'comment_author_email' => $comment->comment_author_email,
        'comment_author_url' => $comment->comment_author_url,
        'comment_content' => $comment->comment_content,
        'comment_type' => $comment->comment_type,
        'comment_parent' => $comment->comment_parent,
        'user_id' => $comment->user_id,
		'post_name' => $post_name,
    );

	if ( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $comment_data['user_login'] = $user->user_login;
        $comment_data['user_email'] = $user->user_email;
		$userlogin = ' عضو';
		$user_email = $comment_data['user_email'];
    } else {
        $comment_data['user_login'] = '';
        $comment_data['user_email'] = $comment->comment_author_email;
		$userlogin = ' مهمان';
		$user_email = $comment_data['user_email'];
    }

	
	$comment_author = $comment_data['comment_author'];
	$comment_content = $comment_data['comment_content'];
	$wtnp_message = "✅ ثبت دیدگاه جدید " . "\n";
	$wtnp_message .= "🕒 زمان: $current_time" . "\n";
	$wtnp_message .= "👤 نام نویسنده: $comment_author" . "\n";
	$wtnp_message .= "🧑🏻‍💻 کاربر: $userlogin" . "\n";
	$wtnp_message .= "✉️ ایمیل: $user_email" . "\n";
	$wtnp_message .= "🗒 متن دیدگاه : $comment_content" . "\n";
	$wtnp_message .= "\n" . "📦 نام محصول : $post_name" . "\n";
	$wtnp_message .= "#دیدگاه_جدید";
	$url_link = $post_link;

	global $wtnp_settings_telegramcb;
	global $wtnp_settings_teltoken;


    
    if ($wtnp_settings_telegramcb == 'yes' && $wtnp_settings_teltoken) {
		notificator_send_message_wtnp_telegram($wtnp_message , $url_link);
	}


}


//die ( $wtnp_settings_baletoken );

