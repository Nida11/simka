<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$autoload['packages']  = array(APPPATH.'third_party');
	$autoload['libraries'] = array('database', 'session', 'user_agent', 'form_validation');
	$autoload['helper']    = array('url', 'form', 'html', 'text', 'u_data', 'u_date', 'u_property', 'u_string'); 
	$autoload['config']    = array();
	$autoload['language']  = array();
	$autoload['model']     = array();


/* End of file autoload.php */
/* Location: ./application/config/autoload.php */
