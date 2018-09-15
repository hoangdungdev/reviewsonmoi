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

$route['default_controller'] = "home/index";
$route['404_override'] = 'hd';
$route['lien-he'] = "home/contact";
$route['nhan-mail'] = "home/recivemail";
$route['nhan-xet'] = "home/comment";
$route['danh-muc/(:any)'] = "home/danhmuc/$1";
$route['tim-kiem'] = "home/timkiem";

$route['san-pham/(:any)'] = "home/product/$1";
$route['san-pham'] = "home/listproduct";

$route['tin-tuc/(:any)/(:any)'] = "home/chitiettintuc/$1/$2";
$route['tin-tuc/(:any)'] = "home/loaitintuc/$1";
$route['tin-tuc'] = "home/tintuc";
$route['chinh-sach/(:any)'] = "home/chinhsach/$1";
// $route['thiet-ke-bao-li-xi'] = "home/post/2";
// $route['in-bao-li-xi'] = "home/post/3";

$route['gioi-thieu/(:any)'] = "home/chitietgioithieu/$1";
$route['gioi-thieu'] = "home/gioithieu";
$route['dpadmin'] = "admin/auth/login";
$route['dpadmin/(:any)'] = "admin/$1";
$route['dang-nhap'] = "home/login";
$route['dang-ky'] = "home/register";
$route['doi-mat-khau'] = "home/changepass";
$route['don-hang'] = "home/donhang";
$route['xem-don-hang/(:any)'] = "home/chitietdonhang/$1";
$route['thoat'] = "home/logout";
$route['thong-tin'] = "home/profile";
$route['khuyen-mai'] = "home/listproductsale";