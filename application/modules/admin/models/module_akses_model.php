<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_akses_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_aplikasi_module';
		$this->key_field = 'id_module';
	}

	function get_data($id_module='', $status='', $show='', $id_parent_module=''){
		$sql = "SELECT 
					id_module,
					CASE 
						WHEN (id_parent_module IS NULL OR id_parent_module = '0') THEN id_module
						ELSE id_parent_module
					END AS id_parent_module, 
					CASE 
						WHEN (id_parent_module IS NULL OR id_parent_module = '0') THEN '0'
						ELSE '1'
					END AS mode_menu,
					nama_module, 
					code_module, 
					status_data, 
					tgl_insrow, 
					show_public, 
					route,
					sort_order
				FROM $this->table_name
				WHERE id_module IS NOT NULL";
		$sql .= (!empty($id_module)) ? " AND id_module  = '$id_module'" : "";
		$sql .= (!empty($status)) ? " AND status_data  = '$status'" : "";
		$sql .= (!empty($show)) ? " AND show_public  = '$show'" : "";
		$sql .= (!empty($id_parent_module)) ? " AND id_parent_module IS NOT NULL" : "";
		$sql .= " ORDER BY sort_order, 2,1,3";
		return $this->db->query($sql)->result_array();
	}

	function get_data_modul_akses($id_code_akses=''){
		$sql = "SELECT 
					A.id_module,
					CASE 
						WHEN (id_parent_module IS NULL OR id_parent_module = '0') THEN A.id_module
						ELSE id_parent_module
					END AS id_parent_module, 
					CASE 
						WHEN (id_parent_module IS NULL OR id_parent_module = '0') THEN '0'
						ELSE '1'
					END AS mode_menu,
					nama_module, 
					code_module, 
					status_data, 
					A.tgl_insrow, 
					show_public, 
					route,
					sort_order,
					CASE
						WHEN B.id_code_akses IS NULL THEN 0
						ELSE 1
					END AS checklist_status,
					B.id_code_akses
				FROM $this->table_name A
				LEFT JOIN simka_aplikasi_menu B ON A.id_module = B.id_module AND B.id_code_akses  = '$id_code_akses'
				WHERE A.id_module IS NOT NULL
				ORDER BY sort_order, 2,1,3";
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

	function save_code_access_menu($data){
		try{
			return $this->db->insert('simka_aplikasi_menu', $data);
		}catch(Exception $e){
			return false;
		}
	}

	function delete_code_access_menu($data){
		try{
			if(empty($data)) throw new Exception();
			$this->db->where('id_module', $data['id_module']);
			$this->db->where('id_code_akses', $data['id_code_akses']);
			return $this->db->delete('simka_aplikasi_menu');
		}catch(Exception $e){
			return false;
		}		
	}
}