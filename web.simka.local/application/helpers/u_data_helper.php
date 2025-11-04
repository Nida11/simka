<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * nama fungsi : manual_sequence
 * description : untuk menjalankan sequence secara manual dari codeigniter
 */
function manual_sequence($nama_sequence){
	$ci =& get_instance();
	$ci->load->database();
	$username = $ci->db->username;
	$password = $ci->db->password;
	$hostname = $ci->db->hostname;
	$char_set = $ci->db->char_set;
	$conn = oci_connect($username, $password, $hostname, $char_set);
	if (!$conn) {
	    $e = oci_error();
	    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	$query = "SELECT ".$nama_sequence.".NEXTVAL FROM DUAL";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	return oci_fetch_assoc($stid);
}

function generate_sqeuence(){
	$tnsname  = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.5.101)(PORT = 1521))';
	$tnsname  .= '(CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = sdm)))';
	$hostname = $tnsname;
	$conn = oci_connect('pegawai', 'kesinforshs', $hostname);
	$stid = oci_parse($conn, 'SELECT SEQ_FOTO_PEGAWAI.nextval from dual');
	$r = oci_execute($stid, OCI_DEFAULT);
	while ( $row = oci_fetch_row($stid)) {
		foreach ($row as $key => $item) {
			$item;
		}
	}
	oci_close($conn);
	return $item;
}


/*
 * nama fungsi : request_curl
 * description : untuk menjalankan fungsi curl
 */
function request_curl($url, $method='', $myvars='', $auth=array(), $agent=''){
	try{
		$user = (is_array($auth) && count($auth) > 0) ? $auth['user'] : 'admsirs';
		$password = (is_array($auth) && count($auth) > 0) ? $auth['pass'] : 'safety';
	    $session = curl_init($url);
	    $arrheader =  array(
			'ws_rshs_id: $user',
			'ws_rshs_signature: $password',
			'Content-Type: application/x-www-form-urlencoded',
	    );
	    curl_setopt($session, CURLOPT_URL, $url);
	    curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
	    curl_setopt($session, CURLOPT_VERBOSE, true);
	    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
	    if($agent!='') curl_setopt($session, CURLOPT_USERAGENT, $agent);

	    switch($method){
	        case 'POST':
	            curl_setopt($session, CURLOPT_POST, true );
	            curl_setopt($session, CURLOPT_POSTFIELDS, $myvars);
	            break;
	        case 'PUT':
	            curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
	            curl_setopt($session, CURLOPT_POSTFIELDS, $myvars);
	            break;
	        case 'DELETE':
	            curl_setopt($session, CURLOPT_CUSTOMREQUEST, "DELETE");
	            curl_setopt($session, CURLOPT_POSTFIELDS, $myvars);
	            break;
	    }
	    curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
	    $response = curl_exec($session);
	    //return $myvars;
	    return $response;
	}catch(Exception $e){
		die($e);
	}
}

function get_list_kelompok_kegiatan($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_instance();
	$CI->load->model('remun/iki_kelompok_kegiatan_model');
	$id_bagian = $CI->session->userdata('ID_BAGIAN');
	$query = $CI->iki_kelompok_kegiatan_model->get_data('', $id_bagian);
	$option['option'][0] = '-- Masukan Kelompok Kegiatan --';
	foreach($query as $value){
		$option['option'][$value['ID_KELOMPOK']] = $value['NM_KELOMPOK'];
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_list_kelompok_penilaian($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_instance();
	$CI->load->model('admin/master_kelompok_penilaian_kinerja_model');
	$query = $CI->master_kelompok_penilaian_kinerja_model->get_data('', 1);
	$option['option'][0] = '-- Masukan Kelompok Penilaian Kinerja --';
	foreach($query as $value){
		$option['option'][$value['ID_KELOMPOK']] = $value['NAMA_PENILAIAN'] . ' - '. $value['BOBOT_DEFAULT'] .'%';
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_list_sasaran_kinerja($name_element, $selected='', $class='', $id='', $element='', $multi='', $kelompok_penilaian=''){
	$CI =& get_instance();
	$CI->load->model('remun/iki_sasaran_kinerja_pegawai_model');
	$id_bagian = $CI->session->userdata('ID_BAGIAN');
	$id_bagian_merge = $CI->session->userdata('MERGE_UNIT');
	$query = $CI->iki_sasaran_kinerja_pegawai_model->get_data('', $id_bagian, $kelompok_penilaian, $id_bagian_merge);
	$option['option'][0] = '-- Masukan Master Kegiatan --';
	$i=1;
	foreach($query as $value){
		$option['option'][$value['ID_KEGIATAN']] = $i.'. ('.$value['ID_BAGIAN'].') '.strtoupper($value['NM_KEGIATAN']) . ' ---'. $value['NM_KELOMPOK'];
		$i++;
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_list_sumber_penilaian($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$data = array(
		'0' => '-- Pilih Sumber Penilaian --',
		'log_book' => 'PENGISIAN LOG BOOK',
		'simrs' => 'DATA DINAMIS'
	);
	if($multi!==''){
		return form_multiselect($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_indikator_rs($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_Instance();
	$CI->load->model('remun/iku_indikator_rs_model');
	$query = $CI->iku_indikator_rs_model->get_data('','','','1');
	$option['option'][''] = ' -- Pilih Nama Indikator --';
	foreach($query as $key=>$value){
		$option['option'][$value['ID_MUTU']] = $value['TAHUN'].' - '.strtoupper($value['NM_INDIKATOR']);
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_periode_iku($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$data = array(
		'' => '-- Pilih Periode --',
		'JANUARI' => '01.JAN - 03.MAR',
		'APRIL' => '04.APR - 06.JUN',
		'JULI' => '07.JUL - 09.SEP',
		'OKTOBER' => '10.OCT - 12.DEC'
	);
	if($multi!==''){
		return form_multiselect($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_periode_iki($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$data = array(
		'' => '-- Pilih Periode --',
		'1' => '01.JAN - 03.MAR',
		'4' => '04.APR - 06.JUN',
		'7' => '07.JUL - 09.SEP',
		'10' => '10.OCT - 12.DEC'
	);
	if($multi!==''){
		return form_multiselect($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $data, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_list_bagian($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_instance();
	$CI->load->model('admin/bagian_model');
	$id_bagian = '';
	$id_induk_bagian = '';
	$query = $CI->bagian_model->get_data($id_bagian, 1, 1);
	$option['option'][0] = '-- Masukan nama bagian --';
	foreach($query as $value){
		$option['option'][$value['ID_BAGIAN']] = $value['ID_BAGIAN'].' - '.strtoupper($value['NM_BAGIAN']);
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_list_pegawai($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_instance();
	$CI->load->model('admin/user_model');
	//$id_bagian = $CI->session->userdata('ID_BAGIAN');
	$id_bagian = '';
	$query = $CI->user_model->get_data_pegawai('', $id_bagian);
	$option['option'][0] = '-- Masukan nama pegawai --';
	foreach($query as $value){
		$option['option'][$value['NIP']] = strtoupper($value['NM_PEGAWAI']);
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}

function get_menu($id_level){
	$CI = get_instance();
	$CI->load->model('admin/module_akses_model');
	$query = $CI->module_akses_model->get_data_modul_akses($id_level);
	return $query;
}

function get_list_module($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$CI =& get_instance();
	$CI->load->model('admin/module_akses_model');
	$query = $CI->module_akses_model->get_data('', '1', '1', '1');
	$option['option'][0] = '-- Masukan Nama Module --';
	foreach($query as $value){
		$option['option'][$value['ID_MODULE']] = strtoupper($value['NAMA_MODULE']);
	}
	if($multi!==''){
		return form_multiselect($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}else{
		return form_dropdown($name_element, $option['option'], $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
	}
}