<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Kecamatan extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_wilayah/';
		$this->load->model('kecamatan_model', 'model_data');
		$this->load->model('wilayah_model');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->nama_kecamatan = $this->get_default_request('nama_kecamatan', '');
		$this->nama_kota = $this->get_default_request('nama_kota', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Manajemen Data Kecamatan';
		$content['js'] = get_js_modules(array('admin/ngkecamatan'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'kecamatan_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response['data_kecamatan'] = $this->model_data->get_data($this->id_kecamatan, $this->id_wilayah);
		$response['data_wilayah'] = $this->wilayah_model->get_data($this->id_wilayah);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_kecamatan)) throw new Exception("Error, id_kecamatan Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_kecamatan, $this->id_wilayah);
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
				'id_kecamatan' => $this->id_kecamatan,
				'id_wilayah' => $this->id_wilayah,
				'nama_kecamatan' => $this->nama_kecamatan,
				'nama_kota' => $this->nama_kota,				
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
			if(empty($this->id_kecamatan)) throw new Exception("Error, id_kecamatan Isian Wajib Diisi", 1);
			$data = array(
				'id_kecamatan' => $this->id_kecamatan,
				'id_wilayah' => $this->id_wilayah,
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
