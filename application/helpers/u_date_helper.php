<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * nama fungsi : month_name
 * description : nama bulan dalam bahasa indonesia
 */
function month_name($mon){
	$month = array( 
		'1'  => 'Januari', 
		'2'  => 'Februari',
		'3'  => 'Maret', 
		'4'  => 'April',
		'5'  => 'Mei', 
		'6'  => 'Juni',
		'7'  => 'Juli', 
		'8'  => 'Agustus',
		'9'  => 'September', 
		'10' => 'Oktober',
		'11' => 'November', 
		'12' => 'Desember',
	);
	return $month[$mon];
}

/*
 * nama fungsi : get_hari
 * description : dropdown jumlah hari dalam 1 bulan
 */
function get_hari($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$array = array(
		'0' => '---',
		'1' => '1',
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19',
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
		'31' => '31'
	);
	$name_element = ($name_element=='') ? 'DD' : $name_element;
	return form_dropdown($name_element, $array, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
}

/*
 * nama fungsi : get_bulan
 * description : dropdown nama bulan dalam bahasa indonesia
 */
function get_bulan($name_element, $selected='', $class='', $id='', $element='', $multi=''){
	$array = array( 
		'0' => '---',
		'01' => 'JANUARI',
		'02' => 'FEBRUARI',
	 	'03' => 'MARET',
	 	'04' => 'APRIL',
	 	'05' => 'MEI',
	 	'06' => 'JUNI',
	 	'07' => 'JULI',
	 	'08' => 'AGUSTUS',
	 	'09' => 'SEPTEMBER',
	 	'10' => 'OKTOBER',
	 	'11' => 'NOVEMBER',
	 	'12' => 'DESEMBER',
	);
	$name_element = ($name_element=='') ? 'MM' : $name_element;
	$selected = ($selected=='') ? date('n') : $selected;
	return form_dropdown($name_element, $array, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
}

/*
 * nama fungsi : get_tahun
 * description : dropdown untuk menampilkan tahun sesuai yang ditentukan
 */
function get_tahun($name_element, $selected='', $class='', $id='', $element='', $start=''){
	$start      = ($start=='') ? 2016 : $start;
	$current    = date('Y');
	$array['0'] = '---';
	for($start ; $start <= $current; $start++){
		$array[$start] = $start;
	}
	$name_element = ($name_element=='') ? 'YYYY' : $name_element;
	$selected = ($selected=='') ? date('n') : $selected;
	return form_dropdown($name_element, $array, $selected, 'class="'.$class.'" id="'.$id.'" '.$element);
}

/*
 * nama fungsi : get_jam
 * description : dropdown untuk menampilkan jam
 */
function get_jam($name, $id='', $class='', $selected=''){
	$start = 0;
	for($start ; $start <= 23; $start++){
		$array[$start] = str_pad($start, 2, 0, STR_PAD_LEFT);
	}
	return form_dropdown($name, $array, date('G'),'class=filter_select');	
}

/*
 * nama fungsi : get_menit
 * description : dropdown untuk menampikan menit
 */
function get_menit($name, $id='', $class='', $selected=''){
	$start = 0;
	for($start ; $start <= 59; $start++){
		$array[$start] = str_pad($start, 2, 0, STR_PAD_LEFT);
	}
	return form_dropdown($name, $array, date('i'),'class=filter_select');
}
