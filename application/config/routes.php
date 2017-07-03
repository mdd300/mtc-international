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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller']   = 'home';
$route['404_override']         = '';
$route['translate_uri_dashes'] = TRUE;

//dinamic urls

$route['admin'] = 'admin/home/index';
$route['home']  = 'home';

$route['contato']  = 'contato';
$route['clientes']  = 'clientes_descricao/index';
$route['contato/send_contact']  = 'contato/send_contact';
$route['contato/send_work']  = 'contato/send_work';
$route['contato/send_newsletter']  = 'contato/send_newsletter';
$route['trabalhe-conosco']  = 'contato/trabalhe_conosco';
$route['area-cliente']  = 'contato/area_cliente';
$route['login-cliente']  = 'contato/login_cliente';

$route['servicos']  = 'servicos';
$route['servicos/(:any)']  = 'servicos/exibe/$1';

$route['areas-de-atuacao']  = 'areas-de-atuacao/index';
$route['operacoes']  = 'operacoes/index';
$route['sustentabilidade']  = 'sustentabilidade/index';
$route['missao-visao']  = 'missao_visao/index';
$route['tecnologia']  = 'tecnologia/index';
$route['quem-somos']  = 'quem-somos/index';

$route['busca']  = 'busca';
$route['busca/']  = 'busca';

$route['noticias'] = 'noticias/index';
$route['noticias/pesquisa/(:any)'] = 'noticias/pesquisa/$1';
$route['noticias/(:any)'] = 'noticias/show/$1';

//rewrite for lps
$route['(:any)'] = 'landing_pages/index/$1';