<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Auth extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->v_default = 'v_auth/';
		$this->load->model('user_model', 'model_data');
		$this->load->model('code_akses_model');
	}

	/*
	 * nama fungsi : index
	 * description : halaman pertama login
	 */
	function index(){
		try{
			if($this->session->userdata('is_logged_in')){
				redirect(base_url().'index/dashboard.html');
			}else{
				if($this->input->is_ajax_request()){
					throw new Exception("Error, Session Anda Sudah Habis. Refresh & Login Kembali", 1);
				}else{
					$data['title'] = 'Login';
					$content['css'] = get_css_modules(array('admin/auth'));
					$data['content'] = $this->load->view($this->v_default.'auth_index_nip', $content ,true);
					$this->load->view('template_login', $data);
				}
			}
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 403);
		}
	}

	/*
	 * nama fungsi : index_granted
	 * description : tampilan kedua setelah nip berhasil di verifikasi kedalam database pegawai
	 */
	function index_granted(){
		if($this->session->userdata('nama_pegawai')){
			$data['title'] = 'Login';
			$content['css'] = get_css_modules(array('admin/auth'));
			$data['content'] = $this->load->view($this->v_default.'auth_index_nip_password', $content ,true);
			$this->load->view('template_login', $data);
		}else{
			redirect($this->router->fetch_class());
		}
	}

	/*
	 * nama fungsi : index_reset_password
	 * description : tampilan kedua setelah nip berhasil di verifikasi kedalam database pegawai
	 */
	function index_reset_password(){
		if($this->session->userdata('nama_pegawai') && $this->session->userdata('must_change')=='1'){
			$data['title'] = 'Login - Reset Password';
			$content['css'] = get_css_modules(array('admin/auth'));
			$data['content'] = $this->load->view($this->v_default.'auth_index_nip_reset_password', $content ,true);
			$this->load->view('template_login', $data);
		}else{
			redirect($this->router->fetch_class());
		}
	}

	/*
	 * nama fungsi : validation_user
	 * description : untuk memvalidasi apakah username / NIP tersedia di database pegawai
	 */
	function validation_user(){
		$username = $this->input->post('u');
		try{
			if(empty($username)) throw new Exception();
			$query = $this->model_data->get_pegawai($username);
			if($query){
				foreach($query as $key=>$value){
					foreach($value as $k=>$v){
						$session_[$k] = $v;
					}
				}
				$query_cek_data = $this->model_data->get_data($value['id_user']);
				$tampilan_akses = (count($query_cek_data) > 0) ? false : true;
				$session_['tampilan_akses'] = $tampilan_akses;

				if(!$tampilan_akses){
					foreach ($query_cek_data as $value) {
						if($value['status_data'] || $value['is_admin']){
							$session_['is_admin'] = $value['is_admin'];
							$session_['color'] = $value['color'];
							$session_['font_color'] = $value['font_color'];
							$session_['css'] = $value['css'];
							$reset_password = $value['must_change'];
						}else{
							throw new Exception("Error, Account Suspended. Silahkan Hubungi Administrator. Untuk Informasi Lebih Lanjut", 1);
						}
					}
				}
				$this->session->set_userdata($session_);
				if($this->session->userdata('must_change') && $this->session->userdata('must_change')=='1'){
					redirect(base_url().'auth/index_reset_password');
				}else{
					redirect(base_url().'auth/index_granted');
				}
			}else{
				throw new Exception();
			}
		}catch(Exception $e){
			$this->session->set_flashdata('error', $e->getMessage());
			$this->session->set_flashdata('header', 'Fatal Error');
			redirect($this->router->fetch_class());
		}
	}

	/*
	 * nama fungsi : validation_password
	 * description : untuk memvalidasi proses login sistem dengan fetch ajax. sistem akan menyimpan semua identitas.
	 */
	function validation_password(){
		$mode_simpan = 'update';
		$level = _CODE_AKSES_DEFAULT;
		$username = $this->session->userdata('id_user');
		$password = $this->input->post('p');
		$kode_akses = $this->input->post('c');
		$simka_akun = $this->session->userdata('tampilan_akses');
		try{
			if(empty($password)) throw new Exception();
			$query = $this->model_data->get_pegawai($username, $password);
			if($query){
				$data = array(
					'id_user' => $username,
					'last_login_ip' => $this->input->ip_address(),
					'last_login_details' => $this->input->user_agent(),
				);

				foreach($query as $key=>$value){
					$level = (empty($value['level_akses'])) ? $level : $value['level_akses'];
					foreach($value as $k=>$v){
						$session_[$k] = $v;
					}
					$session_['login_time'] = date('Ymd').'T'.date('his');
					$session_['is_logged_in'] = true;
					$session_['session_key'] = true;
				}

				if($simka_akun){
					if($kode_akses){
						$query_check_akses = $this->code_akses_model->get_data('', $kode_akses, 1);
						if(count($query_check_akses) > 0){
							foreach ($query_check_akses as $key => $value) {
								$level = $value['id_akses'];
								$session_['is_admin'] = $value['is_admin'];
								$session_['color'] = $value['color'];
								$session_['font_color'] = $value['font_color'];
								$session_['css'] = $value['css'];
								$session_['must_change'] = $value['must_change'];
							}
						}else{
							throw new Exception("Error, User Level Akses Anda Tidak Dikenali Si Sistem, Hubungi Administrator", 1);
						}
					}
					$data['level_akses'] = $level;
					$mode_simpan = '';
				}
				$query_check_akses = $this->code_akses_model->get_data($level, '', 1);
				if(count($query_check_akses) < 1) throw new Exception("Error, User Level Akses Anda Tidak Dikenali Si Sistem, Hubungi Administrator", 1);
				$query_simpan = $this->model_data->save_data($data, $mode_simpan);
				$session_['level_akses'] = $level;
				$this->session->set_userdata($session_);
				redirect(base_url().'index/dashboard.html');
			}else{
				throw new Exception();
			}
		}catch(Exception $e){
			$this->session->sess_destroy();
			$this->session->set_flashdata('error', $e->getMessage());
			$this->session->set_flashdata('header', 'Fatal Error');
			redirect($this->router->fetch_class());
		}
	}

	/*
	 * nama fungsi : reset_password_password
	 * description : untuk melakukan proses reset password
	 */
	function reset_password_password(){
		$mode_simpan = 'update';
		$username = $this->session->userdata('id_user');
		$password = $this->input->post('p');
		$repassword = $this->input->post('c_p');
		try{
			if(empty($password)) throw new Exception();
			if($password!==$repassword) throw new Exception("Error, Password Yang Dimasukan Tidak Sama", 1);
			$data = array(
				'id_user' => $username,
				'pass' => md5($password),
				'must_change' => 0,
				'real_pass' => $password
			);
			$query = $this->model_data->save_data_pegawai($data, $mode_simpan);
			if($query){
				redirect(base_url().'auth/index_granted');
			}else{
				throw new Exception();
			}
		}catch(Exception $e){
			$this->session->sess_destroy();
			$this->session->set_flashdata('error', $e->getMessage());
			$this->session->set_flashdata('header', 'Fatal Error');
			redirect($this->router->fetch_class());
		}
	}

	/*
	 * nama fungsi : logout
	 * description : 
	 */
	function logout(){
		$this->session->sess_destroy();
		redirect($this->router->fetch_class());
	}

	/*
	 * nama fungsi : all_session
	 * description : 
	 */
	function all_session(){
		echo '<pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
	}
}