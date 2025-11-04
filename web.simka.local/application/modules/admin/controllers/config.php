<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH.'controllers/site_utils.php';
class Config extends Site_utils {

	function __construct(){
		parent::__construct();
		$this->check_islogin();
		$this->v_default = 'v_config/';
		$this->file_name = 'simka_bapenda.ini';
	}

	function index(){
		$content['js'] = get_js_modules('admin/ngconfig');
		$content['ini_array'] = parse_ini_file($this->file_name);
		$data['title'] = 'Admin Index';
		$data['content_banner'] = $this->load->view('content_banner/admin', null, true);
		$data['content'] = $this->load->view($this->v_default.'config_index', $content, true);
		$this->load->view('template_main', $data);
	}

	function save_config(){
		$data = $this->input->post();
		try{
			if($this->save_ini_config($data)){
				redirect('admin/config/index','refresh');
			}
		}catch(Exception $e){

		}
	}

	function save_ini_config($data){
		if ($fp = fopen($this->file_name, 'w')){
	        $startTime = microtime(TRUE);
	        do{
	        	$canWrite = flock($fp, LOCK_EX);
	           	if(!$canWrite) usleep(round(rand(0, 100)*1000));
	        } while ((!$canWrite) and ( (microtime(TRUE)-$startTime) < 5));

	        $res = array();
		    foreach($data as $key => $val){
		        if(is_array($val)){
		            $res[] = "[$key]";
		            foreach($val as $skey => $sval) {
		            	$res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
		            }
		        }else {
		        	$res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
		        }
		    }
		    $res = implode("\r\n", $res);
	        if($canWrite){            
	        	fwrite($fp, $res);
	            flock($fp, LOCK_UN);
	        }
	        fclose($fp);
	        return true;
	    }
	    return false;
	}
}