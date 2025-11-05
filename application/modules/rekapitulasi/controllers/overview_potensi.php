<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Overview_potensi extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = '';
		$this->load->model('rekapitulasi_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->periode = $this->get_default_request('periode', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$data['title'] = 'Rekapitulasi Potensi & Realisasi';
		$content['js'] = get_js_modules(array('rekapitulasi/ngoverview_potensi'));
		$data['content_banner'] = $this->load->view('content_banner/rekapitulasi', null, true);
		$data['content'] = $this->load->view($this->v_default.'overview_potensi_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response = $this->model_data->get_data($this->id_kecamatan, $this->id_wilayah, $periode);
		$this->_build_result($response, 'info data', 200);
	}
}