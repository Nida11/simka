<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Profile extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_user/';
		$this->load->model('user_model', 'model_data');
		$this->id_user = $this->session->userdata('id_user');
		$this->_get_request();
	}

	function _get_request(){
		$this->password_lama = $this->get_default_request('password_lama', '');
		$this->password_baru = $this->get_default_request('password_baru', '');
		$this->foto_pegawai = $this->get_default_request('foto_pegawai', '');
		$this->log_book_mode = $this->get_default_request('log_book_mode', '0');

		$this->mode_input = $this->get_default_request('mode_input', 'save');
		$this->value = $this->get_default_request('value', '');
		$this->objectname = $this->get_default_request('objectname', '');
	}

	function index(){
		$content['js'] = get_js_modules(array('admin/ngprofile'));
		$content['id_user'] = $this->id_user;
		$data['title'] = 'Index';
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'profile_index', $content, true);;
		$this->load->view('template_main', $data);
	}

	function get_data(){
		$response = $this->model_data->get_data_profile($this->id_user);
		$this->_build_result($response, 'info data', 200);
	}

	function delete_akun(){
		try{
			$response = $this->model_data->delete_data($this->id_user);
			if(!$response) throw new Exception("Error, Delete Data Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Privileges Berhasil Direset, Data Efektif Berubah Setelah Di Logout'
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
				'id_user' => $this->id_user,
				'nip' => $this->nip
			);
			$response = $this->model_data->save_data_pegawai($data, $this->mode_input);
			if(!$response) throw new Exception("Error, $this->mode_input Data Modul Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Data Berhasil '.$this->mode_input.'. Data Efektif Berubah Setelah Di Logout'
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

	function save_profile(){
		try{
			$data = array(
				'id_user' => $this->id_user,
				'foto_pegawai' => $this->foto_pegawai,
			);
			$response = $this->model_data->save_data_pegawai($data, $this->mode_input);
			if(!$response) throw new Exception("Error, $this->mode_input Data Modul Gagal", 1);
			$response = array(
				'type' => 'Success',
				'msg' => 'Data Berhasil '.$this->mode_input.'. Data Efektif Berubah Setelah Di Logout'
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

	function change_password(){
		$id_user = $this->session->userdata('id_user');
		try{
			if(empty($this->password_lama)) throw new Exception("Error, Password Lama Tidak Boleh Kosong", 1);
			$query = $this->model_data->get_pegawai($id_user, $this->password_lama);
			if($query){
				$data = array(
					'id_user' => $id_user,
					'password' => md5($this->password_baru),
					'real_password' => $this->password_baru,
				);
				$response = $this->model_data->save_data_pegawai($data, 'update');
				if(!$response) throw new Exception("Error, Ganti Password Gagal", 1);
				$response = array(
					'type' => 'Success',
					'msg' => 'Data Berhasil '.$this->mode_input.'. Data Efektif Berubah Setelah Di Logout'
				);
				$this->_build_result($response, $this->mode_input.' data', 200);
			}else{
				throw new Exception("Error, Password Lama Tidak Sesuai", 1);
			}
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
		}
	}

	function upload_profile($id_pegawai=''){
		$target = $this->config->item('doc_root');
		$baseUploadFolder = $this->config->item('upload_base_profile');
		$targetFolder = $target.'/../'.$baseUploadFolder;
		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$fileName_original = $_FILES['file']['name'];
			$type = $_FILES['file']['type'];
			$fileSize = $_FILES['file']['size'];
			$fileParts = pathinfo($_FILES['file']['name']);

			if(empty($id_pegawai)){
				$waktu = date('ym');;
				$get_sequence_foto = rand(1111111111,9999999999);
				$get_sequence_foto = $waktu.'-'.$get_sequence_foto.'.'.$fileParts['extension'];
				$fileName = strtolower(str_replace(' ', '_', $get_sequence_foto));
			}else{
				$fileName = strtolower($id_pegawai.'.'.$fileParts['extension']);
			}
			$targetFile = rtrim($targetPath,'/') . '/' . $fileName;
			$fileTypes = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
			if (in_array($fileParts['extension'],$fileTypes)) {
				try{
					if(move_uploaded_file($tempFile,$targetFile)){
						try{
							echo $fileName;
						}catch(Exception $e){
							throw new Exception('Gagal Insert Ke Database, Hubungi Administrator');
						}
					}else{
						throw new Exception('Gagal Melakukan Unggah Berkas');
					}
				}catch(Exception $e){
					header('HTTP/1.0 500 Server Error');
					die('Ups, Terjadi Kesalahan Dalam Upload Data');
				}
			}else{
				header('HTTP/1.0 500 Server Error');
				die('Invalid file type.');
			}
		}
	}

	function toogle_data(){
		try{
			if(empty($this->nip)) throw new Exception("Error, nip Isian Wajib Diisi", 1);
			$data = array(
				'user_id' => $this->nip,
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