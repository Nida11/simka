<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Produksi extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = '';
		$this->load->model('produksi_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->periode = $this->get_default_request('periode', '');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');

		$this->tahun = $this->get_default_request('sync_tahun', '');
		// $this->bulan = $this->get_default_request('sync_bulan', '');
		$this->bulan1 = $this->get_default_request('sync_bulan1', '');
		$this->bulan2 = $this->get_default_request('sync_bulan2', '');
		$this->tanggal1 = $this->get_default_request('sync_tanggal1', '');
		$this->tanggal2 = $this->get_default_request('sync_tanggal2', '');
	}

	function index(){
		$data['title'] = 'Laporan Grafik Produksi';
		$content['js'] = get_js_modules(array('grafik/ngproduksi'));
		$data['content_banner'] = $this->load->view('content_banner/produksi', null, true);
		$data['content'] = $this->load->view($this->v_default.'produksi_index', $content ,true);
		$this->load->view('template_main', $data);
	}

	function get_data_user() {
		$response = $this->model_data->get_data_user();
		$this->_build_result($response, 'info data', 200);
	}

	function get_data_chart($user_upload = '') {
		if (!empty($user_upload)) {
			if ($this->bulan1 != '' && $this->bulan2 != '') {
				$bulan1 = explode("-", $this->bulan1);
				$bulan2 = explode("-", $this->bulan2);
				$response = $this->model_data->get_data($user_upload, $this->tahun, $bulan1[0], $bulan2[0], $bulan1[1], $bulan2[1]);
			} else {
				$response = $this->model_data->get_data($user_upload, $this->tahun);
			}
		} else {
			if ($this->bulan1 != '' && $this->bulan2 != '') {
				$bulan1 = explode("-", $this->bulan1);
				$bulan2 = explode("-", $this->bulan2);
				$response = $this->model_data->get_data_all($this->tahun, $bulan1[0], $bulan2[0], $bulan1[1], $bulan2[1]);
			} else {
				$response = $this->model_data->get_data_all($this->tahun);
			}
		}
		
		$this->_build_result($response, 'info data', 200);
	}

}