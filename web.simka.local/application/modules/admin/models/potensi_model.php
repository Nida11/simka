<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_potensi';
		$this->key_field = 'id_potensi';
	}

	function get_data($id_potensi='', $id_wilayah='', $periode='', $tahun=''){
		$sql = "SELECT *
				FROM $this->table_name A
				LEFT JOIN simka_wilayah B ON A.id_wilayah = B.id_wilayah
				WHERE $this->key_field IS NOT NULL";
		$sql .= (!empty($id_potensi)) ? " AND id_potensi  = '$id_potensi'" : "";
		$sql .= (!empty($id_wilayah)) ? " AND A.id_wilayah  = '$id_wilayah'" : "";
		$sql .= (!empty($periode)) ? " AND periode  = '$periode'" : "";
		$sql .= (!empty($tahun)) ? " AND tahun  = '$tahun'" : "";
		$sql .= " ORDER BY id_potensi, A.id_wilayah, periode, tahun";
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