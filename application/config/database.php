<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// switch (DB_ENVIRONMENT) {
// 	case 'development':
// 		$hostname = '15.1.1.100';
// 		$username = 'simka';
// 		$password = 'Lampu2014';
// 		$database = 'bapenda_jabar_dev';
// 		break;
// 	case 'production': case 'debug':
// 		$hostname = '15.1.1.100';
// 		$username = 'simka';
// 		$password = 'Lampu2014';
// 		$database = 'bapenda_jabar_dev';
// 		break;
// }

$active_group  = "default";
$active_record = TRUE;
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'simka';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = FALSE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
