<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_akses_model extends CI_Model {

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