<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class wilayah extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_wilayah/';
		$this->load->model('wilayah_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->nama_wilayah = $this->get_default_request('nama_wilayah', '');
		$this->nama_singkat = $this->get_default_request('nama_singkat', '');
		$this->sort_order = $this->get_default_request('sort_order', '');
		$this->url_path = $this->get_default_request('url_path', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Manajemen Data Wilayah';
		$content['js'] = get_js_modules(array('admin/ngwilayah'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'wilayah_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response= $this->model_data->get_data($this->id_wilayah);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_wilayah)) throw new Exception("Error, id_wilayah Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_wilayah);
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
			if(empty($this->id_wilayah)) throw new Exception("Error, id_wilayah tidak boleh kosong", 1);
			$data = array(
				'id_wilayah' => $this->id_wilayah,
				'nama_wilayah' => $this->nama_wilayah,
				'nama_singkat' => $this->nama_singkat,
				'url_path' => $this->url_path,
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
			if(empty($this->id_wilayah)) throw new Exception("Error, id_wilayah Isian Wajib Diisi", 1);
			$data = array(
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
