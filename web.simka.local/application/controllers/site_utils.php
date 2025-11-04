<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_utils extends MX_Controller {

	function __construct(){
		parent::__construct();
	}

	/*
	 * nama fungsi : _get_json_input
	 * description : mendapatkan hasil inputan json dari format request json
	 */
	function _get_json_input(){
		try{
			$data = json_decode(file_get_contents('php://input'), true);
			return $data;
		}catch(Exception $e){
			$this->_set_error_result($e->getMessage());
		}
	}

	/*
	 * nama fungsi : _set_error_result
	 * description : force display to error message
	 */
	function _set_error_result($message, $kode=400){
		$response = array(
			'type' => 'error',
			'msg' => $message,
		);
		$this->_build_error_result($response, $kode);
	}

	/*
	 * nama fungsi : _set_error_result
	 * description : generate output error
	 */
	function _build_error_result($response, $mode=''){
		$kode_header = ($mode!=='') ? $mode : 500;
		$this->output
			 ->set_header("Access-Control-Allow-Origin: *")
			 ->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin")
			 ->set_status_header($kode_header)
			 ->set_content_type('application/json')
			 ->set_output($response['msg']);
	}

	/*
	 * nama fungsi : _build_result
	 * description : generate output
	 */
	function _build_result($response, $search_type='', $mode='', $output_mode=''){

		/* 
		 *	- kode_header
		 *		* 200 : Oke
		 *		* 201 : Inserted
		 *		* 204 : No Content
		 *		* 400 : Bad Request
		 *		* 401 : Unauthorized
		 *		* 403 : Forbiden
		 *		* 404 : Not Found
		 *		* 505 : Error Source Code
		*/

		$kode_header = ($mode!=='') ? $mode : 200;
		switch (strtolower($output_mode)) {
			default:
				$data['response']  = $response;
				$this->output
					 ->set_header("Access-Control-Allow-Origin: *")
					 ->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin")
					 ->set_status_header($kode_header)
					 ->set_content_type('application/json')
					 ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
				break;
		}
	}

	/*
	 * nama fungsi : get_default_request
	 * description : untuk mendapatkan nilai default dari parameter jika tidak terisi
	 */
	function get_default_request($parameter, $return=''){
		return ($this->input->get_post($parameter)) ? $this->input->get_post($parameter) : $return;
	}

	/*
	 * nama fungsi : check_islogin
	 * description : untuk mendapatkan nilai default dari parameter jika tidak terisi
	 */
	function check_islogin(){
		$this->check_ismaintenance();
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in !== true){
			$pesan = notification_message('login_first');
			$this->session->set_flashdata('error', $pesan['message']);
			$this->session->set_flashdata('header', $pesan['header']);
			redirect(base_url().'auth');
		}
		return false;
	}

	function check_system_lock($nama_module='', $check_date=''){
		try{
			if($this->session->userdata('IS_ADMIN')){
				if(_ADMIN_FORCE){
					return true;
				}else{
					throw new Exception("Saat Ini Proses Input Output Sudah Terkunci.\nHubungi Administrator", 1);
				}
			}else{
				$this->load->model('admin/system_lock_model');
				$query = $this->system_lock_model->get_data($nama_module, 1, $check_date);
				if(count($query) > 0){
					return true;
				}else{
					throw new Exception("Saat Ini Proses Input Output Sudah Terkunci.\nHubungi Administrator", 1);
				}
			}
		}catch(Exception $e){
			$response = array(
				'type' => 'error',
				'msg' => $e->getMessage()
			);
			$this->_build_error_result($response, 500);
			die($e->getMessage());
		}
	}

	/*
	 * nama fungsi : check_ismaintenance
	 * description : untuk menginisialisasi keadaan website dalam posisi under maintenance
	 */
	function check_ismaintenance(){
		$is_maintenance = _MAINTENANCE;
		if($is_maintenance){
			redirect(base_url().'maintenance');
		}
		return false;
	}

	/*
	 * nama fungsi : check_isadmin
	 * description : untuk mendapatkan nilai default dari parameter jika tidak terisi
	 */
	function check_isadmin(){
		$is_admin = $this->session->userdata('IS_ADMIN');
		if(!isset($is_admin) && $is_admin !== '0'){
			$pesan = notification_message('permision_deny');
			$this->session->set_flashdata('error', $pesan['message']);
			$this->session->set_flashdata('header', $pesan['header']);
			redirect(base_url().'auth');
		}
		return false;
	}

	function setArray2XML($nodename,$data){
		$this->load->library('array2xml');
		$xml = $this->array2xml->createXML($nodename,$data);
		return $xml->saveXML();
	}

	function setXML2Array($xmldata){
		$this->load->library('xml2array');
		return $this->xml2array->createArray($xmldata);
	}

	function callAPI($endpoint, $operation, $accesskey='', $parameter=array(), $xmlformat=true, $callmethod='REST', $agent="MANTRA"){
		$result = false;
		$callmetho = strtoupper($callmethod);
		if(empty($endpoint)){ 
			$response = array(
				'status' => 0,
				'code' => 10001,
				'message' => 'Empty URL/EndPoint',
				'data' => ''
			);
			if($xmlformat){
				$result =   $this->setArray2XML('response',$response);
			}
			else{
				$result = array('response'=>$response);
			}
			return $result;
		}
		$endpoint .= substr($endpoint,-1) == '/' ? '' : '/';
		if(!empty($accesskey)) $accesskey .= substr($accesskey,-1) == '/' ? '' : '/';
		if(!empty($parameter)){ 
			$apar = array();
			foreach($parameter as $key=>$value){
				$apar[$key] = urlencode($value);
			}
			$parameter = $apar;
		}
		
		if($callmethod == 'RESTFULL' && !empty($parameter)):
			$reqpars = implode('/',$parameter);
			$operation .= '/'.$accesskey.$reqpars;
			$parameter = array();	
		endif;

		if($callmethod == 'RESTFULLPAR' && !empty($parameter)):
			$reqpars = '/';
			foreach($parameter as $key=>$value){
				$reqpars .= $key.'/'.$value;
			}
			$operation .= '/'.$accesskey.substr($reqpars,1);
			$parameter = array();	
		endif;
		
		$par='';
		if(!empty($parameter)) $par = http_build_query($parameter);
		if($callmethod == 'RESTFULL'){
			$uri = empty($operation)?'':$endpoint.$operation;
		}		
		elseif($callmethod == 'RESTFULLPAR'){
			$uri = empty($operation)? '' : $endpoint.$operation;
		}		
		elseif($callmethod == 'GET'){
			$uri = empty($operation) ? '' : $endpoint.$operation.'/'.$accesskey.'?'.$par;
		}		
		elseif($callmethod == 'POST'){
			$uri=empty($operation) ? '' : $endpoint.$operation.'/'.$accesskey;
		}
		else{
			$uri=empty($operation)?'':$endpoint.$operation.'/'.$accesskey.$par;
		}		
		
		if(empty($uri)){
			$response=array('status'=>0,'code'=>10002,'message'=>'Empty method','data'=>'');
			if($xmlformat){
				$result = $this->setArray2XML('response',$response);
			}
			else{
				$result=array('response'=>$response);
			}
		}
		else{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri);            
			if($agent != '') curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);         
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);  
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, FALSE);
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
			if(in_array($callmethod,array('GET','REST','RESTFULL','RESTFULLPAR')) ){
				curl_setopt($ch, CURLOPT_HTTPGET, TRUE);         
			}
			if($callmethod == 'POST'){
				curl_setopt($ch, CURLOPT_POST, TRUE);       
				curl_setopt($ch, CURLOPT_POSTFIELDS,$par);  
			}
			$result = curl_exec($ch);     
			$errno = curl_errno($ch);
			$errmsg = curl_error($ch);                   

			if ($errno!=0){                            
				$response=array('status'=>0,'code'=>$errno,'message'=>$errmsg,'data'=>'');
				if($xmlformat){
					$result = $this->setArray2XML('response',$response);
				}
				else{
					$result=array('response'=>$response);
				}
			}
			else{
				if(substr($result,0,5)!='<?xml'){
					$response = array(
						'status' => 1,
						'code' => 200,
						'message' => 'OK',
						'data' => $result
					);
					$result = $this->setArray2XML('response',$response);
				}
				if($xmlformat){
					$result=trim($result);
				}
				else{
					$result=setXML2Array($result);
				}
			}
			curl_close($ch);
		}
		return $result;
	}
}

/* End of file site_utils.php */
/* Location: ./application/controllers/site_utils.php */