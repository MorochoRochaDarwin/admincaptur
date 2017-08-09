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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logout'] = 'welcome/logout';
$route['home'] = 'admin';
$route['password'] = 'admin/password';
$route['radares'] = 'admin/list_radares';
$route['canton/([0-9]+)'] = 'admin/canton/$1';
$route['canton/([0-9]+)/establecimientos'] = 'admin/establecimientos_canton/$1';
$route['canton/([0-9]+)/eventos'] = 'admin/eventos_canton/$1';
$route['establecimiento/([0-9]+)'] = 'admin/establecimiento/$1';
$route['evento/([0-9]+)'] = 'admin/evento/$1';

//ajax
$route['ajax/update-canton']['post'] = 'admin/actualizar_canton';
$route['ajax/nueva-portada']['post'] = 'admin/nueva_portada';
$route['ajax/eliminar-portada']['post'] = 'admin/eliminar_portada';
$route['ajax/password-change']['post'] = 'admin/password_change';
$route['ajax/establecimientos']['post'] = 'admin/establecimientos';
$route['ajax/eventos']['post'] = 'admin/eventos';
$route['ajax/radares']['post'] = 'admin/radares';
$route['ajax/nuevo-establecimiento']['post'] = 'admin/nuevo_establecimiento';
$route['ajax/edit-establecimiento']['post'] = 'admin/edit_establecimiento';
$route['ajax/edit-evento']['post'] = 'admin/edit_evento';
$route['ajax/nuevo-evento']['post'] = 'admin/nuevo_evento';
$route['ajax/nuevo-radar']['post'] = 'admin/nuevo_radar';
$route['ajax/eliminar-establecimiento']['post'] = 'admin/eliminar_establecimiento';
$route['ajax/eliminar-evento']['post'] = 'admin/eliminar_evento';
$route['ajax/eliminar-radar']['post'] = 'admin/eliminar_radar';




//post
$route['verificar-login']['post'] = 'welcome/login';