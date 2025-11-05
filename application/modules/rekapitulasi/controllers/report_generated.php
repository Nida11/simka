<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Report_generated extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = '';
		$this->load->model('report_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->sync_tahun = $this->get_default_request('sync_tahun', '');
		$this->sync_produksi1 = $this->get_default_request('sync_produksi1', '');
		$this->sync_produksi2 = $this->get_default_request('sync_produksi2', '');
		$this->sync_wilayah1 = $this->get_default_request('sync_wilayah1', '');
		$this->sync_wilayah2 = $this->get_default_request('sync_wilayah2', '');
		$this->sync_kecamatan1 = $this->get_default_request('sync_kecamatan1', '');
		$this->sync_kecamatan2 = $this->get_default_request('sync_kecamatan2', '');
		$this->sync_tgl_akhir_pajak1 = $this->get_default_request('sync_tgl_akhir_pajak1', '');
		$this->sync_tgl_akhir_pajak2 = $this->get_default_request('sync_tgl_akhir_pajak2', '');
		$this->sync_tgl_akhir_stnkb1 = $this->get_default_request('sync_tgl_akhir_stnkb1', '');
		$this->sync_tgl_akhir_stnkb2 = $this->get_default_request('sync_tgl_akhir_stnkb2', '');

		$this->coba = $this->get_default_request('coba', '');
	}

	public function index() {
		$data['title'] = 'Report Generated System';
		$content['js'] = get_js_modules(array('rekapitulasi/ngreport_generated'));
		$data['content_banner'] = $this->load->view('content_banner/report_generated', null, true);
		if($this->session->userdata('is_admin')){
		$data['content'] = $this->load->view($this->v_default.'report_generated_index', $content ,true);}
		else{$data['content'] = $this->load->view($this->v_default.'report_generated_non_index', $content ,true);}
		$this->load->view('template_main', $data);
	}

	function proses_generated()	{
		$response = $this->model_data->proses_generated('proses',
			$this->sync_tahun,
			$this->sync_produksi1, $this->sync_produksi2,
			$this->sync_wilayah1, $this->sync_wilayah2,
			$this->sync_kecamatan1, $this->sync_kecamatan2,
			$this->sync_tgl_akhir_pajak1, $this->sync_tgl_akhir_pajak2,
			$this->sync_tgl_akhir_stnkb1, $this->sync_tgl_akhir_stnkb2
		);
		$this->_build_result($response, 'info data', 200);
	}

	function proses_generated2()	{
		$response = $this->model_data->proses_generated2('proses',
			$this->sync_tahun,
			$this->sync_produksi1, $this->sync_produksi2
		);
		$this->_build_result($response, 'info data', 200);
	}

	function tampilData() {
		$response = $this->model_data->proses_generated('tampil',
			$this->sync_tahun,
			$this->sync_produksi1, $this->sync_produksi2,
			$this->sync_wilayah1, $this->sync_wilayah2,
			$this->sync_kecamatan1, $this->sync_kecamatan2,
			$this->sync_tgl_akhir_pajak1, $this->sync_tgl_akhir_pajak2,
			$this->sync_tgl_akhir_stnkb1, $this->sync_tgl_akhir_stnkb2
		);
		$this->_build_result($response, 'info data', 200);
	}

	function tampilData2() {
		$response = $this->model_data->proses_generated2('tampil',
			$this->sync_tahun,
			$this->sync_produksi1, $this->sync_produksi2
		);
		$this->_build_result($response, 'info data', 200);
	}

}

/* End of file report_generated.php */
/* Location: ./application/modules/rekapitulasi/controllers/report_generated.php */