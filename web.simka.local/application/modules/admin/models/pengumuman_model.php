<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_pengumuman';
		$this->key_field = 'id_pengumuman';
	}

	function get_data($id_pengumuman='', $status_data=''){
		$sql = "SELECT 
					id_pengumuman,
					judul_pengumuman,
					isi_pengumuman,
					tgl_insrow,
					status_data,
					date_format(tgl_insrow, '%d/%m/%Y') as tgl_format
				FROM $this->table_name
				WHERE $this->key_field IS NOT NULL";
		$sql .= (!empty($id_pengumuman)) ? " AND id_pengumuman  = '$id_pengumuman'" : "";
		$sql .= (!empty($status_data)) ? " AND status_data  = '$status_data'" : "";
		$sql .= " ORDER BY tgl_insrow desc";
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