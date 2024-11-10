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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'LoginController';
$route['login/(:any)'] = 'LoginController/loginAuth/$1';

$route['main-view'] = 'MainController/mainView';
$route['user-setup'] = 'MainController/userSetup';
$route['fetch-home-content'] = 'MainController/fetchHomeContent';
$route['reserve-event-slot'] = 'MainController/reserveEventSlot';

# action button
$route['delete-event'] = 'MainController/deleteEvent';
$route['add-event'] = 'EventController/addEvent';


#event module
$route['view-event/(:num)'] = 'EventController/viewEvent/$1';
$route['get-all-user'] = 'EventController/getAllUser';
$route['scan-qr/(:num)']        = 'EventController/scanQr/$1';
$route['scan-qr-staff/(:num)']        = 'EventController/scanQrStaff/$1';
$route['scan-event/login/(:num)'] = 'EventController/timeInStudentEvent/$1';
$route['qr-staff-event/(:any)/(:num)'] = 'EventController/qrStaffEvent/$1/$2';
$route['add-bookmark'] =    'EventController/addBookmark';
#redirect
$route['success-time-in'] = 'EventController/successTimeIn';
$route['invalid-link']  = 'EventController/invalidLink';
$route['logout'] = 'logoutController/logout';

$route['account-setting'] = 'MainController/accountSetting';
$route['save-profile'] = 'MainController/saveProfile';
$route['change-password'] = 'MainController/changePassword';
$route['update-details']    = 'MainController/updateDetails';



$route['test'] = 'TesterController/dump';

#admin 
$route['admin/login'] = 'AdminController/login';
$route['admin/auth']    = 'AdminController/auth';
$route['admin/dashboard'] = 'AdminController/dashboard';



$route['reset/lock'] = 'AdminController/resetLock';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
