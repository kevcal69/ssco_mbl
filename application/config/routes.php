<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['trainee/scheduled_test/(:any)'] = 'trainee/scheduled_test/$1';
$route['trainee/scheduled_test'] = 'trainee/scheduled_test';
$route['trainee/test/(:any)'] = 'trainee/test/$1';
$route['trainee/module/(:any)'] = 'trainee/module/$1';
$route['trainee/module'] = 'trainee/module';
$route['trainee/(:any)'] = 'trainee/trainee/$1';
$route['trainee'] = 'trainee/trainee';
$route['admin'] = 'admin_functions/admin';
$route['admin/module/(:any)'] = 'admin_functions/module/$1';
$route['admin/module'] = 'admin_functions/module';
$route['admin/user/(:any)'] = 'admin_functions/user/$1';
$route['admin/user'] = 'admin_functions/user';
$route['admin/question'] = 'admin_functions/question';
$route['admin/question/(:any)'] = 'admin_functions/question/$1';
$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */