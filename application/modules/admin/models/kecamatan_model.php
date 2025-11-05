<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_kecamatan';
		$this->key_field = 'id_kecamatan';
	}

	function get_data($id_kecamatan='', $id_wilayah='', $status_data=''){
		$sql = "SELECT A.*, 
					B.id_wilayah, 
					B.nama_wilayah, 
					B.nama_singkat, 
					B.sort_order
				FROM $this->table_name A
				LEFT JOIN simka_wilayah B ON A.id_wilayah = B.id_wilayah
				WHERE $this->key_field IS NOT NULL
					AND B.status_data = '1'";
		$sql .= (!empty($id_kecamatan)) ? " AND A.id_kecamatan  = '$id_kecamatan'" : "";
		$sql .= (!empty($id_wilayah)) ? " AND A.id_wilayah  = '$id_wilayah'" : "";
		$sql .= (!empty($status_data)) ? " AND A.status_data  = '$status_data'" : "";
		$sql .= " ORDER BY A.id_wilayah, A.id_kecamatan";
		return $this->db->query($sql)->result_array();
	}

	function save_data($data=array(), $mode_input){
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where($this->key_field, $data[$this->key_field]);
					$this->db->where('id_wilayah', $data['id_wilayah']);
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

	function delete_data($data, $data2){
		try{
			if(empty($data)) throw new Exception();
			$this->db->where($this->key_field, $data);
			$this->db->where('id_wilayah', $data2);
			return $this->db->delete($this->table_name);
		}catch(Exception $e){
			return false;
		}	
	}
}