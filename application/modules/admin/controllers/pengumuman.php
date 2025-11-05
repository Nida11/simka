<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class pengumuman extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_pengumuman/';
		$this->load->model('pengumuman_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_pengumuman = $this->get_default_request('id_pengumuman', '');
		$this->judul_pengumuman = $this->get_default_request('judul_pengumuman', '');
		$this->isi_pengumuman = $this->get_default_request('isi_pengumuman', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Manajemen Pengumuman';
		$content['js'] = get_js_modules(array('admin/ngpengumuman'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'pengumuman_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response= $this->model_data->get_data($this->id_pengumuman);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_pengumuman)) throw new Exception("Error, id_pengumuman Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_pengumuman);
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
				'id_pengumuman' => $this->id_pengumuman,
				'judul_pengumuman' => $this->judul_pengumuman,
				'isi_pengumuman' => $this->isi_pengumuman,
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
			if(empty($this->id_pengumuman)) throw new Exception("Error, id_pengumuman Isian Wajib Diisi", 1);
			$data = array(
				'id_pengumuman' => $this->id_pengumuman,
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
