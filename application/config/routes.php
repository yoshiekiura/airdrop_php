<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'client/login/login';
//$route['login'] = 'application/views/client/login.php';
$route['forgot_password'] = 'client/login/forgot_password';
$route['register'] = 'client/login/register';
$route['dashboard'] = 'client/airdrop';
//$route['airdrop'] = 'client/airdrop';
$route['profile'] = 'client/profile';
$route['airdrop-status'] = 'client/airdrop/status_page';
$route['airdrop-campaign'] = 'client/campaign';
$route['airdrop-submission'] = 'client/submits/index';
$route['airdrop-transaction'] = 'client/transaction/index';

$route['ico-transaction'] = 'client/ICO/transaction_page';
$route['ico-purchase'] = 'client/ICO/purchase_page';
$route['ico-purchase_test'] = 'client/ICO/purchase_page_test';
$route['webhook-endpoint'] = 'home/listen_webhook';

$route['referral'] = 'client/referral';
$route['logout'] = 'client/airdrop/logout';
$route['login/reset_password/(:any)/(:any)'] = 'client/login/reset_password/$1/$2';
$route['login/activate/(:any)/(:any)'] = 'client/login/activate/$1/$2';
$route['settings'] = 'client/settings/index';
$route['change_password']='client/profile/change_password';
$route['adminlogin']='admin/login/index';
$route['admin_password'] = 'admin/User/profile';
$route['change_admin_password'] = 'admin/User/change_password';

$route['ref/(:any)'] = "home/ref/$1";

$route['test'] = 'home/bladeTest';

$route['main'] = 'home/main';
