<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scan_data_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_aplikasi_role';
		$this->key_field = 'id_akses';
	}

	function get_data($id_akses='', $kode_secret='', $status=''){
		$sql = "SELECT *
				FROM $this->table_name
				WHERE $this->key_field IS NOT NULL";
		$sql .= (!empty($id_akses)) ? " AND id_akses  = '$id_akses'" : "";
		$sql .= (!empty($kode_secret)) ? " AND kode_secret  = '$kode_secret'" : "";
		$sql .= (!empty($status)) ? " AND status_data  = '$status'" : "";
		$sql .= " ORDER BY $this->key_field";
		return $this->db->query($sql)->result_array();
	}

	function save_data($data=array(), $mode_input){
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where($this->key_field, $data[$this->key_field]);
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

	// DRR 12Des18
	function insert_data($data=array(), $mode_input) {
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where('no_scan', $data['no_scan']);
					return $this->db->update('simka_data_scan', $data);
					// $data_scan = $this->db->update('simka_data_scan', $data);

					// $data2 = array(
					// 	'id_wilayah' => $data['id_wilayah'],
					// 	'id_kecamatan' => $data['id_kecamatan'],
					// 	'nama_pemilik' => $data['nama_pemilik'],
					// 	'tgl_akhir_pajak' => $data['tgl_akhir_pajak'],
					// 	'tgl_akhir_stnkb' => $data['tgl_akhir_stnkb'],
					// 	'tgl_proses_daftar' => $data['tgl_proses_daftar'],
					// 	'tgl_proses_tetap' => $data['tgl_proses_tetap'],
					// 	'tgl_proses_bayar' => $data['tgl_proses_bayar'],
					// 	'tgl_akhir_pjklm' => $data['tgl_akhir_pjklm'],
					// 	'tgl_akhir_pjkbr' => $data['tgl_akhir_pjkbr']
					// );
					// $this->db->where($data2);
					// $identitas_kendaraan = $this->db->update('simka_identitas_kendaraan', $data);
					// if ($data_scan && $identitas_kendaraan) {
					// 	return true;
					// } else {
					// 	throw new Exception();
					// }
					break;
				default:
					return $this->db->insert('simka_data_scan', $data);
					break;
			}
		}catch(Exception $e){
			return false;
		}
	}

	function insert_data2($data=array(), $mode_input) {
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where($this->key_field, $data[$this->key_field]);
					return $this->db->update('simka_identitas_kendaraan', $data);
					break;
				default:
					return $this->db->insert('simka_identitas_kendaraan', $data);
					break;
			}
		}catch(Exception $e){
			return false;
		}
	}

	public function get_data_scan($no_scan = '', $tgl_scan = '') {
		$results = array();
        $sql = (!empty($no_scan)) ? "SELECT simka_data_scan.*, " : "SELECT simka_data_scan.id_scan_data,
					simka_data_scan.no_scan,
					simka_data_scan.id_wilayah,
					simka_data_scan.id_kecamatan,
					simka_data_scan.no_polisi,
					simka_data_scan.file_image,
					simka_data_scan.user_upload,
					simka_data_scan.status_data,
					simka_data_scan.tgl_scan,
					simka_data_scan.tgl_akhir_pajak,
					simka_data_scan.tgl_akhir_stnkb,
					simka_data_scan.tgl_proses_daftar,
					simka_data_scan.tgl_proses_tetap,
					simka_data_scan.tgl_proses_bayar,
					simka_data_scan.tgl_akhir_pjklm,
					simka_data_scan.tgl_akhir_pjkbr,
					simka_data_scan.tgl_insrow,";
        $sql .= "simka_identitas_kendaraan.nama_pemilik, simka_identitas_kendaraan.no_polisi_format, simka_wilayah.nama_wilayah, simka_kecamatan.nama_kecamatan, simka_kecamatan.nama_kota FROM simka_data_scan 
			INNER JOIN simka_wilayah ON simka_wilayah.id_wilayah = simka_data_scan.id_wilayah
			INNER JOIN simka_kecamatan ON simka_kecamatan.id_wilayah = simka_wilayah.id_wilayah
			INNER JOIN simka_identitas_kendaraan ON simka_data_scan.no_polisi = simka_identitas_kendaraan.no_polisi";
		$sql .= " WHERE YEAR(tgl_scan)  = '$tgl_scan'";
		$sql .= (!empty($no_scan)) ? " AND no_scan  = '$no_scan'" : "";
		$sql .= " GROUP BY simka_data_scan.id_scan_data DESC";

        $query = $this->db->query($sql);
        if(count($query)->num_rows() > 0) {
            $results = $query->result();
        }
            return $results;
	}

	//DRR 7Feb19
	function get_data_scan_raw($no_scan, $data_input = '') {
		$results = array();
        $sql = (!empty($data_input)) ? "SELECT *" : "SELECT id, no_scan, no_scan_multiple";
		// $sql .= " FROM simka_data_scan_imgraw WHERE no_scan  = '$no_scan'";
		$sql .= " FROM simka_data_scan_imgraw";
		$sql .= (!empty($data_input)) ? " WHERE no_scan_multiple = '$data_input'" : "";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $results = $query->result();
        }
            return $results;
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

	function deleteScan($no_scan, $no_polisi, $no_mesin, $no_rangka, $id_wilayah,
		$id_kecamatan, $nama_pemilik, $tgl_akhir_pajak, $tgl_akhir_stnkb, $tgl_proses_daftar, 
		$tgl_proses_tetap, $tgl_proses_bayar, $tgl_akhir_pjklm, $tgl_akhir_pjkbr) {
		try{
			if(empty($no_scan)) throw new Exception();
			$data = array('no_scan' => $no_scan);
			$this->db->where($data);
			$data_scan = $this->db->delete('simka_data_scan');

			$data = array(
				'no_polisi' => $no_polisi,
				'no_mesin' => $no_mesin,
				'no_rangka' => $no_rangka,
				'id_wilayah' => $id_wilayah,
				'id_kecamatan' => $id_kecamatan,
				'nama_pemilik' => $nama_pemilik,
				'tgl_akhir_pajak' => $tgl_akhir_pajak,
				'tgl_akhir_stnkb' => $tgl_akhir_stnkb,
				'tgl_proses_daftar' => $tgl_proses_daftar,
				'tgl_proses_tetap' => $tgl_proses_tetap,
				'tgl_proses_bayar' => $tgl_proses_bayar,
				'tgl_akhir_pjklm' => $tgl_akhir_pjklm,
				'tgl_akhir_pjkbr' => $tgl_akhir_pjkbr
			);
			$this->db->where($data);
			$identitas_kendaraan = $this->db->delete('simka_identitas_kendaraan');

			if ($data_scan && $identitas_kendaraan) {
				return true;
			} else {
				throw new Exception();
			}
		}catch(Exception $e){
			return false;
		}
	}

 	function cek_noPol($no_polisi, $no_mesin, $no_rangka, 
						$id_wilayah, $id_kecamatan, $nama_pemilik, 
						$tgl_akhir_pajak, $tgl_akhir_stnkb, $tgl_proses_daftar, 
						$tgl_proses_tetap, $tgl_proses_bayar, $tgl_akhir_pjklm, $tgl_akhir_pjkbr) 
	{
		$results = array();
        $sql = "SELECT * 
					FROM simka_identitas_kendaraan 
					WHERE no_polisi = '$no_polisi' 
				 		AND no_mesin = '$no_mesin' 
				 		AND no_rangka = '$no_rangka'
				 		AND id_wilayah = '$id_wilayah'
				 		AND id_kecamatan = '$id_kecamatan'
				 		AND nama_pemilik = '$nama_pemilik'
				 		AND tgl_akhir_pajak = '$tgl_akhir_pajak'
				 		AND tgl_akhir_stnkb = '$tgl_akhir_stnkb'
				 		AND tgl_proses_daftar = '$tgl_proses_daftar'
				 		AND tgl_proses_tetap = '$tgl_proses_tetap'
				 		AND tgl_proses_bayar = '$tgl_proses_bayar'
				 		AND tgl_akhir_pjklm = '$tgl_akhir_pjklm'
				 		AND tgl_akhir_pjkbr = '$tgl_akhir_pjkbr'
					GROUP BY id_identitas_kendaraan DESC";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $results = $query->result();
        }
        return $results;
    }


}
