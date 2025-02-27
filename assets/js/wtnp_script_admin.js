jQuery(document).ready(function($) {

  	if(!$('#wtnp_settings_telegramcb').prop('checked')) {
		$('#wtnp_settings_teltoken').parent().prev().hide();
		$('#wtnp_settings_teltoken').parent().hide();
	} else {
      $('#wtnp_settings_teltoken').parent().prev().show();
      $('#wtnp_settings_teltoken').parent().show();
    }

  $('#wtnp_settings_telegramcb').change(function() {
    if(this.checked) {
      $('#wtnp_settings_teltoken').parent().prev().show();
      $('#wtnp_settings_teltoken').parent().show();
    } else {
      $('#wtnp_settings_teltoken').parent().prev().hide();
      $('#wtnp_settings_teltoken').parent().hide();
    }
  });

	if(!$('#wtnp_settings_balecb').prop('checked')) {
		$('#wtnp_settings_baletoken').parent().prev().hide();
		$('#wtnp_settings_baletoken').parent().hide();
	} else {
      $('#wtnp_settings_baletoken').parent().prev().show();
      $('#wtnp_settings_baletoken').parent().show();
    }
	$('#wtnp_settings_balecb').change(function() {
    if(this.checked) {
      $('#wtnp_settings_baletoken').parent().prev().show();
      $('#wtnp_settings_baletoken').parent().show();
    } else {
      $('#wtnp_settings_baletoken').parent().prev().hide();
      $('#wtnp_settings_baletoken').parent().hide();
    }
  });

  $('#wtnp_settings_telegramcb').closest('tr').find('th').addClass('wtnp-telicon-settings');
  $('#wtnp_settings_balecb').closest('tr').find('th').addClass('wtnp-baleicon-settings');
  
});