<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Index extends Site_utils {
	
	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->load->model('admin/pengumuman_model');
		$this->load->model('admin/potensi_model');
		$this->load->model('rekapitulasi/rekapitulasi_model');
		$this->id_wilayah = $this->session->userdata('id_wilayah');
		$this->nama_wilayah = $this->session->userdata('nama_wilayah');
		$this->_get_request();
	}

	function _get_request(){
		$this->bulan = $this->get_default_request('bulan', date('m'));
		$this->tahun = $this->get_default_request('tahun', date('Y'));

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}
	
	function index(){
		redirect(base_url().'dashboard.html');
	}

	function dashboard($data=''){	
		$content['js'] = get_js_modules(array('index/ngindex'));
		$content['bulan'] = $this->bulan;
		$content['tahun'] = $this->tahun;
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/index', null, true);
		$data['content'] = $this->load->view('index_index', $content, true);;
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$periode = $this->tahun.$this->bulan;
		$response['pengumuman'] = $this->pengumuman_model->get_data('', '1');
		$response['realisasi'] = $this->rekapitulasi_model->get_data($this->id_wilayah);
		$response['potensi'] = $this->potensi_model->get_data('', $this->id_wilayah);
		$this->_build_result($response, 'info data', 200);
	}

	function maintenance(){
		$content = array();
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/index', null, true);
		$data['content'] = $this->load->view('index_maintenance_index', $content, true);;
		$this->load->view('template_main', $data);
	}

}