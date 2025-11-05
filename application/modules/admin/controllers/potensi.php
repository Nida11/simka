<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Potensi extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_potensi/';
		$this->load->model('potensi_model', 'model_data');
		$this->load->model('wilayah_model');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_potensi = $this->get_default_request('id_potensi', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->potensi = $this->get_default_request('potensi', '');
		$this->realisasi = $this->get_default_request('realisasi', '');
		$this->outofdate = $this->get_default_request('outofdate', '');
		$this->periode = $this->get_default_request('periode', '');
		$this->tahun = $this->get_default_request('tahun', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Manajemen Data Potensi Wilayah';
		$content['js'] = get_js_modules(array('admin/ngpotensi'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'potensi_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response = $this->model_data->get_data($this->id_potensi, $this->id_wilayah);
		$this->_build_result($response, 'info data', 200);
	}

	function get_data_wilayah(){
		$response = $this->wilayah_model->get_data();
		$this->_build_result($response, 'info data', 200);	
	}

	function delete_data(){
		try{
			if(empty($this->id_potensi)) throw new Exception("Error, id_potensi Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_potensi);
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

	function generate_tahun(){
		$this->mode_input = 'insert';
		for($i=1; $i<=12; $i++){
			$data = array(
				'id_wilayah' => $this->id_wilayah,
				'tahun' => $this->tahun,
				'periode' => str_pad($i, 2, '0', STR_PAD_LEFT)
			);
			$response = $this->model_data->save_data($data, $this->mode_input);
		}
		$response = array(
			'type' => 'Success',
			'msg' => 'Data Berhasil '.$this->mode_input
		);
		$this->_build_result($response, $this->mode_input.' data', 200);
	}

	function save_data(){
		try{
			$data = array(
				'id_potensi' => $this->id_potensi,
				'id_wilayah' => $this->id_wilayah,
				'potensi' => $this->potensi,
				'realisasi' => $this->realisasi,
				'outofdate' => $this->outofdate,
				'periode' => $this->periode,
				'tahun' => $this->tahun
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
			if(empty($this->id_potensi)) throw new Exception("Error, id_potensi Isian Wajib Diisi", 1);
			$data = array(
				'id_potensi' => $this->id_potensi,
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
