<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "index";
$route['404_override'] = '';
$route['maintenance'] = 'index/maintenance';

/** Primary Route **/
$route['dashboard'] = "index/dashboard";

/** Module: admin/auth **/
$route['auth'] = 'admin/auth';
$route['auth/validation_user'] = 'admin/auth/validation_user';
$route['auth/validation_password'] = 'admin/auth/validation_password';
$route['auth/index_granted'] = 'admin/auth/index_granted';
$route['auth/index_reset_password'] = 'admin/auth/index_reset_password';
$route['auth/logout'] = 'admin/auth/logout';
$route['auth/reset_password_password'] = 'admin/auth/reset_password_password';


/** operasional route **/
$route['potensi'] = 'admin/potensi';

/* End of file routes.php */
/* Location: ./application/config/routes.php */