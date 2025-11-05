<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * nama fungsi : notification_message
 * description : menampilkan pesan pada notifikasi
 */
function notification_message($kode){
	switch ($kode) {
		case 'login_err':
			$header = 'ERROR LOGIN';
			$message = 'Data Yang Ada Masukan Tidak Dapat Ditemukan.<br>Periksa Kembali Data Masukan Anda';
			break;
		case 'permision_deny':
			$header = 'ERROR';
			$message = 'Opps, Anda Tidak Memiliki Akses Untuk Fitur Ini.<br>Silahkan Hubungi Administrator<br>Untuk Info Lebih Lanjut';
			break;
		case 'login_first':
			$header = 'ERROR';
			$message = 'Opps, Anda Harus Login Terlebih Dahulu.<br>Silahkan Hubungi Administrator<br>Untuk Info Lebih Lanjut';
			break;
		default:
			$header  = '';
			$message = '';
			break;
	}
	return array('header' => $header, 'message' => $message);
}

/*
 * nama fungsi : preset_message
 * description : untuk menghasilkan pesan-pesan simple di website
 */
function preset_message($kode){
	$message = array(
		'no_data' => '<strong>Tidak ada data yang ditampilkan</strong><br><small>Silahkan lakukan proses pencarian data dengan tombol <span class="glyphicon glyphicon-search"></span></small>',
	);
	return (array_key_exists($kode, $message)) ? $message[$kode] : '';
}

/*
 * nama fungsi : site_component
 * description : untuk membentuk component web di template_main
 */
function site_component(){
	$ci =& get_instance();
	return array(
		'judul' => $ci->config->item("site_title"),
		'browser_title' => $ci->config->item('browser_title'),
		'footer' => $ci->config->item("footer_credit"),
		'author' => $ci->config->item("author"),
		'description' => $ci->config->item("description"),
		'mini_description' => $ci->config->item("mini_description"),
		'keyword' => $ci->config->item("keyword"),
	);
}


/*
 * nama fungsi : get_css_modules
 * description : autoload js/css assets
 */
function get_css_modules($class_name){
	if(is_array($class_name)){
		$result = '';
		foreach($class_name as $value){
			$name = explode('/', $value);
			if(count($name) > 1){
				if(count($name) >= 2){
					$script = _CSS.'modules/'.strtolower($name[0]).'/'.strtolower($name[1]).'.css';
				}
			}else{
				$script = _CSS.'modules/'.strtolower($value).'/'.strtolower($value).'.css';
			}
			$result .= '<link rel="stylesheet" href="'.$script.'?ca='.date('dmYhis').'" />';
		}
	}else{
		$name = explode('/', $class_name);
		if(count($name) > 1){
			if(count($name) >= 2){
				$script = _CSS.'modules/'.strtolower($name[0]).'/'.strtolower($name[1]).'.css';
			}
		}else{
			$script = _CSS.'modules/'.strtolower($class_name).'/'.strtolower($class_name).'.css';
		}
		$result = '<link rel="stylesheet" href="'.$script.'?ca='.date('dmYhis').'" />';
	}
	return $result;
}

/*
 * nama fungsi : get_js_modules
 * description : autoload js/css assets
 */
function get_js_modules($class_name){
	if(is_array($class_name)){
		$result = '';
		foreach ($class_name as $value) {
			$name = explode('/', $value);
			if(count($name) > 1){
				if(count($name) >= 2){
					$script = _JS.'modules/'.strtolower($name[0]).'/'.strtolower($name[1]).'.js';
				}
			}else{
				$script = _JS.'modules/'.strtolower($value).'/'.strtolower($value).'.js';
			}
			$result .= '<script type="text/javascript" src="'.$script.'?ca='.date('dmYhis').'"></script>';
		}
	}else{
		$name = explode('/', $class_name);
		if(count($name) > 1){
			if(count($name) >= 2){
				$script = _JS.'modules/'.strtolower($name[0]).'/'.strtolower($name[1]).'.js';
			}
		}else{
			$script = _JS.'modules/'.strtolower($class_name).'/'.strtolower($class_name).'.js';
		}
		$result = '<script type="text/javascript" src="'.$script.'"></script>';
	}
	return $result;
}

function live_search_text($component='', $component2='', $component3='', $component4='', $component5=''){
	$start = 2018;
	$string = '<div class="hidden-print input-group input-group-sm">';
	if(!empty($component)){
	$string .= '<span class="input-group-addon" id="sizing-addon3">
					<span class="glyphicon glyphicon-search"></span></span>
					<input '.$component.' type="text" class="live_search_angular form-control" placeholder="Masukan Keyword Pencarian Anda" aria-describedby="sizidata-ng-addon3">
				</span>';
	}
	if(!empty($component2)){
				$string .= '<span class="input-group-addon" id="sizing-addon3">
						<select '.$component2.'">
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="40">40</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="500">500</option>
						</select>
						<span>baris</span>
					</span>';
	}
	if(!empty($component3)){
		$string .= '<span class="input-group-addon" id="sizing-addon3">
						<span>Bulan</span>
						<select '.$component3.'">
							<option value="01">JAN</option>
							<option value="02">FEB</option>
							<option value="03">MAR</option>
							<option value="04">APR</option>
							<option value="05">MEI</option>
							<option value="06">JUN</option>
							<option value="07">JUL</option>
							<option value="08">AGS</option>
							<option value="09">SEP</option>
							<option value="10">OKT</option>
							<option value="11">NOV</option>
							<option value="12">DES</option>
						</select>
						<select '.$component4.'">';
							$start = ($start=='') ? 2018 : $start;
							$current = date('Y');
							for($start ; $start <= $current; $start++){
								$string .= '<option value="'.$start.'">'.$start.'</option>';
							}
		$string .= "	</select>";
		$string .= " <a data-ng-click='".$component5."'><span class='glyphicon glyphicon-search'></span></a>";
		$string .= "</span>";
	}
	$string .= "</div>";
	return $string;
}