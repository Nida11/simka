<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas_kendaraan_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_identitas_kendaraan';
		$this->key_field = 'id_identitas_kendaraan';
	}

	function get_data($data=array()){
		$sql = "SELECT *
				FROM $this->table_name A
				LEFT JOIN simka_wilayah B ON A.id_wilayah = B.id_wilayah
				WHERE $this->key_field IS NOT NULL";
		if(is_array($data)){
			foreach($data as $key=>$value){
				$sql .= (!empty($data[$key])) ? " AND $key  = '$value'" : "";

			}
		}
		$sql .= " ORDER BY no_polisi";
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