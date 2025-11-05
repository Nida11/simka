<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_rekapitulasi';
		$this->key_field = 'id_wilayah';
		$this->key_field_kecamatan = 'id_kecamatan';
	}

	function get_data($id_wilayah='', $id_kecamatan='', $periode=''){
		$periode = (empty($periode)) ? date('Ym') : $periode;
		$sql = "SELECT *
				FROM $this->table_name
				WHERE $this->key_field IS NOT NULL";
		$sql .= (!empty($id_wilayah)) ? " AND id_wilayah  = '$id_wilayah'" : "";
		$sql .= (!empty($id_kecamatan)) ? " AND id_kecamatan  = '$id_kecamatan'" : "";
		$sql .= (!empty($periode)) ? " AND periode  = '$periode'" : "";
		$sql .= " ORDER BY $this->key_field, $this->key_field_kecamatan";
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