<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->table_name = 'simka_aplikasi_akun';
		$this->key_field = 'id_user';
	}

	function get_pegawai($id_user='', $pass='', $check_account=''){
		$check_pass = false;
		if(!empty($pass)){
			$sql = "SELECT * 
					FROM simka_pegawai
					WHERE id_user IS NOT NULL AND pass IS NOT NULL";
			$sql .= (!empty($id_user)) ? " AND (id_user = '$id_user' OR nip = '$id_user')" : "";
			$query = $this->db->query($sql)->result_array();
			$password_terisi = (count($query) > 0) ? true : false;
			$check_pass = true;
		}
		$password_md5 = md5($pass);
		$sql = "SELECT
					A.id_user, 
					A.nip, 
					A.nip AS id_pegawai, 
					A.nama_pegawai, 
					A.foto_pegawai, 
					A.must_change,
					B.id_wilayah, 
					B.nama_wilayah, 
					C.is_admin, 
					C.status_data, 
					C.level_akses
				FROM simka_pegawai A 
				LEFT JOIN simka_wilayah B ON A.id_wilayah = B.id_wilayah 
				LEFT JOIN $this->table_name C ON A.id_user = C.id_user
				WHERE A.id_user IS NOT NULL";
		$sql .= (!empty($id_user)) ? " AND (A.id_user = '$id_user' OR A.nip = '$id_user')" : "";
		if($check_pass){
			$sql .= ($password_terisi) ? "  AND pass = '$password_md5'" : " AND TO_CHAR(TGL_LAHIR, 'DDMMYYYY') = '$password'";
		}
		return $this->db->query($sql)->result_array();
	}

	function get_data($id_user='', $status_data=''){
		$sql = "SELECT 
					B.nip, 
					B.id_user, 
					B.nama_pegawai, 
					B.must_change,
					A.*, 
					D.id_akses, 
					D.nama_akses,
					D.color,
					D.font_color,
					D.css,
					C.id_wilayah,
					C.nama_wilayah
				FROM $this->table_name A
				LEFT JOIN simka_pegawai B ON B.id_user = A.id_user
				LEFT JOIN simka_wilayah C ON B.id_wilayah = C.id_wilayah
				LEFT JOIN simka_aplikasi_role D ON A.level_akses = D.id_akses
				WHERE A.$this->key_field IS NOT NULL";
		$sql .= (!empty($id_user)) ? " AND A.id_user  = '$id_user'" : "";
		$sql .= (!empty($status_data)) ? " AND A.status_data  = '1'" : "";
		$sql .= " ORDER BY A.$this->key_field";
		return $this->db->query($sql)->result_array();
	}

	function get_data_pegawai($id_user='', $id_wilayah=''){
		$sql = "SELECT 
					A.id_user,
					A.nip, 
					A.nip AS id_pegawai, 
					nama_pegawai, 
					foto_pegawai, 
					B.id_wilayah, 
					B.nama_wilayah,
					A.pass,
					A.real_pass,
					A.telepon,
					A.email,
					CASE 
						WHEN A.must_change IS NULL THEN 0
						ELSE A.must_change
					END AS must_change
				FROM simka_pegawai A 
				LEFT JOIN simka_wilayah B ON A.id_wilayah = B.id_wilayah 
				WHERE A.id_user IS NOT NULL";
		$sql .= (!empty($id_user)) ? " AND (A.id_user = '$id_user' OR A.nip = '$id_user')" : "";
		$sql .= (!empty($id_wilayah)) ? " AND A.id_wilayah = '$id_wilayah'" : "";
		$sql .= " ORDER BY A.nama_pegawai";
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

	function save_data_pegawai($data=array(), $mode_input){
		try{
			if(!is_array($data) || count($data)==0) throw new Exception();
			switch ($mode_input) {
				case 'update':
					$this->db->where($this->key_field, $data[$this->key_field]);
					return $this->db->update('simka_pegawai', $data);
					break;
				default:
					return $this->db->insert('simka_pegawai', $data);
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

	function get_data_profile($id_user){
		try{
			if(empty($id_user)) throw new Exception();
			$sql = "SELECT A.*
					FROM simka_aplikasi_akun A
					LEFT JOIN simka_pegawai B ON A.id_user = B.id_user
					WHERE A.id_user = '$id_user'";
			return $this->db->query($sql)->result_array();
		}catch(Exception $e){
			return false;
		}
	}
}