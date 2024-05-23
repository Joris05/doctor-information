<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'auth';

$route['dashboard'] = 'dashboard';
$route['logout'] = 'dashboard/logout';

$route['doctor/new'] = 'doctor/formadd';
$route['doctor/list'] = 'doctor/formlist';
$route['doctor/edit/(:any)'] = 'doctor/formEdit/$1';
$route['doctor/detail/(:any)'] = 'doctor/formView/$1';
$route['doctor/details/store'] = 'doctor/store';
$route['doctor/details/put'] = 'doctor/put';
$route['doctor/details/delete'] = 'doctor/delete';
$route['doctor/get/list'] = 'doctor/get';

$route['user/new'] = 'users/formadd';
$route['user/list'] = 'users/formlist';
$route['user/edit/(:any)'] = 'users/formEdit/$1';
$route['user/details/store'] = 'users/store';
$route['user/details/put'] = 'users/put';
$route['user/details/delete'] = 'users/delete';
$route['user/details/reset'] = 'users/reset';
$route['user/get/list'] = 'users/get';

$route['report/upcoming'] = 'reports/upcoming';
$route['report/recently'] = 'reports/recently';

$route['default_controller'] = 'welcome';
$route['404_override'] = 'errorpage';
$route['translate_uri_dashes'] = FALSE;
