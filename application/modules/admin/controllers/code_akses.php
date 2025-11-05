<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class code_akses extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_code_akses/';
		$this->load->model('code_akses_model', 'model_data');
		$this->load->model('module_akses_model');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_akses = $this->get_default_request('id_akses', '');
		$this->nama_akses = $this->get_default_request('nama_akses', '');
		$this->kode_secret = $this->get_default_request('kode_secret', '');
		$this->color = $this->get_default_request('color', '');
		$this->font_color = $this->get_default_request('font_color', '');
		$this->css = $this->get_default_request('css', '');
		$this->deskripsi = $this->get_default_request('deskripsi', '');
		$this->parameter = $this->get_default_request('parameter', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Manajemen User';
		$content['js'] = get_js_modules(array('admin/ngcode_akses'));
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'code_akses_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response['data1'] = $this->model_data->get_data($this->id_akses);
		$response['data2'] = $this->module_akses_model->get_data_modul_akses($this->id_akses);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_akses)) throw new Exception("Error, id_akses Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_akses);
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
			if(empty($this->id_akses)) throw new Exception("Error, id_akses tidak boleh kosong");
			$data = array(
				'id_akses' => $this->id_akses,
				'nama_akses' => $this->nama_akses,
				'kode_secret' => $this->kode_secret,
				'deskripsi' => $this->deskripsi,
				'color' => $this->color,
				'font_color' => $this->font_color,
				'css' => $this->css
			);
			$response = $this->model_data->save_data($data, $this->mode_input);

			if($this->mode_input == 'update'){
				if(!empty($this->parameter)){
					foreach($this->parameter as $value){
						$data = array(
							'id_module' => $value['id_module'],
							'id_code_akses' => $value['id_code_akses'],
						);
						$this->module_akses_model->save_code_access_menu($data);
					}
				}
			}
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
			if(empty($this->id_akses)) throw new Exception("Error, id_akses Isian Wajib Diisi", 1);
			$data = array(
				'id_akses' => $this->id_akses,
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
