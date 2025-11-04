<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_data_scan';
		$this->key_field = 'no_scan';
		$this->key_field_user = 'user_upload';
	}

	function get_data_user() {
		$sql = "SELECT * FROM simka_pegawai ORDER BY nama_pegawai ASC";
		return $this->db->query($sql)->result_array();
	}

	function get_data($user_upload='', $tahun='', $bulan1='', $bulan2='', $tgl1='', $tgl2=''){
		$sql = "SELECT simka_data_scan.user_upload,
					simka_data_scan.tgl_scan,
					simka_data_scan.tgl_insrow,
					COUNT( simka_data_scan.tgl_scan ) AS total,";
		if (!empty($bulan1)) {
			$sql .= "CASE
				MONTH ( tgl_scan ) 
				WHEN 1 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Januari')
				WHEN 2 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Februari')
				WHEN 3 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Maret')
				WHEN 4 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' April')
				WHEN 5 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Mei')
				WHEN 6 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Juni')
				WHEN 7 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Juli')
				WHEN 8 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Agustus')
				WHEN 9 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' September')
				WHEN 10 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Oktober')
				WHEN 11 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' November')
				WHEN 12 THEN
				CONCAT(DAY(simka_data_scan.tgl_scan), ' Desember')
				ELSE 'UNDEFINED' 
			END AS tgl_edit";
		} else {
			$sql .= "CASE
				MONTH ( tgl_scan ) 
				WHEN 1 THEN
				CONCAT('Januari ', YEAR(simka_data_scan.tgl_scan))
				WHEN 2 THEN
				CONCAT('Februari ', YEAR(simka_data_scan.tgl_scan))
				WHEN 3 THEN
				CONCAT('Maret ', YEAR(simka_data_scan.tgl_scan))
				WHEN 4 THEN
				CONCAT('April ', YEAR(simka_data_scan.tgl_scan))
				WHEN 5 THEN
				CONCAT('Mei ', YEAR(simka_data_scan.tgl_scan))
				WHEN 6 THEN
				CONCAT('Juni ', YEAR(simka_data_scan.tgl_scan))
				WHEN 7 THEN
				CONCAT('Juli ', YEAR(simka_data_scan.tgl_scan))
				WHEN 8 THEN
				CONCAT('Agustus ', YEAR(simka_data_scan.tgl_scan))
				WHEN 9 THEN
				CONCAT('September ', YEAR(simka_data_scan.tgl_scan))
				WHEN 10 THEN
				CONCAT('Oktober ', YEAR(simka_data_scan.tgl_scan))
				WHEN 11 THEN
				CONCAT('November ', YEAR(simka_data_scan.tgl_scan))
				WHEN 12 THEN
				CONCAT('Desember ', YEAR(simka_data_scan.tgl_scan))
				ELSE 'UNDEFINED' 
			END AS tgl_edit";
		}
		$sql .= " FROM $this->table_name
				WHERE user_upload = '$user_upload'";
		$sql .= (!empty($tahun)) ? " AND YEAR(simka_data_scan.tgl_scan) = '$tahun'" : "";
		
		$tanggal1 = $tahun.'-'.$bulan1.'-'.$tgl1;
		$tanggal2 = $tahun.'-'.$bulan2.'-'.$tgl2;

		$sql .= (!empty($bulan1) && !empty($bulan2)) ? " AND simka_data_scan.tgl_scan BETWEEN '".$tanggal1."' AND '".$tanggal2."'" : "";
		if (!empty($bulan1)) {
			$sql .= " GROUP BY simka_data_scan.tgl_scan";
		} else if (!empty($tahun)) {
			$sql .= " GROUP BY MONTH(simka_data_scan.tgl_scan)";
		} else {
			$sql .= " GROUP BY MONTH(simka_data_scan.tgl_scan), YEAR(simka_data_scan.tgl_scan)";
		}
		$sql .= " ORDER BY tgl_scan ASC";
		//return $this->db->query($sql)->result_array();
		$query = $this->db->query($sql);
		$data = array();
		if($query !== FALSE && $query->num_rows() > 0){
			$data = $query->result_array();
		}
		return $data;
	}

	// function get_data($user_upload='', $tahun='', $bulan='', $tgl1='', $tgl2=''){
	// 	$sql = "SELECT simka_data_scan.user_upload,
	// 				simka_data_scan.tgl_scan,
	// 				simka_data_scan.tgl_insrow,
	// 				COUNT( simka_data_scan.tgl_scan ) AS total,";
	// 	if (!empty($bulan)) {
	// 		$sql .= "DAY(simka_data_scan.tgl_scan) AS tgl_edit";
	// 	} else if (!empty($tahun)) {
	// 		$sql .= "CASE MONTH(tgl_scan)
	// 					WHEN 1 THEN
	// 						'Januari'
	// 					WHEN 2 THEN
	// 						'Februari'
	// 					WHEN 3 THEN
	// 						'Maret'
	// 					WHEN 4 THEN
	// 						'April'
	// 					WHEN 5 THEN
	// 						'Mei'
	// 					WHEN 6 THEN
	// 						'Juni'
	// 					WHEN 7 THEN
	// 						'Juli'
	// 					WHEN 8 THEN
	// 						'Agustus'
	// 					WHEN 9 THEN
	// 						'September'
	// 					WHEN 10 THEN
	// 						'Oktober'
	// 					WHEN 11 THEN
	// 						'November'
	// 					WHEN 12 THEN
	// 						'Desember'
	// 					ELSE
	// 						'UNDEFINED'
	// 				END AS tgl_edit";
	// 	} else {
	// 		$sql .= "CASE
	// 			MONTH ( tgl_scan ) 
	// 			WHEN 1 THEN
	// 			CONCAT('Januari ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 2 THEN
	// 			CONCAT('Februari ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 3 THEN
	// 			CONCAT('Maret ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 4 THEN
	// 			CONCAT('April ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 5 THEN
	// 			CONCAT('Mei ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 6 THEN
	// 			CONCAT('Juni ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 7 THEN
	// 			CONCAT('Juli ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 8 THEN
	// 			CONCAT('Agustus ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 9 THEN
	// 			CONCAT('September ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 10 THEN
	// 			CONCAT('Oktober ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 11 THEN
	// 			CONCAT('November ', YEAR(simka_data_scan.tgl_scan))
	// 			WHEN 12 THEN
	// 			CONCAT('Desember ', YEAR(simka_data_scan.tgl_scan))
	// 			ELSE 'UNDEFINED' 
	// 		END AS tgl_edit";
	// 	}
	// 	$sql .= " FROM $this->table_name
	// 			WHERE user_upload = '$user_upload'";
	// 	$sql .= (!empty($tahun)) ? " AND YEAR(simka_data_scan.tgl_scan) = '$tahun'" : "";
	// 	$sql .= (!empty($bulan)) ? " AND MONTH(simka_data_scan.tgl_scan) = '$bulan'" : "";
	// 	$sql .= (!empty($tgl1) && !empty($tgl2)) ? " AND DAY(simka_data_scan.tgl_scan) BETWEEN '$tgl1' AND '$tgl2'" : "";
	// 	if (!empty($bulan)) {
	// 		$sql .= " GROUP BY simka_data_scan.tgl_scan";
	// 	} else if (!empty($tahun)) {
	// 		$sql .= " GROUP BY MONTH(simka_data_scan.tgl_scan)";
	// 	} else {
	// 		$sql .= " GROUP BY MONTH(simka_data_scan.tgl_scan), YEAR(simka_data_scan.tgl_scan)";
	// 	}
	// 	$sql .= " ORDER BY tgl_scan ASC";
	// 	return $this->db->query($sql)->result_array();
	// }
	
	function get_data_all($tahun='', $bulan1='', $bulan2='', $tgl1='', $tgl2='') {
		$sql = "SELECT nama_pegawai,";
		$sql .= "(SELECT COUNT(id_scan_data) FROM simka_data_scan WHERE simka_data_scan.user_upload = simka_pegawai.id_user";
		$sql .= (!empty($tahun)) ? " AND YEAR(simka_data_scan.tgl_scan) = '$tahun'" : "";
		$tanggal1 = $tahun.'-'.$bulan1.'-'.$tgl1;
		$tanggal2 = $tahun.'-'.$bulan2.'-'.$tgl2;
		$sql .= (!empty($bulan1) && !empty($bulan2)) ? " AND simka_data_scan.tgl_scan BETWEEN '".$tanggal1."' AND '".$tanggal2."'" : "";
		$sql .= ") AS total";
		$sql .= " FROM simka_pegawai WHERE id_user LIKE '%pppd%'";

		return $this->db->query($sql)->result_array();
	}

	function save_data($data=array(), $mode_input){
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where($this->key_field, $data[$this->key_field]);
					$this->db->where($this->key_field_kecamatan, $data[$this->key_field_kecamatan]);
					return $this->db->update($this->table_name, $data);
					break;
				default:
					return $this->db->insert($this->table_name, $data);
					break;
			}
		}catch(Exception $e){
			return false;
		}
	}

	function delete_data($data){
		try{
			if(empty($data)) throw new Exception();
			$this->db->where($this->key_field, $data);
			return $this->db->delete($this->table_name);
		}catch(Exception $e){
			return false;
		}	
	}
}
