/*
 *
 *-------------------------
 *
 *
 */

var base_url;
var config;
var opening_process = 0;
var ajax_request_content;
var ajax_request_process;
var ajax_timeout = 0;

function animate_to_top(container){
	$('html, body').animate({
		scrollTop: $(container).offset().top
	}, 1000);
}

function set_userconfig(config_data){
	config = {
		auto_refresh_content_index: config_data.auto_refresh_content_index,
	}
}

function get_userconfig(){
	return config;
}

function set_base_url(baseurl){
	base_url = baseurl;
}

function get_base_url(){
	return base_url;
}

function ajax_get_content(param){
	var options = {
		url: param.url,
		type: (typeof param.type=='undefined') ? 'GET' : 'POST',
		timeout: ajax_timeout,
		dataType: 'html',
		data: (typeof param.data=='undefined') ? null : param.data,
		async: true,
		beforeSend: function(e){

		},
		success: function(result){
			if(typeof param.container_type!=='undefined' && param.container_type.toLowerCase() == 'modal'){
				$('#modal').modal('show');
				$('.modal-content').empty().append(result);
			}else{
				$(param.container_target).empty().append(result);
				if(param.animate) animate_to_top(param.container_target);
			}

			close_state = (typeof param.close_state!=='undefined') ? param.close_state : null;
			switch(close_state){
				case 'close_modal':
					$('#modal').modal('hide');
					break;
				case 'refresh_layout':
					$(param.container_target).empty();
					break;
				case 'clean_all':
					$('#modal').modal('hide');
					$(param.container_target).empty();
					break;
				default:
					break;
			}

			alert_state = (typeof param.alert_state!=='undefined') ? param.alert_state : null;
			switch(alert_state){
				case 'sweetalert':
					sweetAlert({
						title: 'testing',
						text: 'lorem ipsum doller sit ammet',
						type: 'success',
						timer: 2000,
						showConfirmButton: false
					});
					break
				case 'alert':
					alert('');
					break;
				case 'toast':
					$.toast({
						text: 'testing'
					});
					break;
				case 'notify':
					$.notify("Terjadi Kesalahan", {className: 'warn'});
					break;
			}

			if(typeof param.callback_target!=='undefined'){
				$(param.callback_target).empty().append(result);
				if(param.animate) animate_to_top(param.callback_target);
			}
		},
	}
	ajax_request_content = $.ajax(options);
}

function confirmExit() {
	if(opening_process == 1){
		return "Anda akan meninggalkan halaman ini, Apakah seluruh proses selesai disimpan ?\nPastikan seluruh proses sudah diselesaikan dan disimpan";
	}
}
window.onbeforeunload = confirmExit;