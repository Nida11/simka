<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	include APPPATH.'controllers/site_utils.php';
	class Identitas_kendaraan extends Site_utils {
		
		function __construct(){
			parent::__construct();
			$this->check_islogin();
			$this->v_default = 'v_scan_data/';
			$this->load->model('identitas_kendaraan_model', 'model_data');
			$this->load->model('admin/wilayah_model', 'wilayah_model');
			$this->_get_request();
		}
		
		function _get_request(){
			$this->id_identitas_kendaraan = $this->get_default_request('id_identitas_kendaraan', '');
			$this->no_polisi = $this->get_default_request('no_polisi', '');
			// 20Feb19
			$this->kd_plat = $this->get_default_request('kd_plat', '');
			$this->no_polisi_format = $this->get_default_request('no_polisi_format', '');
			$this->no_mesin = $this->get_default_request('no_mesin', '');
			$this->no_rangka = $this->get_default_request('no_rangka', '');
			$this->id_wilayah = $this->get_default_request('id_wilayah', '');
			$this->id_kecamatan = $this->get_default_request('id_kecamatan', '');
			$this->nama_pemilik = $this->get_default_request('nama_pemilik', '');
			$this->tgl_akhir_pajak = $this->get_default_request('tgl_akhir_pajak', '');
			$this->tgl_akhir_stnk = $this->get_default_request('tgl_akhir_stnk', '');
			
			$this->mode_input = $this->get_default_request('mode_input', 'save');
			$this->value = $this->get_default_request('value', '');
			$this->objectname = $this->get_default_request('objectname', '');
		}
		
		function index(){
			$data['title'] = 'Manajemen Data Identitas Kendaraan';
			$content['js'] = get_js_modules(array('scan_data/ngidentitas_kendaraan'));
			$content['css'] = get_css_modules(array('scan_data/identitas_kendaraan'));
			$data['content_banner'] = $this->load->view('content_banner/manajemen_data', null, true);
			$data['content'] = $this->load->view($this->v_default.'identitas_kendaraan_index', $content ,true);
			$this->load->view('template_main', $data);
		}
		
		function get_data(){
			$data = array(
			'id_identitas_kendaraan' => $this->id_identitas_kendaraan,
			'no_polisi' => $this->no_polisi,
			'no_polisi_format' => $this->no_polisi_format,
			'no_mesin' => $this->no_mesin,
			'no_rangka' => $this->no_rangka,
			'a.id_wilayah' => $this->id_wilayah,
			'a.id_kecamatan' => $this->id_kecamatan,
			'nama_pemilik' => $this->nama_pemilik,
			'tgl_akhir_pajak' => $this->tgl_akhir_pajak,
			'tgl_akhir_stnk' => $this->tgl_akhir_stnk,
			);
			$response= $this->model_data->get_data($data);
			$this->_build_result($response, 'info data', 200);
		}
		
		function sync_data($no_polisi=''){
			
			$url = 'http://puslia.jabarprov.go.id/bapenda_rest/simka/get_info_kbm/';
			$method = 'simka';
			$accesskey = '6unDulMu';
			
			//$url = 'http://192.168.99.13/mantra/api/bapenda/publish_simka/';
			
			//$url = 'http://puslia.jabarprov.go.id/mantra/api/bapenda/publish_simka/';
			//$method = 'trx_simka';
			//$accesskey = 'vszaf93ux6';
			
			//$accesskey = 'nmslzb77bs';
			
			try{
				$data_config_wilayah = array();
				$this->no_polisi = (!empty($no_polisi)) ? $no_polisi : $this->no_polisi;
				$no_polisi = str_replace(' ', '-', $this->no_polisi);
				$no_polisi = str_replace('--', '-', $no_polisi);
				$no_polisi = str_replace('---', '-', $no_polisi);
				$no_polisi = str_replace('----', '-', $no_polisi);
				$no_polisi = str_replace('-----', '-', $no_polisi);
				$no_polisi = strtoupper($no_polisi);
				
				// 20Feb19
				($this->kd_plat == '') ? $kd_plat = 1 : $kd_plat = $this->kd_plat;
				$var = array('no_polisi' => $no_polisi, 'kd_plat' => $kd_plat);
				//$result = $this->callAPI($url,$method,$accesskey,$var,true,'POST');
				
				
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://puslia.jabarprov.go.id/bapenda_rest/simka/get_info_kbm/?no_polisi=' .$no_polisi. '&kode_plat=' .$kd_plat,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
				'Authorization: Basic c2lta2E6NnVuRHVsTXU=',
				'Content-Type:application/json'
				),
				));
				
				$show_data = curl_exec($curl);
				
				curl_close($curl);
				
				//$data = $this->setXML2Array($show_data);
				//$show_data = json_encode($show_data, true);
				
				// $data = str_replace('&quot;', '"', $data);
				//$show_data = trim(str_replace('\n', '', $show_data));
				
				
				$dataArray = ((array) json_decode($show_data));
				$datadec = json_decode($show_data);
				//$datadec = json_decode($show_data,true);
				//$dataArray = json_decode(json_encode($show_data),true);
				
				//echo $datadecs->no_mesin;
				//var_dump(json_decode($datadec, true));
				
				//if(array_key_exists('data', $data['response']) && is_array($data['response']['data'])){
				//$data_decode = str_replace('&quot;', '"', $data['response']['data']['get_simka']['output']);
				//$data_decode = json_decode($data_decode, true);
				
				if (!empty($datadec->no_polisi)){
					//$data_decode = str_replace('&quot;', '"', $datadec->no_polisi);
					$data_decode = json_decode(json_encode($dataArray),true);;
					
					//if(count($data_decode) > 0){
					//$data_semua = array();
					//$data_semua = array_merge($data_semua, $data_decode);
					
					if(count($data_decode) > 0){
						$data_semua = array();
						$data_semua = array_merge($data_semua ,$data_decode);
						
						//$id_wilayah = $data_semua[0]['kd_wil'];
						$id_wilayah = $datadec->kd_wil;
						if(!empty($id_wilayah) || $id_wilayah !== ''){
							$query  = $this->wilayah_model->get_data($id_wilayah);
							foreach($query as $key=>$v_wilayah){
								$data_config_wilayah = array(
								'url_path' => $v_wilayah['url_path'],
								'url_local_path' => URL_LOCAL_PARENT.$v_wilayah['url_path'].'\\',
								'nama_singkat' => $v_wilayah['nama_singkat'],
								);
							}
							//$data_semua = array_merge($data_semua[0], $data_config_wilayah);
							$data_semua = array_merge($data_semua, $data_config_wilayah);
							}else{
							throw new Exception("Error, Data Kosong", 1);
						}
						
						$data_semua = array_filter(array_map('trim', $data_semua));
						// print_r($data_semua);
						$response = array('data_simka' => array($data_semua));
						}else{
						$response = array();
					}
					
					$this->_build_result($response, 'info data', 200);
					}else{
					//throw new Exception("Error, ". $data['response']['message'], 1);
					throw new Exception("Error, Data Kosong", 1);
				}
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
				if(empty($this->id_wilayah)) throw new Exception("Error, id_wilayah tidak boleh kosong", 1);
				$data = array(
				'no_polisi' => $this->no_polisi,
				'no_polisi_format' => $this->no_polisi_format,
				'no_mesin' => $this->no_mesin,
				'no_rangka' => $this->no_rangka,
				'id_wilayah' => $this->id_wilayah,
				'id_kecamatan' => $this->id_kecamatan,
				'nama_pemilik' => $this->nama_pemilik,
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
				if(empty($this->id_identitas_kendaraan)) throw new Exception("Error, id_identitas_kendaraan Isian Wajib Diisi", 1);
				$data = array(
				'id_identitas_kendaraan' => $this->id_identitas_kendaraan,
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
