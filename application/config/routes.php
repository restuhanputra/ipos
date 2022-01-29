<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Authentication/index';

$route['dashboard'] = 'Dashboard/index';

// AUTHENTICATION
$route['login']  = 'Authentication/index';
$route['logout'] = 'Authentication/logout';

// KATEGORI
$route['kategori']               = 'Kategori/index';
$route['kategori/add']           = 'kategori/create';
$route['kategori/delete/(:num)'] = 'kategori/delete/$1';
$route['kategori/edit/(:num)']   = 'kategori/update/$1';

// SATUAN
$route['satuan']               = 'Satuan/index';
$route['satuan/add']           = 'Satuan/create';
$route['satuan/delete/(:num)'] = 'Satuan/delete/$1';
$route['satuan/edit/(:num)']   = 'Satuan/update/$1';

// PRODUK
$route['produk']               = 'Produk/index';
$route['produk/add']           = 'Produk/create';
$route['produk/delete/(:num)'] = 'Produk/delete/$1';
$route['produk/edit/(:num)']   = 'Produk/update/$1';

// STOK MASUK
$route['stokmasuk']               = 'Stokmasuk/index';
$route['stokmasuk/add']           = 'Stokmasuk/create';
$route['stokmasuk/delete/(:num)'] = 'Stokmasuk/delete/$1';
$route['stokmasuk/edit/(:num)']   = 'Stokmasuk/update/$1';

// STOK KELUAR
$route['stokkeluar']               = 'Stokkeluar/index';
$route['stokkeluar/add']           = 'Stokkeluar/create';
$route['stokkeluar/delete/(:num)'] = 'Stokkeluar/delete/$1';
$route['stokkeluar/edit/(:num)']   = 'Stokkeluar/update/$1';

// PENGGUNA
$route['pengguna']               = 'Pengguna/index';
$route['pengguna/add']           = 'Pengguna/create';
$route['pengguna/delete/(:num)'] = 'Pengguna/delete/$1';
$route['pengguna/edit/(:num)']   = 'Pengguna/update/$1';

// PENGGUNA
$route['konfigurasi'] = 'Konfigurasi/index';

// PROFILE
$route['profile'] = 'Profile/index';

// SUPPLIER
$route['supplier']               = 'Supplier/index';
$route['supplier/add']           = 'Supplier/create';
$route['supplier/delete/(:num)'] = 'Supplier/delete/$1';
$route['supplier/edit/(:num)']   = 'Supplier/update/$1';

// PELANGGAN
$route['pelanggan']               = 'Pelanggan/index';
$route['pelanggan/add']           = 'Pelanggan/create';
$route['pelanggan/delete/(:num)'] = 'Pelanggan/delete/$1';
$route['pelanggan/edit/(:num)']   = 'Pelanggan/update/$1';

// Laporan
$route['laporan']            = 'Laporan/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
