<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config_file = parse_ini_file("simka_bapenda.ini");

/*
 *-----------------------------------
 * project configuration
 *-----------------------------------
 *
 */
$project_name = 'base_project';
$root = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

/*
 *-----------------------------------
 * Upload Document configuration
 *-----------------------------------
 *
 */
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$dir = dirname(__DIR__);
$doc_root = str_replace("\\","/",$doc_root);
$dir = str_replace("\\","/",$dir);
$web_dir = str_replace($doc_root,'',$dir);

$config['upload_base']			= 'public/';
$config['upload_base_profile']  = $config['upload_base'].'foto_pegawai';
$config['upload_scan_data']		= $config['upload_base'].'file_transcan';
$config['doc_root']				= $web_dir;
$config['upload_root']			= $root.$config['upload_base'];

/*
 *-----------------------------------
 * layout configuration
 *-----------------------------------
 *
 */
$config['site_title']           = $config_file['site_title'];
$config['browser_title']        = $config_file['company_sort_name'].' &bullet; '.strtoupper($config['site_title']);
$config['footer_credit']        = strtoupper($config['site_title']).' '.$config_file['company_name'].' - Data Terpadu '.$config_file['company_sort_name'].' <br> '.$config_file['company_detail'].' <br> &copy; '.$config_file['aplication_sort_name'].' - '.date('Y');
$config['author']               = $config_file['company_name'] .' | '.$config_file['company_detail'];
$config['description']          = $config_file['aplication_name'];
$config['search_description']   = $config_file['aplication_name'];
$config['mini_description']     = $config_file['aplication_name'];

/*
 *-----------------------------------
 * codeigniter base configuration
 *-----------------------------------
 *
 */
$config['base_url']             = "$root"; 
$config['index_page']           = '';
$config['modules_locations']    = array(APPPATH.'modules/' => '../modules/');
$config['uri_protocol']         = 'AUTO';
$config['url_suffix']           = '.html';
$config['language']             = 'english';
$config['charset']              = 'UTF-8';
$config['enable_hooks']         = FALSE;
$config['subclass_prefix']      = 'MY_';
$config['permitted_uri_chars']  = 'a-z 0-9~%.:_\-';
$config['allow_get_array']      = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']   = 'c';
$config['function_trigger']     = 'm';
$config['directory_trigger']    = 'd';
$config['log_threshold']        = 1;
$config['log_path']             = '';
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['cache_path']           = '';

$encryption_key = md5($project_name);
$config['encryption_key']       = $encryption_key;
$config['sess_cookie_name']     = $project_name;
$config['sess_expiration']      = $config_file['session_expiration'];
$config['sess_expire_on_close'] = TRUE;
$config['sess_encrypt_cookie']  = FALSE;
$config['sess_use_database']    = FALSE;
$config['sess_table_name']      = 'ci_sessions_'.$project_name;
$config['sess_match_ip']        = FALSE;
$config['sess_match_useragent'] = FALSE;
$config['sess_time_to_update']  = 300;
$config['cookie_prefix']        = "";
$config['cookie_domain']        = "";
$config['cookie_path']          = "/";
$config['cookie_secure']        = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection']      = FALSE;
$config['csrf_token_name']      = 'csrf_test_name';
$config['csrf_cookie_name']     = 'csrf_cookie_name';
$config['csrf_expire']          = 7200;
$config['compress_output']      = FALSE;
$config['time_reference']       = 'gmt';
$config['rewrite_short_tags']   = FALSE;
$config['proxy_ips']            = '';

/*
 *-----------------------------------
 * constant
 *-----------------------------------
 * constanta dibagi menjadi beberapa bagian utama :
 * 1. assets
 * 2. proses (modules sistem)
 * 3. ajax (modules ajax_request)
 *
 */
define('_MAINTENANCE', $config_file['maintenance']);
define('_CODE_AKSES_DEFAULT', $config_file['code_akses_default']);

define('_ROOT', $root);
define('_ASSETS', $root.'assets/');
define('_IMG', _ASSETS.'img/');
define('_IMG_LOGO', _IMG.'logo/');
define('_IMG_LOADER', _IMG.'loader/');
define('_IMG_COMPONENT', _IMG.'component/');
define('_CSS', _ASSETS.'css/');
define('_JS', _ASSETS.'js/');
define('_UPLOAD_ROOT', $config['upload_root']);
define('_INPUT_SISTEM', false);
define('_DATE_FORMAT', date('d').'-'.date('m').'-'.date('Y'));

define('URL_LOCAL_PARENT', $config_file['url_local_parent']);
define('URL_CLOUD_PARENT', $config['upload_scan_data']);

/* End of file config.php */
/* Location: ./application/config/config.php */
