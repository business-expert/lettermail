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

$route['default_controller']    = "index_page";

//// Ponudba
$route['trenutna-ponudba']                   = "ponudbe/currentOffers";
$route['prihajajoce-ponudbe']                = "ponudbe/comingOffers";
$route['v-izteku']                           = "ponudbe/endingOffers";
$route['ponudba/(:any)']                     = "ponudbe/det/$1";
$route['predogled/(:any)']                   = "ponudbe/detID/$1";
$route['danes-novo']                         = "ponudbe/newOffers";
$route['pretekle-ponudbe']                   = "ponudbe/doneOffers";

//// Regije
$route['regija/(:any)']                      = "ponudbe/regions/$1";
$route['regije']                             = "ponudbe/regions";
$route['nastaviRegijo']                      = "index_page/nastaviRegijo";

////  Vsebina   
$route['vsebina/(:any)']                     = "content/detail/$1";

//////  Blog 
$route['blog/(:any)']                        = "blog/detail/$1";

////  Košarica
$route['kupi/(:num)']                        = "shopping/add/$1";
$route['kupi/(:num)/(:any)']                 = "shopping/add/$1/$2";
$route['kosarica']                           = "shopping/view";
$route['kosarica/naprej']                    = "shopping/next";

////  Uporabnik
$route['registracija']                       = "register";
$route['odjavi-me']                          = "login/logout";
$route['uporabnik/podatki/(:num)']           = "user/detail/$1";
$route['uporabnik/nakupi/(:num)']            = "user/payments/$1";

//// Ponudnik
$route['ponudnik']                           = "admin/ponudnik";


$route['404_override']          = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */