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
$route['default_controller']      = 'welcome';
$route['404_override']            = 'welcome/error';
$route['translate_uri_dashes']    = FALSE;

/* Admin */
$route['pasery']        = 'admin/auth';
/* Admin Dashboard */
$route['pasery/dashboard']  = 'admin/dashboard';
/* Admin Pos */
$route['pasery/post']                       = 'admin/post';
$route['pasery/post/add']                   = 'admin/post/add';
$route['pasery/post/edit/(:any)']           = 'admin/post/edit/$1';
$route['pasery/post/remove']                = 'admin/post/remove';
$route['pasery/post/category']              = 'admin/category';
$route['pasery/post/category/edit/(:any)']  = 'admin/category/edit/$1';
$route['pasery/post/category/remove']       = 'admin/category/remove';
/* Admin Library */
$route['pasery/library']              = 'admin/library';
$route['pasery/library/add']          = 'admin/library/add';
$route['pasery/library/edit/(:any)']  = 'admin/library/edit/$1';
$route['pasery/library/remove']       = 'admin/library/remove';
/* Admin Gallery */
$route['pasery/gallery']                = 'admin/gallery';
$route['pasery/gallery/add']            = 'admin/gallery/add';
$route['pasery/gallery/edit/(:any)']    = 'admin/gallery/edit/$1';
$route['pasery/gallery/remove']         = 'admin/gallery/remove';
$route['pasery/gallery/library/(:any)'] = 'admin/gallery/library/$1';
/* Admin Document */
$route['pasery/document']                = 'admin/document';
$route['pasery/document/add/(:any)']     = 'admin/document/add/$1';
$route['pasery/document/(:any)']         = 'admin/document/parent/$1';
$route['pasery/document/edit/(:any)']    = 'admin/document/edit/$1';
$route['pasery/document/remove']         = 'admin/document/remove';
$route['pasery/document/library/(:any)'] = 'admin/document/library/$1';
/* Admin Page */
$route['pasery/page']                = 'admin/page';
$route['pasery/page/add']            = 'admin/page/add';
$route['pasery/page/edit/(:any)']    = 'admin/page/edit/$1';
$route['pasery/page/remove']         = 'admin/page/remove';
$route['pasery/page/library/(:any)'] = 'admin/page/library/$1';
/* Admin Profile */
$route['pasery/user']              = 'admin/user';
$route['pasery/user/add']          = 'admin/user/add';
$route['pasery/user/edit/(:any)']  = 'admin/user/edit/$1';
$route['pasery/user/remove']       = 'admin/user/remove';
$route['pasery/profile']           = 'admin/profile';
/* Admin Setting */
$route['pasery/setting']                      = 'admin/setting';
$route['pasery/setting/menu']                 = 'admin/menu';
$route['pasery/setting/menu/add']             = 'admin/menu/add';
$route['pasery/setting/menu/(:any)']          = 'admin/menu/edit/$1';
$route['pasery/setting/slide']                = 'admin/slide';
$route['pasery/setting/slide/add']            = 'admin/slide/add';
$route['pasery/setting/slide/remove']         = 'admin/slide/remove';
$route['pasery/setting/link']                 = 'admin/link';
$route['pasery/setting/link/add']             = 'admin/link/add';
$route['pasery/setting/link/library']         = 'admin/link/library';
$route['pasery/setting/link/library/(:any)']  = 'admin/link/library_edit/$1';
$route['pasery/setting/link/edit/(:any)']     = 'admin/link/edit/$1';
$route['pasery/setting/link/remove']          = 'admin/link/remove';

/* Page */
$route['page/(:any)']                 = 'public/page/read/$1';
/* Post */
$route['post']                        = 'public/post';
$route['post/(:num)']                 = 'public/post/index/$1';
$route['post/(:any)']                 = 'public/post/read/$1';
$route['post/author/(:any)']          = 'public/post/author/$1';
$route['post/author/(:any)/(:num)']   = 'public/post/author/$1/$2';
$route['post/category/(:any)']        = 'public/post/category/$1';
$route['post/category/(:any)/(:num)'] = 'public/post/category/$1/$2';
/* Gallery */
$route['gallery']                     = 'public/gallery';
$route['gallery/(:num)']              = 'public/gallery/index/$1';
$route['gallery/(:any)']              = 'public/gallery/view/$1';
/* Documnet */
$route['document']                    = 'public/document';
$route['document/(:num)']             = 'public/document/index/$1';
$route['document/parent/(:any)']             = 'public/document/parent/$1';
$route['document/parent/(:any)/(:num)']      = 'public/document/parent/$1/$2';
$route['document/download/(:any)']    = 'public/document/download/$1';
$route['document/search']             = 'public/document/search';
$route['document/search/']            = 'public/document/search/$1';
