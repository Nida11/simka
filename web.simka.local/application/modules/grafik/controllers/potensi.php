<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Potensi extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = '';
		$this->load->model('potensi_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->tahun = $this->get_default_request('sync_tahun', '');
		$this->bulan = $this->get_default_request('sync_bulan', '');
		$this->tanggal1 = $this->get_default_request('sync_tanggal1', '');
		$this->tanggal2 = $this->get_default_request('sync_tanggal2', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
	}

	public function index()	{
		$data['title'] = 'Laporan Potensi Wilayah';
		$content['js'] = get_js_modules(array('grafik/ngpotensi'));
		$data['content_banner'] = $this->load->view('content_banner/potensi', null, true);
		$data['content'] = $this->load->view($this->v_default.'potensi_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data_chart($tipe) {
		// $response = $this->model_data->get_data($this->tahun, $this->bulan, $this->tanggal1, $this->tanggal2);
		$response = $this->model_data->get_data_wilayah($tipe, $this->tahun, $this->bulan, $this->tanggal1, $this->tanggal2);
		$this->_build_result($response, 'info data', 200);
	}

}

/* End of file Potensi.php */
/* Location: ./application/modules/grafik/controllers/Potensi.php */