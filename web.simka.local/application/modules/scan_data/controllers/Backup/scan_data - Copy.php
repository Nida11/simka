<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'controllers/site_utils.php';
class Scan_data extends Site_utils {

	function __construct(){
		parent::__construct();
		//$this->check_islogin();
		$this->v_default = 'v_scan_data/';
		$this->load->model('scan_data_model', 'model_data');
		$this->_get_request();
	}

	function _get_request(){
		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');

		//DRR 7Feb19
		$this->no_scan = $this->get_default_request('no_scan', '');
		$this->no_scan_multiple = $this->get_default_request('no_scan_multiple', '');
		$this->no_polisi = $this->get_default_request('no_polisi', '');
		$this->no_polisi_format = $this->get_default_request('no_polisi_format', '');
		$this->no_mesin = $this->get_default_request('no_mesin', '');
		$this->no_rangka = $this->get_default_request('no_rangka', '');
		$this->id_wilayah = $this->get_default_request('id_wilayah', '');
		$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
		$this->nama_pemilik = $this->get_default_request('nama_pemilik', '');
		$this->tgl_scan = $this->get_default_request('tgl_scan', '');
		$this->tgl_akhir_pajak = $this->get_default_request('tgl_akhir_pajak', '');
		$this->tgl_akhir_stnkb = $this->get_default_request('tgl_akhir_stnkb', '');
		$this->tgl_proses_daftar = $this->get_default_request('tgl_proses_daftar', '');
		$this->tgl_proses_tetap = $this->get_default_request('tgl_proses_tetap', '');
		$this->tgl_proses_bayar = $this->get_default_request('tgl_proses_bayar', '');
		$this->tgl_akhir_pjklm = $this->get_default_request('tgl_akhir_pjklm', '');
		$this->tgl_akhir_pjkbr = $this->get_default_request('tgl_akhir_pjkbr', '');
	}

	function index(){
		$content['js'] = get_js_modules(array('scan_data/ngscan_data'));
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/scan_data', null, true);
		$data['content'] = $this->load->view($this->v_default.'scan_data_index', $content, true);;
		$this->load->view('template_main', $data);
	}

	function list_scan_data(){
		$content['js'] = get_js_modules(array('scan_data/ngscan_data'));
		$content['css'] = get_css_modules(array('scan_data/identitas_kendaraan'));
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/scan_data', null, true);
		$data['content'] = $this->load->view($this->v_default.'scan_data_list_index', $content, true);;
		$this->load->view('template_main', $data);	
	}

	function drr_list_scan_data(){
		$content['js'] = get_js_modules(array('scan_data/nglist_scan'));
		$content['css'] = get_css_modules(array('scan_data/identitas_kendaraan'));
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/scan_data', null, true);
		//$content['tampil'] = $this->model_data->get_data_scan();
		$data['content'] = $this->load->view($this->v_default.'drr_scan_data_list_index', $content, true);;
		$this->load->view('template_main', $data);	
	}

	// DRR 13Des18
	function drr_get_data_scan() {
		$response= $this->model_data->get_data_scan($this->no_scan, $this->tgl_scan);
		$this->_build_result($response, 'info data', 200);
	}

	//DRR 7Feb19
	function drr_get_data_scan_raw() {
		$response= $this->model_data->get_data_scan_raw($this->no_scan, $this->no_scan_multiple);
		$this->_build_result($response, 'info data', 200);
	}

	//DRR 7Feb19
	function drr_download_image() {
		$contents = $this->input->post('image_contents');
		$no_scan = $this->input->post('no_scan');
        $extension = 'png';
        if (is_null($contents) || is_null($extension)) {
            show_error('Image contents empty');
        }
        $name = $no_scan .'.' . strtolower($extension);
        $contents = base64_decode($contents);
        $this->load->helper('download');
        force_download($name, $contents);
	}

	function get_data(){
		$response['data_scan_data'] = $this->model_data->get_data($this->id_module);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_data(){
		try{
			if(empty($this->id_module)) throw new Exception("Error, id_module Isian Wajib Diisi", 1);
			$response = $this->model_data->delete_data($this->id_module);
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

	function deleteScan() {
		try{
			if(empty($this->no_scan)) throw new Exception("Error, no_scan Isian Wajib Diisi", 1);
			$response = $this->model_data->deleteScan($this->no_scan, $this->no_polisi, $this->no_mesin, 
				$this->no_rangka, $this->id_wilayah, $this->id_kecamatan, $this->nama_pemilik, $this->tgl_akhir_pajak, 
				$this->tgl_akhir_stnkb, $this->tgl_proses_daftar, $this->tgl_proses_tetap, $this->tgl_proses_bayar,
				$this->tgl_akhir_pjklm, $this->tgl_akhir_pjkbr);
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
				'no_scan' => $this->no_scan,
				'id_wilayah' => $this->id_wilayah,
				'id_kecamatan' => $this->id_kecamatan,
				'tgl_akhir_pajak' => $this->tgl_akhir_pajak,
				'tgl_akhir_stnkb' => $this->tgl_akhir_stnkb,
				'tgl_proses_daftar' => $this->tgl_proses_daftar,
				'tgl_proses_tetap' => $this->tgl_proses_tetap,
				'tgl_proses_bayar' => $this->tgl_proses_bayar,
				'tgl_akhir_pjklm' => $this->tgl_akhir_pjklm,
				'tgl_akhir_pjkbr' => $this->tgl_akhir_pjkbr,
			);
			$response = $this->model_data->insert_data($data, $this->mode_input);
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

	//DRR 7Feb19
	function insert_data() {
		try{
			error_reporting(0);
			$no_polisi = $this->input->post('no_polisi');
			$no_polisi_format = $this->input->post('no_polisi_format');
			$no_mesin = $this->input->post('no_mesin');
			$no_rangka = $this->input->post('no_rangka');
			$id_wilayah = $this->input->post('id_wilayah');
			$id_kecamatan = $this->input->post('id_kecamatan');
			$nama_pemilik = $this->input->post('nama_pemilik');
			$tgl_akhir_pajak = $this->input->post('tgl_akhir_pajak');
			$tgl_akhir_stnkb = $this->input->post('tgl_akhir_stnkb');
			$tgl_proses_daftar = $this->input->post('tgl_proses_daftar');
			$tgl_proses_tetap = $this->input->post('tgl_proses_tetap');
			$tgl_proses_bayar = $this->input->post('tgl_proses_bayar');
			$tgl_akhir_pjklm = $this->input->post('tgl_akhir_pjklm');
			$tgl_akhir_pjkbr = $this->input->post('tgl_akhir_pjkbr');

			//plat
			$plat = $no_polisi_format;
			$nm_file = str_replace("-", "", $plat);
			$noPolisi_format = $plat;
			// $plat1 = explode(" ", $plat);
			// preg_match("/([a-zA-Z]+)(\\d+)/", $plat1[1], $plat2);
			// $nm_file = $plat1[0] . $plat2[2] . $plat2[1];
			// $noPolisi_format = $plat1[0] .'-'. $plat2[2] .'-'. $plat2[1];
			// $nopolSplit = str_replace(" ", $plat);
			// preg_match("/([a-zA-Z]+)/", $nopolSplit, $nopolHuruf);
			// preg_match("/(\d+)/", $nopolSplit, $nopolAngka);
			// $nm_file = substr($nopolHuruf[0],0,1) . $nopolAngka[0] . substr($nopolHuruf[0],1);
			// $noPolisi_format = substr($nopolHuruf[0],0,1). '-' . $nopolAngka[0] . '-' . substr($nopolHuruf[0],1);
			
			// path
			$path_img = $this->input->post('file_image') . $nm_file .'-'. 
						$this->input->post('no_scan').'-'. 
						$this->session->userdata('id_user').'.'. 
						$this->input->post('ImageType2');
						// 'PNG';
			// img to base64
			$img = str_replace('\\', '/', $path_img);
			// $type     = pathinfo($img, PATHINFO_EXTENSION);
			// $gambar     = $_FILES['RemoteFile']['tmp_name'];
			// $gambar2     = file_get_contents($gambar);
			// $conv_img = base64_encode($gambar2);

			$data = array(
				'no_scan' => $this->input->post('no_scan'),
				'id_wilayah' => $id_wilayah,
				'id_kecamatan' => $id_kecamatan,
				'no_polisi' => $no_polisi,
				'file_image' => $path_img,
				'user_upload' => $this->session->userdata('id_user'),
				'status_data' => 1,
				'tgl_scan' => date("Y-m-d"),
				'tgl_akhir_pajak' => $tgl_akhir_pajak,
				'tgl_akhir_stnkb' => $tgl_akhir_stnkb,
				'tgl_proses_daftar' => $tgl_proses_daftar,
				'tgl_proses_tetap' => $tgl_proses_tetap,
				'tgl_proses_bayar' => $tgl_proses_bayar,
				'tgl_akhir_pjklm' => $tgl_akhir_pjklm,
				'tgl_akhir_pjkbr' => $tgl_akhir_pjkbr,
				'tgl_insrow' => date("Y-m-d H:i:s")
			);

			$data2 = array(
				'no_polisi' => $no_polisi,
				'no_polisi_format' => $noPolisi_format,
				'no_mesin' => $no_mesin,
				'no_rangka' => $no_rangka,
				'id_wilayah' => $id_wilayah,
				'id_kecamatan' => $id_kecamatan,
				'nama_pemilik' => $nama_pemilik,
				'tgl_akhir_pajak' => $tgl_akhir_pajak,
				'tgl_akhir_stnkb' => $tgl_akhir_stnkb,
				'tgl_proses_daftar' => $tgl_proses_daftar,
				'tgl_proses_tetap' => $tgl_proses_tetap,
				'tgl_proses_bayar' => $tgl_proses_bayar,
				'tgl_akhir_pjklm' => $tgl_akhir_pjklm,
				'tgl_akhir_pjkbr' => $tgl_akhir_pjkbr,
				'sync_status' => 1,
				'sync_tgl_insrow' => date("Y-m-d H:i:s"),
				'tgl_insrow' => date("Y-m-d H:i:s")
			);

			$cek_noPol = $this->model_data->cek_noPol($no_polisi, $no_mesin, $no_rangka, 
														$id_wilayah, $id_kecamatan, $nama_pemilik, 
														$tgl_akhir_pajak, $tgl_akhir_stnkb, $tgl_proses_daftar, 
														$tgl_proses_tetap, $tgl_proses_bayar, $tgl_akhir_pjklm, $tgl_akhir_pjkbr);

			if (!$cek_noPol) {
				$response = $this->model_data->insert_data($data, $this->mode_input);
				$response = $this->model_data->insert_data2($data2, $this->mode_input); //identitas
			}else{
				$response = $this->model_data->insert_data($data, $this->mode_input);
			}

			// $response = $this->model_data->insert_data($data, $this->mode_input);
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

	// DRR 7Feb19
	public function gambar($no_scan, $no_scan_multiple) {
		// $gambar     = $_FILES['RemoteFile']['tmp_name'];
		// $data     = file_get_contents($gambar);
		// $conv_img = base64_encode($data);

		$source				= "./assets/dok/".$_FILES['RemoteFile']['name'];
		$destination_medium	= "./assets/dok/medium/";

		move_uploaded_file($_FILES['RemoteFile']['tmp_name'], $source);

		list($width, $height) = getimagesize($source);

		$this->load->library('image_lib');
		$img['image_library'] = 'GD2';
		$img['maintain_ratio']= TRUE;

		/// Limit Width Resize
		$limit_medium   = 1024;
		$limit_thumb    = 220;

		// Size Image Limit was using (LIMIT TOP)
		$limit_use  = $width > $height ? $width : $height;

		// Percentase Resize
		if ($limit_use > $limit_medium) {
			$percent_medium = $limit_medium/$limit_use;
		}

		////// Making MEDIUM /////////////
		$img['width']   = $limit_use > $limit_medium ?  $width * $percent_medium : $width;
		$img['height']  = $limit_use > $limit_medium ?  $height * $percent_medium : $height;

		// Configuration Of Image Manipulation :: Dynamic
		$img['thumb_marker'] = '';
		$img['quality']      = '100%';
		$img['source_image'] = $source;
		$img['new_image']    = $destination_medium;
									
		// Do Resizing
		$this->image_lib->initialize($img);
		$this->image_lib->resize();
		$this->image_lib->clear() ;

		// $file_test = $n_baru;

		$data     = file_get_contents($destination_medium.$_FILES['RemoteFile']['name']);
		$conv_img = base64_encode($data);

		$data = array(
			'no_scan' => $no_scan,
			'no_scan_multiple' => $no_scan_multiple,
			'img_raw' => $conv_img
		);

		$this->db->insert('simka_data_scan_imgraw', $data);

		unlink($source);
		unlink($destination_medium.$_FILES['RemoteFile']['name']);
	}
	// public function gambar($no_scan, $no_scan_multiple) {
	// 	$gambar     = $_FILES['RemoteFile']['tmp_name'];
	// 	$data     = file_get_contents($gambar);
	// 	$conv_img = base64_encode($data);

	// 	// $data = array(
	// 	// 	'img_raw' => $conv_img, 
	// 	// );
	// 	// $this->db->where('no_scan', $no_scan);
	// 	// $this->db->update('simka_data_scan', $data);

	// 	$data = array(
	// 		'no_scan' => $no_scan,
	// 		'no_scan_multiple' => $no_scan_multiple,
	// 		'img_raw' => $conv_img
	// 	);

	// 	$this->db->insert('simka_data_scan_imgraw', $data);

	// 	// unlink($gambar);
	// }

	function toogle_data(){
		try{
			if(empty($this->id_module)) throw new Exception("Error, id_module Isian Wajib Diisi", 1);
			$data = array(
				'id_module' => $this->id_module,
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