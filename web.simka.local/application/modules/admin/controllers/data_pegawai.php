<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Data_pegawai extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_user/';
		$this->load->model('user_model', 'model_data');
		$this->load->model('wilayah_model');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_user = $this->get_default_request('id_user', '');
		$this->pass = $this->get_default_request('pass', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->nama_pegawai = $this->get_default_request('nama_pegawai', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Data Pegawai';
		$content['js'] = get_js_modules(array('admin/ngdata_pegawai'));
		$content['css'] = get_css_modules(array('index/index'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'data_pegawai_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$this->id_wilayah = ($this->session->userdata('is_admin')!=='1') ? $this->session->userdata('id_wilayah') : '';
		$response['data_pegawai'] = $this->model_data->get_data_pegawai($this->id_user, $this->id_wilayah);
		$response['data_wilayah'] = $this->wilayah_model->get_data();
		$this->_build_result($response, 'info data', 200);
	}

	function save_data(){
		try{
			if(empty($this->id_user)) throw new Exception("Error, id_user tidak boleh kosong");
			$data = array(
				'id_user' => $this->id_user,
				'id_wilayah' => $this->id_wilayah,
				'nama_pegawai' => $this->nama_pegawai
			);
			if(!empty($this->pass)){
				$data = array_merge($data, array(
					'pass' => md5($this->pass),
					'real_pass' => $this->pass
				));
			}
			$response = $this->model_data->save_data_pegawai($data, $this->mode_input);
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
			if(empty($this->id_user)) throw new Exception("Error, id_user Isian Wajib Diisi", 1);
			$data = array(
				'id_user' => $this->id_user,
				$this->objectname => $this->value
			);
			$response = $this->model_data->save_data_pegawai($data, $this->mode_input);
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
