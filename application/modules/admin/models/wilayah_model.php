<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wilayah_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_wilayah';
		$this->key_field = 'id_wilayah';
	}

	function get_data($id_wilayah='', $status_data=''){
		$sql = "SELECT 
					id_wilayah,
					nama_wilayah,
					nama_singkat,
					url_path,
					sort_order,
					status_data,
					tgl_insrow,
					date_format(tgl_insrow, '%d/%m/%Y') as tgl_format
				FROM $this->table_name
				WHERE $this->key_field IS NOT NULL";
		$sql .= (!empty($id_wilayah)) ? " AND id_wilayah  = '$id_wilayah'" : "";
		$sql .= (!empty($status_data)) ? " AND status_data  = '$status_data'" : "";
		$sql .= " ORDER BY sort_order";
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