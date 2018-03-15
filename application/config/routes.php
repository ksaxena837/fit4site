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

$route['default_controller'] = "home";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['registerMe'] = 'login/registerMe';
$route['profile'] = 'user/getProfileDetail';
$route['startchat'] = 'user/userChat';

$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";

$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";
/*************************************Product Module ***********************************************/
$route['account/product-list'] = 'account/product';
$route['account/add-product'] = 'account/product/addNew';
$route['account/product-edit/(:num)'] = 'account/product/editProduct/$1';


$route['account/subcategory_view'] = 'account/product/subcategory_view';
$route['account/product-status/(:num)/(:num)'] = 'account/product/ProductStatus/$1/$2';
$route['account/product-delete/(:num)'] = 'account/product/deleteProduct/$1';
$route['account/add-category'] = 'account/product/addCategory';
$route['account/edit-category'] = 'account/product/editCategory';
$route['account/edit-category/(:num)'] = 'account/product/editCategory/$1';
$route['account/category-delete/(:num)'] = 'account/product/deleteCategory/$1';
$route['account/category-status/(:num)/(:num)'] = 'account/product/CategoryStatus/$1/$2';
/***************************************End Product Module *****************************************/
/*----------- For Sub Category Page --------------------------------------------- */
$route['account/add-subcategory/(:num)'] = 'account/category/addSubCategory/$1';
$route['account/view-subcategory/(:num)']	= 'account/category/viewSubCategory/$1';
$route['account/edit-subcategory/(:num)']	= 'account/category/editSubCategory/$1';
$route['account/sub-category-delete/(:num)']	= 'account/category/SubCategoryDelete/$1';
/*----------- For Sub Category Page --------------------------------------------- */

/***************Frontend ROUTES *******************************/
$route['about-us'] = 'home/about';
$route['contact-us'] = 'home/contact';
$route['our-services'] = 'home/services';
$route['portfolio'] = 'home/portfolio';
$route['featured-job'] = 'home/jobs';
$route['search-job'] = 'home/searchJob';
$route['shop'] = 'home/shop';
$route['featured-job/(:num)'] = 'home/jobs/$1';
$route['single-job/(:num)'] = 'home/singleJob/$1';
$route['shop/product-by-category/(:any)'] = 'shop/shopByCategoryId/$1';

/************ Group Module ******************/






/*******************Group Module End Here *************/

/* End of file routes.php */
/* Location: ./application/config/routes.php */
