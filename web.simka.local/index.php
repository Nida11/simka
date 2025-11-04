<?php header("X-Hiawatha-Cache: 5"); ?>
<?php
	$config_file = parse_ini_file("simka_bapenda.ini");
	define('ENVIRONMENT', $config_file['aplikasi_online_mode']);
	if (defined('ENVIRONMENT')){
		switch (ENVIRONMENT){
			case 'development': case 'devel': case 'dev': case 'develop': case 'PKB/BBNKB':
				define('DB_ENVIRONMENT', 'development');
				define('DEBUG_MODE', 'development');
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				break;
			case 'testing': case 'production': case 'beta': case 'live': case 'live':
				define('DB_ENVIRONMENT', 'production');
				define('DEBUG_MODE', 'production');
				error_reporting(0);
				break;
			case 'live_debug': case 'debug':
				define('DB_ENVIRONMENT', 'production');
				define('DEBUG_MODE', 'development');
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				break;
			default:
				exit('The application environment is not set correctly.');
		}
	}
	define('APPS_STATUS', $config_file['maintenance']);
	$system_path = 'core_system';
	$application_folder = 'application';
	if (defined('STDIN')){
		chdir(dirname(__FILE__));
	}
	if (realpath($system_path) !== FALSE){
		$system_path = realpath($system_path).'/';
	}
	$system_path = rtrim($system_path, '/').'/';
	if ( ! is_dir($system_path)){
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 |-------------------------------------------------------------------
 | Now that we know the path, set the main path constants
 |-------------------------------------------------------------------
 |
*/
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
	define('EXT', '.php');
	define('BASEPATH', str_replace("\\", "/", $system_path));
	define('FCPATH', str_replace(SELF, '', __FILE__));
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));
	if (is_dir($application_folder)){
		define('APPPATH', $application_folder.'/');
	}else{
		if ( ! is_dir(BASEPATH.$application_folder.'/')){
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}
		define('APPPATH', BASEPATH.$application_folder.'/');
	}

	define('VIEWPATH', APPPATH.'views/');
/*
 |--------------------------------------------------------------------
 | LOAD THE BOOTSTRAP FILE
 |--------------------------------------------------------------------
 |
*/
	require_once BASEPATH.'core/CodeIgniter.php';

/* End of file index.php */
/* Location: ./index.php */
