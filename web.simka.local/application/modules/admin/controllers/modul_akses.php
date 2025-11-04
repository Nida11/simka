<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Modul_akses extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_modul_akses/';
		$this->load->model('module_akses_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_module = $this->get_default_request('id_module', '');
		$this->id_parent_module = $this->get_default_request('id_parent_module', '');
		$this->nama_module = $this->get_default_request('nama_module', '');
		$this->code_module = $this->get_default_request('code_module', '');
		$this->route = $this->get_default_request('route', '');
		$this->sort_order = $this->get_default_request('sort_order', '');
		$this->id_code_akses = $this->get_default_request('id_code_akses', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$content['js'] = get_js_modules(array('admin/ngmodul_akses'));
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'modul_akses_index', $content, true);;
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response = $this->model_data->get_data($this->id_module);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_module)) throw new Exception("Error, id_module Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_module);
			if(!$response) throw new Exception("Error, Delete Data Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Data Berhasil Dihapus'
			);
			$this->_build_result($response, 'delete data', 200);
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
		}
	}

	function delete_module_menu_data(){
		try{
			if(empty($this->id_module)) throw new Exception("Error, id_module Isian Wajib Diisi", 1);
			$data = array(
				'id_module' => $this->id_module,
				'id_code_akses' => $this->id_code_akses,
			);
			$response = $this->model_data->delete_code_access_menu($data);
			if(!$response) throw new Exception("Error, Delete Data Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Data Berhasil Dihapus'
			);
			$this->_build_result($response, 'delete data', 200);
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
		}
	}

	function save_data(){
		try{
			$data = array(
				'id_module' => $this->id_module,
				'id_parent_module' => $this->id_parent_module,
				'nama_module' => $this->nama_module,
				'code_module' => $this->code_module,
				'route' => $this->route,
				'sort_order' => $this->sort_order
			);
			$response = $this->model_data->save_data($data, $this->mode_input);
			if(!$response) throw new Exception("Error, $this->mode_input Data Modul Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Data Berhasil '.$this->mode_input
			);
			$this->_build_result($response, $this->mode_input.' data', 200);
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
		}
	}

	function toogle_data(){
		try{
			if(empty($this->id_module)) throw new Exception("Error, id_module Isian Wajib Diisi", 1);
			$data = array(
				'id_module' => $this->id_module,
				$this->objectname => $this->value
			);
			$response = $this->model_data->save_data($data, $this->mode_input);
			if(!$response) throw new Exception("Error, $this->mode_input Data Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => $this->objectname.' Berhasil '.$this->mode_input
			);
			$this->_build_result($response, $this->mode_input.' data', 200);
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
		}	
	}
}